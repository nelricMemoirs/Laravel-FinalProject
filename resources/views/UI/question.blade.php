@extends('layouts.app')

@section('content')

<h1 class=" col-7">Forum</h1>
<a href="{{route('pertanyaan.create')}}" class=" btn btn-default btn-outline-primary">Create a Question</a>
<a href="{{url('/')}}" class=" btn btn-default btn-outline-primary">Back to Front Page</a>

<hr>
@if (count($pertanyaan) > 0)
@foreach ($pertanyaan as $judul)
<div class="well">
    <div class="row">
        <div class="col text-center">
            <h3><a href="/pertanyaan/{{$judul->id}}">{{$judul->judul_pertanyaan}}</a></h3>
            {{-- agar bisa dibaca format HTML pada CkEditor gunakan {!! var !!} --}}
            <p>Content: {!! Str::limit($judul->isi_pertanyaan, 50) !!} <span class=" text-success"> click title for detail</span></p>
            <small>Written at {{$judul->created_at}}</small>
            &emsp;
            <small>Updated at {{$judul->updated_at}}</small><br>
            <small>tag : </small>
            @foreach (explode(' ', $judul->tag) as $item)

            <small class="pr-1 pl-1 text-light", , style="background-color: rgb(0, 128, 49)">{{$item}}</small>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col text-center">
            <a href="/jawaban/{{$judul->id}}" class=" btn btn-default btn-warning">Beri Jawaban</a>
        </div>
    </div>

    <hr>
</div>
@endforeach




@else
<h4>No Article Yet</h4>
@endif
@endsection
