<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Services\PreferenceService;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function assert;

class PreferencesPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        assert($template instanceof TemplateRendererInterface);

        $preferenceService = $container->has(PreferenceService::class)
            ? $container->get(PreferenceService::class)
            : null;
        assert($preferenceService instanceof PreferenceService);

        return new PreferencesPageHandler($template, $preferenceService);
    }
}
