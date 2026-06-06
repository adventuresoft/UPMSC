<?php
$base_dir = "/Users/tareqjamilsarkar/Antigravity (Adventure Soft)/UPMSC/resources/views/backend/pages/certificate";

$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($base_dir));
$count = 0;

foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $fpath = $file->getPathname();
        $content = file_get_contents($fpath);
        $original = $content;

        if (strpos($content, 'class="col-8 text-center"') !== false && strpos($content, 'গণপ্রজাতন্ত্রী বাংলাদেশ সরকার') !== false) {
            
            $content = preg_replace_callback('/<div class="col-8 text-center">[\s\S]*?<\/div>/', function($matches) {
                $block = $matches[0];
                
                // replace H2 1
                $block = preg_replace(
                    '/<h2 class="text-\s*font-Nikosh-bold mb-0" style="font-size:18px; position: relative; top: -16px;">/',
                    '<h2 class="text- font-Nikosh-bold mb-0" style="font-size:18px; position: relative; top: -16px; line-height: 1;">',
                    $block
                );
                // replace H2 2
                $block = preg_replace(
                    '/<h2 class="text-success font-weight-bold mb-0" style="font-size:28px;">/',
                    '<h2 class="text-success font-weight-bold mb-0" style="font-size:28px; line-height: 1.1; margin-top: -10px;">',
                    $block
                );
                // replace H3
                $block = preg_replace(
                    '/<h3 class="font-weight-bold" style="color:#2e3192; margin-top:2px; font-size:32px;">/',
                    '<h3 class="font-weight-bold" style="color:#2e3192; margin-top:-5px; font-size:32px; line-height: 1.1;">',
                    $block
                );
                // replace P
                $block = preg_replace(
                    '/<p class="mb-0" style="font-size:15px;">/',
                    '<p class="mb-0" style="font-size:15px; margin-top:-2px; line-height: 1.2;">',
                    $block
                );
                return $block;
            }, $content);
        }

        if ($content !== $original) {
            file_put_contents($fpath, $content);
            $count++;
            echo "Updated $fpath\n";
        }
    }
}

echo "Total updated: $count\n";
