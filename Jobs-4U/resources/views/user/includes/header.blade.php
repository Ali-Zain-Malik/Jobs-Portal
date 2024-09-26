

<nav class="nav-bar p-2 border-bottom fixed-top">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a id="title-link" href="{{route("user.home")}}" class="d-flex align-items-center mb-2 mb-lg-0 text-dark text-decoration-none">
          <h3 id="title-heading">Jobs 4U</h3>
        </a>
  
        <!-- This menu will be displayed when the screen size gets smaller -->
        <div class="menu">
          <div class="dropdown">
            <a class="dropdown-toggle btn" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="img/menu.svg" alt="">
            </a>
  
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{route("user.home")}}">Home</a></li>
              <li><a class="dropdown-item" href="posts.php">Post</a></li>
              <li><a class="dropdown-item" href="requests.php">Requests</a></li>
              <li><a class="dropdown-item find-jobs">Find Jobs</a></li>
              <li><a class="dropdown-item switch" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#">Switch to Applicant</a></li>
            </ul>
          </div>
  
          <div class="dropdown text-end">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="img/demo_image.png" style="object-fit: cover;" alt="Profile Pic" width="45" height="45" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small">
              <li><a class="dropdown-item" href="profile_page.php">Profile</a></li>
              <li><a class="dropdown-item" href="posts.php">My Posts</a></li>
              <li><a class="dropdown-item" href="{{route("user.favorites")}}">Favorites</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Settings</a></li>
              <li><a class="dropdown-item" href="{{route("user.signout")}}">Sign out</a></li>
            </ul>
          </div>
        </div>
  
        <!-- This will be displayed when the screen size is larger -->
  
        <ul class="nav-link-list nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="{{route("user.home")}}" class="nav-link px-2">Home</a></li>
          <li><a href="job_post.php" class="nav-link px-2">Post</a></li>
          <li><a href="requests.php" class="nav-link px-2">Requests</a></li>
          <li><a style="cursor:pointer;" class="nav-link px-2 find-jobs">Find Jobs</a></li>
          <li><a href="#" class="nav-link px-2 switch" data-bs-toggle="modal" data-bs-target="#exampleModal">Switch to Applicant</a></li>
        </ul>
  
  
        <!-- <h6 class="mt-3 me-2 text-warning fs-6">Ali Zain</h6> -->
        <div class="dropdown text-end profile">
          <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
            aria-expanded="false">
            <img src="img/demo_image.png" style="object-fit: cover;" alt="Profiel Pic" width="45" height="45" class="rounded-circle">
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="profile_page.php">Profile</a></li>
            <li><a class="dropdown-item" href="posts.php" target="_blank">My Posts</a></li>
            <li><a class="dropdown-item" href="{{route("user.favorites")}}">Favorites</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="{{route("user.signout")}}">Sign out</a></li>
          </ul>
        </div>
  
      </div>
    </div>
  </nav>