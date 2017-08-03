<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Siswa;
use App\Transformers\ApiSiswaTransformers;
use App\Transformers\SiswaTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use Yajra\Datatables\Datatables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Siswa $siswa)
    {
        if(request()->wantsJson()){
            return Datatables::of(Siswa::query())->make(true);
        }
        return view('siswa.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modal = [
            'title' => 'Tambah Siswa',
            'id' => 'form-tambah',
            'action' => route('siswa.store'),
            'form' => Siswa::initialize()
        ];
        return view('siswa.form', compact('modal'))->render();
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
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'warganegara' => 'required',
            'alamat' => 'required',
            'kelas' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'no_telepon' => 'required',
            'foto' => 'required|mimes:png,jpg,jpeg',
        ]);

        $extension = $request->file('foto')->getClientOriginalExtension();
        $filename = $request->nis.'.'.$extension;

        $request->file('foto')->move(
            public_path() . '/images/user/', $filename
        );

        $siswa = [
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'warganegara' => $request->warganegara,
            'alamat' => $request->alamat,
            'kelas_id' => $request->kelas,
            'ayah' => $request->ayah,
            'ibu' => $request->ibu,
            'no_telepon' => $request->no_telepon,
            'foto' => $filename,
        ];

        Siswa::create($siswa);

        return response()->json([
            'saved' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        $info = [
            'masuk' => Absensi::where('nip_nis', $siswa->nis)->where('keterangan', 'Masuk')->count(),
            'izin' => Absensi::where('nip_nis', $siswa->nis)->where('keterangan', 'Izin')->count(),
            'sakit' => Absensi::where('nip_nis', $siswa->nis)->where('keterangan', 'Sakit')->count(),
            'alpa' => Absensi::where('nip_nis', $siswa->nis)->where('keterangan', 'Alpa')->count(),
        ];
        $siswa = fractal($siswa, new SiswaTransformer())->parseIncludes('kelas')->jsonSerialize()['data'];
        $modal = [
            'title' => 'Profil Siswa'
        ];
        return view('siswa.show', compact('siswa', 'modal', 'info'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $modal = [
            'title' => 'Ubah Siswa',
            'id' => 'form-ubah',
            'action' => route('siswa.update', $id),
            'form' => fractal($siswa, new SiswaTransformer())->parseIncludes('kelas')->jsonSerialize()['data']
        ];
        return view('siswa.form-ubah', compact('modal'))->render();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nis' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'agama' => 'required',
            'warganegara' => 'required',
            'alamat' => 'required',
            'kelas' => 'required',
            'ayah' => 'required',
            'ibu' => 'required',
            'no_telepon' => 'required',
            'foto' => 'mimes:png,jpg,jpeg',
        ]);
        $siswa = Siswa::findOrFail($id);

        $update = [
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'warganegara' => $request->warganegara,
            'alamat' => $request->alamat,
            'kelas' => $request->kelas,
            'ayah' => $request->ayah,
            'ibu' => $request->ibu,
            'no_telepon' => $request->no_telepon,
        ];

        if($request->file('foto')){
            if($siswa->foto && file_exists(public_path() . '/images/user/'.$siswa->foto)){
                unlink(public_path() . '/images/user/'.$siswa->foto);
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = $request->nis.'.'.$extension;

            $request->file('foto')->move(
                public_path() . '/images/user/', $filename
            );

            $update['foto'] = $filename;
        }

        $siswa->update($update);

        return response()
            ->json([
                'saved' => true,
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        if($siswa->foto && file_exists(public_path() . '/images/user/'.$siswa->foto)){
            unlink(public_path() . '/images/user/'.$siswa->foto);
        }

        $siswa->delete();

        return response()
            ->json([
                'deleted' => true
            ]);
    }

    public function api_index(Siswa $siswa)
    {
        $siswa = $siswa->all();

        return fractal($siswa)
            ->transformWith(new ApiSiswaTransformers())
            ->respond();
    }
}
