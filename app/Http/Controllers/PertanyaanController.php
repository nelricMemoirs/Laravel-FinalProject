<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\Pkomentar;
use App\Jkomentar;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy('created_at', 'desc')->get();

        return \view('UI.question')->with('pertanyaan', $pertanyaan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('UI.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required',
            'isi_pertanyaan' => 'required'
        ]);

        $pertanyaan = new Pertanyaan;
        $pertanyaan->judul_pertanyaan = $request->input('judul');
        $pertanyaan->isi_pertanyaan = $request->input('isi_pertanyaan');
        $pertanyaan->tag = $request->input('tag');
        $pertanyaan->save();

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
        $judul =  Pertanyaan::find($id);
        // dd(Pertanyaan::find($id));
        return \view('UI.show')->with('pertanyaan', $judul);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $judul =  Pertanyaan::find($id);
        return \view('UI.edit')->with('pertanyaan', $judul);
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
        $this->validate($request, [
            'judul' => 'required',
            'isi_pertanyaan' => 'required'
        ]);

        $article = Pertanyaan::find($id);
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
        $article = Pertanyaan::find($id);
        $article->delete();
        return \redirect('/pertanyaan')->with('success', 'Question Deleted');
    }
}
