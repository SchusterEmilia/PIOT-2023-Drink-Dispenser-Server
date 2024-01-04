<?php

declare(strict_types=1);

namespace App\Storage\Repositories;

use App\Storage\Components\Ingredient;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<Ingredient>
 */
class IngredientRepository extends EntityRepository
{
}
