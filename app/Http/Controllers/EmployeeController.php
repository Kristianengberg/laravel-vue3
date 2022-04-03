<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function all()
    {
        return EmployeeResource::collection(Employee::join('positions', 'positions.id', '=', 'position_id')->latest('employees.created_at')->get());
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(Employee::class),
            ],
            'phone' => [
                'required',
                'numeric',
                'max:99999999',
                Rule::unique(Employee::class),
            ],
            'position_id' => ['required', 'numeric', 'max:1']
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position_id' => $request->position_id
        ]);
    }
}
