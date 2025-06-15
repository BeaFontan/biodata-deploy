<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSightingsRequest;
use App\Models\Species;
use App\Services\SightingService;
use Exception;
use Illuminate\Http\RedirectResponse;

/**
 * Class SightingController
 * @package App\Http\Controllers
 */
class SightingController extends Controller
{
    private SightingService $sightingService;

    /**
     * @param SightingService $sightingService
     */
    public function __construct(SightingService $sightingService)
    {
        $this->sightingService = $sightingService;
    }

    /**
     * @param CreateSightingsRequest $request
     * @param Species $species
     * @return RedirectResponse
     */
    public function store(CreateSightingsRequest $request, Species $species): RedirectResponse
    {
        try {
            $input = $request->validated();
            $this->sightingService->store($input, $species);

            return redirect()->route('speciesFront', $species)->with('message', 'Avistamento rexistrado correctamente');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

}
