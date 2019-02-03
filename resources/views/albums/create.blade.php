@extends('layouts.app')
@section('content')
    <h3>Create Album</h3>
  {!!Form::open(['action'=>'AlbumController@store','method'=>'POST','enctype'=>"multipart/form-data"])!!}
  <div class="grid-container">
        <div class="grid-x grid-padding-x">
        {{Form::text('name',null,['placeholder'=>'Album Name'])}}
        {{Form::text('desc',null,['placeholder'=>'Album Description'])}}
       {{Form::file('cover_image')}} 
       

        {{Form::submit('Create album')}}
        </div>
  </div>
    {!!Form::close()!!} 
@endsection