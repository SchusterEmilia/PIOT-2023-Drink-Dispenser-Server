<?php

declare(strict_types=1);

namespace App\Handler\API;

use App\Services\PreferenceService;

use function assert;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetPreferenceHandlerFactory
{
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $preferenceService = $container->has(PreferenceService::class)
            ? $container->get(PreferenceService::class)
            : null;
        assert($preferenceService instanceof PreferenceService);

        return new GetPreferenceHandler($preferenceService);
    }
}
