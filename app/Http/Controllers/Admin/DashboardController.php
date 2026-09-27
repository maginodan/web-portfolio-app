<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Skill;
use App\Models\Message;
use App\Models\Project;
use App\Models\Service;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        //Overview dashboard
        $skillCount = Skill::all()->count();
        $educationCount = Education::all()->count();
        $experienceCount = Experience::all()->count();
        $serviceCount = Service::all()->count();
        $projectCount = Project::all()->count();
        $testimonialCount = Testimonial::all()->count();
        $messageCount = Message::all()->count();
        $userCount = User::all()->count();

        //Latest Projects 
        $projects = Project::orderBy('created_at', 'DESC')->take(3)->get();

        //Latest Testimonials
        $testimonials = Testimonial::orderBy('created_at', 'DESC')->take(3)->get();
        
        //Skills
        $skills = Skill::orderBy('id', 'DESC')->take(10)->get();

        //Skills with services
        $services = Service::orderBy('id', 'DESC')->with('skills')->take(5)->get();

        return view('admin.home.index', compact(
            [
                'skillCount',
                'educationCount',
                'experienceCount',
                'serviceCount',
                'projectCount',
                'testimonialCount',
                'messageCount',
                'userCount',
                'projects',
                'testimonials',
                'skills',
                'services',

            ]
        ));
    }

    
}
