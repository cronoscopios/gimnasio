<?php

namespace App\Http\Controllers;

use App\Models\ScheduledClass;
use Illuminate\View\View;

class ScheduledClassController extends Controller
{
    /**
     * Show the weekly class timetable.
     */
    public function index(): View
    {
        return view('scheduled-classes.index', [
            'classesByDay' => ScheduledClass::with(['activity', 'trainer'])
                ->chronological()
                ->get()
                ->groupBy('day_of_week'),
        ]);
    }
}
