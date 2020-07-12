@extends('layouts.app')

@section('content')

<a href="/pertanyaan/{{$jawaban->pertanyaan_id}}" class="btn btn-outline-secondary">Back</a>

&emsp;

<hr>
    <div>
        Jawaban: <br>
        {!! $jawaban->jawaban !!} {{-- agar bisa dibaca format HTML pada CkEditor gunakan {!! var !!} --}}
    </div>
    <hr>
    <!-- {!! Form::open(['action'=> 'JawabanController@store', 'method' => 'POST']) !!} -->

    <form action="{{route('jkomentar.store')}}" method="post">
            
        @csrf
            <textarea name="isi_komentar" id="editor" class="form-control mb-1" cols="30" rows="3" placeholder="comment"></textarea>
            <input type="hidden" name="jawaban_id" value="{{$jawaban->id}}">
            <input type="hidden" name="p_id" value="{{$jawaban->pertanyaan_id}}">
            <button type="submit" class="btn btn-success btn-sm float-right" >Submit</button>
        </form>
    <!-- {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} -->
@endsection