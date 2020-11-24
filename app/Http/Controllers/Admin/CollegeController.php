<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
use App\Models\College;
use App\Models\Faculty;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $levels = Level::all();
        $faculties = Faculty::all();
        $affiliations = Affiliation::all();
        $colleges = College::all();


        return view('admin.college.index', compact('levels', 'faculties', 'affiliations', 'colleges'));
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'minimim_acceptance_percentage' => 'required',
            'minimum_scholarship_percentage' => 'required',
            'website' => 'required',
            'email' => 'required',
            'faculty_id' => 'required',
            'level_id' => 'required',
            'affiliation_id' => 'required',
        ]);


        $dataToInsert = $request->except(['_token', 'logo']);

        $college = College::forceCreate($dataToInsert);

        $path = $request->file('logo')->store('public/logo');

        $college->logo = $path;
        $college->save();

        return redirect()->back()->with('message', 'The college has been entered successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $college = College::find($id);
        $levels = Level::all();
        $faculties = Faculty::all();
        $affiliations = Affiliation::all();
        if (!$college) {
            return redirect()->back()->with('message', 'The college you wanted to edit was not found.');
        }

        return view('admin.college.edit', compact('college', 'levels', 'faculties', 'affiliations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'location' => 'required',
            'minimim_acceptance_percentage' => 'required',
            'minimum_scholarship_percentage' => 'required',
            'website' => 'required',
            'email' => 'required',
            'faculty_id' => 'required',
            'level_id' => 'required',
            'affiliation_id' => 'required',
        ]);

        $college = College::findOrFail($id);
        $college->forceFill($request->except(['_token', 'logo', '_method']));
        $college->save();

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('public/logo');
            $college->logo = $path;
            $college->save();
        }

        return redirect()->back()->with('message', 'The college has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
