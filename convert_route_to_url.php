<?php

$directory = __DIR__ . '/resources/views'; // Change si tes fichiers sont ailleurs

function recursiveReplaceRouteWithUrl($dir) {
    $files = scandir($dir);

    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;

        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            recursiveReplaceRouteWithUrl($path); // Appel récursif
        } elseif (is_file($path) && preg_match('/\.(blade\.php|php|html)$/', $file)) {
            $content = file_get_contents($path);

            // Remplace href="{{ route('nom') }}" par href="{{ url('/nom') }}"
            $updated = preg_replace_callback(
                '/href\s*=\s*"{{\s*route\(\s*[\'"]([^\'"]+)[\'"]\s*\)\s*}}"/',
                function ($matches) {
                    $route = $matches[1];
                    return 'href="{{ url(\'/' . $route . '\') }}"';
                },
                $content
            );

            file_put_contents($path, $updated);
            echo "✅ Fichier modifié : $path\n";
        }
    }
}

recursiveReplaceRouteWithUrl($directory);
