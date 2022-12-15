<?php

namespace App\Http\Controllers;

use App\Models\Verse; 
use Illuminate\Http\Request;

class VerseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Verse::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'path'=> 'required',
            'year' => 'required'
        ]);
        return Verse::create($request->all());
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

        return Verse::find($id);
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
        //

        $verse = Verse::find($id); 
        $verse->update($request->all()); 

        return $verse;
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
        return Verse::destroy($id);
    }

    /**
     * 
     *
     * @param  str  $int
     * @return \Illuminate\Http\Response
     */
    public function search($year)
    {
        //
        return Verse::where('year', 'like', '%'.$year.'%')->get();
    }
}
