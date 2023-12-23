<?php

declare(strict_types=1);

namespace App\Handler\API;

use App\Services\PreferenceService;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GetPreferenceHandler implements RequestHandlerInterface
{
    public function __construct(
        private PreferenceService $preferenceService
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
        assert(is_string($uid));
        $preference = $this->preferenceService->getPreference($uid);
        $preferenceIngredients = [];
        if ($preference !== null) {
            $preferenceIngredientsUnsorted = $preference->getPreferenceIngredients()->getValues();
            foreach ($preferenceIngredientsUnsorted as $preferenceIngredient) {
                $id = $preferenceIngredient->getIngredient()->getId();
                $preferenceIngredients[$id] = $preferenceIngredient->getPercentage();
            }
            $status = 200;
        }
        return new JsonResponse($preferenceIngredients, $status);
    }
}
