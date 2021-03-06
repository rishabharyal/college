<?php

namespace App\Http\Controllers;

use App\Models\Affiliation;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Favorite;
use App\Models\Level;
use App\Models\Rating;
use App\Models\UserCollege;
use App\Services\Cosine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    private $cosine;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(Cosine $cosine)
    {
        $this->cosine = $cosine;
    }

    public function rankColleges() {
        $colleges = College::orderByRaw('((`colleges`.`pass_percent`*0.3)+(`colleges`.`extra_activities`*0.2)+(`colleges`.`placements`*0.5)) DESC')->get();

        return view('ranks', compact('colleges'));
    }

    private function getSimilarCollege($id, $description) {
        $otherColleges = College::where('id', '!=', $id)->orderBy('name', 'DESC')->get();
        $mostSimilar = [];
        foreach ($otherColleges as $key => $college) {
            $similarity = $this->cosine->calculate($description, $college->description . ' ' .$college->description . ' ' . $college->faculty->name . ' ' . $college->location . ' ' . $college->level->name);
            if ($mostSimilar === []) {
                $mostSimilar[0] = [$similarity, $college];
            } else {
                if ($mostSimilar[0][0] <= $similarity) {
                    array_unshift($mostSimilar, [$similarity, $college]);
                    array_pop($mostSimilar);
                    continue;
                }
                if (!isset($mostSimilar[1])) {
                    $mostSimilar[1] = [$similarity, $college];
                    continue;
                }
                if ($mostSimilar[1][0] <= $similarity) {
                    $temp = $mostSimilar[1];
                    $mostSimilar[1] = [$similarity, $college];
                    $mostSimilar[2] = $temp;
                    continue;
                }
                if (!isset($mostSimilar[2])) {
                    $mostSimilar[2] = [$similarity, $college];
                    continue;
                }

                if ($mostSimilar[2][0] <= $similarity) {
                    $mostSimilar[2] = [$similarity, $college];
                }
            }
        }

        return array_map(function($item) {
            return $item[1];
        }, $mostSimilar);
    }

    public function showCollege($id) {
        $college = College::findOrFail($id);

        $myRatings = null;
        $allRatings = new Rating();

        $ratingByTopic = Rating::select(['topic', DB::raw('SUM(`rating_given`)/COUNT(`rating_given`) as average_rating')])
            ->groupBy('topic')->where('college_id', $id)->get();
        $averageRating = Rating::select([DB::raw('SUM(`rating_given`)/COUNT(`rating_given`) as average_rating')])->where('college_id', $id)
            ->first();

        $favorite = null;
        if (Auth::check()) {
            $favorite = Favorite::where('user_id', Auth::id())->where('college_id', $id)->first();
            $myRatings = Rating::where('user_id', Auth::id())->where('college_id', $id)->get();
            $allRatings = $allRatings->where('user_id', '!=', Auth::id())->where('college_id', $id);
        }

        $similarColleges = $this->getSimilarCollege($college->id, $college->description . ' ' . $college->faculty->name . ' ' . $college->location . ' ' . $college->level->name);

        $allRatings = $allRatings->where('college_id', $id)->get();
        $topics = [
            'Budget',
            'Placement',
            'Extra Activities',
            'Practicals'
        ];

        if (Auth::user() && Auth::user()->faculty()->first()) {
            $topics[Auth::user()->faculty()->first()->name] = Auth::user()->faculty()->first()->name;
        }

        $user = Auth::user();

        return view('college', compact('college', 'similarColleges', 'favorite', 'myRatings', 'allRatings', 'ratingByTopic', 'averageRating', 'user', 'topics'));
    }

    public function showAllColleges(Request $request) {
        $filter = $request->get('filter') ?? 'Overall';
        if ($filter == 'Placement') {
            $colleges = College::orderBy('placements', 'DESC')->get();
        } elseif ($filter == 'Budget') {
            $colleges = College::orderBy('fee_amount', 'ASC')->get();
        }  elseif ($filter == 'Pass') {
            $colleges = College::orderBy('pass_percent', 'DESC')->get();
        } elseif ($filter == 'Rating') {
            $collegeIds = Rating::selectRaw('college_id, SUM(RATING_GIVEN)/COUNT(RATING_GIVEN) as rating')->groupBy('college_id')->orderByRaw('rating DESC')->get()->pluck('college_id')->toArray();
            $colleges = collect();
            foreach ($collegeIds as $id) {
                $colleges->push(College::find($id));
            }
        } else {
            $colleges = College::orderByRaw('((`colleges`.`pass_percent`*0.3)+(`colleges`.`extra_activities`*0.2)+(`colleges`.`placements`*0.5)) DESC')->get();
        }

        return view('colleges', compact('colleges', 'filter'));
    }

    public function showProfile() {
        $user = Auth::user();
        $colleges = College::orderBy('name', 'ASC')->get();
        $faculties = Faculty::orderBy('name', 'ASC')->get();
        if (!$user) {
            abort(403, "You are not authorized to view this page.");
        }

        return view('profile', compact('user', 'colleges', 'faculties'));
    }

    public function saveProfile(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'email' =>  'required|unique:users,id,' .  Auth::id()
        ]);

        $user = Auth::user();
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if (strlen($request->get('password')) >= 9) {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        if ($request->has('college_id') && $request->has('faculty_id')) {
            $collegeId = $request->get('college_id');
            $facultyId = $request->get('faculty_id');

            $membership = $user->membership;

            if (!$membership) {
                $membership = new UserCollege();
                $membership->user_id = $user->id;
            }

            $membership->college_id = $collegeId;
            $membership->faculty_id = $facultyId;

            if ($request->hasFile('attachment')) {
                $path = $request->file('attachment')->store('public/attachments');
                $membership->verification_document = $path;
            }
            $membership->save();

        }

        return redirect()->back()->with('message', 'Profile updated successfully!');
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
        $locations = College::distinct('city')->pluck('city');
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
                $resultColleges = $resultColleges->where('city', 'LIKE',  '%' . $request->get('location') . '%');
            }

            if ($request->get('start_fee') && $request->get('end_fee')) {
                $resultColleges = $resultColleges->whereBetween('fee_amount', [$request->get('start_fee'), $request->get('end_fee')]);
            }

            $resultColleges = $resultColleges->get();
        }


        return view('home', compact('levels', 'affiliations', 'faculties', 'colleges', 'locations', 'request', 'resultColleges'));
    }
}
