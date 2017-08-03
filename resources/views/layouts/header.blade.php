<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', '') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            @if(Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
                <li class="nav-item">
                    <a href="{{route('home.dashboard')}}" class="nav-item-link">
                        <span class="nav-item-icon"><i class="fa fa-home"></i></span>
                        <span class="nav-item-title">Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.index') }}" class="nav-item-link">
                        <span class="nav-item-icon"><i class="fa fa-graduation-cap"></i></span>
                        <span class="nav-item-title">Siswa</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('guru.index') }}" class="nav-item-link">
                        <span class="nav-item-icon"><i class="fa fa-users"></i></span>
                        <span class="nav-item-title">Guru</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-item-link">
                        <span class="nav-item-icon"><i class="fa fa-building"></i></span>
                        <span class="nav-item-title">Kelas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('absensi.index') }}" class="nav-item-link">
                        <span class="nav-item-icon"><i class="fa fa-list-alt"></i></span>
                        <span class="nav-item-title">Kehadiran</span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->nama }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('logout') }}">Logout</a> </li>
                    </ul>
                </li>
            @endif
            </ul>
            {{--<ul class="nav navbar-nav">--}}
                {{--<li><a href="{{ route('home.dashboard') }}">Dashbord</a> </li>--}}
            {{--</ul>--}}
            {{--@else--}}
            {{--<ul class="nav navbar-nav navbar-right">--}}
                {{--<li><a href="{{ route('login') }}">Login</a></li>--}}
            {{--</ul>--}}
            {{--@endif--}}
        </div>
    </div>
</nav>