<?php

declare(strict_types=1);

namespace App\Handler\API;

use App\Services\PreferenceService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetPreferenceHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $preferenceService = $container->get(PreferenceService::class);

        return new GetPreferenceHandler($preferenceService);
    }
}
