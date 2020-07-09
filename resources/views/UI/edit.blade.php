@extends('layouts.app')

@section('content')
    <h1>Edit Question</h1>
    {!! Form::open(['action'=> ['PertanyaanController@update', $pertanyaan->id], 'method' => 'POST']) !!}
    <div class=" container-fluid">
        <div class="form-group">
            {{Form::label('judul', 'Judul')}}
            {{Form::text('judul', $pertanyaan->judul_pertanyaan,['class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'title'])}}
            {{Form::label('tag', 'tag')}}
            {{Form::text('tag', $pertanyaan->tag,['class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'input tag for this Question'])}}
        </div>
        <div class="form-group">
            {{Form::label('judul', 'Judul')}}
            {{Form::textarea('isi_pertanyaan', $pertanyaan->isi_pertanyaan,['id'=> 'editor', 'class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'isi artikel'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    </div>
    
    
{!! Form::close() !!}
@endsection