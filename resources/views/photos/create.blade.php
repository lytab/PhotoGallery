@extends('layouts.app')
@section('content')
    <h3>Upload Photo</h3>
  {!!Form::open(['action'=>'PhotoController@store','method'=>'POST','enctype'=>"multipart/form-data"])!!}
  <div class="grid-container">
        <div class="grid-x grid-padding-x">
        {{Form::text('title',null,['placeholder'=>'Photo Title'])}}
        {{Form::textarea('desc',null,['placeholder'=>'Photo Description'])}}
        {{Form::hidden('album_id',$album_id)}}
       {{Form::file('photo')}} 
       

        {{Form::submit('Upload')}}
        </div>
  </div>
    {!!Form::close()!!} 
@endsection