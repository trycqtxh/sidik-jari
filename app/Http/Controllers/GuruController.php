<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Guru;
use App\Transformers\ApiGuruTransformers;
use App\Transformers\GuruTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()){
            return Datatables::of(Guru::query())->make(true);
        }
        return view('guru.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modal = [
            'title' => 'Tambah Guru',
            'action' => route('guru.store'),
            'form' => Guru::initialize()
        ];
        return view('guru.form', compact('modal'))->render();
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
            'nip' => 'required',
            'nama' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg'
        ]);

        $extension = $request->file('foto')->getClientOriginalExtension();
        $filename = $request->nip.'.'.$extension;

        $request->file('foto')->move(
            public_path() . '/images/user/', $filename
        );

        $guru = [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'foto' => $filename
        ];

        Guru::create($guru);

        return response()->json([
            'saved' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        $info = [
            'masuk' => Absensi::where('nip_nis', $guru->nip)->where('keterangan', 'Masuk')->count(),
            'izin' => Absensi::where('nip_nis', $guru->nip)->where('keterangan', 'Izin')->count(),
            'sakit' => Absensi::where('nip_nis', $guru->nip)->where('keterangan', 'Sakit')->count(),
            'alpa' => Absensi::where('nip_nis', $guru->nip)->where('keterangan', 'Alpa')->count(),
        ];
        $guru = fractal($guru, new GuruTransformer())->jsonSerialize()['data'];
        $modal = [
            'title' => 'Profil Guru'
        ];
        return view('guru.show', compact('guru', 'modal', 'info'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        $modal = [
            'title' => 'Ubah Guru',
            'action' => route('guru.update', $id),
            'form' => fractal($guru, new GuruTransformer())->jsonSerialize()['data']
        ];
        return view('guru.form', compact('modal'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nip' => 'required',
            'nama' => 'required',
            'foto' => 'mimes:png,jpg,jpeg'
        ]);

        $guru = Guru::findOrFail($id);

        $update = [
            'nip' => $request->nip,
            'nama' => $request->nama,
        ];

        if($request->file('foto')){
            if($guru->foto && file_exists(public_path() . '/images/user/'.$guru->foto)){
                unlink(public_path() . '/images/user/'.$guru->foto);
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = $request->nip.'.'.$extension;

            $request->file('foto')->move(
                public_path() . '/images/user/', $filename
            );

            $update['foto'] = $filename;
        }

        $guru->update($update);

        return response()
            ->json([
                'saved' => true,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        if($guru->foto && file_exists(public_path() . '/images/user/'.$guru->foto)){
            unlink(public_path() . '/images/user/'.$guru->foto);
        }

        $guru->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }

    public function user(Guru $guru)
    {
        $guru = $guru->find(Auth::user()->nip);
        return fractal($guru)
            ->transformWith(new GuruTransformer())
            ->respond();
    }

    public function api_index(Guru $guru)
    {
        $guru = $guru->all();
        return fractal($guru)
            ->transformWith(new ApiGuruTransformers())
            ->respond();
    }
}
