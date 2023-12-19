<?php

declare(strict_types=1);

namespace App\Services;

use App\Storage\Components\Ingredient;
use App\Storage\Components\Preference;
use App\Storage\Components\Preference2Ingredients;
use App\Storage\Repositories\PreferenceRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\ORMException;

class PreferenceService
{

    public function __construct(
        private EntityManager $entityManager,
        private PreferenceRepository $preferenceRepository,
    )
    {
    }
    public function getPreference(string $uid): ?Preference
    {
        return $this->preferenceRepository->find($uid);
    }


    /**
     * @param list<array{ingredient: Ingredient, percentage: int}> $ingredients
     */
    public function setPreference(string $uid, array $ingredients): bool
    {
        $preference = $this->preferenceRepository->find($uid);
        if ($preference === null){
            $preference = Preference::createNew($uid);
            $this->entityManager->persist($this->entityManager);
        }
        $preference->getPreferenceIngredients()->clear();
        foreach ($ingredients as $ingredient){
            $p2i = Preference2Ingredients::createNew($preference, $ingredient["ingredient"], $ingredient["percentage"]);
            $preference->getPreferenceIngredients()->add($p2i);
        }

        $this->entityManager->flush();

        return true;
    }
}
