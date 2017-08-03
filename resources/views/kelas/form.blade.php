<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">{{ $modal['title'] }}</h4>
</div>
<div class="modal-body">
    {!! Form::open(['class' => 'form-horizontal', 'id' => 'form-kelas', 'url' => $modal['action']]) !!}
        <div class="form-group">
            <label class="control-label col-md-3">Kelas</label>
            <div class="col-md-9">
                <input class="form-control" name="kelas" value="{{ $modal['form']['kelas'] }}">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button class="btn btn-default">Simpan</button>
        </div>
    {{--</form>--}}
    {!! Form::close() !!}
</div>
