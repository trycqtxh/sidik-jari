<section class="col-md-3 menu-sidebar">
    <div class="panel panel-collapse panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"> Main Menu</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="{{ route('siswa.index') }}">Siswa</a> </li>
                <li><a href="{{ route('guru.index') }}">Guru</a> </li>
                <li><a href="{{ route('absensi.index') }}">Absensi</a> </li>
                {{--<li class="active">--}}
                {{--<a href="#">Siswa</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="#">Guru</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                {{--<a href="#">Kehadiran</a>--}}
                {{--</li>--}}
            </ul>
        </div>
    </div>
</section>