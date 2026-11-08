<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class LegalController extends Controller
{
    public function show(string $page): View
    {
        $legal = config("legal.pages.{$page}");

        abort_if($legal === null, 404);

        return view('pages.legal', ['legal' => $legal]);
    }
}
