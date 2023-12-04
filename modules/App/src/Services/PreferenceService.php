<?php

declare(strict_types=1);

namespace App\Services;

use App\Storage\Components\Preference;

class PreferenceService
{
    public function getPreference(string $uid): ?Preference
    {
        //TODO fetch from repository and database
        $preference = new Preference($uid, 100, 0);

        return $preference;
    }

    public function setPreference(string $uid, mixed ...$notYetUsed): bool
    {
        //TODO decide on arguments structure and save to db
        return true;
    }
}
