@extends('admin.layouts.masterLayout')
@section("title")
    {{$user->name}} - Profile 
@endsection

@push("styles")
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main')
  <main id="main" class="main">
  @if(Session("success"))
    <div class="alert alert-success">
      {{Session("success")}}
    </div>
  @elseif(Session("error"))
    <div class="alert alert-danger">
      {{Session("error")}}
    </div>
  @endif
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
              <img style="width: 100%; height:100%; object-fit:cover;" src="{{ asset(!empty($user->profile_pic) ? "storage/".$user->profile_pic : "img/demo_image.png") }}" class="rounded-circle" alt="">
              </div>
              <h2>{{ $user->name }}</h2>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
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
              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">{{$user->description ?? "N/A"}}</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$user->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Location</div>
                    <div class="col-lg-9 col-md-8">{{$user->city_name ?? "N/A"}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$user->email}}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <form id="edit-form" class="mb-0" method="POST" action="{{ route("profile.edit", $user->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="img-div" style="width: 120px; height: 120px; border-radius: 50%;">
                        <img id="image" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset(!empty($user->profile_pic) ? "storage/".$user->profile_pic : "img/demo_image.png") }}" class="rounded-circle" alt="">
                        </div>
                        <div class="pt-2">
                          <button type="button" class="btn btn-primary btn-sm" id="upload-btn" title="Upload new profile image"><i class="bi bi-upload"></i></button>
                          <input type="file" id="file-input" name="profile_pic" accept=".png, .jpg, jpeg, tiff" style="display: none;">
                          @if($user->profile_pic)
                            <button type="button" class="btn btn-danger btn-sm" id="delete-image" user-id="{{ $user->id }}" title="Remove my profile image"><i class="bi bi-trash"></i></button>
                          @endif
                        </div>
                        @error("profile_pic")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                        @error("name")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px" placeholder="Add a description">{{ $user->description ?? NULL }}</textarea>
                        @error("about")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="{{ $user->email }}">
                        @error("email")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="date_of_birth" class="col-md-4 col-lg-3 col-form-label">Date of Birth</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="date_of_birth" type="date" class="form-control" id="date-of-birth" value="{{ $user->date_of_birth }}">
                        @error("date_of_birth")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3 d-flex align-items-center">
                      <label for="location" class="col-md-4 col-lg-3 col-form-label">Location</label>
                      <div class="col-md-8 col-lg-9">
                        <select name="city" id="city">
                          <option value="">Select City</option>
                          @foreach($cities as $city)
                            <option @selected($user->city_id == $city->id) value="{{ $city->id }}">{{$city->city_name}}</option>
                          @endforeach
                        </select>
                        @error("city")
                          <span class="text-danger fs-6">{{$message}}</span>
                        @enderror
                      </div>
                    </div>

                    <div class="row mb-3 d-flex align-items-center">
                      <label for="Role" class="col-md-4 col-lg-3 col-form-label">Role</label>
                      <div class="col-md-8 col-lg-9">
                          <input name="role" class="form-check-input" @checked($user->role == "employer") type="radio" id="role-employer" value="employer" role="button">
                          <label for="role-employer" class="text-dark pointer me-3" role="button">Employer</label>
                          
                          <input name="role" class="form-check-input" @checked($user->role == "applicant") type="radio" id="role-applicant" value="applicant" role="button">
                          <label for="role-applicant" class="text-dark pointer me-3" role="button">Applicant</label>

                      </div>
                    </div>
                  
                    <div class="row mb-3> align-items-center">
                      <label for="top-employer" class="col-md-4 col-lg-3 col-form-label">Top Employer</label>
                      <div class="col-md-8 col-lg-9">

                          <input name="top-emp" @checked($user->is_top_employer == 1) class="form-check-input" id="top-yes" type="radio" value="1" role="button">
                          <label for="top-yes" class="text-dark pointer me-3" role="button">Yes</label>
                          
                          <input name="top-emp" @checked($user->is_top_employer == 0) class="form-check-input" id='top-no' type="radio" value="0" role="button">
                          <label for="top-no" class="text-dark pointer me-3" role="button">No</label>

                      </div>
                    </div>

                    <div class="text-center mt-3">
                      <button type="submit" class="btn btn-primary w-100" id="save-changes-btn">Save Changes</button>
                    </div>
                  </form>

                </div>


                <div class="tab-pane fade experience" id="experience">
                  <div class="experience container px-0 mt-2">
                    @include('admin.includes.user_experience', ["experiences" => $experiences])
                  </div>
                </div>


                <div class="tab-pane fade education" id="education">
                  <div class="education container px-0 mt-2">
                    @include('admin.includes.user_education', ["education" => $education])
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main>
@endsection

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
<script>
  document.addEventListener("DOMContentLoaded", function()
  {
      $('#city').select2({
        width: "100%"
      });

      $("#upload-btn").on("click", function()
      {
        $("#file-input").click();
      });

      $("#file-input").on("change", function()
      {
        const file = this.files[0];
        if(file)
        {
          const reader = new FileReader();
          reader.onload = function(event)
          {
            $("#image").attr("src", event.target.result).show();
          }

          reader.readAsDataURL(file);
        }
      });

      $("#delete-image").on("click", function()
      {
        const user_id = $(this).attr("user-id");
        $.ajax(
        {
          url : "{{ route("profile_photo.remove", '__id__') }}".replace("__id__", user_id),
          type : "POST",
          data : {
            _token : "{{ csrf_token() }}",           
          },
          success : function(response)
          {
            window.location.reload();
          },
        });
      });
  })
</script>  