<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom:20px;">
    <a class="navbar-brand" href="{{ URL('/') }}">{{ $navbarTitle }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mr-auto"></ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{URL('/login')}}">登入</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{URL('/register')}}">註冊</a>
            </li>
        </ul>
    </div>
</nav>