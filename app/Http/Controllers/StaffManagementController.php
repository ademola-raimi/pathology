<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class StaffManagementController extends Controller
{
	/**
     * All staffs
     *
     * @return \Illuminate\Http\Response
     */
    public function viewStaffs()
    {
    	$staffs = User::get();

    	return view('dashboard.staff-management.all-staffs', compact('staffs'));
    }

    /**
     * This method gets edit form for staff
     *
     * @param $id
     * 
     * @return \Illuminate\Http\Response
     */
    public function editStaffForm($id)
    {
    	$staff = user::find($id);

    	return view('dashboard.staff-management.edit-form', compact('staff'));
    }

    /**
     * This method validates the inputed data and updates the requested staff form
     *
     * @param Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateStaff(Request $request)
    {
    	$this->validate($request, [
            'email' => 'required|email|unique:users,email,'.$request->id,
            'role'  => 'required',
            'name'  => 'required',
        ]);

    	$splitName = explode(" ", $request->name);

        $staff = User::where('id', $request->id)->update([
            'email'  => $request->email,
            'role_id'   => $request->role,
            'first_name'   => $splitName['0'],
            'last_name' => $splitName['1'],
        ]);
        
        if ($staff) {
            alert()->success('User updated succesfully', 'success');

            return redirect()->route('getAllStaffs'); 
        } else {
            alert()->error('Something went wrong', 'error');

            return redirect()->back();
        }
    }

    /**
     * This method deletes or destroys staff
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteStaff($id)
    {
        $staff = User::find($id);

        if (is_null($staff)) {
            alert()->error('Oops! Something went wrong');

            return redirect()->route('getAdminPage');  
        }

        $staffDelete = $staff->delete();

        if ($staffDelete) {
            alert()->success('Staff deleted succesfully', 'success');

            return redirect()->route('getAllStaffs'); 
        } else {
           alert()->error('Something went wrong', 'error');

            return redirect()->route('getAllStaffs');
        }
    }
}
