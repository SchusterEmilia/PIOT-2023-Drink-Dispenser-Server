<?php

declare(strict_types=1);

namespace App\Storage\Components;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'preferences2ingredients')]
class Preference2Ingredients
{
    public function __construct(
        #[Id]
        #[Column(name: 'id', type: Types::INTEGER)]
        #[GeneratedValue(strategy: 'IDENTITY')]
        private ?int $id,
        #[ManyToOne(targetEntity: Preference::class, fetch: 'EAGER', inversedBy: 'preferenceIngredients')]
        #[JoinColumn(name: 'preference_uid', referencedColumnName: 'uid', nullable: false, onDelete: 'CASCADE')]
        private Preference $preference,
        #[ManyToOne(targetEntity: Ingredient::class, fetch: 'EAGER')]
        #[JoinColumn(name: 'ingredient_id', referencedColumnName: 'id', nullable: false)]
        private Ingredient $ingredient,
        #[Column(name: 'percentage', type: Types::INTEGER)]
        private int $percentage, //Should add up to 100
    ) {
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPreference(): Preference
    {
        return $this->preference;
    }

    public function getIngredient(): Ingredient
    {
        return $this->ingredient;
    }

    public function getPercentage(): int
    {
        return $this->percentage;
    }
}
