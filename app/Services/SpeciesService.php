<?php

namespace App\Services;

use App\Http\Requests\CreateSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Species;
use App\Repositories\SpeciesRepository;
use Relay\Exception;

/**
 * Class SpeciesService
 * @package App\Services
 */
class SpeciesService
{
    private SpeciesRepository $speciesRepository;

    /**
     * @param SpeciesRepository $speciesRepository
     */
    public function __construct(SpeciesRepository $speciesRepository)
    {
        $this->speciesRepository = $speciesRepository;
    }

    /**
     * @param CreateSpeciesRequest $request
     * @throws Exception
     */
    public function storeSpecie(CreateSpeciesRequest $request): void
    {
        $this->speciesRepository->storeSpecie($request);
    }

    /**
     * @param UpdateSpeciesRequest $request
     * @throws Exception
     */
    public function editSpecie(UpdateSpeciesRequest $request): void
    {
        $this->speciesRepository->editSpecie($request);
    }

    /**
     * @param Species $species
     */
    public function destroySpecie(Species $species): void
    {
        $this->speciesRepository->delete($species);
    }

}
