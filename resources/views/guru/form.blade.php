<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $modal['title'] }}</h4>
</div>
<div class="modal-body">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'form-guru', 'files' => true, 'url' => $modal['action']]) !!}
    {{--<form class="form-horizontal" id="form-siswa" role="form" action="{{  }}" method="POST">--}}
        <div class="form-group">
            <label class="control-label col-md-3">NIP</label>
            <div class="col-md-9">
                <input class="form-control" name="nip" value="{{ $modal['form']['nip'] }}">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">Nama</label>
            <div class="col-md-9">
                <input class="form-control" name="nama" value="{{ $modal['form']['nama'] }}">
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
