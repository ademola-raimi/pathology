<?php

namespace App\Http\Controllers;

use App\User;
use App\Report;
use App\Patient;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Load admin page.
     *
     * @return dashboard
     */
    public function adminPage()
    {
        return view('dashboard.index');
    }

    /**
     * Get all patients.
     *
     * @return patients
     */
    public function getPatients()
    {
    	$patients = Patient::paginate(10);

    	return view('dashboard.all-patients', compact('patients'));
    }

    /**
     * Get all reports.
     *
     * @return reports
     */
    public function getReports()
    {
    	$reports  = Report::with('patient')->get();

        return view('dashboard.all-reports', compact('reports'));
    }
}
