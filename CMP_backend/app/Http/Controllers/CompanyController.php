<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $company = Company::latest()->paginate(10);
        return response()->json([$company]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $fileNameToStore = NULL;
        $status          = false;
        $message         ='Something went wrong';

        $input = $request->all();

        //File Upload to Storage
        if($request->hasFile('logo')){
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs(
                'public/images', $fileNameToStore
                );
        }

        $is_saved = Company::insert([
            'name'              => $input['name'],
            'email_address'     => $input['email_address'],
            'logo'              => $fileNameToStore,
            'website_address'   => $input['website_address']
        ]);

        $details = [
            'title' => 'CMP',
            'body'  => 'Greetings! Your company got registered successfully'
        ];

        \Mail::to($input['email_address'])->send(new \App\Mail\CompanyMail($details));
        if($is_saved) { 
            $status          = true;
            $message         ='Saved Successfully';
        }

        $arr = ['status'=>$status, 'message'=>$message,'fileName'=>$fileNameToStore];

        return response()->json($arr);
    
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {

        $fileNameToStore = NULL;
        $status          = false;
        $message         ='Something went wrong';
        $is_updated = $company->update(request()->except('logo'));
        if($request->hasFile('logo')){
            $filenameWithExt = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('logo')->storeAs(
                'public/images', $fileNameToStore
                );
            Storage::delete('public/images/'.$company['logo']);
            $company->logo = $fileNameToStore;
            $company->save();

        }

        if($is_updated) { 
            $status          = true;
            $message         ='Updated Successfully';
        }

        $arr = ['status'=>$status, 'message'=>$message,'fileName'=>$fileNameToStore];

        return response()->json($arr);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $status          = false;
        $message         ='Something went wrong';
        $is_deleted = $company->delete();
        if($is_deleted){
            Storage::delete('public/images/'.$company['logo']);
            $status          = true;
            $message         ='Deleted Successfully';
        }
        $arr = ['status'=>$status, 'message'=>$message];
        return response()->json($arr);
    }
}
