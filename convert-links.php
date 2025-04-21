<?php

$folder = __DIR__ . '/resources/views'; // Dossier à modifier
$routes = [
    'index.html'      => 'index',
    'home-02.html'    => 'home2',
    'home-03.html'    => 'home3',
    'product.html'    => 'product',
    'shoping-cart.html' => 'shoping',
    'blog.html'       => 'blog',
    'about.html'      => 'about',
    'contact.html'    => 'contact',
    'blog-detail'     =>'blog-detail',
    'product-detail.html'    => 'product-detail',

    // ajoute ici d'autres correspondances
];

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($folder)
);

foreach ($files as $file) {
    if ($file->isFile() && preg_match('/\.(blade\.php|html)$/', $file->getFilename())) {
        $content = file_get_contents($file->getRealPath());

        foreach ($routes as $html => $routeName) {
            $pattern = '/href="([^"]*' . preg_quote($html, '/') . ')"/';
            $replacement = 'href="{{ url(\'/' . $routeName . '\') }}"';
            $content = preg_replace($pattern, $replacement, $content);
        }

        file_put_contents($file->getRealPath(), $content);
        echo "✅ Modifié : " . $file->getRealPath() . PHP_EOL;
    }
}

echo "🎉 Terminé ! Tous les liens ont été modifiés.\n";
