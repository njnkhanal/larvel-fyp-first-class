<?php

namespace App\Http\Controllers;

use App\Models\ApplyJob;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function homepage()
    {
        $jobs = Job::where('status','active')->get();
        return view('welcome',compact('jobs'));
    }

    public function jobdetail($id)
    {
        $job = Job::findOrFail($id);
        return view('frontend.jobdetail', compact('job'));
    }

    public function jobApplied($id)
    {
        $job = Job::findOrFail($id);
        $applied = ApplyJob::where('job_id',$id)
                ->where('user_id',Auth::user()->id)
                ->first();
        return view('frontend.applied', compact('job','applied'));
    }

    public function aboutpage()
    {
        return view('about');
    }

    public function contactpage()
    {
        return view('contact');
    }
    public function categorypage($name)
    {
        return view('category', compact('name'));
    }
    public function profilepage()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
