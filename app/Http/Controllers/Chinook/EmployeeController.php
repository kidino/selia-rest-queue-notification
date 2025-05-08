<?php
namespace App\Http\Controllers\Chinook;
use App\Http\Controllers\Controller;
use App\Models\Employee;
class EmployeeController extends Controller
{
    public function employee1()
    {
        $employees = Employee::all(); //BAD: No eager loading
        return view('chinook.employee.index1', compact('employees'));
    }

    public function employee2()
    {
        $employees = Employee::with('manager')
            ->withCount('customers') // Uses SQL COUNT
            ->withCount('subordinates') // Uses SQL COUNT
            ->get();
        return view('chinook.employee.index2', compact('employees'));
    }
    
}

