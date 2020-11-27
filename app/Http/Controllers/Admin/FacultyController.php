<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliation;
use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        $affiliations = Affiliation::all();
        return view('admin.faculty.index', compact('faculties','affiliations'));
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
            'affiliation_id' => 'required|exists:affiliations,id'
        ]);

        $faculty = new Faculty();
        $faculty->affiliation_id = $request->get('affiliation_id');
        $faculty->name = $request->get('name');
        $faculty->description = $request->get('description');
        $faculty->save();

        return redirect()->back()->with('message', 'The new faculty entry has ben successfully added.');
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
        $faculty = Faculty::find($id);
        $affiliations = Affiliation::all();
        if (!$faculty) {
            return redirect()->back()->with('message', 'The faculty you wanted to edit does not exist anymore.');
        }

        return view('admin.faculty.edit', compact('faculty', 'affiliations'));
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
            'affiliation_id' => 'required|exists:affiliations,id',
        ]);

        $faculty = Faculty::find($id);
        if (!$faculty) {
            return redirect()->back()->with('message', 'The faculty you wanted to edit does not exist anymore.');
        }

        $faculty->name = $request->get('name');
        $faculty->affiliation_id = $request->get('affiliation_id');
        $faculty->description = $request->get('description');
        $faculty->save();

        return redirect()->back()->with('message', 'The faculty has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = Faculty::find($id);
        if ($faculty) {
            $faculty->delete();
        }

        return redirect()->back()->with('success', 'The faculty has been deleted successfully.');
    }
}
