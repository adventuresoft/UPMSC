<?php

$dir = new RecursiveDirectoryIterator('c:/xampp/htdocs/laravel/dcdhaka.srsibd.com-2-main/upms/resources/views/backend/pages');

foreach(new RecursiveIteratorIterator($dir) as $file) {
    if(strpos($file->getFilename(), 'index.blade.php') !== false) {
        $content = file_get_contents($file->getPathname());
        
        $new_content = preg_replace_callback('/(?:@if\s*\(\s*edit_permission.*?\)\s*)?<a[^>]*?href\s*=\s*"[^"]*(?:edit)[^"]*"[^>]*?>(?:\s*<i[^>]*fa-edit[^>]*><\/i>\s*|\s*Edit\s*)<\/a>(?:\s*@endif)?/is', function($m) {
            if(strpos($m[0], '@if') !== false) {
                return $m[0];
            }
            return "@if(edit_permission())\n" . ltrim($m[0]) . "\n@endif";
        }, $content);
        
        // Also check for the single quote variant
        $new_content = preg_replace_callback('/(?:@if\s*\(\s*edit_permission.*?\)\s*)?<a[^>]*?href\s*=\s*\'[^\']*(?:edit)[^\']*\'[^>]*?>(?:\s*<i[^>]*fa-edit[^>]*><\/i>\s*|\s*Edit\s*)<\/a>(?:\s*@endif)?/is', function($m) {
            if(strpos($m[0], '@if') !== false) {
                return $m[0];
            }
            return "@if(edit_permission())\n" . ltrim($m[0]) . "\n@endif";
        }, $new_content);

        // A third fallback pattern for anchor tags containing fa-edit, without relying on href="...edit..."
        $new_content = preg_replace_callback('/(?:@if\s*\(\s*edit_permission.*?\)\s*)?<a[^>]*?>(?:\s*<i[^>]*fa-edit[^>]*><\/i>\s*)<\/a>(?:\s*@endif)?/is', function($m) {
            if(strpos($m[0], '@if') !== false) {
                return $m[0];
            }
            return "@if(edit_permission())\n" . ltrim($m[0]) . "\n@endif";
        }, $new_content);

        if($new_content !== $content) {
            file_put_contents($file->getPathname(), $new_content);
            echo "Updated: " . $file->getPathname() . "\n";
        }
    }
}
