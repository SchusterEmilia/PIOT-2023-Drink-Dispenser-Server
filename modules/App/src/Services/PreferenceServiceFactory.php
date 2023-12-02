<?php

declare(strict_types=1);

namespace App\Services;

use App\Handler\API\GetPreferenceHandler;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use function assert;

class PreferenceServiceFactory
{
    public function __invoke(ContainerInterface $container): PreferenceService
    {
        return new PreferenceService();
    }
}
