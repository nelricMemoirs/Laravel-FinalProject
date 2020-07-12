@extends('layouts.app')

@section('content')
<a href="/pertanyaan" class="btn btn-outline-secondary">Back</a>
<h1 class=" col-7">{{$pertanyaan->judul_pertanyaan}}</h1>
<small>Written by {{$pertanyaan->created_at}}</small>
&emsp;
<small>Updated at {{$pertanyaan->updated_at}}</small><br>
<small>tag : </small>

@foreach (explode(' ', $pertanyaan->tag) as $item)

    <small class=" pr-1 pl-1 text-light ", style="background-color: rgb(0, 128, 49)">{{$item}}</small>

@endforeach

<hr>
    <div>
        {!! $pertanyaan->isi_pertanyaan !!} {{-- agar bisa dibaca format HTML pada CkEditor gunakan {!! var !!} --}}
    </div>
    <hr>
    {!! Form::open(['action'=> 'JawabanController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::text('id_pertanyaan', $pertanyaan->id,['class' => 'form-control col-lg-7 col-sm-5 invisible', 'placeholder' => 'title'])}}
        {{Form::label('jawaban', 'jawaban :')}}
        {{Form::textarea('jawaban', '',['id'=> 'editor', 'class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'isi jawaban masa sih'])}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

@endsection
