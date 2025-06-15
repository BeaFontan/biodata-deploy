<?php

namespace App\Services;

use App\Repositories\ConservationStatusRepository;

/**
 * Class ConservationStatusService
 * @package App\Services
 */
class ConservationStatusService
{
    private ConservationStatusRepository $conservationStatusRepository;

    /**
     * @param ConservationStatusRepository $conservationStatusRepository
     */
    public function __construct(ConservationStatusRepository $conservationStatusRepository)
    {
        $this->conservationStatusRepository = $conservationStatusRepository;
    }
}
