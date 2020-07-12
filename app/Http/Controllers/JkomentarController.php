<?php

namespace App\Http\Controllers;
use App\Jawaban;
use App\Pertanyaan;
use App\Jkomentar;

use Illuminate\Http\Request;


class JkomentarController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $pertanyaan_id = $request->p_id;
        // dd($pertanyaan_id);
        Jkomentar::create([
    		'isi_komentar' => $request->isi_komentar,
            'jawaban_id' => $request->jawaban_id,
            'user_id' => auth()->user()->id
    	]);
        return redirect()->route('pertanyaan.show', [$pertanyaan_id])->with('success', 'Comment Answer Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $jawaban =  Jawaban::find($id);
        return view('show')->with('jawaban', $jawaban);
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
    }
}
