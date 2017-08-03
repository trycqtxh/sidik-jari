<template>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Profil Siswa</div>
                <div class="panel-body profil">
                    <div class="col-md-4">
                        <img class="img-thumbnail img-responsive" src="images\user\default.png">
                        <div class="profile-info">
                            <ul class="nav">
                                <li>Masuk <span class="label label-info">2</span></li>
                                <li>Izin <span class="label label-warning"></span></li>
                                <li>Sakit <span class="label label-warning"></span></li>
                                <li>Tidak Ada Keterangan <span class="label label-danger"></span></li>
                            </ul>

                            <!--<router-link :to="'/siswa/' + data.nis + '/edit'" tag="button" class="btn btn-info pull-right">Ubah</router-link>-->
                            <!--<button class="btn btn-danger" @click="remove">Hapus</button>-->
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped table-bordered">
                            <tbody>
                            <tr>
                                <td>Nis</td>
                                <td>:</td>
                                <td>10112671</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>Faisal Abdul Hamid</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Tempat Tanggal Lahir</td>
                                <td>:</td>
                                <td>Tasikmalaya, 18 April 2016</td>
                            </tr>
                            <tr>
                                <td>Agama</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Warganegara</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Ayah</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Ibu</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>No Telepon Ortu</td>
                                <td>:</td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Data Kehadiran</div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
</template>