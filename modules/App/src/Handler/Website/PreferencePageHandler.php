<?php

declare(strict_types=1);

namespace App\Handler\Website;

use App\Services\PreferenceService;
use App\Storage\Repositories\IngredientRepository;
use Laminas\Diactoros\Response\EmptyResponse;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PreferencePageHandler implements RequestHandlerInterface
{
    public function __construct(
        private TemplateRendererInterface $template,
        private PreferenceService $preferenceService,
        private IngredientRepository $ingredientRepository,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $error = false;
        $percentageError = false;
        $queryparams = $request->getQueryParams();
        $uid = $queryparams['uid'] ?? null;
        if (!is_string($uid)) {
            return new EmptyResponse(400);
        }
        if ($request->getMethod() === 'POST') {
            //TODO: doPost
            $params = $request->getParsedBody();
            $parsedParams = $this->doParse($params);
            if ($parsedParams === null) {
                return new EmptyResponse(400);
            }
            $ingredientAmounts = [];
            $parsedIngredients = $parsedParams['ingredients'];
            foreach ($parsedIngredients as $parsedIngredient) {
                $ingredient = $this->ingredientRepository->find($parsedIngredient['id']);
                if ($ingredient === null) {
                    continue;
                }
                $ingredientAmounts[] = ['ingredient' => $ingredient, 'percentage' => $parsedIngredient['percentage']];
            }
            $percentage = 0;
            foreach ($ingredientAmounts as $ingredientAmount){
                $percentage += $ingredientAmount['percentage'];
            }
            if($percentage === 100){
                $this->preferenceService->setPreference($parsedParams['uid'], $ingredientAmounts);
            } else {
                $error = true;
                $percentageError = true;
            }
        }
        $preference = $this->preferenceService->getPreference($uid);
        $ingredients = $this->ingredientRepository->findAll();
        $preferenceIngredients = [];
        if ($preference !== null) {
            $preferenceIngredientsUnsorted = $preference->getPreferenceIngredients()->getValues();
            foreach ($preferenceIngredientsUnsorted as $preferenceIngredient) {
                $id = $preferenceIngredient->getIngredient()->getId();
                $preferenceIngredients[$id] = $preferenceIngredient->getPercentage();
            }
        }
        return new HtmlResponse($this->template->render('app::preference', [
            'preference'            => $preference,
            'preferenceIngredients' => $preferenceIngredients,
            'uid'                   => $uid,
            'ingredients'           => $ingredients,
            'error'                 => $error,
            'percentageError'       => $percentageError,
        ]));
    }

    /**
     * @return null|array{uid: string, ingredients: list<array{id: int, percentage: int}>}
     */
    private function doParse(mixed $params): ?array
    {
        if (is_array($params)) {
            $parsedParameters = [];
            $parsedParameters['ingredients'] = [];
            $uid = $params['UID'] ?? '';
            assert(is_string($uid));
            $parsedParameters['uid'] = $uid;
            $rawIngredients = array_filter($params, function (string $key): bool {
                return str_starts_with($key, 'ingredient-');
            }, ARRAY_FILTER_USE_KEY);
            foreach ($rawIngredients as $rawIngredientId => $percentage) {
                $ingredientId = (int) str_replace('ingredient-', '', $rawIngredientId);
                assert(is_string($percentage));
                $percentageInt = (int) $percentage;
                if ($percentageInt === 0) {
                    continue;
                }
                $parsedParameters['ingredients'][] = ['id' => $ingredientId, 'percentage' => $percentageInt];
            }

            return $parsedParameters;
        }

        return null;
    }
}
