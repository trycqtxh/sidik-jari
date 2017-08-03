@extends('layouts.template')

@section('title', 'Absensi Siswa')

@section('content')
    <div id="home">

    </div>
@endsection

@push('js')
{{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.4.6/socket.io.min.js') }}
{{ Html::script('js/home.js') }}
@endpush

@push('css')

@endpush