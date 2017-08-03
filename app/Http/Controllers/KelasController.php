<?php

namespace App\Http\Controllers;

use App\Kelas;
use App\Transformers\KelasTransformer;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->wantsJson()){
            return Datatables::of(Kelas::query())->make(true);
        }
        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modal = [
            'title' => 'Tambah Kelas',
            'action' => route('kelas.store'),
            'form' => Kelas::initialize()
        ];
        return view('kelas.form', compact('modal'))->render();
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
            'kelas' => 'required'
        ]);

        Kelas::create($request->all());

        return response()->json([
            'saved' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function show(Kelas $kelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $modal = [
            'title' => 'Ubah Kelas',
            'action' => route('kelas.update', $id),
            'form' => fractal($kelas, new KelasTransformer())->jsonSerialize()['data']
        ];
        return view('kelas.form', compact('modal'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kelas' => 'required'
        ]);

        $kelas = Kelas::findOrFail($id);

        $kelas->update($request->all());

        return response()->json([
            'saved' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Kelas::findOrFail($id);

        $siswa->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }
}
