<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\MembershipPlan;
use App\Models\Trainer;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function __invoke(): View
    {
        return view('pages.home', [
            'activities' => Activity::ordered()->limit(6)->get(),
            'trainers' => Trainer::ordered()->limit(3)->get(),
            'cheapestPlan' => MembershipPlan::orderBy('monthly_price_cents')->first(),
        ]);
    }
}
