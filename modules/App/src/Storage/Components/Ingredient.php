<?php

declare(strict_types=1);

namespace App\Storage\Components;

class Ingredient
{
    public function __construct(
        private string $name,
        private string $description,
        private string $id, //Hardcoded & must be synced to device
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

    public function getId(): string
    {
        return $this->id;
    }
}
