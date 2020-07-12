<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\Pertanyaan;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $jawaban = Jawaban::orderBy('created_at', 'desc')->get();

        return \view('UI.jawaban')->with('jawaban', $jawaban);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $judul =  Pertanyaan::find($id);
        return \view('jawaban.create')->with('pertanyaan', $judul);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());
        $this->validate($request, [
            'id_pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        $jawaban = new Jawaban;
        $jawaban->pertanyaan_id = $request->input('id_pertanyaan');
        $jawaban->jawaban = $request->input('jawaban');
        $jawaban->user_id = auth()->user()->id;
        $jawaban->save();

        return redirect('/pertanyaan')->with('success', 'Answer created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $judul =  Pertanyaan::find($id);
        return \view('jawaban.show')->with('pertanyaan', $judul);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $judul =  Jawaban::find($id);
        return \view('jawaban.edit')->with('jawaban', $judul);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'jawaban' => 'required',
            'id_pertanyaan' => 'required'
        ]);
        
        $answer = Jawaban::find($id);
        $answer->jawaban = $request->input('jawaban');
        $answer->pertanyaan_id = $request->input('id_pertanyaan');
        $answer->save();
        
        $id_pertanyaan = $request->id_pertanyaan;

        return redirect('pertanyaan/'.$id_pertanyaan)->with('success', 'Jawaban Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $jawaban = Jawaban::find($id);
        $jawaban->delete();
        return \redirect('/pertanyaan')->with('success', 'Jawaban Deleted');
    }
}
