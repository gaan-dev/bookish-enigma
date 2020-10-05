<?php

require __DIR__.'/../bootstrap/app.php';

session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
$token = $_SESSION['token'];

$router = new \Bramus\Router\Router();

require __DIR__.'/../routes/web.php';

$router->run();
