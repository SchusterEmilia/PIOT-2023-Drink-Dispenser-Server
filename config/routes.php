<?php

declare(strict_types=1);

use App\Handler\API\GetPreferenceHandler;
use App\Handler\HomePageHandler;
use App\Handler\PingHandler;
use App\Handler\Website\PreferencesPageHandler;
use Mezzio\Application;
use Mezzio\Handler\NotFoundHandler;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

/**
 * FastRoute route configuration
 *
 * @see https://github.com/nikic/FastRoute
 *
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Handler\HomePageHandler::class, 'home');
 * $app->post('/album', App\Handler\AlbumCreateHandler::class, 'album.create');
 * $app->put('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.put');
 * $app->patch('/album/{id:\d+}', App\Handler\AlbumUpdateHandler::class, 'album.patch');
 * $app->delete('/album/{id:\d+}', App\Handler\AlbumDeleteHandler::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Handler\ContactHandler::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Handler\ContactHandler::class,
 *     Mezzio\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->get('/', HomePageHandler::class, 'home');

    $app->get('/api/preference', GetPreferenceHandler::class, 'api.getPreference'); //Device & App
    $app->post('/api/preference', NotFoundHandler::class, 'api.postPreference'); // App
    $app->route('/preference', PreferencesPageHandler::class, ['get','post'],'preference'); //Website

    $app->get('/api/stats', NotFoundHandler::class, 'api.getStats'); //App
    $app->post('/api/stats', NotFoundHandler::class, 'api.postStats'); //Device
    $app->route('/stats', NotFoundHandler::class, ['get','post'],'stats'); //Website


    $app->post('/api/registerUser', NotFoundHandler::class, 'api.registerUser'); //App

    $app->get('/api/ping', PingHandler::class, 'api.ping');
};
