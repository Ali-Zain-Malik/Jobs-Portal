@extends('user.layouts.masterLayout')
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset("css/profile_page.css")}}">
@endpush

@section('title')
    {{$user->name}} - Profile
@endsection

@section('main')

    <!-- Main container containing everthing -->
    <div class="container  d-flex align-items-center flex-column bg-light pt-5 mt-5">
        <!-- Profile Picture -->
        <div class="profile-image-div rounded-circle">
            <img class="profile-image rounded-circle" src="{{asset($user->profile_pic ? "storage/".$user->profile_pic : "img/demo_image.png")}}" alt="">
        </div>
        <!-- Profile picture ends here -->

        <!-- Name section -->
        <div class="name-div d-flex">
            <p class="h5 fw-bolder mt-3 name text-center" id="name">{{$user->name}}</p>
        </div>
        <!-- Name section ends here -->

        <hr style="width: 100%;">

        <!-- Description Section starts here -->
        <div class="description w-100 px-5">
            <h5 class="text-start fw-bold ps-2 d-inline">Description</h5> 
            <p class="ps-2 mb-0 description-text" spellcheck="false" style="font-size: 14px; max-height:65px; overflow:hidden;">
                {{$user->description}}
            </p>
            <span class="ps-2 pointer seeMore d-none">...See More</span>
        </div>
        <!-- Description section ends here -->


        <hr style="width: 100%;">


        <!-- Skills section starts here -->
        <div class="skills-div w-100 px-5">
            <h5 class="fw-bold text-start ps-2">Skills</h5>
            <select name="skills" id="skills" multiple="multiple" class="col-lg-6 col-12">
               @foreach ($user_skills as $skill)
                   <option value="" selected>{{$skill->skill_name}}</option>
               @endforeach
            </select>
        </div>
        <!-- Skills section ends here -->


        <hr style="width: 100%;">


        <!-- Experience heading and plus icon -->
        <div class="d-flex justify-content-between mb-2 w-100 px-5">
            <h5 class="fw-bold ps-2">Experience</h5>
        </div>
        <!-- Experience heading ends -->

        <!-- Experience cards start here -->
        <div class="container experience row d-flex justify-content-around">
           
            @foreach ($user_experience as $experience)
                <div class="card col-lg-5">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold">{{$experience->designation}}</h5>
                    </div>
                    <div class="card-body mt-2">
                        <h5 class="card-title">{{$experience->company}}</h5>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><img src="{{asset("img/calender.svg")}}" alt=""></span>
                            <span style="font-size: 14px;">{{\Carbon\Carbon::parse($experience->start_date)->format('F Y')}}</span> - 
                            <span style="font-size: 14px;">
                                @if($experience->end_date)
                                    {{ \Carbon\Carbon::parse($education->end_date)->format('F Y') }}
                                @else
                                    Present
                                @endif
                            </span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{$experience->employment_type}}</span>
                            <span class="bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{$experience->location_type}}</span>
                        </p> 
                    </div>
                </div>
            @endforeach

        </div>
        <!-- Experience cards ends here -->


        <hr style="width: 100%;">

        <!-- Education heading starts here and plus icon -->
        <div class="d-flex justify-content-between mb-2 w-100 px-5">
            <h5 class="fw-bold ps-2">Education</h5>
        </div>
        <!-- Education heading ends here -->

        <!-- Education cards start here -->
        <div class="container education row d-flex justify-content-around">
            
            @foreach ($user_education as $education)
                <div class="card col-lg-5">
                    <div class="d-flex justify-content-between align-items-center card-header pb-0">
                        <h5 class="fw-bold">{{$education->major}}</h5>
                    </div>
                    <div class="card-body mt-2">
                        <h5 class="card-title my-0">{{$education->institute}}</h5>
                        <h6 class="mt-0">{{$education->program}}</h6>
                        <p class="card-text fs-6 d-flex align-items-center gap-2">
                            <span><img src="{{asset("img/calender.svg")}}" alt=""></span>
                            <span style="font-size: 14px;">{{\Carbon\Carbon::parse($education->start_date)->format('F Y')}}</span> - 
                            <span style="font-size: 14px;">
                                @if($education->end_date)
                                    {{ \Carbon\Carbon::parse($education->end_date)->format('F Y') }}
                                @else
                                    Present
                                @endif
                            </span>
                        </p>

                        <p class="card-text">
                            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{$education->grade}}</span>
                        </p> 
                    </div>
                </div>
            @endforeach

        </div>
        <!-- Education cards end here -->

    </div>
    <!-- Main container ends here -->

@endsection


<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        $("#skills").select2({
            disabled    :   true
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
    });
</script>