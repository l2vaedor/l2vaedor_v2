<?php

namespace App\Http\Controllers;

use App\Support\PatchNotes;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('welcome', [
            'patchNotes' => PatchNotes::latest(3),
        ]);
    }
}
