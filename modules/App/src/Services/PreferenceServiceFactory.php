<?php

declare(strict_types=1);

namespace App\Services;

use App\Storage\Components\Preference;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class PreferenceServiceFactory
{
    public function __invoke(ContainerInterface $container): PreferenceService
    {
        $entityManager = $container->get(EntityManager::class);
        $preferenceRepository = $entityManager->getRepository(Preference::class);
        return new PreferenceService($entityManager, $preferenceRepository);
    }
}
