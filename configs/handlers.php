<?php
declare(strict_types=1);

use App\Handlers\ShutdownHandler;
use Slim\Handlers\ErrorHandler;

return [

    // Handlers //
    'errorHandler' => ErrorHandler::class,

    'shutdownHandler' => ShutdownHandler::class,

];
