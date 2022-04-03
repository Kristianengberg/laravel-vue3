<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    // Når alle medarbejdere skal hentes, for at kun at lave en query til databasen joiner jeg employee med position og får dem tilbage i seneste tilføjet rækkefølge
    public function all()
    {
        return EmployeeResource::collection(Employee::join('positions', 'positions.id', '=', 'position_id')->latest('employees.created_at')->get());
    }


    // Min employee controller som står for at oprette nye. Inputtet bliver først valideret og hvis den er godkendt så kan vi oprette en ny medarbejder.
    // Jeg er lidt i tvivl om det er sådan man validerer telefonnumre. Jeg kan godt se noget udfordrende hvis man har medarbejdere som ikke har dansk nummer eller man kommer til at skrive +45 eller lignende
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
                'min:11111111',
                'max:99999999',
                Rule::unique(Employee::class),
            ],
            'position_id' => ['required', 'numeric', 'max:2']
        ]);

        Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'position_id' => $request->position_id
        ]);
    }
}
