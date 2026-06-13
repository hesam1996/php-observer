<?php
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($path !== APP_PATH) {
    http_response_code(404);
    require_once 'Pages/notfound.php';
    exit();
}

if (
    count($_GET) > 1 ||
    (count($_GET) === 1 && !isset($_GET['file']))
) {
    http_response_code(404);
    require_once 'Pages/notfound.php';
    exit();
}
