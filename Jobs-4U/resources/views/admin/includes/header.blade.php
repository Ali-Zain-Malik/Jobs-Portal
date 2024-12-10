<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route("admin.dashboard")}}" class="logo d-flex align-items-center">
            
            <span class="d-none d-lg-block">Jobs 4U Admin</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                {{-- Profile pic --}}
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <div class="image-div dropdown-toggle me-4 rounded-circle" style="width: 35px; height:35px;">                                                        
                        <img style="width: 100%; height:100%; object-fit:cover;" src="{{ asset("img/demo_image.png") }}" class="rounded-circle" alt="">
                    </div>
                </a>
                {{--  End Profile pic --}}
            
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6 class="text-capitalize">{{ Auth::user()->name }}</h6>
                        <span class="text-capitalize">{{ Auth::user()->role }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
            
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route("profile.view", Auth::id()) }}">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
            
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route("user.signout") }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="sign-out">Sign Out</span>
                        </a>
                    </li>
            
                </ul>
            </li>
        
        </ul>
    </nav>
</header>