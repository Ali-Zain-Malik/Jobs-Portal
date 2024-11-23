@extends('admin.layouts.masterLayout')
@section("title")
    Users Management
@endsection
@section('main')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <div class="image-div" style="width: 120px; height:120px;">
              <img style="width: 100%; height:100%; object-fit:cover;" src="" class="rounded-circle" alt="">
              </div>
              <h2>User Name</h2>
              <div class="social-links mt-2">
                
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" style="font-size: 14px;">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#experience">Experience</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education">Education</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">About</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8">User Name</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Location</div>
                    <div class="col-lg-9 col-md-8">Country Name</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">User Email</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="edit-form" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="img-div" style="width: 120px; height: 120px; border-radius: 50%;">
                        <img id="image" style="width: 100%; height: 100%; object-fit: cover;" src="" class="rounded-circle" alt="">
                        </div>
                        <div class="pt-2">
                          <a href="#" class="btn btn-primary btn-sm" id="upload-btn" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                          <input type="file" id="file-input" name="profile_pic" accept=".png, .jpg, jpeg, tiff" style="display: none;">
                          <a href="#" class="btn btn-danger btn-sm" id="delete-image" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value="Name">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px">User About</textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="User Email">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="date-of-birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date-of-birth" type="date" class="form-control" id="date-of-birth" value="Date of birth">
                      </div>
                    </div>

                    <div class="row mb-3 d-flex align-items-center">
                      <label for="location" class="col-md-4 col-lg-3 col-form-label">Location</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="select-country" id="select-country">
                          <option value="Country ID">Country Name</option>
                          All other countries
                        </select>

                        <div class="my-2"></div>

                        <select name="select-city" id="select-city">
                          <option value="City ID">City Name</option>
                          All other cities
                        </select>
                        
                      </div>
                    </div>

                    <div class="row mb-3 d-flex align-items-center">
                      <label for="Role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                      <div class="col-md-8 col-lg-9">

                          <input name="role" class="form-check-input" type="radio" id="role-employer" value="1">
                          <label for="role-employer" class="text-dark pointer pe-3">Employer</label>
                          
                          <input name="role" class="form-check-input" type="radio" id="role-applicant" value="0">
                          <label for="role-applicant" class="text-dark pointer pe-3">Applicant</label>

                          <input name="role" class="form-check-input" type="radio" id="role-admin" value="2">
                          <label for="role-admin" class="text-dark pointer">Admin</label>
                      </div>
                    </div>
                  
                    <div class="row mb-3> align-items-center">
                      <label for="top-employer" class="col-md-4 col-lg-3 col-form-label">Top Employer</label>
                      <div class="col-md-8 col-lg-9">

                          <input name="top-emp" class="form-check-input" type="radio" value="1">
                          <label for="top-employer-yes" class="text-dark pointer pe-3">Yes</label>
                          
                          <input name="top-emp" class="form-check-input" type="radio" value="0">
                          <label for="top-employer-no" class="text-dark pointer pe-3">No</label>

                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" id="save-changes-btn">Save Changes</button>
                    </div>
                  </form>

                </div>


                <div class="tab-pane fade experience" id="experience">
                  <div class="add-experience-icon">
                    <i class="bi bi-plus fs-1 pointer plus-icon" title="Add Experience" data-bs-toggle="modal" data-bs-target="#staticBackdrop"></i>
                  </div>
                  <div class="experience container px-0 mt-2">
                    User Experience
                  </div>
                </div>


                <div class="tab-pane fade education" id="education">
                  <div class="add-education-icon">
                    <i class="bi bi-plus fs-1 pointer education-plus-icon" title="Add Education" data-bs-toggle="modal" data-bs-target="#addEducation"></i>
                  </div>
                  <div class="education container px-0 mt-2">
                    User Education
                  </div>
                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">

                  <form id="change-password-form">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword" required>
                        <div class="invalid-feedback">Please enter current password</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                        <div class="invalid-feedback">Please provide a new password</div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                        <div class="invalid-feedback">Please confirm your new password</div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="button" class="btn btn-primary" id="save-pass-chng-btn">Change Password</button>
                    </div>
                  </form>

                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection