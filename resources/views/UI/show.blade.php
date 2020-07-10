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
    

    <div class="well mb-3 pl-5">
        <small>Komentar:</small><br>
        @foreach($pertanyaan->pkomentar as $pk)
            {{ $pk->isi_komentar }} - {{date("M y 'd G:i",strtotime($pk->created_at))}} <hr>
        
        @endforeach

        <small>add a comment</small>
        <div class="well">
        
            <form action="{{route('pkomentar.store')}}" method="post">
            
            @csrf
                <textarea name="isi_komentar" id="" class="form-control mb-1" cols="30" rows="3"></textarea>
                <input type="hidden" name="pertanyaan_id" value="{{$pertanyaan->id}}">
                <button type="submit" class="btn btn-success btn-sm float-right" >Submit</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col text-center">
            <p>Jawaban : </p>
                @foreach($pertanyaan->jawaban as $t)
                    <b>{!! $t->jawaban !!}</b> 
                        @foreach($t->jkomentar as $jk )
                            <!-- {{$jk->isi_komentar}} <br> -->
                            {{ $jk->isi_komentar }} - {{date("M y 'd G:i",strtotime($jk->created_at))}} <hr>
                        @endforeach
                    
                    <a href="/jkomentar/{{$t->id}}" class="btn btn-primary btn-sm mb-2">add a comment</a> 
                @endforeach
        </div>
    </div>
    <a href="/pertanyaan/{{$pertanyaan->id}}/edit" class=" btn btn-default btn-outline-primary">Edit Question</a>

    {!! Form::open(['action'=> ['PertanyaanController@destroy', $pertanyaan->id], 'method'=> 'POST', 'class' => 'float-right']) !!}
        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
    {!! Form::close() !!}

@endsection
