@extends('user.layouts.masterLayout')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="css/profile_page.css">
@endpush

@section('title')
    Jobs 4U - My Profile
@endsection

@section('main')
<form style="margin-top:60px;" enctype="multipart/form-data">
    <!-- Main container containing everthing -->
    <div class="container  d-flex align-items-center flex-column bg-light pt-5">
        <!-- Profile Picture -->
        <div class="profile-image-div rounded-circle">
            <img class="profile-image rounded-circle" src="img/demo_image.png" alt="">
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
            <p class="h5 fw-bolder mt-3 name text-center" id="name">Name</p><span><img id="name-edit" src="img/pencil.svg" role="button" title="Edit Name" alt=""></span>
        </div>
        <p style="font-size: 14px;" class="name-msg my-0"></p>
        <!-- Name section ends here -->


        <hr style="width: 100%;">


        <!-- Description Section starts here -->
        <div class="description w-100 px-5">
            <h5 class="text-start fw-bold ps-2 d-inline">Description</h5> <sup style="top:-1rem;"><img id="description-edit" src="img/pencil.svg" role="button" title="Edit Description" alt=""></sup>
            <p class="ps-2 mb-0 description-text" spellcheck="false" style="font-size: 14px; max-height:65px; overflow:hidden;">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Autem, voluptate? Veniam repudiandae animi rem ab unde aliquid pariatur ullam id, fugit eum enim, provident praesentium nulla qui voluptas corrupti tempora?
                Ea voluptatibus laborum quia incidunt praesentium quod exercitationem omnis veritatis repellendus neque quam, blanditiis ex assumenda, sed ab harum illo quo minima? Pariatur illum maiores esse! Nobis molestias commodi reprehenderit?
                Laudantium debitis iusto a nobis aut reiciendis totam alias? Explicabo, quis! Non dolor velit illo autem consequuntur enim sed distinctio, ut impedit nemo perspiciatis deleniti accusantium itaque aperiam laborum iste.
                Molestiae, vitae obcaecati? Consectetur laboriosam nobis velit placeat natus officia quam at sit enim, hic blanditiis. Eveniet quibusdam temporibus laudantium saepe, laboriosam autem reprehenderit pariatur omnis ea aliquid, consectetur maxime?
                Ab atque pariatur voluptates autem optio illo corporis quaerat unde dolore, iure facilis officiis iste quisquam eius obcaecati! Inventore beatae culpa doloribus rem officia sequi non perferendis dolorum deleniti exercitationem.
                Earum sint labore, corrupti aut magni explicabo eius amet! Suscipit aspernatur corporis, tempore velit quos quod, necessitatibus laboriosam asperiores laborum iste fugit dolores! Consequatur aliquam qui deleniti et in corporis.
                Quis mollitia soluta sit error pariatur, ipsa odio iure eaque rerum quaerat quae repellendus accusamus fugiat cupiditate et reiciendis eveniet, atque, sapiente saepe accusantium placeat veniam cumque aliquid delectus! Sit!
                Quam iste minus modi sapiente in tempora placeat officia error molestias alias, similique ex ipsum maiores aspernatur suscipit non voluptas quas! Reiciendis, possimus. Incidunt magni, tempore quidem nisi accusantium sunt.
                Earum esse asperiores iure tenetur soluta a libero reprehenderit facilis obcaecati fugit temporibus error vel illum labore ut voluptatem corporis, sint neque tempore ad laboriosam, fuga exercitationem itaque minima. Saepe!
                Voluptatibus iure mollitia veniam ipsa consequatur repellat necessitatibus accusantium voluptate quae. Tempore totam quo, doloremque ducimus excepturi facilis recusandae officiis in incidunt at. Nemo adipisci voluptates delectus expedita dignissimos ad?
                Nesciunt obcaecati dolores quam ex incidunt minima ab id eos enim omnis at rem quaerat asperiores quasi libero, reiciendis ut corporis itaque facilis atque! Tempora nihil voluptatum sint totam? Nam!
                Modi accusantium odit sequi illo impedit minus suscipit, maiores eveniet excepturi voluptas odio quisquam eius! Aspernatur corrupti error amet adipisci fugiat suscipit commodi consequatur, assumenda deserunt! Modi nulla earum temporibus!
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
                <option value="">Skills 1</option>
                <option value="">Skills 2</option>
                <option value="">Skills 3</option>
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
    });


    $("#skills").on("select2:select select2:unselect", function()
    {
        $("#skills-save-btn").removeClass("d-none");
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