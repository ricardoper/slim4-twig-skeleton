<?php
declare(strict_types=1);

use App\Middlewares\Demo\ExampleMiddleware;
use App\Middlewares\SessionMiddleware;
use App\Middlewares\ViewMiddleware;

return [

    SessionMiddleware::class,
    ViewMiddleware::class,

    ExampleMiddleware::class,

];
