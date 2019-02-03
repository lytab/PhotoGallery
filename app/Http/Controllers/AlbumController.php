<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::with('photos')->get();
       return view('albums.index')->with('albums',$albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $rules=[
            'name'=>'required',
            'cover_image'=>'image|max:1999'
        ];
       
       
      
        //$this->validate($request,$rules);
        $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
        $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('cover_image')->getClientOriginalExtension();
        //create new filename
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        //Upload Image
        $path = $request->file('cover_image')->storeAs('public/album_covers',$fileNameToStore);
        $album=new Album();
        $album->name=$request->name;
        $album->desc=$request->desc;
        $album->cover_image=$fileNameToStore;
        $album->save();
        return redirect()->back()->with('status', "Album Created !!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }
}
