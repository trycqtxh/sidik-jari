@extends('layouts.template')

@section('title', 'Absensi')

@section('content')
    <div id="absensi">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading data-viewer">
                        Laboran Kehadiran
                    </div>
                    <div class="panel-heading">
                        <form role="form" class="form-horizontal">
                            <div class="form-group form-group-sm">
                                <div class="col-md-5">
                                    <input class="form-control" name="date_range" v-model="params.date_range">
                                </div>
                                <div class="col-md-5">
                                    <select class="form-control" name="kelas" v-model="params.kelas">
                                        <option value="all">Semuanya</option>
                                        @foreach($kelas as $k)
                                        <option value="{{ $k->id }}">{{ $k->kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-default btn-sm btn-block" @click="cari">Cari</a>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-default btn-sm btn-block" @click="exportData">Export</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-responsive" id="tabel">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nis</th>
                                <th>Nama</th>
                                <th>Masuk</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Alpa</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(siswa, index) in data">
                                <td width="50px">@{{ index+1 }}</td>
                                <td width="200px">@{{ siswa.nis }}</td>
                                <td>@{{ siswa.nama }}</td>
                                <td width="50px">@{{ siswa.masuk}}</td>
                                <td width="50px">@{{ siswa.izin}}</td>
                                <td width="50px">@{{ siswa.sakit}}</td>
                                <td width="50px">@{{ siswa.alpa}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    {{ Html::script('js/absensi.js') }}
@endpush