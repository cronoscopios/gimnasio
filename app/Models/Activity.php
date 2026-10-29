<?php

namespace App\Models;

use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'slug', 'summary', 'description', 'level', 'duration_minutes', 'sort_order'])]
class Activity extends Model
{
    /** @use HasFactory<ActivityFactory> */
    use HasFactory;

    /**
     * Get the weekly classes scheduled for this activity.
     *
     * @return HasMany<ScheduledClass, $this>
     */
    public function scheduledClasses(): HasMany
    {
        return $this->hasMany(ScheduledClass::class);
    }

    /**
     * Order activities as they should be listed on the website.
     *
     * @param  Builder<Activity>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('name');
    }
}
