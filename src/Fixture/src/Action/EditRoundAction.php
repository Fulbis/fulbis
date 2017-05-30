<?php

namespace Fixture\Action;

use App\Action;
use App\Repository\Fixture;
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


class EditRoundAction extends Action
{

    use Action\HelperTrait;

    private $template;
    private $router;
    private $entityPersister;
    private $fixtureGenerator;
    private $team;
    private $fixture;

    public function __construct(
        Template\TemplateRendererInterface $template, Router\RouterInterface $router,
        EntityPersister $entityPersister, FixtureGenerator $fixtureGenerator,
        Team $team, Fixture $fixture)
    {
        $this->template = $template;
        $this->router = $router;
        $this->entityPersister = $entityPersister;
        $this->fixtureGenerator = $fixtureGenerator;
        $this->team = $team;
        $this->fixture = $fixture;
    }

    public function index(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $form = FormFactory::fromHtml($this->getFormTemplate($request));

        $validationResult = $form->validate($this->getFormData($request), 'POST');

        return new HtmlResponse($this->template->render('fixture::edit', ['form' => $form->asString($validationResult), 'errors' => $validationResult->getMessages()]));
    }

    public function indexPost(ServerRequestInterface $request, DelegateInterface $delegate)
    {

        $form = FormFactory::fromHtml($this->getFormTemplate($request));

        $validationResult = $form->validateRequest($request);

        if ($validationResult->isValid()) {

            foreach($this->parseData($validationResult->getValues()) as $fixtureId => $data) {
                $this->entityPersister->edit(\App\Entity\Fixture::class, $fixtureId, $data);
            }

            return new RedirectResponse($this->router->generateUri('fixture.view', ['leagueId' => $this->getRouteParam($request, 'leagueId')]));
        }

        return new HtmlResponse($this->template->render('fixture::edit', ['form' => $form->asString($validationResult), 'errors' => $validationResult->getMessages()]));
    }

    private function getFormTemplate(ServerRequestInterface $request) {
        $round = $this->getRouteParam($request, 'round');
        $leagueId = $this->getRouteParam($request,'leagueId');

        $matches = $this->fixture->findByLeague($leagueId, $round);

        $teams = [];
        foreach($this->team->findByLeague($leagueId)as $team) {
            $teams[(string)$team->getId()] = $team->getName();
        }

        if (sizeof($teams)%2 != 0) {
            $teams["0"] = "-----";
        }

        return $this->template->render('fixture::form-edit', ['matches' => $matches, 'teams' => $teams, 'round' => $round]);
    }

    private function parseData(array $data) {
        $new = [];

        foreach($data as $key => $val) {
            $key = explode("_", $key);
            $new[$key[1]][$key[2]] = $val;
        }

        return $new;
    }

    private function getFormData(ServerRequestInterface $request) {
        $round = $this->getRouteParam($request, 'round');
        $leagueId = $this->getRouteParam($request,'leagueId');

        $matches = $this->fixture->findByLeague($leagueId, $round);

        $data = [];

        foreach($matches as $match) {
            foreach($match->getArrayCopy() as $field => $value) {

                if (($field === 'team1' || $field === 'team2') && $value === null) {
                    $value = "0";
                }

                $data['data_'.(string)$match->getId().'_'.$field] = $value;
            }
        }

        return $data;
    }
}
