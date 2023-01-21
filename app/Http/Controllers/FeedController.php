<?php

namespace App\Http\Controllers;
use App\Models\feed;
use App\Models\commer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class FeedController extends Controller
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
        // dd($request->all());
        $request->validate([
            'fullname' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $image = $request->file('file');
        $imgName = time(). rand().'.'.$image->extension();
        if(!file_exists(public_path('/assets/img/'.$image->getClientOriginalName()))){
            $destinationPath = public_path('/assets/img/');
     
            $image->move($destinationPath, $imgName);
            $uploaded = $imgName;
         } else {
            $uploaded = $image->getClientOriginalName();
         }
         feed::create([
            'user_id' => Auth::user()->id,
            'fullname' => $request->fullname,
            'description' => $request->description,
            'file' => $uploaded
         ]);
         return redirect()->route('landing');
    }

    /**
     * Display the specified resource. 
     *
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function show(feed $feed)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(feed $feed)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, feed $feed)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\feed  $feed
     * @return \Illuminate\Http\Response
     */
    public function destroy(feed $feed)
    {
        //
    }
}
