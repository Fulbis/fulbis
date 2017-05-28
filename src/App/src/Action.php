<?php

namespace App;

use App\Action\HelperTrait;
use Fig\Http\Message\StatusCodeInterface as StatusCode;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Expressive\Router\RouteResult;

class Action implements MiddlewareInterface {

    use HelperTrait;

    public function process(ServerRequestInterface $request, DelegateInterface $delegate) {
        $action = $request->getAttribute('action', 'index');

        if ($request->getMethod() !== 'GET') {
            $action .= ucwords(strtolower($request->getMethod()));
        }

        if (! method_exists($this, $action)) {
            return new EmptyResponse(StatusCode::STATUS_NOT_FOUND);
        }

        return $this->$action($request, $delegate);
    }

}