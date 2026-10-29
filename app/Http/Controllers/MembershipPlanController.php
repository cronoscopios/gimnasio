<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use Illuminate\View\View;

class MembershipPlanController extends Controller
{
    /**
     * Show the pricing page.
     */
    public function index(): View
    {
        return view('membership-plans.index', [
            'plans' => MembershipPlan::ordered()->get(),
        ]);
    }
}
