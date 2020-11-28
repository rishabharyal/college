<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Favorite;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function rankColleges() {
        $colleges = College::orderByRaw('((`colleges`.`pass_percent`*0.3)+(`colleges`.`extra_activities`*0.2)+(`colleges`.`placements`*0.5)) DESC')->get();

        return view('ranks', compact('colleges'));
    }

    public function showCollege($id) {
        $college = College::findOrFail($id);
        $colleges = College::where('id', '!=', $id)->take(3)->inRandomOrder()->get();
        $favorite = null;
        if (Auth::check()) {
            $favorite = Favorite::where('user_id', Auth::id())->where('college_id', $id)->first();
        }

        return view('college', compact('college', 'colleges', 'favorite'));
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
    public function index(Request $request)
    {
        $levels = Level::all();
        $affiliations = Affiliation::all();
        $faculties = Faculty::all();
        $colleges = College::take(6)->get();
        $locations = College::distinct('location')->pluck('location');
        $resultColleges = null;
        if ($request->has('search')) {
            $resultColleges = new College();
            if ($request->get('faculty')) {
                $resultColleges = $resultColleges->where('faculty_id', $request->get('faculty'));
            }
            if ($request->get('level')) {
                $resultColleges = $resultColleges->where('level_id', $request->get('level'));
            }
            if ($request->get('affiliation')) {
                $resultColleges = $resultColleges->whereHas('faculty', function($q) use ($request) {
                    $q->where('affiliation_id', $request->get('affiliation'));
                });
            }
            if ($request->get('text')) {
                $resultColleges = $resultColleges->where(function($query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->get('text') . '%')
                        ->orWhere('description', 'LIKE',  '%' . $request->get('text') . '%');
                });
            }

            if ($request->get('location')) {
                $resultColleges = $resultColleges->where('location', 'LIKE',  '%' . $request->get('location') . '%');
            }

            if ($request->get('start_fee') && $request->get('end_fee')) {
                $resultColleges = $resultColleges->whereBetween('fee_amount', [$request->get('start_fee'), $request->get('end_fee')]);
            }

            $resultColleges = $resultColleges->get();
        }

        return view('home', compact('levels', 'affiliations', 'faculties', 'colleges', 'locations', 'request', 'resultColleges'));
    }
}
