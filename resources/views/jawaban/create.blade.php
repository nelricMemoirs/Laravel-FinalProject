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
    <a href="/pertanyaan/{{$pertanyaan->id}}/edit" class=" btn btn-default btn-outline-primary">Edit Question</a>

    {!! Form::open(['action'=> ['PertanyaanController@destroy', $pertanyaan->id], 'method'=> 'POST', 'class' => 'float-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}

@endsection
