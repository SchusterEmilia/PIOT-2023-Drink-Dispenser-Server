<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Storage\Components\Preference;
use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PreferencesOverviewPageHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);

        $preferenceRepository = $container->get(EntityManager::class)->getRepository(Preference::class);

        return new PreferencesOverviewPageHandler($template, $preferenceRepository);
    }
}
