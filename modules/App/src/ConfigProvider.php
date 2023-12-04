<?php

declare(strict_types=1);

namespace App;

use App\Handler\API\GetPreferenceHandler;
use App\Handler\API\GetPreferenceHandlerFactory;
use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use App\Handler\PingHandler;
use App\Handler\Website\PreferencesPageHandler;
use App\Handler\Website\PreferencesPageHandlerFactory;
use App\Services\PreferenceService;
use App\Services\PreferenceServiceFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.laminas.dev/laminas-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => PingHandler::class,
            ],
            'factories' => [
                PreferenceService::class => PreferenceServiceFactory::class,

                GetPreferenceHandler::class   => GetPreferenceHandlerFactory::class,
                PreferencesPageHandler::class => PreferencesPageHandlerFactory::class,

                HomePageHandler::class => HomePageHandlerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
