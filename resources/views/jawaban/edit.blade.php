@extends('layouts.app')

@section('content')

{{-- Detail Pertanyaan --}}
<a href="/pertanyaan" class="btn btn-outline-secondary">Back</a>
<h1 class=" col-7">{{$jawaban->question->judul_pertanyaan}}</h1>
<small>Written by {{$jawaban->question->created_at}}</small>
&emsp;
<small>Updated at {{$jawaban->question->updated_at}}</small><br>
<small>tag : </small>

{{-- Tag --}}
@foreach (explode(' ', $jawaban->question->tag) as $item)

    <small class=" pr-1 pl-1 text-light ", style="background-color: rgb(0, 128, 49)">{{$item}}</small>

@endforeach

<hr>
    <div>
        {!! $jawaban->question->isi_pertanyaan !!} {{-- agar bisa dibaca format HTML pada CkEditor gunakan {!! var !!} --}}
    </div>
    <hr>
    {{-- Update jawaban --}}
    {!! Form::open(['action'=> ['JawabanController@update', $jawaban->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::text('id_pertanyaan', $jawaban->question->id,['class' => 'form-control col-lg-7 col-sm-5 invisible', 'placeholder' => 'title'])}}
        {{Form::label('jawaban', 'jawaban :')}}
        {{Form::textarea('jawaban', $jawaban->jawaban,['id'=> 'editor', 'class' => 'form-control col-lg-7 col-sm-5', 'placeholder' => 'isi jawaban masa sih'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

@endsection
