<?php
/**
 * Exports the site as plain HTML into dist/ for static hosting (Vercel, Netlify, GitHub Pages…).
 * Static hosts don't run PHP, so upload/deploy the dist/ folder — not the project root.
 *
 * Usage:  php build.php
 */
define('STATIC_BUILD', true);

$root = __DIR__;
$dist = $root . '/dist';

function remove_dir(string $dir): void
{
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    ) as $item) {
        $item->isDir() ? rmdir($item->getPathname()) : unlink($item->getPathname());
    }
    rmdir($dir);
}

function copy_dir(string $from, string $to): void
{
    mkdir($to, 0755, true);
    foreach (new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($from, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    ) as $item) {
        $target = $to . '/' . substr($item->getPathname(), strlen($from) + 1);
        $item->isDir() ? @mkdir($target, 0755, true) : copy($item->getPathname(), $target);
    }
}

if (is_dir($dist)) {
    remove_dir($dist);
}
mkdir($dist, 0755, true);

ob_start();
require $root . '/index.php';
file_put_contents($dist . '/index.html', ob_get_clean());

copy_dir($root . '/assets', $dist . '/assets');

echo "Static site built in dist/ — deploy that folder.\n";
