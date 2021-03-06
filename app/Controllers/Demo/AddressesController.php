<?php
declare(strict_types=1);

namespace App\Controllers\Demo;

use App\Kernel\Abstracts\ControllerAbstract;
use App\Models\Demo\AddressesModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class AddressesController extends ControllerAbstract
{

    /**
     * List Action
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function list(Request $request, Response $response): Response
    {
        unset($request, $response);

        $addresses = (new AddressesModel())->getLast();

        return $this->render('Demo/Addresses/list.twig', ['addresses' => $addresses]);
    }

    /**
     * List With PDO Action
     *
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function pdo(Request $request, Response $response): Response
    {
        unset($request, $response);

        $addresses = (new AddressesModel())->getLastWithPdo();

        return $this->render('Demo/Addresses/list.twig', ['addresses' => $addresses]);
    }
}
