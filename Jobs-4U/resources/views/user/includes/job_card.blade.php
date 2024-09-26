@php
use App\Models\user\Favorite_job;
@endphp
@if (isset($empty))
    <strong>No Results Found</strong>
@else

@foreach ($jobs as $job)
@php
    $is_favorite    =   Favorite_job::where("user_id", auth()->id())->where("job_id", $job->jobID)->first();
    if($is_favorite)
    {
        $favorite   =   "heart-solid.svg";
    }
    else 
    {
        $favorite   =   "heart-regular.svg";
    }
@endphp
<div class="col-lg-6 col-md-12 col-11">
    <div class="job-card mx-2 shadow-lg">
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex gap-1">
                <div class="image-div" style="width: 50px; height: 50px;">
                    <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                </div>
                <div class="d-flex flex-column">
                    <h4 style="font-size: 12px;" class="m-0">{{$job->emp_company}}</h4>
                    <h3 style="font-size: 16px;" class="m-0 fw-bold">{{$job->job_title}}</h3>
                    <div class="d-flex align-items-center">
                        <img src="img/location.svg" style="width: 14px;" alt="">
                        <p style="font-size: 12px;">{{$job->city_name}}</p>

                        <div class="ms-3 gap-1 d-flex align-items-center">
                            <img src="img/clock-regular.svg" style="width: 12px;" alt="">
                            <span style="font-size: 10px;">{{$job->start_date}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 25px; height: 25px;">
                <img class="w-100 heart-btn" role="button" job-id = "{{$job->jobID}}" src="img/{{$favorite}}" alt="favorite">
            </div>
        </div>

        <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center row-gap-2  mt-3">
            <div class="job-types d-flex gap-2">
                <span class="px-2 py-1 rounded-pill text-white fw-semibold text-capitalize" style="font-size: 12px; background-color: orange;">{{$job->employment_type}}</span>
                <span class="px-2 py-1 rounded-pill text-white fw-semibold text-capitalize" style="font-size: 12px; background-color: orange;">{{$job->location_type}}</span>
            </div>
            @if (!Route::is("user.home")) {{-- Only show these buttons if it is not the home page --}}
                <div class="view-apply d-flex gap-2">
                    <button type="button" class="view-btn px-3 py-1 rounded-pill text-white border-0" job-id="{{$job->jobID}}" data-bs-toggle="modal" data-bs-target="#viewModal">View</button>
                    <button type="button" class="apply-btn px-3 py-1 rounded-pill text-white border-0" job-id="{{$job->jobID}}">Apply</button>
                </div>
            @endif

        </div>

        <hr class="mt-2">

        <div class="d-flex justify-content-between align-items-center">
            <span class="d-flex salary-span"><span class="currency me-1 text-uppercase">{{$job->currency}}</span><span class="fw-bold amount">{{$job->salary}}</span><p>/</p><span class="period">{{$job->per_period}}</span></span>
            <span class="d-flex" style="font-size: 10px;"><span class="remaining-days me-1">{{ \Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m-d'))->diffInDays($job->expiry_date) }}</span><span> day(s) left to apply</span></span>
        </div>
    </div>
</div>
@endforeach



<script>
    //Toggle favorites
    const heart_btns    =   document.querySelectorAll(".heart-btn");

    heart_btns.forEach(function(btn)
    {
        btn.addEventListener("click", function()
        {
            const job_id    =   this.getAttribute("job-id");
            const img_src   =   this.getAttribute("src");

            // if(img_src === "img/heart-solid.svg")
            const newSrc    =   (img_src == "img/heart-solid.svg") ? "img/heart-regular.svg" : "img/heart-solid.svg";
            $.ajax(
            {
                url         :   "{{route("toggleFavorite")}}",
                type        :   "post",
                dataType    :   "json",
                data        :
                {
                    job_id  :   job_id,
                    _token  : '{{ csrf_token() }}'
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        $("#toast-inner").text(response.message);
                        $("#myToast").fadeIn();
                        $("#myToast").addClass("d-block");
                        setTimeout(() => 
                        {
                            $("#myToast").fadeOut();
                            $("#myToast").removeClass("d-block");
                        }, 1500);

                        btn.setAttribute("src", newSrc);
                    }
                }
            });
        })    
    });
    // Toggle favorites ends here


    // View Job details starts
    const jobs_view_btns  = document.querySelectorAll(".view-btn");
    jobs_view_btns.forEach(function(btn)
    {
        btn.addEventListener("click", function()
        {
            const job_id    =   this.getAttribute("job-id");
            $.ajax(
            {
                url         :   "{{route("viewJob")}}",
                type        :   "post",
                dataType    :   "json",
                timeout     :   10000,
                data        :
                {
                    job_id  :   job_id,
                    _token  : '{{ csrf_token() }}'
                },
                beforeSend  :   function()
                {
                    $(".loader").removeClass("d-none");
                    $(".loader").addClass("d-flex");
                },
                complete    :   function()
                {
                    $(".loader").removeClass("d-flex");
                    $(".loader").addClass("d-none");
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        $(".job-summary").text(response.job_details.job_description);
                        $(".required-skills").empty(); // Clearing the previous skill names before entering loop, because append gets duplicated if the code is run again. 
                        for(let i=0; i< response.job_skills.length; i++)
                        {
                            $(".required-skills").append(`<li>${response.job_skills[i].skill_name}</li>`);
                        }
                    }
                },
                error       :   function()
                {
                    $("#toast-inner").text("Some thing went wrong");
                    $("#myToast").fadeIn();
                    $("#myToast").addClass("d-block");
                    setTimeout(() => 
                    {
                        $("#myToast").fadeOut();
                        $("#myToast").removeClass("d-block");
                    }, 1500);
                }
            });
        })
    });
</script>
@endif
