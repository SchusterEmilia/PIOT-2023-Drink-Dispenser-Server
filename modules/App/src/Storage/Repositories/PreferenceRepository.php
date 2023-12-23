<?php

declare(strict_types=1);

namespace App\Storage\Repositories;

use App\Storage\Components\Preference;
use Doctrine\ORM\EntityRepository;

/**
 * @template-extends EntityRepository<Preference>
 */
class PreferenceRepository extends EntityRepository
{
}
