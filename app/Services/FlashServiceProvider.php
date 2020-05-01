<?php
declare(strict_types=1);


namespace App\Services;

use App\Kernel\ServiceProviderInterface;
use Closure;
use Pimple\Container;
use Slim\Flash\Messages;

class FlashServiceProvider implements ServiceProviderInterface
{

    /**
     * Service register name
     */
    public function name(): string
    {
        return 'flash';
    }

    /**
     * Register new service on dependency container
     *
     * @param Container $c
     * @return Closure
     */
    public function register(Container $c): Closure
    {
        return function () {
            return new Messages;
        };
    }
}
