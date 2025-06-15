<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class ConservationStatus
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $label
 * @property string $color
 * @property int $threshold
 * @property string $actions
 * @property boolean $should_notify
 * @property string $created_at
 * @property string $updated_at
 * @property Species[] $species
 */

class ConservationStatus extends Model
{
    const CONSERVATION_STATUS_VERY_DANGER = 'VERY_DANGER';
    const CONSERVATION_STATUS_DANGER = 'DANGER';
    const CONSERVATION_STATUS_SLIGHT = 'SLIGHT';
    const CONSERVATION_STATUS_WATCHED = 'WATCHED';
    const CONSERVATION_STATUS_NORMAL = 'NORMAL';

    protected $table = 'conservation_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'label',
        'color',
        'threshold',
        'actions',
        'should_notify'
    ];

    /**
     * @return HasMany
     */
    public function species(): HasMany
    {
        return $this->hasMany(Species::class);
    }
}
