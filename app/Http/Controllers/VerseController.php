<?php

namespace App\Http\Controllers;

use App\Models\verse;
use Illuminate\Http\Request;

class VerseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $verses = Verse::all(); 

        return view('verse.index',compact('verses')); 
    }

    public function create(){

        return view('verse.create');
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
        $required->validate(['path'=>'required', 'year'=>'required']);

        Verse::create(['name'=>$request->path , 'year'=>$request->year]);

        return to_route('verse.index')->with('status','The verse created successfully.');
    }

   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\verse  $verse
     * @return \Illuminate\Http\Response
     */
    public function show(verse $verse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\verse  $verse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, verse $verse)
    {
        //
        $request->validate(['path'=>'required', 'year'=>'required']);

        $verse->update(['path'=>$request->path, 'year'=>$request->year]);

        return to_route('verse.index')->with('status','The verse updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\verse  $verse
     * @return \Illuminate\Http\Response
     */
    public function destroy(verse $verse)
    {
        //

        $verse->delete(); 

        return to_route('index')->with('status','The verse destroyed successfully.');
    }
}
