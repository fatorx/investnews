<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0 py-3">
    <div class="container-xl">
        <a class="navbar-brand" href="{{ route('index') }}">
            Laravel Todo
        </a>
        <div class="navbar-nav ms-lg-auto">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 profile-menu">
                <li class="nav-item dropdown">
                    @guest
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('login') }}" type="button" class="login-btn btn btn-sm me-2">
                            Login
                        </a>
                        <a href="{{ route('register') }}" type="button" class="register-btn btn btn-sm p-1">
                            Register
                        </a>
                    </div>
                    @else
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span>{{ auth()->user()->name ?? ''}}</span>
                        <img class="rounded-circle header-profile-user" src="{{ asset('assets/images/admin.jpg') }}" alt="Admin Image">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="fa fa-user-o fa-fw"></i>
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" onclick="event.preventDefault(); this.closest('form').submit();" role="button">
                                    <i class="fa fa-sign-out fa-fw"></i>
                                    Log Out
                                </a>
                            </form>
                        </li>
                    </ul>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
