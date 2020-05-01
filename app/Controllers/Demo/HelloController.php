<?php
declare(strict_types=1);

namespace App\Controllers\Demo;

use App\Kernel\Controllers\ControllerAbstract;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HelloController extends ControllerAbstract
{

    /**
     * Index Action
     *
     * @param Request $request
     * @param Response $response
     * @param array $arguments
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request, Response $response, array $arguments): Response
    {
        unset($request, $response);

        $data = container('example')->capName($arguments['name']);

        return $this->render('Demo/Hello/index.twig', ['name' => $data]);
    }
}
