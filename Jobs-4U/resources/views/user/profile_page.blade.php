@extends('user.layouts.masterLayout')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/profile_page.css">
@endpush

@section('title')
    Jobs 4U - My Profile
@endsection

@section('main')
<form style="margin-top:60px;" enctype="multipart/form-data" id="form">
    @csrf
    <!-- Main container containing everthing -->
    <div class="container  d-flex align-items-center flex-column bg-light pt-5">
        <!-- Profile Picture -->
        <div class="profile-image-div rounded-circle">
            <img class="profile-image rounded-circle" src="{{asset($user->profile_pic ? "storage/".$user->profile_pic : "img/demo_image.png")}}" alt="">
            <!-- Overlay appearing on hover -->
            <div class="overlay">
                <img src="img/camera.svg" id="camera-icon" title="Upload Profile Pic" alt="">
                <input type="file" class="profile-image-input"  accept=".jpg, .jpeg, .png" name="profile-image-input">
            </div>
            <!-- overlay ends here -->
        </div>
        <!-- Profile picture ends here -->
        <p id="upload-status" class="pt-2 text-success fw-semibold mb-0" style="font-size:14px;"></p>
        <!-- Save button for profile picture update -->
        <div class="d-flex justify-content-center mb-2 d-none img-sv-div">
            <button style="font-size:14px;" type="button" id="img-save-btn" class="px-3 py-1 border-0 bg-warning fw-semibold rounded-pill d-block save-btn">Save New Image</button>
        </div>
        <!-- Save button ends here -->


        <!-- Name section -->
        <div class="name-div d-flex">
            <p class="h5 fw-bolder mt-3 name text-center" id="name">{{$user->name}}</p><span><img id="name-edit" src="img/pencil.svg" role="button" title="Edit Name" alt=""></span>
        </div>
        <p style="font-size: 14px;" class="name-msg my-0"></p>
        <!-- Name section ends here -->


        <hr style="width: 100%;">


        <!-- Description Section starts here -->
        <div class="description w-100 px-5">
            <h5 class="text-start fw-bold ps-2 d-inline">Description</h5> <sup style="top:-1rem;"><img id="description-edit" src="img/pencil.svg" role="button" title="Edit Description" alt=""></sup>
            <p class="ps-2 mb-0 description-text" spellcheck="false" style="font-size: 14px; max-height:65px; overflow:hidden;">
                {{$user->description ? $user->description : "No description added yet"}}
            </p>
            <span class="ps-2 pointer seeMore d-none">...See More</span>

            <button style="font-size: 14px;" type="button" id="desc-save-btn" class="px-3 py-1 my-2 bg-warning border-0 rounded-pill fw-semibold d-none save-btn float-end">Save New Description</button>
        </div>
        <!-- Description section ends here -->


        <hr style="width: 100%;">


        <!-- Skills section starts here -->
        <div class="skills-div w-100 px-5">
            <h5 class="fw-bold text-start ps-2">Skills</h5>

            <select name="skills" id="skills" multiple="multiple" class="col-lg-6 col-12">
                @php
                    $userSkillIds   =   $user_skills->pluck("skill_id")->toArray();
                @endphp
                @foreach ($skills as $sk)
                    <option @selected(in_array($sk->id, $userSkillIds)) value="{{$sk->id}}">{{$sk->skill_name}}</option>
                @endforeach
            </select>
            <div class="d-inline ms-3">
                <button style="font-size: 14px;" type="button" id="skills-save-btn" class="bg-warning fw-semibold border-0 px-3 py-1 rounded-pill d-none save-btn">Save Skills</button>
            </div>
        </div>
        <!-- Skills section ends here -->


        <hr style="width: 100%;">


        <!-- Experience heading and plus icon -->
        <div class="d-flex justify-content-between mb-2 w-100 px-5">
            <h5 class="fw-bold ps-2">Experience</h5>
            <img id="add-experience" src="img/plus.svg" role="button" title="Add Experience" alt="" data-bs-toggle="modal" data-bs-target="#experienceModal">
        </div>
        <!-- Experience heading ends -->

        <!-- Experience cards start here -->
        <div class="container experience row d-flex justify-content-around">
           

            <div class="card col-lg-5">
                <div class="d-flex justify-content-between align-items-center card-header pb-0">
                    <h5 class="fw-bold">Designation</h5>
                    <span class="pe-1 d-flex gap-3"><img id="delete-experience" src="img/trash.svg" role="button" alt=""></span>
                </div>
                <div class="card-body mt-2">
                    <h5 class="card-title">Company</h5>
                    <p class="card-text fs-6 d-flex align-items-center gap-2">
                        <span><img src="img/calender.svg" alt=""></span>
                        <span style="font-size: 14px;">20 August 2024</span> - 
                        <span style="font-size: 14px;">Present</span>
                    </p>

                    <p class="card-text">
                        <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">Employment Type</span>
                        <span class="bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">Location Type</span>
                    </p> 
                </div>
            </div>

        </div>
        <!-- Experience cards ends here -->


        <hr style="width: 100%;">

        <!-- Education heading starts here and plus icon -->
        <div class="d-flex justify-content-between mb-2 w-100 px-5">
            <h5 class="fw-bold ps-2">Education</h5>
            <img id="add-education" src="img/plus.svg" role="button" title="Add Education" alt=""  data-bs-toggle="modal" data-bs-target="#educationModal">
        </div>
        <!-- Education heading ends here -->

        <!-- Education cards start here -->
        <div class="container education row d-flex justify-content-around">
            
            
            <div class="card col-lg-5">
                <div class="d-flex justify-content-between align-items-center card-header pb-0">
                    <h5 class="fw-bold">Major</h5>
                    <span class="pe-1 d-flex gap-3"><img id="delete-education" src="img/trash.svg" role="button" alt=""></span>
                </div>
                <div class="card-body mt-2">
                    <h5 class="card-title my-0">Institute</h5>
                    <h6 class="mt-0">Program</h6>
                    <p class="card-text fs-6 d-flex align-items-center gap-2">
                        <span><img src="img/calender.svg" alt=""></span>
                        <span style="font-size: 14px;">20 August 2024</span> - 
                        <span style="font-size: 14px;">Present</span>
                    </p>

                    <p class="card-text">
                        <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">Grade</span>
                    </p> 
                </div>
            </div>


        </div>
        <!-- Education cards end here -->

    </div>
    <!-- Main container ends here -->


