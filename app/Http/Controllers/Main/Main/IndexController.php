<?php

namespace App\Http\Controllers\Main\Main;

use App\Helpers\FootballParser;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {

        $isAdmin = auth()->user()->is_admin;

        return inertia('Main', compact('isAdmin'));
    }
}
