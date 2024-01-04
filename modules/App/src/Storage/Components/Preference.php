<?php

declare(strict_types=1);

namespace App\Storage\Components;

use App\Storage\Repositories\PreferenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: PreferenceRepository::class)]
#[Table(name: 'preferences')]
class Preference
{
    /**
     * @param Collection<int, Preference2Ingredients> $preferenceIngredients
     */
    private function __construct(
        #[Id]
        #[Column(type: Types::STRING, length: 64, unique: true)]
        private string $uid,
        #[OneToMany(
            mappedBy: 'preference',
            targetEntity: Preference2Ingredients::class,
            cascade: ['remove'],
            fetch: 'LAZY'
        )]
        private Collection $preferenceIngredients,
    ) {
    }

    public static function createNew(string $uid): Preference
    {
        return new Preference(
            $uid,
            new ArrayCollection()
        );
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @return Collection<int, Preference2Ingredients>
     */
    public function getPreferenceIngredients(): Collection
    {
        return $this->preferenceIngredients;
    }

    /**
     * @return list<Preference2Ingredients>
     */
    public function getHighestIngredients(): array
    {
        $ingredients = $this->getPreferenceIngredients()->getValues();
        usort($ingredients, function (Preference2Ingredients $ingredient1, Preference2Ingredients $ingredient2): int {
            return $ingredient2->getPercentage() - $ingredient1->getPercentage();
        });

        return $ingredients;
    }
}
