<?php

namespace App\Http\Controllers;

use App\Services\ConservationStatusService;

/**
 * Class ConservationStatusController
 * @package App\Http\Controllers
 */
class ConservationStatusController extends Controller
{
    private ConservationStatusService $conservationStatusService;

    /**
     * @param ConservationStatusService $conservationStatusService
     */
    public function __construct(ConservationStatusService $conservationStatusService)
    {
        $this->conservationStatusService = $conservationStatusService;
    }

}
