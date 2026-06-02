<?php
$dir = __DIR__ . '/resources/views/backend/pages/certificate';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
$count = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        
        if (strpos($path, 'voter_area') !== false || strpos($path, 'nid_correction') !== false) {
            continue;
        }

        $content = file_get_contents($path);
        $originalContent = $content;

        // Fix the double 'ইউনিয়ন পরিষদ' and 'Union Parishad' in headers and signatures
        $content = str_replace("{{ \$certificate->user->institute->union->bn_name ?? '' }} ইউনিয়ন পরিষদ", "{{ \$certificate->user->institute->union->bn_name ?? '' }}", $content);
        $content = str_replace("{{ \$certificate->user->institute->union->name ?? '' }} Union Parishad", "{{ \$certificate->user->institute->union->name ?? '' }}", $content);

        // Remove font-weight:600 from Chairman name
        $content = preg_replace('/style="font-weight:600;"\s*>\(\{\{\s*\$certificate->user->institute->superUser->people->bn_name/', '>({{ $certificate->user->institute->superUser->people->bn_name', $content);
        $content = preg_replace('/style="font-weight:600;"\s*>\(\{\{\s*\$certificate->user->institute->superUser->people->name/', '>({{ $certificate->user->institute->superUser->people->name', $content);

        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Fixed: " . basename($path) . " in " . dirname($path) . "\n";
            $count++;
        }
    }
}

echo "Total files fixed: $count\n";
