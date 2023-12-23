<?php

declare(strict_types=1);

namespace App\Storage\Components;

use App\Storage\Repositories\IngredientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity(repositoryClass: IngredientRepository::class)]
#[Table(name: 'ingredients')]
class Ingredient
{
    public function __construct(
        #[Column(type: Types::STRING, length: 255)]
        private string $name,
        #[Column(type: Types::TEXT, length: 1024)]
        private string $description,
        #[Id]
        #[Column(type: Types::INTEGER)]
        private int $id, //Hardcoded & must be synced to device
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
