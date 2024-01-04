<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Storage\Repositories\PreferenceRepository;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PreferencesOverviewPageHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private PreferenceRepository $preferenceRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $preferences = $this->preferenceRepository->findAll();
        return new HtmlResponse($this->template->render('app::preferences-overview', [
            'preferences' => $preferences,
        ]));
    }
}
