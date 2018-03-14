<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:20px;">
    <a class="navbar-brand" href="{{ URL('/') }}">{{ $navbarTitle }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mr-auto"></ul>
        <ul class="navbar-nav">
        @if (session()->has('user_name'))
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    使用者：{{session('user_name')}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{URL('update-password')}}">更改密碼</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{URL('/sign-out')}}">登出</a>
                </div>
            </div>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{URL('/login')}}">登入</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('/register')}}">註冊</a>
            </li>
        @endif
        </ul>
    </div>
</nav>