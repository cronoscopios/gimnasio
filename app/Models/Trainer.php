<?php

namespace App\Models;

use Database\Factories\TrainerFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'specialty', 'bio', 'qualifications', 'photo_path', 'sort_order'])]
class Trainer extends Model
{
    /** @use HasFactory<TrainerFactory> */
    use HasFactory;

    /**
     * Get the weekly classes taught by this trainer.
     *
     * @return HasMany<ScheduledClass, $this>
     */
    public function scheduledClasses(): HasMany
    {
        return $this->hasMany(ScheduledClass::class);
    }

    /**
     * Order trainers as they should be listed on the website.
     *
     * @param  Builder<Trainer>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }
}
