<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class StatisticsController extends Controller
{
    public function index()
    {
        /**
         * show if user is from accounts, exams, itunit or principal office
         */
        if((Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit')) || Auth::user()->hasRole('superadmin')||
            (Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('accounts')) || (Auth::user()->hasRole('accounts')) ||
            Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('exams') || Auth::user()->hasRole('exams')||
            Auth::user()->hasRole('manager') && Auth::user()->belongsTodepartmentOf('principal office') || Auth::user()->hasRole('manager')
                
            )
        {
            return view('statistics.index');
            
        }
        else{
            abort(403, 'You are not authorised to view this page');
        }        
        
    }
}
