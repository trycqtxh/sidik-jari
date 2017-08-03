<?php

namespace App\Http\Controllers;

use App\Absensi;
use App\Kelas;
use App\Siswa;
use App\Transformers\AbsensiLaporan;
use App\Transformers\AbsensiTransformer;
use App\Transformers\ApiAbsensiTransformers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use LRedis;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $absensi = Absensi::where('tanggal', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'desc')->paginate(10);

            if($request->vuejs)
            {

                $siswa = new Siswa();
                if($request->kelas == "all")
                {
                    $siswa_absensi = $siswa->all();
                }else{
                    $siswa_absensi = $siswa
                        ->where('kelas_id', $request->kelas)
                        ->get();
                }
                return fractal($siswa_absensi, new AbsensiLaporan())->respond();
            }

            return fractal($absensi, new AbsensiTransformer())->parseIncludes(['siswa'])->respond();
        }
        $kelas = Kelas::all();
        return view('absensi.index', compact('kelas'));
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
        $this->validate($request, [
            'nis' => 'required|exists:siswa,nis',
            'keterangan' => 'required'
        ]);

        $absensi = [
            'nip_nis' => $request->nis,
            'keterangan' => $request->keterangan
        ];

        Absensi::create($absensi);

        $siswa = Siswa::findOrFail($request->nis);

        $redis = LRedis::connection();
        $redis->publish('message', $siswa);

        return response()
            ->json([
                'saved' => true
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function show(Absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function edit(Absensi $absensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Absensi  $absensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absensi $absensi)
    {
        //
    }

    public function data()
    {
        $absensi = Absensi::where('tanggal', Carbon::now()->format('Y-m-d'))->orderBy('created_at', 'desc')->get();
//        return $absensi;
        if(!$absensi->isEmpty()){
            return fractal($absensi)
                ->transformWith(new ApiAbsensiTransformers())
                ->respond();
        }else{
			$data[] = [
                    'nis' => '',
                    'nama' => '',
                    'jam_masuk' => '',
                    'keterangan' => '',
                ];
            return response()->json([
                'data' => $data
            ]);
        }
    }

    public function excel()
    {
        $siswa = new Siswa();
        if(request()->kelas == "all")
        {
            $siswa_absensi = $siswa->all();
        }else{
            $siswa_absensi = $siswa
                ->where('kelas_id', request()->kelas)
                ->get();
        }

        $data = fractal($siswa_absensi, new AbsensiLaporan())->toArray()['data'];

        $title = 'laporan-absensi';

        Excel::create($title, function($excel) use($title, $data){
            $excel->setTitle($title)
                ->setCreator('Sistem Absensi Fingerprint')
                ->setCompany('SMAN 1 Cimahi')
                ->setDescription('Laporan Absensi');

            $excel->sheet('Laporan', function($sheet) use($data) {
                //Header
                $sheet->protect('password');

                $sheet->setPageMargin([1.9, 1.7, 1.9, 1.7]);
                $sheet->setFontFamily('Times New Roman');
                $sheet->prependRow(1, array('LAPORAN ABSENSI'));
                $sheet->prependRow(2, array('SMAN 1 CIMAHI'));
                $sheet->prependRow(3, array('Jl. Pacinan No.22A, Cimahi, Cimahi Tengah, Kota Cimahi, Jawa Barat 40525'));
                if(request()->date_range){
                    $sheet->prependRow(6, array('Pertanggal - '.request()->date_range));
                }

                $sheet->setHeight([
                    '1' => 20,
                    '2' => 20,
                    '3' => 20,
                    '4' => 5,
                    '6' => 20,
                ]);
                $sheet->setWidth([
                    'A'=>4,
                    'B'=>20,
                    'C'=>30,
                    'D'=>13,
                    'E'=>13,
                    'F'=>13,
                    'G'=>13,
                ]);
                $sheet->mergeCells('A1:G1');
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A3:G3');
                $sheet->mergeCells('A6:G6');

                $sheet->cells('A1:G7', function($cells) {
                    $cells->setFontSize(12);
                    $cells->setFontWeight('bold');
                    $cells->setAlignment('center');
                });
                //Garis
                $sheet->cells('A5:G5', function($cells) {
                    $cells->setBorder('double');
                });

                $sheet->prependRow(8, ['No', 'NIS', 'Nama', 'Masuk', 'Izin', 'Sakit', 'Alpa']);
                $sheet->setHeight(['8' => 20]);

                $jumlah_row = count($data) + 8;
                $sheet->setFontSize(12);
                $sheet->setFontBold(false);
                $sheet->setBorder('A8:G'.$jumlah_row, 'thin');
                $sheet->fromArray($data, null, 'B9', false, false);
                for($i=1; $i<=count($data); $i++){
                    $row = $i+8;
                    $sheet->cell('A'.$row, function($cell) use ($i) {
                        $cell->setValue($i);
                        $cell->setAlignment('center');
                    });
                }
            })->export('xls');
        });
    }
}
