<?php
/**
 * Created by PhpStorm.
 * User: nartra
 * Date: 28/9/19
 * Time: 1:43 PM
 */

namespace App\Application\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

abstract class BaseController
{
    public abstract function index(Request $request, Response $response, $args): Response;
}