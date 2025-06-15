<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Species;
use App\Services\SpeciesService;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class SpeciesController
 * @package App\Http\Controllers
 */
class SpeciesController extends Controller
{
    private SpeciesService $speciesService;

    /**
     * @param SpeciesService $speciesService
     */
    public function __construct(SpeciesService $speciesService)
    {
        $this->speciesService = $speciesService;
    }

    /**
     * @param Request $request
     * @return Application|View
     */
    public function createOrEdit(Request $request): Application|View
    {
        $species = null;
        $images = collect();

        if ($request->has('id')) {
            $species = Species::findOrFail($request->id);
            $images = $species->getMedia('species_images');
        }

        return view('species.create-edit', compact('species', 'images'));
    }


    /**
     * @return RedirectResponse
     */
    public function index(): object
    {
        $species = Species::paginate(12);

        $totalPlants = Species::plants()->count();
        $totalAnimals = Species::animals()->count();
        $totalSpecies = Species::count();

        return view('species.index', compact('species','totalPlants', 'totalAnimals', 'totalSpecies'));
    }

    /**
     * @param Species $species
     * @return RedirectResponse
     */
    public function show(Species $species): object
    {
        $images = $species->getMedia('species_images');
        $totalRecordedSpecies = $species->sightings()->get()->sum('individuals');
        $sightings = $species->sightings()->select('latitude', 'longitude', 'observed_at', 'individuals')->get();

        return view('species.show', compact('species', 'images', 'totalRecordedSpecies', 'sightings'));
    }

    /**
     * @param CreateSpeciesRequest $request
     * @return RedirectResponse
     */
    public function storeSpecie(CreateSpeciesRequest $request): RedirectResponse
    {
        try {
            $this->speciesService->storeSpecie($request);

            return redirect()->route('listSpeciesFront')->with('message', 'Especie rexistrada correctamente');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param UpdateSpeciesRequest $request
     * @return RedirectResponse
     */
    public function editSpecie(UpdateSpeciesRequest $request): RedirectResponse
    {
        try {
            $this->speciesService->editSpecie($request);

            return redirect()->route('listSpeciesFront')->with('message', 'Especie modificada correctamente');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * @param Species $species
     * @return RedirectResponse
     */
    public function destroy(Species $species): RedirectResponse
    {
        try {
            $this->speciesService->destroySpecie($species);

            return redirect()->route('listSpeciesFront')->with('message', 'Especie eliminada correctamente');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }
}
