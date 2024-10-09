<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/profile_page.css")}}">
    <title>Profile - {{ $user->name }}</title>
</head>
<body>
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
        </div>
        <!-- Description section ends here -->


        <hr style="width: 100%;">


        <!-- Skills section starts here -->
        <div class="skills-div w-100 px-5">
            <h5 class="fw-bold text-start ps-2">Skills</h5>
            @foreach($user_skills as $skill)
                <li>{{ $skill->skill_name }}</li>
            @endforeach
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

</body>
</html>