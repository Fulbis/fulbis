<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

/** @var Zend\Expressive\Application $app */

$app->route('/', App\Action\HomeAction::class, ['GET', 'POST'], 'home');
$app->route('/login', Auth\Action\LoginAction::class, ['GET', 'POST'], 'login');
$app->get('/logout', Auth\Action\LogoutAction::class, 'logout');
$app->route('/signup', SignUp\Action\SignUpAction::class, ['GET', 'POST'], 'signup');

/* leagues */
$app->get('/leagues', Leagues\Action\FetchAllAction::class, 'leagues.fetchAll');
$app->route('/leagues/create', Leagues\Action\CreateAction::class, ['GET', 'POST'], 'leagues.create');
$app->get('/leagues/{leagueId}', Leagues\Action\ViewAction::class, 'leagues.view');
/*$app->get('/leagues/{leagueId}/edit', Leagues\Action\Edit::class, 'leagues.edit');
$app->get('/leagues/{leagueId}/delete', Leagues\Action\Delete::class, 'leagues.delete');*/

/* dashboard */
$app->get('/leagues/{leagueId}/dashboard', Leagues\Action\DashboardAction::class, 'leagues.dashboard');

/* fixture */
$app->get('/leagues/{leagueId}/fixture', Fixture\Action\ViewAction::class, 'fixture.view');
$app->route('/leagues/{leagueId}/fixture/create/automatically', Fixture\Action\CreateAutomaticallyAction::class, ['GET', 'POST'], 'fixture.create.automatically');
$app->route('/leagues/{leagueId}/fixture/edit/{round}', Fixture\Action\EditRoundAction::class, ['GET', 'POST'], 'fixture.edit');

/* game */
$app->get('/leagues/{leagueId}/game/{gameId}', Fixture\Action\GameAction::class, 'fixture.game.view');

/* standings */
$app->get('/leagues/{leagueId}/standings', Standings\Action\ViewAction::class, 'standings.view');

/* Teams */
$app->get('/leagues/{leagueId}/teams', Teams\Action\FetchAllAction::class, 'teams.fetchAll');
$app->route('/leagues/{leagueId}/teams/create', Teams\Action\CreateAction::class, ['GET', 'POST'], 'teams.create');
$app->get('/leagues/{leagueId}/teams/{teamId}', Teams\Action\ViewAction::class, 'teams.view');
/*$app->get('/leagues/{leagueId}/teams/{teamId}/edit', Teams\Action\Edit::class, 'teams.edit');
$app->get('/leagues/{leagueId}/teams/{teamId}/delete', Teams\Action\Delete::class, 'teams.delete');*/

/* Players */
//$app->get('/leagues/{leagueId}/teams/{teamId}/players', Players\Action\FetchAll::class, 'players.fetchAll');
$app->route('/leagues/{leagueId}/teams/{teamId}/players/create', Players\Action\CreateAction::class, ['GET', 'POST'], 'players.create');
/*$app->get('/leagues/{leagueId}/teams/{teamId}/players/{playerId}/edit', Players\Action\Edit::class, 'players.edit');
$app->get('/leagues/{leagueId}/teams/{teamId}/players/{playerId}/delete', Players\Action\Delete::class, 'players.delete');*/
