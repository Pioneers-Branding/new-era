<?php
/**
 * Build script for Netlify deployment
 * ------------------------------------------------------------------
 * Renders every PHP page to static HTML in dist/, rewrites .php links
 * to .html, and copies the assets alongside. Run locally with:
 *
 *     php build.php
 *
 * Netlify runs it via the build command in netlify.toml and publishes dist/.
 */

// Run from the project root no matter where the script was called from.
chdir(__DIR__);

// The CLI has no request, but the page templates read $_SERVER. Give them
// something sane so nothing warns mid-render.
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['REQUEST_URI']    = $_SERVER['REQUEST_URI']    ?? '/';
$_SERVER['HTTP_HOST']      = $_SERVER['HTTP_HOST']      ?? 'localhost';
$_SERVER['SERVER_NAME']    = $_SERVER['SERVER_NAME']    ?? 'localhost';
$_SERVER['HTTPS']          = 'on';

// Pages to build (source PHP file => output HTML file).
// Files that do not exist yet are skipped with a warning, so pages we have
// planned can sit here until they are written.
$pages = [
    'index.php'     => 'index.html',
    'thank-you.php' => 'thank-you.html', // form confirmation page
    'privacy.php'   => 'privacy.html',   // privacy policy
    'terms.php'     => 'terms.html',     // terms of use
];

// Folders copied wholesale into dist/.
// assets/ holds photos, insurance logos, the Magstim device shot, the clinic
// photo, the neurons hero and both logo variants.
//
// Anything named in $skipDirs is staging material that no page references, so
// it stays in the repo but is not published.
$assetDirs = ['assets'];
$skipDirs  = ['insurance-check'];

// Single files copied into dist/ when present.
$rootFiles = [
    'favicon.ico', 'favicon.png', 'apple-touch-icon.png', 'robots.txt', 'sitemap.xml',
    '_redirects', '_headers',
];

/* ------------------------------------------------------------------ */

function removeDir(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }
    foreach (scandir($dir) as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $path = "$dir/$file";
        is_dir($path) ? removeDir($path) : unlink($path);
    }
    rmdir($dir);
}

function copyDir(string $src, string $dst): int
{
    if (!is_dir($src)) {
        return 0;
    }
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    $count = 0;
    foreach (scandir($src) as $file) {
        if ($file === '.' || $file === '..' || $file === '.DS_Store') {
            continue;
        }
        if (in_array($file, $GLOBALS['skipDirs'], true) && is_dir("$src/$file")) {
            continue;
        }
        $srcPath = "$src/$file";
        $dstPath = "$dst/$file";
        if (is_dir($srcPath)) {
            $count += copyDir($srcPath, $dstPath);
        } elseif (copy($srcPath, $dstPath)) {
            $count++;
        }
    }
    return $count;
}

/* ---- Start from a clean dist/ ------------------------------------- */

removeDir('dist');
mkdir('dist', 0755, true);

/* ---- Render the pages --------------------------------------------- */

$built = 0;
$skipped = [];

foreach ($pages as $srcFile => $outFile) {

    if (!file_exists($srcFile)) {
        $skipped[] = $srcFile;
        echo "Skipped: $srcFile (not created yet)\n";
        continue;
    }

    $destPath = 'dist/' . $outFile;
    $destDir  = dirname($destPath);

    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    // Render. Included at global scope on purpose: the pages share their
    // data arrays and helpers across the whole build.
    ob_start();
    include $srcFile;
    $html = ob_get_clean();

    if (trim($html) === '') {
        fwrite(STDERR, "ERROR: $srcFile rendered nothing.\n");
        exit(1);
    }

    // Internal .php links become .html for the static host. Anything with a
    // scheme (tel:, mailto:, https://) has no .php in it, so it is untouched.
    $html = str_replace(
        ['.php"', ".php'", '.php#', '.php?'],
        ['.html"', ".html'", '.html#', '.html?'],
        $html
    );

    file_put_contents($destPath, $html);
    $built++;
    echo "Built:   $outFile (" . number_format(strlen($html) / 1024, 1) . " KB)\n";
}

/* ---- Copy the static files ---------------------------------------- */

foreach ($assetDirs as $dir) {
    $n = copyDir($dir, 'dist/' . $dir);
    echo "Copied:  $dir/ ($n files)\n";
}

foreach ($rootFiles as $file) {
    if (file_exists($file) && copy($file, 'dist/' . $file)) {
        echo "Copied:  $file\n";
    }
}

/* ---- Sanity checks -------------------------------------------------- */

// Every local src/href the build emitted should exist in dist/. Catches a
// renamed photo or a logo that never got copied, before it 404s in production.
$missing = [];
foreach (glob('dist/*.html') as $page) {
    $html = file_get_contents($page);
    preg_match_all('/(?:src|href)="(?!https?:|tel:|mailto:|#|data:)([^"]+)"/i', $html, $m);
    foreach (array_unique($m[1]) as $ref) {
        $path = 'dist/' . rawurldecode(ltrim(strtok($ref, '?#'), '/'));
        if (!file_exists($path)) {
            $missing[] = basename($page) . ' -> ' . $ref;
        }
    }
}

// The consultation form POSTs back to itself, which a static host cannot do.
$formIsStatic = false;
if (file_exists('dist/index.html')) {
    $formIsStatic = (bool) preg_match('/<form[^>]*method="post"[^>]*>/i', file_get_contents('dist/index.html'))
                 && !preg_match('/<form[^>]*(netlify|data-netlify|action=)/i', file_get_contents('dist/index.html'));
}

/* ---- Report -------------------------------------------------------- */

echo "\nBuild complete: $built page" . ($built === 1 ? '' : 's') . " in dist/.\n";

if ($skipped) {
    echo "Not built yet: " . implode(', ', $skipped) . "\n";
    echo "Footer links pointing at those pages will 404 until they exist.\n";
}

if ($missing) {
    echo "\nWARNING: " . count($missing) . " reference(s) missing from dist/:\n";
    foreach (array_slice($missing, 0, 20) as $ref) {
        echo "  $ref\n";
    }
    if (count($missing) > 20) {
        echo "  ... and " . (count($missing) - 20) . " more\n";
    }
}

if ($formIsStatic) {
    echo "\nNOTE: the consultation form POSTs to itself, which will not work on\n";
    echo "Netlify. Add data-netlify=\"true\" plus a hidden form-name field to use\n";
    echo "Netlify Forms, or point action= at your CRM endpoint.\n";
}
