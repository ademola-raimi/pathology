<?php

namespace App\Http\Controllers;

use Alert;
use App\Patient;
use Illuminate\Http\Request;
use SimpleSoftwareIO\SMS\Facades\SMS as SMS;
use Unicodeveloper\JusibePack\Facades\Jusibe as Jusibe;

class LabController extends Controller
{
	/**
     * Get sms details.
     *
     * @return payload
     */
	public function getSmsDetails($id)
	{
		$patient = Patient::find($id);

		$message = "Your report is ready and you can check by inputing your Login details on our website, Here is your login details.\nName: ".$patient->name."\npin: ". $patient->patient_id;

		$payload = [
		    'to' => $patient->phone_number,
		    'from' => 'PATHOLOGY',
		    'message' => $message
		];

		return $this->sendSms($payload);
	}

	/**
     * Send sms
     *
     * @return back
     */
	public function sendSms($payload)
	{
		$response = Jusibe::sendSMS($payload)->getResponse();

		if ($response) {
			Alert::success('Message sent to patient', 'Success');

            return redirect()->back();
		}

		Alert::error('Something went wrong', 'Error');

        return redirect()->back();
		
	}
}
