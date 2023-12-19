<?php

declare(strict_types=1);

namespace App\Storage\Components;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name: 'actions')]
class Action
{
    public function __construct(
        #[Id]
        #[Column(type: Types::INTEGER)]
        #[GeneratedValue(strategy: 'IDENTITY')]
        private ?int $id,
        #[Column(type: Types::STRING, length: 64, unique: true)]
        private string $uid,
        #[Column(type: Types::DATETIME_IMMUTABLE)]
        private \DateTimeImmutable $date,
        #[Column(type: Types::BOOLEAN)]
        private bool $successful,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): string
    {
        return $this->uid;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function isSuccessful(): bool
    {
        return $this->successful;
    }
}
