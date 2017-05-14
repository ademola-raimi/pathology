<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StaffManagementTest extends TestCase
{
    use DatabaseTransactions;

    public function testViewAllStaffs()
    {
    	$user = $this->createOperatorUser();

        $this->actingAs($user)->visit('staffs')
            ->see('Manage Staffs');
    }

    public function testViewEditStaff()
    {
    	$user  = $this->createOperatorUser();
        $staff = $this->createStaff();

        $this->actingAs($user)->visit('staff/'.$staff->id.'/edit')
        	->see('Edit Staff')
            ->see($staff->first_name . ' ' . $staff->last_name);
    }

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

    public function testStaffDeletedSuccesfully()
    {
    	$user  = $this->createOperatorUser();
    	$staff = $this->createStaff();

    	$this->actingAs($user)->visit('staff/'.$staff->id.'/delete')
    	->seePageIs('/staffs');
    }
}
