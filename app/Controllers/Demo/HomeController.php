<?php
declare(strict_types=1);

namespace App\Controllers\Demo;

use App\Emitters\PlainResponseEmitter;
use App\Kernel\Abstracts\ControllerAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends ControllerAbstract
{

    /**
     * Index Action
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request, Response $response): Response
    {
        unset($request, $response);

        return $this->render('Demo/Home/index.twig');
    }

    /**
     * Index Action
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function flash(Request $request, Response $response): Response
    {
        unset($request);

        $this->setFlashMessage('Flash', 'This is a FLASH message!');
        $this->setFlashMessage('Flash', 'This is another FLASH message!');

        return $response
            ->withStatus(302)
            ->withHeader('Location', '/hello/ricardoper');
    }

    /**
     * Dump Action
     *
     * Example action to know the ways to obtain data
     *
     * @param Request $request
     * @param Response $response
     * @param array $arguments
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function dump(Request $request, Response $response, array $arguments): Response
    {
        $app = app();
        $app = $this->getApp();

        $container = container();
        $exampleService = container('example');

        $container = $this->getContainer();
        $exampleService = $this->getContainer('example');

        $exampleService = $this->getService('example');

        $configs = configs();
        $appConfigs = configs('app');
        $appEnvConfig = configs('app.env');

        $configs = $this->getConfigs();
        $loggerConfigs = $this->getConfigs('logger');
        $loggerNameConfig = $this->getConfigs('logger.name');

        $logErrorsEnv = env('LOG_ERRORS', false);


        // Flash Messages //
        $flash = $this->getFlash();
        $flashMsg = $this->hasFlashMessage('Flash');
        $flashMsg = $this->getFlashMessages();
        $flashMsg = $this->getFlashMessages('Flash');
        $flashMsg = $this->getFlashFirstFMessage('Flash');


        // Emitters //
        $this->setEmitter('plain', PlainResponseEmitter::class);


        unset($request, $response, $arguments, $app, $container, $exampleService, $configs, $viewsConfigs, $logErrorsEnv);

        return $this->render('Demo/Home/dump.twig');
    }
}
