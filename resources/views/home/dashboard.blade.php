@extends('layouts.template')

@section('title', 'Dashboard - '.config('app.name'))

@section('content')
    <div class="container main-container">
        <div class="row">
            <div class="col-md-4">
                <div class="box bg-info">
                    <h4>Jumlah siswa</h4>
                    <div class="box-body">
                        12
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-danger">
                    <h4>Jumlah siswa</h4>
                    <div class="box-body">
                        12
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box bg-success">
                    <h4>Jumlah siswa</h4>
                    <div class="box-body">
                        12
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

