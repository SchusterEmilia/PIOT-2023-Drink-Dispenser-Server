<?php

declare(strict_types=1);

namespace App\Storage;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

class EntityManagerFactory
{
    public function __invoke(ContainerInterface $container): EntityManager
    {
        // Create a simple "default" Doctrine ORM configuration for Attributes
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . '/Components'],
            isDevMode: true,
        );
        $dbconfig = $container->get('config');
        $connectionConfig = $dbconfig['doctrine']['connection']['params'];

        // configuring the database connection
        $connection = DriverManager::getConnection(
            $connectionConfig,
            $config
        );

        // obtaining the entity manager
        $entityManager = new EntityManager($connection, $config);
        return $entityManager;
    }
}
