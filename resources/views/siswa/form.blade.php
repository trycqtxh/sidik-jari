<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $modal['title'] }}</h4>
</div>
<div class="modal-body">
    {!! Form::open(['class' => 'form-horizontal', 'id' => $modal["id"], 'files' => true, 'url' => $modal['action']]) !!}
    {{--<form class="form-horizontal" id="form-siswa" role="form" action="{{  }}" method="POST">--}}
        <div class="form-group">
            <label class="control-label col-md-3">NIS</label>
            <div class="col-md-9">
                <input class="form-control" name="nis" value="{{ $modal['form']['nis'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Nama</label>
            <div class="col-md-9">
                <input class="form-control" name="nama" value="{{ $modal['form']['nama'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Jenis Kelamin</label>
            <div class="col-md-9">
                <select class="form-control" name="jenis_kelamin">
                    <option value="">Pilih</option>
                    <option value="Laki-laki" @if($modal['form']['jenis_kelamin'] == 'Laki-laki') selected @endif>Laki-laki</option>
                    <option value="Perempuan" @if($modal['form']['jenis_kelamin'] == 'Perempuan') selected @endif>Perempuan</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Tempat Lahir</label>
            <div class="col-md-9">
                <input class="form-control" name="tempat_lahir" value="{{ $modal['form']['tempat_lahir'] }}">
            </div>
        </div>
        <div class="form-group date">
            <label class="control-label col-md-3">Tanggal Lahir</label>
            <div class="col-md-9">
                <div class="input-group">
                    <input class="form-control" name="tanggal_lahir" value="{{ $modal['form']['tanggal_lahir'] }}" readonly>
                    <label class="input-group-addon btn" for="tanggal_lahir">
                        <span class="fa fa-calendar"></span>
                    </label>
                </div>

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Agama</label>
            <div class="col-md-9">
                <select class="form-control" name="agama">
                    <option value="">Pilih</option>
                    <option value="Islam" @if($modal['form']['agama'] == 'Islam') selected @endif>Islam</option>
                    <option value="Kristen Khatolik" @if($modal['form']['agama'] == 'Kristen Khatolik') selected @endif>Kristen Khatolik</option>
                    <option value="Kristen Protestan" @if($modal['form']['agama'] == 'Kristen Protestan') selected @endif>Kristen Protestan</option>
                    <option value="Hindu" @if($modal['form']['agama'] == 'Hindu') selected @endif>Hindu</option>
                    <option value="Budha" @if($modal['form']['agama'] == 'Budha') selected @endif>Budha</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Warganegara</label>
            <div class="col-md-9">
                <select class="form-control" name="warganegara">
                    <option value="">Pilih</option>
                    <option value="WNI" @if($modal['form']['warganegara'] == 'WNI') selected @endif>WNI</option>
                    <option value="WNA" @if($modal['form']['warganegara'] == 'WNA') selected @endif>WNA</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3">Kelas</label>
            <div class="col-md-9">
                <select class="form-control" name="kelas">
                    <option value="">Pilih</option>
                    @foreach(App\Kelas::all() as $kelas)
                        <option value="{{ $kelas->id }}" @if($kelas->id == $modal['form']['kelas']['data']['id']) selected @endif>{{ $kelas->kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Alamat</label>
            <div class="col-md-9">
                <textarea class="form-control" name="alamat">{{ $modal['form']['alamat'] }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Ayah</label>
            <div class="col-md-9">
                <input class="form-control" name="ayah" value="{{ $modal['form']['ayah'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Ibu</label>
            <div class="col-md-9">
                <input class="form-control" name="ibu"  value="{{ $modal['form']['ibu'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">No Hp Ortu</label>
            <div class="col-md-9">
                <input class="form-control" name="no_telepon" value="{{ $modal['form']['no_telepon'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Foto</label>
            <div class="col-md-9">
                {!! Form::file('foto', null) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button class="btn btn-default">Simpan</button>
        </div>
    {{--</form>--}}
    {!! Form::close() !!}
</div>

<script>
    $( ".date" ).datepicker({
        format: 'yyyy-mm-dd',
        allowInputToggle: true
    });
</script>
