<?php
$dir = __DIR__ . '/resources/views/backend/pages/certificate';

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

$bnSignature = <<<'EOD'
                    <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1" style="font-weight:600;">({{ $certificate->user->institute->superUser->people->bn_name ?? $certificate->user->institute->superUser->name ?? 'চেয়ারম্যান' }})</p>
                        <p class="mb-0">চেয়ারম্যান</p>
                        <p class="mb-0">{{ $certificate->user->institute->union->bn_name ?? '' }} ইউনিয়ন পরিষদ</p>
                        <p class="mb-0" style="font-size:14px;">{{ $certificate->user->institute->union->thana->bn_name ?? '' }}, {{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}</p>
                    </div>
EOD;

$enSignature = <<<'EOD'
                   <div class="chairman">
                        <div style="height:40px;"></div>
                        <p class="mb-1" style="font-weight:600;">({{ $certificate->user->institute->superUser->people->name ?? $certificate->user->institute->superUser->name ?? 'Chairman' }})</p>
                        <p class="mb-0">Chairman</p>
                        <p class="mb-0">{{ $certificate->user->institute->union->name ?? '' }} Union Parishad</p>
                        <p class="mb-0" style="font-size:14px;">{{ $certificate->user->institute->union->thana->name ?? '' }}, {{ $certificate->user->institute->union->thana->district->name ?? '' }}</p>
                    </div>
EOD;

$count = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $path = $file->getPathname();
        
        // Exclude voter_area and nid_correction as requested
        if (strpos($path, 'voter_area') !== false || strpos($path, 'nid_correction') !== false) {
            continue;
        }

        $content = file_get_contents($path);
        $originalContent = $content;

        $isBn = (strpos($file->getFilename(), 'bn_') !== false);
        
        // Check for include
        if (preg_match('/@include\s*\(\s*\'backend\.partials\.chairman_signature\'[^\)]*\)\s*/i', $content)) {
            // we need to wrap it inside certificate-signature if it isn't already?
            // Wait, the include might be inside <div class="certificate-signature"> already.
            // Let's check citizen/bn_certificate.blade.php
            // Yes, it has @include(...) inside the certificate-body, but wait:
            // The include itself contains <div class="certificate-signature"> in chairman_signature.blade.php!
            
            $signatureBlock = $isBn ? 
                '<div class="certificate-signature">
                    <div class="qr-code" id="qrcode"></div>
' . $bnSignature . '
                </div>' 
                : 
                '<div class="certificate-signature">
                    <div class="qr-code" id="qrcode"></div>
' . $enSignature . '
                </div>';
                
            $content = preg_replace('/@include\s*\(\s*\'backend\.partials\.chairman_signature\'[^\)]*\)\s*/i', $signatureBlock . "\n", $content);
        }

        if ($content !== $originalContent) {
            file_put_contents($path, $content);
            echo "Updated include: " . basename($path) . " in " . dirname($path) . "\n";
            $count++;
        }
    }
}

echo "Total files updated: $count\n";
