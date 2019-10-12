<?php
/**
 * Created by PhpStorm.
 * User: nartra
 * Date: 28/9/19
 * Time: 1:48 PM
 */

namespace App\Application\Controllers\Product;

use App\Application\Controllers\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use \App\Service\Product\Product as ProductService;

class Product extends BaseController
{

    private $productService;

    /**
     * Product constructor.
     * @param $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    public function index(Request $request, Response $response, $args): Response
    {
        // TODO: Implement index() method.
    }

    public function listAll(Request $request, Response $response, $args): Response
    {
        $products = $this->productService->getAll()->map(function($item){
            $item->create_at = date("c", $item->create_at);
            $item->update_at = date("c", $item->update_at);
            return $item;
        });

        $response->getBody()->write($products->toJson());
        return $response->withHeader('Content-Type', 'application/json');
    }
}