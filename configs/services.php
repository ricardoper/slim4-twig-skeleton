<?php
declare(strict_types=1);

use App\Services\Demo\ExampleServiceProvider;
use App\Services\FlashServiceProvider;
use App\Services\Logger\LoggerServiceProvider;
use App\Services\ViewServiceProvider;

return [

    LoggerServiceProvider::class,
    FlashServiceProvider::class,
    ViewServiceProvider::class,

    ExampleServiceProvider::class,

];
