<?php

namespace App\Models;

use Database\Factories\ScheduledClassFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['activity_id', 'trainer_id', 'day_of_week', 'starts_at', 'ends_at', 'room'])]
class ScheduledClass extends Model
{
    /** @use HasFactory<ScheduledClassFactory> */
    use HasFactory;

    /**
     * Spanish day names indexed by ISO-8601 day of week (1 = Monday).
     *
     * @var array<int, string>
     */
    public const DAY_NAMES = [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
    ];

    /**
     * Get the activity taught in this class.
     *
     * @return BelongsTo<Activity, $this>
     */
    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    /**
     * Get the trainer who teaches this class.
     *
     * @return BelongsTo<Trainer, $this>
     */
    public function trainer(): BelongsTo
    {
        return $this->belongsTo(Trainer::class);
    }

    /**
     * Order classes chronologically through the week.
     *
     * @param  Builder<ScheduledClass>  $query
     */
    #[Scope]
    protected function chronological(Builder $query): void
    {
        $query->orderBy('day_of_week')->orderBy('starts_at');
    }
}
