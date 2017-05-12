<?php

namespace App\Http\Controllers;

use Auth;
use Alert;
use App\User;
use Validator;
use App\Report;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\ReportRequest;
use App\Http\Requests\PatientTestRequest;

class OperatorUserController extends Controller
{
    /**
     * Get patient form.
     *
     * @return view
     */
    public function getPatientForm()
    {
    	return view('dashboard.operator.patient-test-result');
    }

    /**
     * Create a new patient
     *
     * @param  Request  $request
     * @return dashboard
     */
    public function postPatient(PatientTestRequest $request)
    {
        Patient::create([
            'name'          => $request['name'],
            'user_id'       => auth()->user()->id,
            'phone_number'  => $request['phone_number'],
            'date_of_birth' => $request['date_of_birth'],
            'email'         => $request['email'],
            'patient_id'    => rand(),
            'case_number'   => rand(),
        ]);

        alert()->success('Your record has been successully recorded', 'success');

        return redirect()->route('getAdminPage');
    }

    /**
     * Get report form.
     *
     * @return view
     */
    public function getReportForm()
    {
    	$patients = Patient::all();

    	return view('dashboard.operator.patient-report', compact('patients'));
    }

    /**
     * Create a new report
     *
     * @param  Request  $request
     * @return dashboard
     */
    public function postReport(ReportRequest $request)
    {
        Report::create([
            'user_id'     => auth()->user()->id,
            'patient_id'  => $request['patient_id'],
            'description' => $request['description'],
            'statement'   => $request['statement'],
        ]);

        alert()->success('Your record has been successully recorded', 'success');

        return redirect()->route('getAdminPage');
    }

    /**
     * This method gets edit from of patient
     *
     * @param $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function editPatientForm($id)
    {
        $patient      = Patient::find($id);

        if (is_null($patient)) {
            alert()->error('Oops! Something went wrong');

            return redirect()->route('getAdminPage');  
        }
        
        return view('dashboard.operator.update-patient-test', compact('patient'));
    }

    /**
     * This method validates the inputed data and updates the requested patient form
     *
     * @param $id
     * @param $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updatePatient($id, Request $request)
    {
        $this->validate($request, [
            'phone_number'  => 'required',
            'email'         => 'required|email|unique:patients,email,'.$request->id,
            'date_of_birth' => 'required',
            'name'          => 'required',
        ]);

        $patient = Patient::where('id', $request->id)->update([
            'phone_number'  => $request->phone_number,
            'email'         => $request['email'],
            'name'          => $request->name,
            'date_of_birth' => $request->date_of_birth,
        ]);
        
        if ($patient) {
            alert()->success('Patient updated succesfully', 'success');

            return redirect()->route('getPatients'); 
        } else {
            alert()->error('Something went wrong', 'error');

            return redirect()->back();
        }
    }

    /**
     * This method deletes or destroys patient
     *
     * @return \Illuminate\Http\Response
     */
    public function deletePatient($id)
    {
        $patient = Patient::find($id);

        if (is_null($patient)) {
            alert()->error('Oops! Something went wrong');

            return redirect()->route('getAdminPage');  
        }

        $patientDelete = $patient->delete();

        if ($patientDelete) {
            alert()->success('Patient deleted succesfully', 'success');

            return redirect()->route('getAdminPage'); 
        } else {
           alert()->error('Something went wrong', 'error');

            return redirect()->route('getPatients');
        }
    }

    /**
     * This method gets edit form of report
     *
     * @param $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function editReportForm($id)
    {
        $report = Report::find($id);

        if (is_null($report)) {
            alert()->error('Oops! Something went wrong');

            return redirect()->route('getAdminPage');  
        }
        
        return view('dashboard.operator.update-report', compact('report'));
    }

    /**
     * This method validates the inputed data and updates the requested report form
     *
     * @param $id
     * @param $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateReport($id, Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'statement'   => 'required',
        ]);

        $report = Report::where('id', $request->id)->update([
            'description' => $request->description,
            'statement'   => $request['statement'],
        ]);
        
        if ($report) {
            alert()->success('Report updated succesfully', 'success');

            return redirect()->route('getPatients'); 
        } else {
            alert()->error('Something went wrong', 'error');

            return redirect()->back();
        }
    }

    /**
     * This method deletes or destroys report
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteReport($id)
    {
        $report = Report::find($id);

        if (is_null($report)) {
            alert()->error('Oops! Something went wrong');

            return redirect()->route('getAdminPage');  
        }

        $reportDelete = $report->delete();

        if ($reportDelete) {
            alert()->success('Report deleted succesfully', 'success');

            return redirect()->route('getAdminPage'); 
        } else {
           alert()->error('Something went wrong', 'error');

            return redirect()->route('getPatients');
        }
    }
}
