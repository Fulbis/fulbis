<?php

namespace App;

use Fig\Http\Message\StatusCodeInterface as StatusCode;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\EmptyResponse;
use Zend\Expressive\Router\RouteResult;

class Action implements MiddlewareInterface {

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

    public function getRouteParam(ServerRequestInterface $request, $name, $default = null) {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        $params = $routeResult->getMatchedParams();

        return isset($params[$name]) ? $params[$name] : $default;
    }

}