<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Level;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function showCollege($id) {
        $college = College::findOrFail($id);
        $colleges = College::where('id', '!=', $id)->take(3)->inRandomOrder()->get();

        return view('college', compact('college', 'colleges'));
    }

    public function showAllColleges() {
        $colleges = College::orderBy('name', 'ASC')->get();

        return view('colleges', compact('colleges'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $levels = Level::all();
        $affiliations = Affiliation::all();
        $faculties = Faculty::all();
        $colleges = College::take(6)->get();
        return view('home', compact('levels', 'affiliations', 'faculties', 'colleges'));
    }
}
