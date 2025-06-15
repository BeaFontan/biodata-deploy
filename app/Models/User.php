<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

/**
 * Class User
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $email
 * @property string $password
 * @property boolean $must_change_password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property Sighting[] sightings
 * @property Species[] $species
 */

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, HasRoles, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'password',
        'must_change_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'must_change_password' => 'boolean'
        ];
    }

    /**
     * Function to appoint Scientist rol.
     *
     * @return void
     */
    public function assignAdminRole(): void
    {
        $this->assignRole('admin');
    }

    /**
     * Function to appoint Scientist rol.
     *
     * @return void
     */
    public function assignScientistRole(): void
    {
        $this->assignRole('scientist');
    }

    /**
    * Function to appoint Public rol.
     *
     * @return void
     */
    public function assignPublicRole(): void
    {
        $this->assignRole('public');
    }

    /**
     * @return HasMany
     */
    public function sightings(): HasMany
    {
        return $this->hasMany(Sighting::class);
    }

    /**
     * @return HasMany
     */
    public function species(): HasMany
    {
        return $this->hasMany(Species::class);
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
            ->addMediaConversion('default')
            ->fit(Fit::Crop, 400, 400)
            ->nonQueued();
    }
}
