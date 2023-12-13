<?php

declare(strict_types=1);

namespace App\Storage\Components;

class Preference
{
    public function __construct(
        private string $uid,
    ) {
    }

    public function getUid(): string
    {
        return $this->uid;
    }
}
