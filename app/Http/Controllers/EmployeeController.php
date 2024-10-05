<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Permission;
use App\Models\UserTask;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Enums\RoleTypeEnum;
use Exception;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $role      = \DB::table('roles')->where('name', RoleTypeEnum::Employee->value)->first();
        $employees = User::where('role_id', $role->id)->get();
        return view('employee.index', compact('employees'));
    }

    public function edit($id)
    {
        $employee       = User::findOrFail($id);
        $permissions    = Permission::all();
        return view('employee.form', compact('employee', 'permissions'));
    }
    public function update(Request $request, $id)
    {
        $validatedData          = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|email|max:255|unique:users,email,' . $id,
            'permissions'       => 'array',
            'permissions.*'     => 'string',
        ]);
    
        $employee = User::findOrFail($id);
        
        $employee->name = $validatedData['name'];
        $employee->email = $validatedData['email'];
    
        if (isset($validatedData['permissions'])) {
            $employee->permissions = json_encode($validatedData['permissions']);
        } else {
            $employee->permissions = json_encode([]); 
        }
        
        $employee->save();
    
        return redirect()->route('employees')->with('success', 'Employee updated successfully!');
    }
    
    

    public function destroy($id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees')->with('success', 'Employee deleted successfully!');
    }
}

