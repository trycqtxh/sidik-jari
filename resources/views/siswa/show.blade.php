<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $modal['title'] }}</h4>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body profil">
                    <div class="col-md-4">
                        <img class="img-thumbnail img-responsive" src="{{ $siswa['foto'] }}">
                        <div class="profile-info">
                            <ul class="nav">
                                <li>Masuk <span class="label label-info">{{ $info['masuk'] }}</span></li>
                                <li>Izin <span class="label label-warning">{{ $info['izin'] }}</span></li>
                                <li>Sakit <span class="label label-warning">{{ $info['sakit'] }}</span></li>
                                <li>Tidak Ada Keterangan <span class="label label-danger">{{ $info['alpa'] }}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td>NIS</td>
                                <td>:</td>
                                <td>{{ $siswa['nis'] }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{ $siswa['nama'] }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td>{{ $siswa['kelas']['data']['kelas'] }}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>{{ $siswa['jenis_kelamin'] }}</td>
                            </tr>
                            <tr>
                                <td>Tempat Tanggal Lahir</td>
                                <td>:</td>
                                <td>{{ $siswa['tempat_lahir'] }}, {{ $siswa['tanggal_lahir'] }}</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td>{{ $siswa['agama'] }}</td>
                            </tr>
                            <tr>
                                <td>Warganegara</td>
                                <td>:</td>
                                <td>{{ $siswa['warganegara'] }}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{ $siswa['alamat'] }}</td>
                            </tr>
                            <tr>
                                <td>Ayah</td>
                                <td>:</td>
                                <td>{{ $siswa['ayah'] }}</td>
                            </tr>
                            <tr>
                                <td>Ibu</td>
                                <td>:</td>
                                <td>{{ $siswa['ibu'] }}</td>
                            </tr>
                            <tr>
                                <td>No Telepon Ortu</td>
                                <td>:</td>
                                <td>{{ $siswa['no_telepon'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Data Kehadiran</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</div>