<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffManagementTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * test get all staff page
     */
    public function testViewAllStaffs()
    {
    	$user = $this->createOperatorUser();

        $this->actingAs($user)->visit('staffs')
            ->see('Manage Staffs');
    }

    /**
     * test get staff edit page
     */
    public function testViewEditStaff()
    {
    	$user  = $this->createOperatorUser();
        $staff = $this->createStaff();

        $this->actingAs($user)->visit('staff/'.$staff->id.'/edit')
        	->see('Edit Staff')
            ->see($staff->first_name . ' ' . $staff->last_name);
    }

    /**
     * test staff user was updated
     */
    public function testStaffRoleWasSuccesfullyUpdatedToOperator()
    {
    	$user  = $this->createOperatorUser();
    	$staff = $this->createStaff();

        $this->actingAs($user)->visit('staff/'.$staff->id.'/edit')
            ->type(3, 'role')
            ->type('ramah_ng@sample.com', 'email')
            ->type('Raimi Ademola', 'name')
            ->press('Update Staff')
            ->seePageIs('/staffs')
            ->see('Manage Staffs');
    }

    /**
     * test staff user was not updated due to invalid details
     */
    public function testStaffRoleWasNotSuccesfullyUpdatedDueToInvalidDetails()
    {
        $user  = $this->createOperatorUser();
        $staff = $this->createStaff();

        $this->actingAs($user)->visit('staff/'.$staff->id.'/edit')
            ->type('', 'role')
            ->type('', 'email')
            ->type('', 'name')
            ->press('Update Staff')
            ->seePageIs('staff/'.$staff->id.'/edit')
            ->see('The role field is required.')
            ->see('The name field is required.')
            ->see('The email field is required.');
    }

    /**
     * test staff was deleted
     */
    public function testStaffDeletedSuccesfully()
    {
    	$user  = $this->createOperatorUser();
    	$staff = $this->createStaff();

    	$this->actingAs($user)->visit('staff/'.$staff->id.'/delete')
    	->seePageIs('/staffs');
    }
}
