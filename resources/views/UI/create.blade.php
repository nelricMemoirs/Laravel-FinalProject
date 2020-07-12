@extends('layouts.app')

@section('content')
        
        {!! Form::open(['action'=> 'PertanyaanController@store', 'method' => 'POST']) !!}
        <div class=" container-fluid">
            <h1>Create an Article</h1>
            <div class="form-group">
                {{Form::label('judul', 'Judul')}}
                {{Form::text('judul', '',['class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'title'])}}
                {{Form::label('tag', 'tag')}}
                {{Form::text('tag', '',['class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'separate with space (ex: php laravel)'])}}
            </div>
            <div class="form-group">
                {{Form::label('isipertanyaan', 'Isi Pertanyaan')}}
                {{Form::textarea('isi_pertanyaan', '',['id'=> 'editor', 'class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'Content'])}}
            </div>
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        </div>


        {!! Form::close() !!}
@endsection