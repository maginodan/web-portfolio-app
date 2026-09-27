<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

use App\Models\About;
use App\Models\Certificate;
use App\Models\Counter;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Media;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){
        $abouts = About::orderBy('id', 'DESC')->get();
        $medias = Media::orderBy('id', 'DESC')->take(3)->get();
        $counters = Counter::orderBy('order')->get();
        $projectsCount = Project::all()->count();
        $experiencesCount = Experience::all()->count();
        $services = Service::orderBy('id', 'DESC')->with('skills')->get();
        $educations = Education::orderBy('id', 'DESC')->get();
        $experiences = Experience::orderBy('id', 'DESC')->get();
        $projects = Project::orderBy('id', 'DESC')->get();
        $testimonials = Testimonial::latest()->get();
        $certificates = Certificate::orderBy('id', 'DESC')->get();

        return view('pages.home.index', compact(
            [
                'abouts',
                'medias',
                'counters',
                'projectsCount',
                'experiencesCount',
                'services',
                'educations',
                'experiences',
                'projects',
                'testimonials',
                'certificates'
            ]
        ));
    }
}
