<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class LabTest extends TestCase
{
	use DatabaseTransactions;

    protected function createLabUser()
    {
    	return factory('App\User')->create([
            'email'      => 'demola@gmail.com',
            'password'   => bcrypt('london'),
            'first_name' => 'Demola',
            'last_name'  => 'Raimi',
            'role_id'    => 2,
            'avatar'     => 'https://en.gravatar.com/userimage/102347280/b3e9c138c1548147b7ff3f9a2a1d9bb0.png?size=200',
        ]);
    }

    /**
     * Test that lab user cannot access patient form 
     */
    public function testLabUserCanNotAccessPatientTestForm()
    {
    	$user = $this->createLabUser();

        $this->actingAs($user)->visit('patient')
            ->seePageIs('/');
    }

    /**
     * Test that lab user cannot access report form 
     */
    public function testLabUserCanNotAccessReportTestForm()
    {
    	$user = $this->createLabUser();

        $this->actingAs($user)->visit('report')
            ->seePageIs('/');
    }
}