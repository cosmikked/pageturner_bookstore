
<header class="p-3 border-bottom sticky-top bg-white">
    <div class="container-fluid">
        <div
            class="d-flex flex-wrap align-items-center justify-content-start justify-content-lg-start"
        >
            <a
                href="{{ route('home') }}"
                class="d-flex align-items-center mb-2 mb-lg-0 link-body-emphasis text-decoration-none me-4"
            >
                <img src="{{ asset('/storage/defaults/logo.png') }}" alt="Logo" width="40" height="32" class="me-2" />
                <span class="fs-4 fw-bold">PageTurner</span>
            </a>
            <ul
                class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 gap-3">
                <li>
                    <a href="{{ route('home') }}" class="nav-link px-2 link-body-emphasis"
                    >Home</a
                    >
                </li>
                <li>
                    <a href="{{ route('store.catalog') }}" class="nav-link px-2 link-body-emphasis"
                    >Books</a
                    >
                </li>
            </ul>

            <div class="d-flex align-items-center gap-4">
                <!-- Cart Button (visible to all) -->
                <a href="{{ route('store.cart.index')}}" class="btn position-relative">
                    <i class="bi bi-cart"></i>
                     <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                </a>

                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary ms-2">Sign Up</a>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary ms-2">Log In</a>
                @else
                    <div class="dropdown d-flex align-items-center">
                        <x-avatar :user="Auth::user()" />
                        <a href="{{ route('profile.edit') }}" class="btn dropdown-toggle dropdown-toggle-split ms-2 p-0 border-0 bg-transparent shadow-none" data-bs-toggle="dropdown" aria-expanded="false" style="line-height: 1;">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">View Profile</a></li>
                            <li><hr class="dropdown-divider" /></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endguest
            </div>
        </div>
    </div>
</header>
