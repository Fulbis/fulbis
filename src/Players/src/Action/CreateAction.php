<?php

namespace Players\Action;

use App\Action;
use App\Service\EntityPersister;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Xtreamwayz\HTMLFormValidator\FormFactory;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Router;


class CreateAction extends Action
{

    private $template;
    private $router;
    private $entityPersister;

    public function __construct(Template\TemplateRendererInterface $template, Router\RouterInterface $router, EntityPersister $entityPersister)
    {
        $this->template = $template;
        $this->router = $router;
        $this->entityPersister = $entityPersister;
    }

    public function index(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new HtmlResponse($this->template->render('players::create'));
    }

    public function indexPost(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $form = FormFactory::fromHtml($this->template->render('players::create'));

        $validationResult = $form->validateRequest($request);

        if ($validationResult->isValid()) {

            $data = $validationResult->getValues();

            $leagueId = $this->getRouteParam($request, 'leagueId');
            $teamId = $this->getRouteParam($request, 'teamId');

            $players = array_filter(
                array_map('trim',
                    explode("\n", trim($data["name"]))
                )
            );

            foreach($players as $player) {
                $this->entityPersister->create(\App\Entity\Player::class, ['team' => $teamId, 'name' => $player]);
            }

            return new RedirectResponse($this->router->generateUri('teams.view', ['leagueId' => $leagueId, 'teamId' => $teamId]));
        }

        return new HtmlResponse($this->template->render('players::create', ['form' => $form->asString($validationResult), 'errors' => $validationResult->getMessages()]));
    }
}
