@extends('layouts.app')

@section('content')
{{-- content --}}
<div class="container-fluid">
    <a href="/pertanyaan" class="btn btn-outline-secondary">Back</a>
    <br><br>
    <div class="row">
        <div class="col-1 ">
            <div class="container-fluid" style=" margin-top: 90px">
                {{-- check autentikasi --}}
                @if (!Auth::guest())
                    @if (Auth::user()->id == $pertanyaan->user_id)
                        {{-- font up and down vote disable jika user ADALAH pembuat pertanyaan--}}
                                {{-- route vote ada di VoteController --}}
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm disabled">
                        <i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                        <br><br>
                                {{-- tampilkan jumlah up-vote - jumlah down-vote --}}
                        <span class=" ml-3"> {{$pertanyaan->countUpVoters() - $pertanyaan->countDownVoters()}} </span>
                        
                                {{-- route downvote ada di VoteController --}}
                        <a href="{{ route('downvote', $pertanyaan->id) }}" class="btn btn-link btn-sm disabled">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                        
                        @else
                        {{-- font up and down vote enable jika user BUKAN pembuat pertanyaan--}}
                                {{-- route vote ada di VoteController --}}
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm">
                        <i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                        <br><br>
                                {{-- tampilkan jumlah up-vote - jumlah down-vote --}}
                        <span class=" ml-3">  {{$pertanyaan->countUpVoters() - $pertanyaan->countDownVoters()}}</span> 

                                {{-- route downvote ada di VoteController --}}
                        <a href="{{ route('downvote', $pertanyaan->id) }}"  class="btn btn-link btn-sm">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                    @endif
                    @else
                    {{-- font up and down vote jika user BELUM LOGIN, ketika klik vote maka user harus login dulu--}}
                                {{-- route vote ada di VoteController --}}
                        <a href="{{ route('vote', $pertanyaan->id) }}" class="btn btn-link btn-sm">
                        <i class="fa fa-sort-asc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                        <br><br>
                                {{-- tampilkan jumlah up-vote - jumlah down-vote --}}
                        <span class=" ml-3"> {{$pertanyaan->countUpVoters() - $pertanyaan->countDownVoters()}} </span> 

                                {{-- route downvote ada di VoteController --}}
                        <a href="{{ route('vote', $pertanyaan->id) }}"  class="btn btn-link btn-sm">
                        <i class="fa fa-sort-desc" aria-hidden="true" style="font-size:50px;color:gray"></i>
                        </a>
                @endif
            
            </div>
        </div>

        <div class=" col-10">
                    {{-- Judul Pertanyaan dan detailnya --}}
                <h1 class=" col-7">{{$pertanyaan->judul_pertanyaan}}</h1>
                <small>Written by {{$pertanyaan->created_at}}</small>
                &emsp;
                <small>Updated at {{$pertanyaan->updated_at}}</small><br>
                <small>tag : </small>
                        {{-- tag --}}
                @foreach (explode(' ', $pertanyaan->tag) as $item)

                    <small class=" pr-1 pl-1 text-light ", style="background-color: rgb(0, 128, 49)">{{$item}}</small>
                    

                @endforeach

                    {{-- end dari Judul --}}
                <hr>
                    {{-- isi dari Pertanyaan --}}
                    <div>
                        {!! $pertanyaan->isi_pertanyaan !!} {{-- agar bisa dibaca format HTML pada CkEditor gunakan {!! var !!} --}}
                    </div>
                    <hr>
                        {{-- Button Edit Question dan Delete Question --}}
                        @if (!Auth::guest())
                            @if (Auth::user()->id == $pertanyaan->user_id)

                                <a href="/pertanyaan/{{$pertanyaan->id}}/edit" class=" btn btn-default btn-outline-primary">Edit Question</a>
                                {!! Form::open(['action'=> ['PertanyaanController@destroy', $pertanyaan->id], 'method'=> 'POST', 'class' => 'float-right']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {!! Form::close() !!}
                            @endif
                        @endif
                        {{-- End of button Edit Question dan Delete Question --}}
                        {{-- Komentar pada pertanyaan, user HARUS LOGIN untuk bisa submit, auto redirect to login page --}}
                    <div class="well mb-3 pl-5">
                        <small>Komentar:</small><br>
                        @foreach($pertanyaan->pkomentar as $pk)
                            {!! $pk->isi_komentar !!} - <small>{{date("M y 'd G:i",strtotime($pk->created_at))}}</small>
                            <hr>       
                        @endforeach
                                <small>add a comment</small>
                                <div class="well">
                                
                                    <form action="{{route('pkomentar.store')}}" method="post">
                                    
                                    @csrf
                                        <textarea name="isi_komentar" id="editor" class="form-control mb-1" cols="30" rows="3" placeholder="comment"></textarea>
                                        <input type="hidden" name="pertanyaan_id" value="{{$pertanyaan->id}}">
                                        <button type="submit" class="btn btn-success btn-sm float-right" >Submit</button>
                                    </form>
                                </div>
                        {{-- end of Komentar pada pertanyaan --}}
                        {{-- end of isi pertanyaan --}}
                    </div>

                    <div class="row">
                        <div class="col text-justify">
                                {{-- Jawaban --}}
                            @foreach($pertanyaan->jawaban as $t)
                                <h5>Jawaban : </h5>
                                {!! $t->jawaban !!}
                                <div class="col text-center">
                                {{-- edit jawaban --}}
                                @if (!Auth::guest())
                                @if (Auth::user()->id == $pertanyaan->user_id)
                                <a href="/jawaban/{{$t->id}}/edit" class=" btn btn-default btn-outline-primary float-left btn-sm">Edit Answer</a>
                                
                                {{-- delete jawaban --}}
                                {!! Form::open(['action'=> ['JawabanController@destroy', $t->id], 'method'=> 'POST', 'class' => 'inline']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete Answer', ['class' => 'btn btn-danger btn-sm float-right'])}}
                                {!! Form::close() !!}
                                @endif
                                @endif
                                {{-- end of jawaban --}}
                                <br><br><hr>
                                {{-- komentar --}}
                                @foreach($t->jkomentar as $jk )
                                <small>Komentar:</small><br>
                                {!! $jk->isi_komentar !!} - <small>{{date("M y 'd G:i",strtotime($jk->created_at))}}</small> <hr>
                                @endforeach
                        
                                <a href="/jkomentar/{{$t->id}}" class="btn btn-primary btn-sm mb-2">add a comment</a>
                                {{-- end of komentar --}} 
                                </div>
                            @endforeach
                        </div>
                    </div>
            </div>
                {{-- end content --}}
    </div>
</div>
@endsection
