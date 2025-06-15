<?php

namespace App\Repositories;

use App\Models\ConservationStatus;

/**
 * Class ConservationStatusRepository
 * @package App\Repositories
 */
class ConservationStatusRepository extends BaseRepository
{
    public function model(): string
    {
        return ConservationStatus::class;
    }

}
