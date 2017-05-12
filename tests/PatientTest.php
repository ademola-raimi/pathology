<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PatientTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test that user cannot login successfully due to insupplied data
     */
    public function testForUnsuppliedLoginDetails()
    {
        $this->visit('patient/login')
            ->type('', 'patient_name')
            ->type('', 'patient_id')
            ->press('Check')
            ->see('The patient name field is required.')
            ->see('The patient id field is required.');
    }

    /**
     * Test that user cannot login successfully due to wrong data provided
     */
    public function testForUnSuccessfulLogin()
    {
        $this->visit('patient/login')
            ->type('Ademola', 'patient_name')
            ->type(456765, 'patient_id')
            ->press('Check')
            ->see('Error')
            ->seePageIs('patient/login');
    }

    public function patient()
    {
        $patient = factory('App\Patient')->create([
            'email'      => 'demola@gmail.com',
            'phone_number'   => '8132186996',
            'name' => 'Ademola',
            'date_of_birth'  => 'Raimi',
            'patient_id'    => 457688,
            'case_number'     => 9484330,
        ]);

        return $patient;
    }

    public function report()
    {
        $report = factory('App\Report')->create([
            'statement'   => 'You need to exercise every week',
            'description' => 'You are doing great',
            'user_id'     => 1,
            'patient_id'  => 1,
        ]);

        return $report;
    }

    /**
     * Test that user login successfully
     */
    public function testForSuccessfulLoginToViewReport()
    {
        $this->patient();

        $this->visit('patient/login')
            ->type('Ademola', 'patient_name')
            ->type(457688, 'patient_id')
            ->press('Check')
            ->seePageIs('patient/report')
            ->see('Your report');
    }

    public function testASingleReportView()
    {
        // Session::start();

        // $patient = $this->patient();

        // $this->call('POST', 'patient/login', [
        //     'patient_name' => $patient->name,
        //     'patient_id'   => $patient->patient_id,
        // ]);

        // $report = $this->report();
        

        // $this->visit('patient/report')
        //     ->click($report->description)
        //     ->seePageIs('patient/report/'.$report->id)
        //     ->see($report->name);
    }
}