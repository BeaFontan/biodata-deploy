<?php

namespace App\Repositories;

use App\Models\Sighting;

/**
 * Class SightingRepository
 * @package App\Repositories
 */
class SightingRepository extends BaseRepository
{
    public function model(): string
    {
        return Sighting::class;
    }

}