</form>
@endsection

@include("user.includes.addExperienceModal")
@include("user.includes.addEducationModal")
<script>
document.addEventListener("DOMContentLoaded", function()
{
    $("#skills").select2();
    $("#camera-icon").on("click", function()
    {
        $(".profile-image-input").click();
    });

    $(".profile-image-input").on("change", function()
    {
        const image =   event.target.files[0];
        if(image)
        {
            const reader        =   new FileReader();
            reader.onloadstart  =   function()
            {
                $("#upload-status").text("Uploading ...");
            }

            reader.onprogress = function(event) 
            {
                if (event.lengthComputable) 
                {
                    const percentLoaded = Math.round((event.loaded / event.total) * 100);
                    $('#upload-status').text(`Loading: ${percentLoaded}%`);
                }
            }

            reader.onload   = function(event) 
            {
                $('.profile-image').attr('src', event.target.result).show();
                $('#upload-status').text('Image loaded successfully!');
                $(".img-sv-div").removeClass("d-none");
            }

            reader.onerror  = function() 
            {
                $('#upload-status').text('An error occurred while uploading');
            }   

            reader.readAsDataURL(image);
        }
    });

    $("#img-save-btn").on("click", function()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const form              =   document.getElementById("form");
        const formData          =   new FormData(form);
        const new_profile_img   =   document.querySelector(".profile-image-input");
        
        // Ensuring that the file has been selected
        if(new_profile_img.files.length > 0)
        {
            formData.append("new_profile_img",new_profile_img.files[0]);
            
            $.ajax(
            {
                url         :   "{{route("user.changeProfilePic")}}",
                type        :   "post",
                data        :   formData,
                contentType :   false,
                processData :   false,
                success     :   function(response)
                {
                    if(response.success)
                    {
                        location.reload();
                        // $('#upload-status').text(response.message);
                    }
                    else
                    {
                        $("#upload-status").text(response.error).addClass("text-danger");
                    }
                }
            });
        }
        
    });

    $("#name-edit").on("click", function()
    {
        if($("#name").is("[contenteditable='true']"))
        {
            if($("#name").text().trim() === "")
            {
                $(".name-msg").text("Name cannot be empty !!").addClass("text-danger");
                return;
            }
            else if($("#name").text().trim().length < 3)
            {
                $(".name-msg").text("Name must be more than 2 characters").addClass("text-danger");
                return;
            }
            $(".name-msg").text("").removeClass("text-danger");
            $("#name").attr("contenteditable", "false").removeClass("editable");
            $("#name-edit").attr("src", "img/pencil.svg");
            

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax(
            {
                url         :   "{{route("user.changeName")}}",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    "name"  :   $("#name").text().trim()
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        location.reload();
                    }
                }
            });
        }
        else
        {
            $("#name").attr("contenteditable", "true").addClass("editable");
            $("#name-edit").attr("src", "img/check.svg").attr("title", "Save New Name");
        }
    });

    if($(".description-text").text().length > 400)
    {
        $(".seeMore").removeClass("d-none");
    }

    $(".seeMore").on("click", function()
    {
        if($(".description-text").css("maxHeight") === "65px")
        {
            $(".description-text").css({
                "maxHeight" : "none",
                "overflow"  : "visible"
            });
            $(".seeMore").text("See Less");
        }
        else
        {
            $(".description-text").css({
                "maxHeight" : "65px",
                "overflow"  : "hidden"
            });
            $(".seeMore").text("...See More");
        }
    });

    $("#description-edit").on("click", function()
    {
        $(".description-text").attr("contenteditable", "true").addClass("editable");
        $("#desc-save-btn").removeClass("d-none");
        $(".seeMore").text("");
        $(".description-text").css({
            "maxHeight" : "none",
            "overflow"  : "visible"
        });   

        if($(".description-text").text().trim() == "No description added yet")
        {
            $(".description-text").text("");
        } 
    });


    $("#desc-save-btn").on("click", function()
    {
        $.ajax(
        {
            url         :   "{{route("user.updateDescription")}}",
            type        :   "post",
            dataType    :   "json",
            data        :
            {
                "description"   :   $(".description-text").text().trim()
            },
            headers     :
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success     :   function(response)
            {
                if(response.success)
                {
                    location.reload();
                }
            }
        });
    });

    $("#skills").on("select2:select select2:unselect", function()
    {
        $("#skills-save-btn").removeClass("d-none");
    });


    $("#skills-save-btn").on("click", function()
    {
        $.ajax(
        {
            url         :   "{{route("user.updateSkills")}}",
            type        :   "post",
            dataType    :   "json",
            data        :
            {
                "skills"   :   $("#skills").val()
            },
            headers     :
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success     :   function(response)
            {
                if(response.success)
                {
                    location.reload();
                }
            }
        });
    });

    $("#add-experience, #add-education").on("click", function(event)
    {
        $("#start-month, #end-month").empty();
        for (let i = 0; i < 12; i++) 
        {
            const date = new Date(0, i);
            $("#start-month, #end-month").append(`<option value='${i+1}'>${date.toLocaleString("default", {month: "long"})}</option>`)
        }

        $("#start-year, #end-year").empty();
        const current_year  =   new Date().getFullYear();
        for(let i = current_year; i >= 1924; i--)
        {
            $("#start-year, #end-year").append(`<option value='${i}'>${i}</option>`)
        } 

        if(event.target.id === "add-experience")
        {
            toggleEndDate($('#currently-working'));
        }
        else if(event.target.id === "add-education")
        {
            toggleEndDate($('#currently-studying'));
        }
    });

    $("#currently-working").click(function()
    {
        toggleEndDate($('#currently-working'));
    });
    $("#currently-studying").click(function()
    {
        toggleEndDate($('#currently-studying'));
    });


    $("#exp-save-btn").on("click", function(event)
    {
        event.preventDefault();
        $.ajax(
            {
                url         :   "{{route("user.addExperience")}}",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    _token          :   '{{ csrf_token() }}',
                    designation     :   $("#designation").val().trim(),
                    company         :   $("#company").val().trim(),
                    employment_type :   $("#employment-type").val(),
                    location_type   :   $("#location-type").val(),
                    start_month     :   $("#start-month").val(),
                    start_year      :   $("#start-year").val(),
                    end_month       :   $("#end-month").prop("disabled")    ? null : $("#end-month").val(),
                    end_year        :   $("#end-year").prop("disabled")     ? null : $("#end-year").val(),
                    currently_working   :   $("#currently-working").prop("checked") ? 1 : 0
                },
                success     :   function(response) 
                {
                    if(response.success)
                    {
                        location.reload();
                    }
                    else
                    {
                        let errors = response.error;
                        $('.is-invalid').removeClass('is-invalid');
                        $(".text-danger").remove();
                        $.each(errors, function(field, messages) 
                        {
                            let input = $(`[name="${field}"]`);

                            // Add invalid class to the input field
                            input.addClass('is-invalid');

                            // Add error message after the input field
                            input.after(`<div class="text-danger fw-light">${messages[0]}</div>`);
                        });
                    }
                }
            });
    });

    $("#delete-experience, #delete-education").on("click", function(event)
    {
        if(event.target.id === "delete-experience")
        {
            confirmMsg("Experience")
        }
        else if(event.target.id === "delete-education")
        {
            confirmMsg("Education")
        }
    });

    function toggleEndDate(btn)
    {
        if(btn.prop("checked"))
        {
            $(".end-date-div").removeClass("d-flex").addClass("d-none");
            $("#end-month, #end-year").prop("disabled", true);
        }
        else
        {
            $(".end-date-div").removeClass("d-none").addClass("d-flex");
            $("#end-month, #end-year").prop("disabled", false);
        }
    }

    function confirmMsg(message)
    {
        alertify.confirm(`Delete ${message}`, `Are you sure to delete ${message}`, 
        function(){ alertify.success('Ok') },
        function(){ alertify.error('Cancelled')});
    }

});

</script>