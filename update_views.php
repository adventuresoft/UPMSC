<?php
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('resources/views'));
$count = 0;
foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        // Match asset($variable) or asset($variable ?? 'fallback')
        $newContent = preg_replace('/asset\(\s*(\$[^)]+)\s*\)/', 'imageUrl($1)', $content);
        if ($newContent !== $content) {
            file_put_contents($file->getPathname(), $newContent);
            $count++;
        }
    }
}
echo "Updated files: $count\n";
