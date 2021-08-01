<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class DashboardController extends Controller
{
    public function index()
    {
        $exam_results = Auth::user()->results()->get();
        return view('dashboard.index', compact('exam_results'));
    }
}
