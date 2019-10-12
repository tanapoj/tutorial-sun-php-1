<?php
declare(strict_types=1);


use App\Application\Actions\Product\ProductListAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\Country\CountryAction;
use App\Application\Actions\Product\ProductAction;
use App\Application\Controllers\Product\Product;
use App\Application\Controllers\TestController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app, \DI\Container $di) {

    function call($class, $method = "index")
    {
        global $container;
        return [$container->get($class), $method];
    }

    $app->group('/api', function (Group $group) use ($di) {

        $group->get('/country', CountryAction::class);

        $group->get('/product', call(Product::class, 'listAll'));
        $group->get('/product/{id}', call(Product::class, 'listAll'));
        $group->post('/product', call(Product::class, 'listAll'));
        $group->put('/product/{id}', call(Product::class, 'listAll'));
        $group->delete('/product/{id}', call(Product::class, 'listAll'));

        //$group->get('/test', [new TestController(), 'test']);
//        $group->get('/test', call(TestController::class));
        $group->get('/test', function(Request $request, Response $response, $args){
            $response->getBody()->write("this is test");
            return $response;
        });


    });
};
