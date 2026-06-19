<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class DashboardController extends Controller
{
    public function index()
    {
        $penyakitList = Penyakit::all();

        return view('dashboard', compact('penyakitList'));
    }
}
