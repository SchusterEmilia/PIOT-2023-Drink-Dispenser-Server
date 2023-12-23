<?php

declare(strict_types=1);

namespace App;

use App\Handler\API\GetPreferenceHandler;
use App\Handler\API\GetPreferenceHandlerFactory;
use App\Handler\HomePageHandler;
use App\Handler\HomePageHandlerFactory;
use App\Handler\PingHandler;
use App\Handler\Website\ActionsOverviewPageHandler;
use App\Handler\Website\ActionsOverviewPageHandlerFactory;
use App\Handler\Website\PreferencePageHandler;
use App\Handler\Website\PreferencePageHandlerFactory;
use App\Services\PreferenceService;
use App\Services\PreferenceServiceFactory;
use App\Storage\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

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
     * @return array<string, array<string, array<string, class-string|list<string>>>>
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
     * @return array<string, array<class-string, class-string>>
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                PingHandler::class => PingHandler::class,
            ],
            'factories' => [
                PreferenceService::class => PreferenceServiceFactory::class,

                ActionsOverviewPageHandler::class => ActionsOverviewPageHandlerFactory::class,
                GetPreferenceHandler::class       => GetPreferenceHandlerFactory::class,
                PreferencePageHandler::class      => PreferencePageHandlerFactory::class,
                HomePageHandler::class            => HomePageHandlerFactory::class,

                EntityManager::class => EntityManagerFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     * @return array<string, array<string, list<string>>>
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
