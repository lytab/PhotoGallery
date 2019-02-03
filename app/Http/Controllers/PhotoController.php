<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
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
    public function create($album_id)
    {
        return view('photos.create')->with('album_id', $album_id);
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
            'title'=>'required',
            'photo'=>'image|max:1999'
        ];
       
       
      
        //$this->validate($request,$rules);
        $fileNameWithExt=$request->file('photo')->getClientOriginalName();
        $fileName=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
        $extension=$request->file('photo')->getClientOriginalExtension();
        //create new filename
        $fileNameToStore=$fileName.'_'.time().'.'.$extension;
        //Upload Image
        $path = $request->file('photo')->storeAs('public/photos/'.$request->album_id,$fileNameToStore);
        $album=new Photo();
        $album->title=$request->title;
        $album->desc=$request->desc;
        $album->album_id=$request->album_id;
        $album->photo=$fileNameToStore;
        $album->size=$request->file('photo')->getClientSize();
        $album->save();
        return redirect(('/albums'.'/'.$request->album_id))->with('status', "Photo Uploaded !!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo=Photo::findOrFail($id);
        return view('photos.show')->with('photo', $photo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo=Photo::findOrFail($id);
        $album_id=$photo->album_id;
        if(Storage::delete('public/photos/'.$album_id.'/'.$photo->photo)){

            $photo->delete();
            return redirect('/albums'.'/'.$album_id)->with('status','Photo Deleted !!');
        }
    }
}
