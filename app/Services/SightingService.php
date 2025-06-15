<?php

namespace App\Services;

use App\Models\Species;
use App\Repositories\SightingRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class SightingService
 * @package App\Services
 */
class SightingService
{
    private SightingRepository $sightingRepository;

    /**
     * @param SightingRepository $sightingRepository
     */
    public function __construct(SightingRepository $sightingRepository)
    {
        $this->sightingRepository = $sightingRepository;
    }

    /**
     * @param array $input
     * @param Species $species
     */
    public function store(array $input, Species $species): void
    {
        $input['user_id'] = Auth::user()->id;
        $input['species_id'] = $species->id;

        $this->sightingRepository->create($input);
    }
}
