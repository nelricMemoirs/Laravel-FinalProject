@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="pertanyaan/create" class="btn btn-primary">Create Question</a>
                    <br><br>
                    <h3>Your Question(s) on Forum</h3>
                    @if (count($pertanyaan) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <th></th>
                        <th>Score: {{$user->score}}</th>
                        </tr>
                        @foreach ($pertanyaan as $item)
                            <tr>
                                <td>{{$item->judul_pertanyaan}}</td>
                                <td><a href="pertanyaan/{{$item->id}}/edit" class="btn btn-secondary">Edit</a></td>
                                <td>{!! Form::open(['action'=> ['PertanyaanController@destroy', $item->id], 'method'=> 'POST', 'class' => 'float-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}</td>
                            </tr>
                        @endforeach
                    </table>
                    @else
                        <h6>You dont have any active question</h6>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
