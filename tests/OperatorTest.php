<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class OperatorTest extends TestCase
{
    use DatabaseTransactions;

    protected function createOperatorUser()
    {
    	return factory('App\User')->create([
            'email'      => 'demola@gmail.com',
            'password'   => bcrypt('london'),
            'first_name' => 'Demola',
            'last_name'  => 'Raimi',
            'role_id'    => 3,
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);
    }

    protected function createPatient()
    {
    	return factory('App\Patient')->create([
            'email'      => 'demola@gmail.com',
            'name'   => 'Raimi Ademola',
            'phone_number' => '08032186996',
            'date_of_birth'  => '12/24/2016',
            'patient_id'    => 38726836,
        	'case_number'   => 84743883,
        ]);
    }

    protected function createReport()
    {
    	$patient = $this->createPatient();

    	return factory('App\Report')->create([
            'patient_id'   => $patient->id,
            'description' => '08032186996',
            'statement'  => '12/24/2016',
        ]);
    }

    /**
     * Test that patient test form was visited
     */
    public function testPatientTestFormWasVisited()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('patient')
            ->see('Patient\'s Test Form');
    }

    /**
     * Test that patient test already exist
     */
    public function testPatientAlreadyExist()
    {
        $user = $this->createOperatorUser();
       	$this->createPatient();

        $this->actingAs($user)->visit('patient')
            ->type('Raimi Ademola', 'name')
            ->type('demola@gmail.com', 'email')
            ->type('8032186996', 'phone_number')
            ->type('12/24/2016', 'date_of_birth')
            ->press('Test')
            ->see('The email has already been taken.')
            ->see('The phone number must be at least 11 characters.');
    }

    /**
     * Test that patient test form was successful
     */
    public function testForSuccessfulPatientFormSubmission()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('patient')
            ->type('Raimi Ademola', 'name')
            ->type('demola@gmail.com', 'email')
            ->type('08032186996', 'phone_number')
            ->type('12/24/2016', 'date_of_birth')
            ->press('Test')
            ->seePageIs('/admin')
            ->see('Pathology Admin Page');
    }

    /**
     * Test that patient test form was unsuccessful due to missing fields
     */
    public function testUnsuccesfullPatientFormDueToEmptyFields()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('patient')
            ->type('', 'name')
            ->type('', 'email')
            ->type('', 'phone_number')
            ->type('', 'date_of_birth')
            ->press('Test')
            ->see('The name field is required.')
            ->see('The email field is required.')
            ->see('The phone number field is required.')
            ->see('The date of birth field is required.');
    }

    /**
     * Test that patient test edit form was visited
     */
    public function testThatPatientEditFormWasVisited()
    {
        $user = $this->createOperatorUser();

        $patient = $this->createPatient();
        $this->actingAs($user)->visit('patient/'.$patient->id.'/edit')
            ->see('Edit Patient');
    }
    
    /**
     * Test that patient test update was unsuccessful due to unauthenticated user access 
     * and redirect the unathenticated user to login page
     */
    public function testThatOnlyLoggedInUserCanUpdatePatient()
    {
        $patient = $this->createPatient();
        $this->visit('patient/'.$patient->id.'/edit')
            ->seePageIs('/login');
    }


    /**
     * Test that patient was only be deleted  by an operator user
     */
    public function testThatOnlyOperatorUserCanDeletePatient()
    {
        $patient = $this->createPatient();
        $this->visit('patient/'.$patient->id.'/delete')
            ->seePageIs('/login');
    }

    /**
     * Test that patient was deleted by an operator user
     */
    public function testThatPatientWasDeletedByOperatorUser()
    {
        $user = $this->createOperatorUser();

        $patient = $this->createPatient();
        $this->actingAs($user)->visit('patient/'.$patient->id.'/delete');
        $this->visit('patient/'.$patient->id.'/edit')
            ->seePageIs('/admin');
    }

    /**
     * Test all get all patients
     */
    public function testGetAllPatient()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('view/patients')
            ->see('All Patients');
    }





    /**
     * Test that report form was visited
     */
    public function testReportFormWasVisited()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('report')
            ->see('Patient\'s Report Form');
    }

    /**
     * Test that report form was successful
     */
    public function testForSuccessfulReportSubmission()
    {
        $user = $this->createOperatorUser();
        $patient = $this->createPatient();

        $this->actingAs($user)->visit('report')
            ->type('Raimi Ademola', 'statement')
            ->type('demola@gmail.com', 'description')
            ->type($patient->id, 'patient_id')
            ->press('Add Report')
            ->seePageIs('/admin')
            ->see('Pathology Admin Page');
    }

    /**
     * Test that report form was unsuccessful due to missing fields
     */
    public function testUnsuccesfullReportFormDueToEmptyFields()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('report')
            ->type('', 'statement')
            ->type('', 'description')
            ->type('', 'patient_id')
            ->press('Add Report')
            ->see('The description field is required.')
            ->see('The statement field is required.')
            ->see('The patient id field is required.');
    }

    /**
     * Test that report edit form was visited
     */
    public function testThatReportEditFormWasVisited()
    {
    	$user   = $this->createOperatorUser();
        $report = $this->createReport();
        $this->actingAs($user)->visit('report/'.$report->id.'/edit')
            ->see('Edit Report');
    }
    
    /**
     * Test that report update was unsuccessful due to unauthenticated user access 
     * and redirect the unathenticated user to login page
     */
    public function testThatOnlyLoggedInUserCanUpdateReport()
    {
        $report = $this->createReport();
        $this->visit('report/'.$report->id.'/edit')
            ->seePageIs('/login');
    }


    /**
     * Test that patient was only be deleted  by an operator user
     */
    public function testThatOnlyOperatorUserCanDeleteReport()
    {
        $report = $this->createReport();
        $this->visit('report/'.$report->id.'/delete')
            ->seePageIs('/login');
    }

    /**
     * Test that report was deleted by an operator user
     */
    public function testThatReportWasDeletedByOperatorUser()
    {
        $user = $this->createOperatorUser();

        $report = $this->createReport();
        $this->actingAs($user)->visit('report/'.$report->id.'/delete');
        $this->visit('report/'.$report->id.'/edit')
            ->seePageIs('/admin');
    }

    /**
     * Test get all Reports
     */
    public function testGetAllReport()
    {
        $user = $this->createOperatorUser();

        $this->actingAs($user)->visit('view/reports')
            ->see('All Report');
    }
}
