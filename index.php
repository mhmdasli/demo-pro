<?php
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
*/
require_once __DIR__ . '/vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Create New App Instance
|--------------------------------------------------------------------------
*/
$app = new \App\App();

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
*/
$response = $app->run();

/*
|--------------------------------------------------------------------------
| Return Response
|--------------------------------------------------------------------------
*/
$response->send();