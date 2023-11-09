<header>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 text-center">
                <a href="javascript:;" title="">
                    <img src="{{ asset('assets/images/logo.webp')}}" alt="">
                </a>
            </div>
            <div class="col-md-10 d-flex align-items-center justify-content-between">
                @if(Auth::check())
                <div class="admin_user">
                    <figure>
                        <img src="{{ asset('assets/images/user.webp')}}" alt="">
                    </figure>
                    <div class="userdetails">
                        <h5>{{ Auth::user()->name }}.</h5>
                        <p>Admin</p>
                    </div>
                </div>
                @endif
                <div class="headright">
                    {{-- <a class="notification" href="javascript:;" title="">
                        <i class="fal fa-bell"></i>
                        <span>2</span>
                    </a> --}}
                    <a class="themeBtn" href="javascript:;" title="">Contact Us</a>
                    @if(!Auth::check())
                        <a class="themeBtn" href="javascript:;" title="">Login</a>
                        @else 
                        <a href="{{ route('logout') }}" class="themeBtn" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a> 
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
