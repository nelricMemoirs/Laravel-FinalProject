<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\Pertanyaan;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
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

        $jawaban = new Jawaban;
        $jawaban->pertanyaan_id = $request->input('id_pertanyaan');
        $jawaban->jawaban = $request->input('jawaban');
        $jawaban->save();

        return redirect('/pertanyaan')->with('success', 'Article created');
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
            'judul' => 'required',
            'isi_pertanyaan' => 'required'
        ]);

        $article = Jawaban::find($id);
        $article->judul_pertanyaan = $request->input('judul');
        $article->isi_pertanyaan = $request->input('isi_pertanyaan');
        $article->tag = $request->input('tag');
        $article->save();

        return redirect('/pertanyaan')->with('success', 'Question Updated');
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
        $article = Jawaban::find($id);
        $article->delete();
        return \redirect('/pertanyaan')->with('success', 'Question Deleted');
    }
}
