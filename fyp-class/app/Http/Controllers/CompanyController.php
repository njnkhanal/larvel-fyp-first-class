<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function company()
    {
        return view('company.pages.dashboard');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('backend.pages.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required|string|max:200|unique:categories,title',
            'company_manager' => 'required|exists:users,id',
            // 'image' => 'nullable|image|mimes:jpg,png,gif,webp,svg|max:2048',
            'status' => 'required|in:active,inactive'
        ]);
        // dd($request->all());
        $data = $request->all();
        // store image to public file
        // $data['image'] = null;
        // if ($request->hasFile('image')) { // check condition is image exists or not
        //     $img = $request->file('image'); // get image file in img variable
        //     $img_path = 'upload/company/'; // set path to save the image
        //     $img_name = Str::random(3) . now()->format('Y-m-d-his') . '.' . $img->getClientOriginalExtension(); // set name with time and extention to save image
        //     $img->move($img_path, $img_name); // move the image file to the destination path with the name
        //     // pass image name to the datbase
        //     $data['image'] = $img_path . $img_name;
        // }
        $company = Company::create($data);


        $user = User::findorfail($request->company_manager);
        $user->role = 'company';
        $user->company_id = $company->id;
        $user->save();

        return redirect(route('company.index'))->with('success', 'company Stored Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company  = Company::findOrFail($id);
        return view('backend.pages.company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company  = Company::findOrFail($id);
        // validation
        $request->validate([
            'name' => 'required|string|max:200|unique:categories,title,' . $id,
            'company_manager' => 'required|exists:users,id',
            // 'image' => 'nullable|image|mimes:jpg,png,gif,webp,svg|max:2048',
            'status' => 'required|in:active,inactive'
        ]);
        // take request data
        $data = $request->all();
        // store image to public file
        // $data['image'] = $company->image; // set deafult company image
        // if ($request->hasFile('image')) { // check condition is image exists or not
        //     $img = $request->file('image'); // get image file in img variable
        //     $img_path = 'upload/company/'; // set path to save the image
        //     $img_name = Str::random(3) . now()->format('Y-m-d-his') . '.' . $img->getClientOriginalExtension(); // set name with time and extention to save image
        //     $img->move($img_path, $img_name); // move the image file to the destination path with the name
        //     // pass image name to the datbase
        //     $data['image'] = $img_path . $img_name;
        // }

        // update company
        $company->update($data);
        $user = User::findorfail($request->company_manager);
        $user->role = 'company';
        $user->company_id = $company->id;
        $user->save();

        return redirect(route('company.index'))->with('success', 'company Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company  = Company::findOrFail($id);
        $company->delete();
        return back()->with('success', 'company Deleted Successfully!');
    }
}
