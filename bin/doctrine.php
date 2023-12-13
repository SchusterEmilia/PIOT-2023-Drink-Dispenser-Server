#!/usr/bin/env php
<?php
// bin/doctrine

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\ConfigurationArray;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Tools\Console\Command;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\Command\ClearCache\MetadataCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\QueryCommand;
use Doctrine\ORM\Tools\Console\Command\ClearCache\ResultCommand;
use Doctrine\ORM\Tools\Console\Command\GenerateProxiesCommand;
use Doctrine\ORM\Tools\Console\Command\MappingDescribeCommand;
use Doctrine\ORM\Tools\Console\Command\ValidateSchemaCommand;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

chdir(__DIR__ . '/../');

require 'vendor/autoload.php';

$container = require 'config/container.php';
assert($container instanceof ContainerInterface);

$entityManager = $container->get(EntityManager::class);

$config = $container->get('config');
$migrationsConfig = $config['doctrine']['migrations'];

$dependencyFactory = DependencyFactory::fromEntityManager(
    new ConfigurationArray($migrationsConfig),
    new ExistingEntityManager($entityManager)
);

$console = new Application();

$console->addCommands([
    new Command\DiffCommand($dependencyFactory),
    new Command\DumpSchemaCommand($dependencyFactory),
    new Command\ExecuteCommand($dependencyFactory),
    new Command\GenerateCommand($dependencyFactory),
    new Command\LatestCommand($dependencyFactory),
    new Command\ListCommand($dependencyFactory),
    new Command\MigrateCommand($dependencyFactory),
    new Command\RollupCommand($dependencyFactory),
    new Command\StatusCommand($dependencyFactory),
    new Command\SyncMetadataCommand($dependencyFactory),
    new Command\VersionCommand($dependencyFactory),
    new GenerateProxiesCommand(new SingleManagerProvider($entityManager)),
    new MappingDescribeCommand(new SingleManagerProvider($entityManager)),
    new MetadataCommand(new SingleManagerProvider($entityManager)),
    new QueryCommand(new SingleManagerProvider($entityManager)),
    new ResultCommand(new SingleManagerProvider($entityManager)),
    new ValidateSchemaCommand(new SingleManagerProvider($entityManager)),
]);

$console->run();
