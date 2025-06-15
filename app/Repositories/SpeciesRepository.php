<?php

namespace App\Repositories;

use App\Http\Requests\CreateSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Species;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Relay\Exception;
use Throwable;

/**
 * Class SpeciesRepository
 * @package App\Repositories
 */
class SpeciesRepository extends BaseRepository
{
    public function model(): string
    {
        return Species::class;
    }

    /**
     * @param CreateSpeciesRequest $request
     * @return Species
     * @throws Exception
     */
    public function storeSpecie( CreateSpeciesRequest $request): Species
    {
        DB::beginTransaction();

        try {
            $species = new Species();
            $species->fill($request->validated());
            $species->user_id = Auth::id();
            $species->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $species
                        ->addMedia($image)
                        ->toMediaCollection('species_images', 'public');
                }
            }

            DB::commit();
            return $species;
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @param UpdateSpeciesRequest $request
     * @return Species
     * @throws Exception
     */
    public function editSpecie(UpdateSpeciesRequest $request): Species
    {
        DB::beginTransaction();

        try {
            $species = new Species();
            $species->update($request->validated());
            $species->user_id = Auth::id();
            $species->save();

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $species
                        ->addMedia($image)
                        ->toMediaCollection('species_images', 'public');
                }
            }

            DB::commit();
            return $species;
        } catch (Throwable $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }
}
