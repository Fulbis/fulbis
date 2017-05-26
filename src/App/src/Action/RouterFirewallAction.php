<?php

namespace App\Action;

use Doctrine\ORM\EntityManager;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

class RouterFirewallAction implements ServerMiddlewareInterface
{
    private $template;
    private $entityManager;

    public function __construct(TemplateRendererInterface $template, EntityManager $entityManager)
    {
        $this->template = $template;
        $this->entityManager = $entityManager;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $userId = $request->getAttribute(\Auth\Action\AuthAction::class)['id'];

        /** @var \Zend\Expressive\Router\RouteResult $routeResult */
        $routeResult = $request->getAttribute(\Zend\Expressive\Router\RouteResult::class);

        $params = $routeResult->getMatchedParams();

        $this->template->addDefaultParam(TemplateRendererInterface::TEMPLATE_ALL, 'routeParams', $params);

        if (isset($params['leagueId'])) {
            /** @var \App\Repository\League $league */
            $league = $this->entityManager->getRepository(\App\Entity\League::class);
            $this->template->addDefaultParam(
                                TemplateRendererInterface::TEMPLATE_ALL,
                                'league',
                                $league->find($params['leagueId'])
            );
        }

        return $delegate->process($request);
    }
}