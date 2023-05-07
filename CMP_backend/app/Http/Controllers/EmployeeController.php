<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json([$employee]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        auth()->guard('web')->logout();
        auth()->user()->tokens()->delete();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $status          = false;
        $message         ='Something went wrong';
        $is_saved = Employee::create($request->all())->id;
        if($is_saved) { 
            $status          = true;
            $message         ='Saved Successfully';
        }

        $arr = ['status'=>$status, 'message'=>$message];

        return response()->json($arr);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $status          = false;
        $message         ='Something went wrong';
        $is_updated = $employee->update($request->all());
        if($is_updated) { 
            $status          = true;
            $message         ='Saved Successfully';
        }

        $arr = ['status'=>$status, 'message'=>$message];

        return response()->json($arr);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $status          = false;
        $message         ='Something went wrong';
        $is_deleted = $employee->delete();
        if($is_deleted){
            $status          = true;
            $message         ='Deleted Successfully';
        }
        $arr = ['status'=>$status, 'message'=>$message];
        return response()->json($arr);
    }
}
