<?php
/**
 * Dev-server router — repo root only, never deployed.
 *
 *     php -S localhost:8002 router.php
 *
 * Each landing page lives in its own folder and links its assets relatively
 * ("assets/logo/..."), which is what lets the same markup work when Netlify
 * publishes a folder as a site root.
 *
 * PHP's built-in server happily serves psychiatry/index.php for the URL
 * "/psychiatry", but unlike Apache, nginx or Netlify it does not redirect to
 * "/psychiatry/" first. Without the trailing slash the browser resolves every
 * relative asset one level too high — "/assets/logo/..." instead of
 * "/psychiatry/assets/logo/..." — so the page renders with every image broken
 * and nothing in the console but 404s on paths that look almost right.
 *
 * This restores the redirect a real server would have sent.
 */

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path !== '/' && substr($path, -1) !== '/' && is_dir(__DIR__ . $path)) {
    header('Location: ' . $path . '/', true, 301);
    exit;
}

return false;   // everything else: let the built-in server serve it
