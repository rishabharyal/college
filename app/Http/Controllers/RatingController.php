<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'college_id' => 'required|exists:colleges,id',
            'rating' => 'required',
            'topic' => 'required'
        ]);

        $userId = Auth::id();
        $rating = new Rating();
        $rating->user_id = $userId;
        $rating->college_id = $request->get('college_id');
        $rating->topic = $request->get('topic');
        $rating->rating_given = $request->get('rating');
        $rating->save();

        return redirect()->back()->with('message', 'Rating added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);
        $rating->rating_given = $request->get('rating');
        $rating->topic = $request->get('topic');
        $rating->save();

        return redirect()->back()->with('message', 'Rating updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $rating = Rating::find($id);
        if ($rating) {
            $rating->delete();
        }

        return redirect()->back()->with('message', 'Rating deleted successfully!');
    }
}
