@extends('layouts.template')

@section('title', 'Guru')

@section('content')
	<div id="guru">
		<div class="container main-container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading data-viewer">
							Data Guru
							<a class="btn btn-default btn-sm pull-right" id="btn-tambah">Tambah</a>
						</div>
						<div class="panel-body">
							<table class="table table-bordered table-responsive" id="tabel">
								<thead>
								<tr>
									<th>NIP</th>
									<th>Nama</th>
									<th>Action</th>
								</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	@include('layouts.modal')
@endsection

@push('js')
	{{Html::script('js/guru.js')}}
@endpush