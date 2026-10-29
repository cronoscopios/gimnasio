<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\View\View;

class ActivityController extends Controller
{
    /**
     * Show the list of activities.
     */
    public function index(): View
    {
        return view('activities.index', [
            'activities' => Activity::ordered()->get(),
        ]);
    }

    /**
     * Show a single activity with its weekly classes.
     */
    public function show(Activity $activity): View
    {
        return view('activities.show', [
            'activity' => $activity,
            'scheduledClasses' => $activity->scheduledClasses()->with('trainer')->chronological()->get(),
        ]);
    }
}
