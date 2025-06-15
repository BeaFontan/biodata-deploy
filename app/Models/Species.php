<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class Species
 *
 * @package App\Models
 * @property int $id
 * @property string $type
 * @property string $user_id
 * @property string $conservation_status_id
 * @property string $scientific_name
 * @property string $common_name
 * @property string $kingdom
 * @property string $phylum
 * @property string $class
 * @property string $order
 * @property string $family
 * @property string $genus
 * @property string $species_name
 * @property string $subspecies
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property ConservationStatus $conservationStatus
 * @property Sighting[] $sightings
 */

class Species extends Model implements HasMedia
{
    use InteractsWithMedia;
    const TYPE_ANIMAL = 'animal';
    const TYPE_PLANT = 'plant';

    public static function types(): array
    {
        return [
            self::TYPE_ANIMAL => 'ANIMAL',
            self::TYPE_PLANT => 'PLANT',
        ];
    }

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'type',
        'user_id',
        'conservation_status_id',
        'scientific_name',
        'common_name',
        'kingdom',
        'phylum',
        'class',
        'order',
        'family',
        'genus',
        'species_name',
        'subspecies'
    ];

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
    public function conservationStatus(): BelongsTo
    {
        return $this->belongsTo(ConservationStatus::class);
    }

    /**
     * @return HasMany
     */
    public function sightings(): HasMany
    {
        return $this->hasMany(Sighting::class);
    }

    /**
     * Function to appoint Media Convertions.
     *
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('image')
            ->fit(Fit::Crop, 300, 400)
            ->nonQueued();
    }

    /**
     * @param $query
     * @return void
     */
    public function scopePlants($query)
    {
        return $query->where('type', self::TYPE_PLANT);
    }

    /**
     * @param $query
     * @return void
     */
    public function scopeAnimals($query)
    {
        return $query->where('type', self::TYPE_ANIMAL);
    }
}
