<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Affiliation;

class AffiliationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $affiliations = Affiliation::all();
        return view('admin.affiliation.index', compact('affiliations'));
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
            'name' => 'required'
        ]);

        $affiliation =  new Affiliation();
        $affiliation->name = $request->get('name');
        $affiliation->description = $request->get('description');
        $affiliation->save();

        return redirect()->back()->with('message', 'The new affiliation entry has ben successfully added.');
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
        $affiliation = Affiliation::find($id);
        if (!$affiliation) {
            return redirect()->back()->with('message', 'The affiliation you wanted to edit does not exist anymore.');
        }

        return view('admin.affiliation.edit', compact('affiliation'));
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
            'name' => 'required'
        ]);

        $affiliation = Affiliation::find($id);
        if (!$affiliation) {
            return redirect()->back()->with('message', 'The affiliation you wanted to edit does not exist anymore.');
        }

        $affiliation->name = $request->get('name');
        $affiliation->description = $request->get('description');
        $affiliation->save();

        return redirect()->back()->with('message', 'The affiliation has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affiliation = Affiliation::find($id);
        if ($affiliation) {
            $affiliation->delete();
        }

        return redirect()->back()->with('success', 'The affiliation has been deleted successfully.');
    }
}
