<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\job;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class jobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        return view('backend.pages.job.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.job.create', compact('categories'));
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
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpg,png,gif,webp,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive'
        ]);
        $data = $request->all();
        Job::create($data);
        return redirect(route('job.index'))->with('success', 'job Stored Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job  = Job::findOrFail($id);
        $categories = Category::all();
        return view('backend.pages.job.edit', compact('job', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $job  = Job::findOrFail($id);
        // validation
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            // 'image' => 'nullable|image|mimes:jpg,png,gif,webp,svg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive'
        ]);
        // take request data
        $data = $request->all();
        // update job
        $job->update($data);
        return redirect(route('job.index'))->with('success', 'job Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job  = Job::findOrFail($id);
        $job->delete();
        return back()->with('success', 'job Deleted Successfully!');
    }
}
