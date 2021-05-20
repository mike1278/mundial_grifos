<?php

namespace App\Http\Controllers;

class FallBackController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('login');
    }
}
