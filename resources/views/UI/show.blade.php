@extends('layouts.app')

@section('content')

<div class="container">
    <a href="/pertanyaan" class="btn btn-outline-secondary">Back</a>
    <br><br>
    <div class="row">
        <div class="col-1 ">
            {{-- Font --}}
            <div class="container-fluid" style=" margin-top: 90px">
                @if (!Auth::guest())
                    @if (Auth::user()->id == $pertanyaan->user_id)
                    
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm disabled"><i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                        <br><br>
                        <span class=" ml-3"> {{$pertanyaan->countVoters()}} </span> 
                        <a class="btn btn-link btn-sm disabled">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                        
                        @else
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm"><i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                        <br><br>
                        <span class=" ml-3"> {{$pertanyaan->countVoters()}} </span> 
                        <a class="btn btn-link btn-sm">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                    @endif
                    @else
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm"><i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                        <br><br>
                        <span class=" ml-3"> {{$pertanyaan->countVoters()}} </span> 
                        <a class="btn btn-link btn-sm">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i></a>
                        
                @endif
            
            </div>
            
        </div>
        <div class=" col-10">
            <h1 class=" col-7">{{$pertanyaan->judul_pertanyaan}}</h1>
        <small>Written by {{$pertanyaan->created_at}} by {{$pertanyaan->user->name}}</small>
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
                @if (!Auth::guest())
                    @if (Auth::user()->id == $pertanyaan->user_id)
                    
                
                        <a href="/pertanyaan/{{$pertanyaan->id}}/edit" class=" btn btn-default btn-outline-primary">Edit Question</a>

                        {!! Form::open(['action'=> ['PertanyaanController@destroy', $pertanyaan->id], 'method'=> 'POST', 'class' => 'float-right']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!! Form::close() !!}
                    @endif
                @endif
                
        </div>     
    </div>
</div>


@endsection
