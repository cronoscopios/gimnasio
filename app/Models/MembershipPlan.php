<?php

namespace App\Models;

use Database\Factories\MembershipPlanFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Number;

#[Fillable(['name', 'description', 'monthly_price_cents', 'enrollment_fee_cents', 'commitment_months', 'features', 'is_featured', 'sort_order'])]
class MembershipPlan extends Model
{
    /** @use HasFactory<MembershipPlanFactory> */
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'features' => 'array',
            'is_featured' => 'boolean',
        ];
    }

    /**
     * Get the monthly price, VAT included, formatted in euros.
     *
     * @return Attribute<string, never>
     */
    protected function formattedMonthlyPrice(): Attribute
    {
        return Attribute::get(fn (): string => Number::currency($this->monthly_price_cents / 100, 'EUR', 'es'));
    }

    /**
     * Get the one-off enrollment fee, VAT included, formatted in euros.
     *
     * @return Attribute<string, never>
     */
    protected function formattedEnrollmentFee(): Attribute
    {
        return Attribute::get(fn (): string => Number::currency($this->enrollment_fee_cents / 100, 'EUR', 'es'));
    }

    /**
     * Order plans as they should be listed on the website.
     *
     * @param  Builder<MembershipPlan>  $query
     */
    #[Scope]
    protected function ordered(Builder $query): void
    {
        $query->orderBy('sort_order')->orderBy('monthly_price_cents');
    }
}
