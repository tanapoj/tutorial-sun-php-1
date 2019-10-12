<?php
/**
 * Created by PhpStorm.
 * User: nartra
 * Date: 28/9/19
 * Time: 1:21 PM
 */

namespace App\Application\Controllers;

use App\Service\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TestController extends BaseController
{


    public function __construct(Product $product)
    {
        $this->productService = $product;
    }

    public function index(Request $request, Response $response, $args): Response
    {
        $response->getBody()->write("test");
        return $response;
    }
}