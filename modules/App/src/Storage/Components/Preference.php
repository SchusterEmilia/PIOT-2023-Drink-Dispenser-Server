<?php

declare(strict_types=1);

namespace App\Storage\Components;

class Preference
{

    //TODO: expand for infinite amount of ingredients by relegating this to a list of components
    //TODO: alternatively a steps like solution like "Step1: coffee 90%, Step2: oat-milk 10%". Or "Step1: vodka 45% & cola 45%, Step2: tabasco 10%"

    public function __construct(
        public string $uid,
        public int $ingredients1percent,
        public int $ingredients2percent)
    {
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getIngredients1percent(): int
    {
        return $this->ingredients1percent;
    }

    public function getIngredients2percent(): int
    {
        return $this->ingredients2percent;
    }



}