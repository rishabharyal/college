<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Level;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
    	$data = [
    		'users' => User::count(),
    		'levels' => Level::count(),
    		'faculties' => Faculty::count(),
    		'colleges' => College::count(),
    		'affiliations' => Affiliation::count(),
    	];
    	return view('admin.dashboard', compact('data'));
    }
}
