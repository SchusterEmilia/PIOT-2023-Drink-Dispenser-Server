<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Services\PreferenceService;
use App\Storage\Components\Ingredient;
use Doctrine\ORM\EntityManager;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PreferencePageHandlerFactory
{
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $template = $container->get(TemplateRendererInterface::class);

        $preferenceService = $container->get(PreferenceService::class);

        $ingredientRepository = $container->get(EntityManager::class)->getRepository(Ingredient::class);

        return new PreferencePageHandler($template, $preferenceService, $ingredientRepository);
    }
}
