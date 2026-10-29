<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\View\View;

class FaqController extends Controller
{
    /**
     * Show the frequently asked questions page.
     */
    public function index(): View
    {
        return view('faqs.index', [
            'faqs' => Faq::ordered()->get(),
        ]);
    }
}
