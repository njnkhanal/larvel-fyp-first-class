<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Job;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ApplyJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $applied = ApplyJob::query();
        if ($request->from && $request->to) {
            $applied = $applied->whereBetween('created_at', [$request->from, $request->to]);
        }
        // current month
        // $from = Carbon::now()->startOfMonth();
        // $to = Carbon::now();
        $applied = $applied->get();
        return view('backend.pages.applied.index', compact('applied'));
    }


    public function statusUpdate($type, $id)
    {
        $applied = ApplyJob::findOrFail($id);
        if ($type == 'pending') {
            $applied->status = 'pending';
        } else if ($type == 'cancel') {
            $applied->status = 'cancel';
        } else if ($type == 'accepted') {
            $applied->status = 'accepted';
        } else {
            $applied->status = 'pending';
        }
        $applied->save();
        return back()->with('success', 'updated succesfully');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required|file|mimes:pdf,docx,txt|max:2048',
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['job_id'] = $id;
        // store resume to public file
        $data['resume'] = null;
        if ($request->hasFile('resume')) { // check condition is resume exists or not
            $img = $request->file('resume'); // get resume file in img variable
            $img_path = 'upload/resume/'; // set path to save the resume
            $img_name = Str::random(3) . now()->format('Y-m-d-his') . '.' . $img->getClientOriginalExtension(); // set name with time and extention to save resume
            $img->move($img_path, $img_name); // move the resume file to the destination path with the name
            // pass resume name to the datbase
            $data['resume'] = $img_path . $img_name;
        }
        ApplyJob::create($data);
        // return back()->
        return redirect()->route('job.applied', $id)->with('success', 'Applied successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplyJob  $applyJob
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyJob $applyJob)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApplyJob  $applyJob
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplyJob $applyJob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ApplyJob  $applyJob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApplyJob $applyJob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplyJob  $applyJob
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplyJob $applyJob)
    {
        //
    }
}
