<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\View\View;

class TrainerController extends Controller
{
    /**
     * Show the team page.
     */
    public function index(): View
    {
        return view('trainers.index', [
            'trainers' => Trainer::ordered()->get(),
        ]);
    }
}
