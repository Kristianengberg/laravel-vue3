<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function all()
    {
        return EmployeeResource::collection(Employee::join('positions', 'positions.id', '=', 'position_id')->get());
    }
}
