<?php

namespace App\Http\Controllers;

use Alert;
use Illuminate\Support\Facades\DB;
use App\User;
use PHPMailer;
use App\Report;
use App\Patient;
use Illuminate\Http\Request;
use App\Http\Requests\PatientLoginRequest;
use Collective\Html\Eloquent\FormAccessible;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PatientController extends Controller
{
    protected $mailer;

    public function __construct(PHPMailer $mailer)
    {
        $this->mailer = $mailer;
    }
    
    /**
     * Create a new user instance after a valid staff login.
     *
     * @param  Request  $request
     * @return User
     */
    public function postPatientLoginForm(PatientLoginRequest $request)
    {
        $patient = Patient::where('patient_id', $request->patient_id)->where('name', $request->patient_name)->first();

        if (!$patient) {
            Alert::error('Your login details does not match', 'Error');

            return redirect()->back();
        }

        alert()->success('You are now signed in', 'Success');

        return $this->patientReport($patient);
    }

    /**
     * Implement autocomplete
     *
     * @param  Request  $request
     * @return view
     */
    public function autocomplete(Request $request)
    {
        $term    = $request->term;
        $results = [];

        $queries = Patient::where('name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();

        foreach ($queries as $query)
        {
            $results[] = [ 'id' => $query->id, 'value' => $query->name ];
        }

        return response()->json($results);
    }

    /**
     * Loads the report of patient
     *
     * @param  Request  $request
     * @return view
     */
    protected function patientReport($patient)
    {
    	$reports =  Report::where('patient_id', $patient->id)->get();

    	return view('layout.patient.patient-report', compact('reports', 'patient'));
    }

    /**
     * get a single report
     *
     * @param  Request  $request
     * @return view
     */
    public function getSingleReport($id)
    {
        $report = Report::with('patient', 'user')->get();
    	$report  = Report::where('id', $id)->first();
    	$user    = User::where('id', $report->user_id)->first();
    	$patient = Patient::where('id', $report->patient_id)->first();


    	return view('layout.patient.patient-details', compact('report', 'user', 'patient'));
    }

    /**
     * Create a pdf
     *
     * @param  Request  $request
     * @return view
     */
    protected function createPDF($id)
    {
        $report  = Report::where('id', $id)->first();
        $user    = User::where('id', $report->user_id)->first();
        $patient = Patient::where('id', $report->patient_id)->first();

        $pdf = PDF::loadView('layout.patient.download', compact('report', 'user', 'patient'));

        return $pdf;
    }

    /**
     * get patient email
     *
     * @param  Request  $request
     * @return patient email
     */
    protected function getPatientEmail($id)
    {
        $report  = Report::where('id', $id)->first();
        $patient = Patient::where('id', $report->patient_id)->first();

        return $patient->email;
    }

    /**
     * Export to pdf
     *
     * @param  Request  $request
     * @return dashboard
     */
    public function exportToPDF($id)
    {
        $title = 'Report.pdf';
        $pdf = $this->createPDF($id);

        return $pdf->download($title);
    }

    /**
     * Send mail to patient
     *
     * @param  Request  $request
     * @return dashboard
     */
    public function sendAsMail($id)
    {
        $title = 'Report.pdf';
        $pdf = $this->createPDF($id);

        if (!file_exists($title))
        {
            $pdf->save($title);
        }

    	$this->mailer->isSMTP();
		$this->mailer->Host = env('Host');
		$this->mailer->SMTPAuth = true;
        $this->mailer->Username = env('Username');
        $this->mailer->Password = env('Password');
		$this->mailer->SMTPSecure = 'tls';
		$this->mailer->Port = 587;

		$this->mailer->addAddress($this->getPatientEmail($id));
		$this->mailer->addAttachment($title);
		$this->mailer->isHTML(true);
		$this->mailer->Subject = 'Report Details';
		$this->mailer->Body    = 'The attachment contains your report';

		if(!$this->mailer->send()) {
            alert()->error('Something went wrong'.$this->mailer->ErrorInfo);
            return redirect()->back();
		} else {
		    alert()->success('Your email has been succesfully sent', 'Success');

            return redirect()->back();
		}
    }
}
