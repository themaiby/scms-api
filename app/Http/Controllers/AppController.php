<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AppController extends Controller
{
    protected const API_VERSION = 1;

    /**
     * @return View
     */
    public function renderApp(): View
    {
        return view('app');
    }
}
