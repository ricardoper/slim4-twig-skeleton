<?php
declare(strict_types=1);

namespace App\Services;

use App\Kernel\ServiceProviderInterface;
use Closure;
use Pimple\Container;
use Slim\Views\Twig;

class ViewServiceProvider implements ServiceProviderInterface
{

    /**
     * Service register name
     */
    public function name(): string
    {
        return 'view';
    }

    /**
     * Register new service on dependency container
     *
     * @param Container $c
     * @return Closure
     */
    public function register(Container $c): Closure
    {
        return function (Container $c) {
            $view = $c['settings']['view'];

            return Twig::create($view['templates'], $view);
        };
    }
}
