<?php

namespace Fixture\Action;

use App\Action;
use App\Repository\Game;
use App\Repository\Team;
use App\Service\EntityPersister;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Fixture\Service\FixtureGenerator;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Xtreamwayz\HTMLFormValidator\FormFactory;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\RedirectResponse;
use Zend\Expressive\Template;
use Zend\Expressive\Router;


class CreateAutomaticallyAction extends Action
{

    use Action\HelperTrait;

    private $template;
    private $router;
    private $entityPersister;
    private $fixtureGenerator;
    private $team;
    private $game;

    public function __construct(
        Template\TemplateRendererInterface $template, Router\RouterInterface $router,
        EntityPersister $entityPersister, FixtureGenerator $fixtureGenerator,
        Team $team, Game $game)
    {
        $this->template = $template;
        $this->router = $router;
        $this->entityPersister = $entityPersister;
        $this->fixtureGenerator = $fixtureGenerator;
        $this->team = $team;
        $this->game = $game;
    }

    public function index(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        return new HtmlResponse($this->template->render('fixture::automatically'));
    }

    public function indexPost(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $form = FormFactory::fromHtml($this->template->render('fixture::form-automatically'));

        $validationResult = $form->validateRequest($request);

        if ($validationResult->isValid()) {

            $data = $validationResult->getValues();

            $leagueId = $this->getRouteParam($request, 'leagueId');

            $teams = array_map(
                        function(\App\Entity\Team $team){return (string)$team->getId();},
                        $this->team->findByLeague($leagueId)
            );

            $fixture = $this->fixtureGenerator->build($teams, $data['totalGames'] == 2);

            // delete existing games
            $this->game->deleteFromLeague($leagueId);

            foreach($fixture as $round => $games) {
                foreach($games as $game) {
                    $data = [
                        'league' => $leagueId,
                        'round' => $round,
                        'team1' => $game[0],
                        'team2' => $game[1],
                    ];

                    $this->entityPersister->create(\App\Entity\Game::class, $data);
                }
            }

            return new RedirectResponse($this->router->generateUri('fixture.view', ['leagueId' => $leagueId]));
        }

        return new HtmlResponse($this->template->render('fixture::automatically', ['form' => $form->asString($validationResult), 'errors' => $validationResult->getMessages()]));
    }
}
