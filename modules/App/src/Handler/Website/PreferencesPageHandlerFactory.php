<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Services\PreferenceService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PreferencesPageHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);

        $preferenceService = $container->get(PreferenceService::class);

        return new PreferencesPageHandler($template, $preferenceService);
    }
}
