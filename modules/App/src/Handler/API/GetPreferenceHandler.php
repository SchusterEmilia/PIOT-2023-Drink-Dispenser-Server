<?php

declare(strict_types=1);

namespace App\Handler\API;

use App\Services\PreferenceService;
use Chubbyphp\Container\MinimalContainer;
use DI\Container as PHPDIContainer;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\LaminasView\LaminasViewRenderer;
use Mezzio\Plates\PlatesRenderer;
use Mezzio\Router\LaminasRouter;
use Mezzio\Template\TemplateRendererInterface;
use Pimple\Psr11\Container as PimpleContainer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class GetPreferenceHandler implements RequestHandlerInterface
{
    public function __construct(
        private ?TemplateRendererInterface $template,
        private ?PreferenceService $preferenceService
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $uid = $params['uid'] ?? null;

        if ($uid === null) {
            return new JsonResponse([], 400);
        }
        $status = 404;
        $data = null;
        $preference = $this->preferenceService->getPreference($uid);
        if ($preference !== null) {
            $data = $preference;
            $status = 200;
        }
        return new JsonResponse($data, $status);
    }
}
