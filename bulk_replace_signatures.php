<?php
/**
 * Bulk replace hardcoded chairman signatures with shared partial in certificate blade files
 */

$certificatePath = __DIR__ . '/resources/views/backend/pages/certificate';

// Recursive directory traversal
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($certificatePath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

$replacementPattern = <<<'EOD'
@include('backend.partials.chairman_signature', ['certificate' => $certificate])
EOD;

// Pattern to match the old chairman div signature block
$patterns = [
    // Pattern 1: With hardcoded chairman name (Mohammad Rana)
    '/(<div class="certificate-signature">\s*<div class="qr-code"[^>]*>.*?<\/div>\s*)<div class="chairman">\s*<div style="height:40px;"><\/div>\s*<p class="mb-1">\([^)]*\)<\/p>\s*<p class="mb-0">Chairman<\/p>\s*<p class="mb-0">.*?<\/p>\s*<p class="mb-0" style="font-size:14px;">.*?<\/p>\s*<\/div>\s*<\/div>/is',
    // Pattern 2: With Bengali chairman name
    '/(<div class="certificate-signature">\s*<div class="qr-code"[^>]*>.*?<\/div>\s*)<div class="chairman">\s*<div style="height:40px;"><\/div>\s*<p class="mb-1">\([^)]*\)<\/p>\s*<p class="mb-0">চেয়ারম্যান<\/p>\s*<p class="mb-0">.*?<\/p>\s*<p class="mb-0" style="font-size:14px;">.*?<\/p>\s*<\/div>\s*<\/div>/is',
];

$count = 0;
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'blade' && strpos($file->getFilename(), '.blade.php') !== false) {
        $filePath = $file->getPathname();
        $content = file_get_contents($filePath);
        
        // Check if file contains old signature pattern
        if (preg_match('/<div class="chairman">/', $content)) {
            // Try to replace each pattern
            $newContent = $content;
            $replaced = false;
            
            // Simple replacement: find the old signature block and replace with include
            if (preg_match_all('/(<div class="certificate-signature">[\s\S]*?<div class="qr-code"[^>]*>[\s\S]*?<\/div>)\s*<div class="chairman">[\s\S]*?<\/div>\s*<\/div>/i', $newContent, $matches)) {
                foreach ($matches[1] as $openDiv) {
                    $oldBlock = $openDiv . '
                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1">(' . (strpos($filePath, 'bn_') ? 'মোহাম্মাদ রানা' : 'Mohammad Rana') . ')</p>
                        <p class="mb-0">' . (strpos($filePath, 'bn_') ? 'চেয়ারম্যান' : 'Chairman') . '</p>';
                    
                    // This is complex, so let's use a simpler approach
                }
                
                // Simpler direct replacement
                $newContent = preg_replace(
                    '/<div class="chairman">[\s\S]*?<\/div>\s*<\/div>\s*$/m',
                    '@include(\'backend.partials.chairman_signature\', [\'certificate\' => $certificate])',
                    $newContent
                );
            }
            
            if ($newContent !== $content) {
                file_put_contents($filePath, $newContent);
                echo "Updated: " . str_replace(__DIR__, '', $filePath) . "\n";
                $count++;
            }
        }
    }
}

echo "\nTotal files updated: $count\n";
?>
