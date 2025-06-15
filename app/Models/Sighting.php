<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Sighting
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $species_id
 * @property float $latitude
 * @property float $longitude
 * @property int $individuals
 * @property string $observed_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Species $species
 */

class Sighting extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'species_id',
        'latitude',
        'longitude',
        'individuals',
        'observed_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'observed_at' => 'date'
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function species(): BelongsTo
    {
        return $this->belongsTo(Species::class);
    }
}
