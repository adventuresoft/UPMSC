<?php
$dir = __DIR__ . '/resources/views/backend/pages/certificate';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$count = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        $content = file_get_contents($path);
        $originalContent = $content;

        // Is it a Bengali certificate or English?
        $isBn = (strpos($file->getFilename(), 'bn_') !== false);

        if ($isBn) {
            // Header Replacements
            $content = preg_replace('/৩\s*নং শুকতাইল ইউনিয়ন পরিষদ/u', '{{ $certificate->user->institute->union->bn_name ?? \'\' }} ইউনিয়ন পরিষদ', $content);
            $content = preg_replace('/উপজেলা: <span>গোপালগঞ্জ সদর<\/span>/u', 'উপজেলা: <span>{{ $certificate->user->institute->union->thana->bn_name ?? \'\' }}</span>', $content);
            $content = preg_replace('/জেলা: <span>গোপালগঞ্জ<\/span>/u', 'জেলা: <span>{{ $certificate->user->institute->union->thana->district->bn_name ?? \'\' }}</span>', $content);

            // Signature Replacements
            $content = preg_replace('/\(মোহাম্মাদ রানা\)/u', '({{ $certificate->user->institute->superUser->people->bn_name ?? $certificate->user->institute->superUser->name ?? \'চেয়ারম্যান\' }})', $content);
            
            // Signature address replacements (sometimes they hardcoded text without span)
            $content = preg_replace('/গোপালগঞ্জ সদর, গোপালগঞ্জ/u', '{{ $certificate->user->institute->union->thana->bn_name ?? \'\' }}, {{ $certificate->user->institute->union->thana->district->bn_name ?? \'\' }}', $content);
            
        } else {
            // English Certificate Header Replacements
            $content = preg_replace('/৩\s*নং শুকতাইল ইউনিয়ন পরিষদ/u', '{{ $certificate->user->institute->union->bn_name ?? \'\' }} ইউনিয়ন পরিষদ', $content);
            $content = preg_replace('/No\.\s*3\s+S[h]?uktail Union Parishad/i', '{{ $certificate->user->institute->union->name ?? \'\' }} Union Parishad', $content);
            
            // English Signature Replacements
            $content = preg_replace('/\(Mohammad Rana\)/i', '({{ $certificate->user->institute->superUser->people->name ?? $certificate->user->institute->superUser->name ?? \'Chairman\' }})', $content);
            $content = preg_replace('/No\.3\s*Shuktail Union Parishad\s*/i', '{{ $certificate->user->institute->union->name ?? \'\' }} Union Parishad', $content);
        }

        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Updated: " . basename($path) . " in " . dirname($path) . "\n";
            $count++;
        }
    }
}

echo "Total files updated: $count\n";
