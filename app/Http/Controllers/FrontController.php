<?php

namespace App\Http\Controllers;

use App\Models\JobPost;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(Request $request)
    {
        $publishedJobPosts = JobPost::published()->get();

        return view('home', compact('publishedJobPosts'));
    }
}
