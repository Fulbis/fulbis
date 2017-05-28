<?php

namespace App\Action;

use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Router\RouteResult;

trait HelperTrait {

    public function getRouteParams(ServerRequestInterface $request) {
        /** @var RouteResult $routeResult */
        $routeResult = $request->getAttribute(RouteResult::class);

        return $routeResult->getMatchedParams();
    }

    public function getRouteParam(ServerRequestInterface $request, $name, $default = null) {
        $params = $this->getRouteParams($request);

        return isset($params[$name]) ? $params[$name] : $default;
    }

}