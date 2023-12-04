<?php

declare(strict_types=1);

namespace App\Services;

use Psr\Container\ContainerInterface;

class PreferenceServiceFactory
{
    public function __invoke(ContainerInterface $container): PreferenceService
    {
        return new PreferenceService();
    }
}
