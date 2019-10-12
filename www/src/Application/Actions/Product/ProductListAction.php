<?php
/**
 * Created by PhpStorm.
 * User: nartra
 * Date: 28/9/19
 * Time: 12:22 PM
 */

namespace App\Application\Actions\Product;


use App\Application\Actions\Action;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Service\Product\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Exception\HttpBadRequestException;

class ProductListAction extends Action
{
    private $productService;

    public function __construct(LoggerInterface $logger, Product $product)
    {
        parent::__construct($logger);
        $this->productService = $product;
    }

    /**
     * @return Response
     * @throws DomainRecordNotFoundException
     * @throws HttpBadRequestException
     */
    protected function action(): Response
    {
        $products = $this->productService->getAll()->map(function($item){
            $item->create_at = date("c", $item->create_at);
            $item->update_at = date("c", $item->update_at);
            return $item;
        });

        $res = $this->response;
        $res->getBody()->write($products->toJson());
        return $res->withHeader('Content-Type', 'application/json');
    }
}