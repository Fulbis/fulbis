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

$app->get('/', App\Action\LoginAction::class, 'home');

/* leagues */
$app->get('/leagues', Leagues\Action\FetchAll::class, 'leagues.fetchAll');
$app->get('/leagues/create', Leagues\Action\Create::class, 'leagues.create');
$app->get('/leagues/{leagueId}/edit', Leagues\Action\Edit::class, 'leagues.edit');
$app->get('/leagues/{leagueId}/delete', Leagues\Action\Delete::class, 'leagues.delete');

/* Teams */
$app->get('/leagues/{leagueId}/teams', Teams\Action\FetchAll::class, 'teams.fetchAll');
$app->get('/leagues/{leagueId}/teams/create', Teams\Action\Create::class, 'teams.create');
$app->get('/leagues/{leagueId}/teams/{teamId}/edit', Teams\Action\Edit::class, 'teams.edit');
$app->get('/leagues/{leagueId}/teams/{teamId}/delete', Teams\Action\Delete::class, 'teams.delete');

/* Players */
$app->get('/leagues/{leagueId}/teams/{teamId}/players', Players\Action\FetchAll::class, 'players.fetchAll');
$app->get('/leagues/{leagueId}/teams/{teamId}/players/create', Players\Action\Create::class, 'players.create');
$app->get('/leagues/{leagueId}/teams/{teamId}/players/{playerId}/edit', Players\Action\Edit::class, 'players.edit');
$app->get('/leagues/{leagueId}/teams/{teamId}/players/{playerId}/delete', Players\Action\Delete::class, 'players.delete');
