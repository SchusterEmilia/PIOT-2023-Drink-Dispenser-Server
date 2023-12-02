<?php

declare(strict_types=1);

namespace App\Handler;

use Chubbyphp\Container\MinimalContainer;
use DI\Container as PHPDIContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\LaminasRouter;
use Mezzio\Template\TemplateRendererInterface;
use Pimple\Psr11\Container as PimpleContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HomePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template = null
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return new HtmlResponse($this->template->render('app::home-page'));
    }
}
