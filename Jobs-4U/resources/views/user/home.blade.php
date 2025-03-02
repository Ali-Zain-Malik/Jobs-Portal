@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search_bar.css">
    <link rel="stylesheet" href="css/job_card.css">
@endpush

@section('title')
    Jobs 4U - Home
@endsection


@section("main")
<div class="hero-wrapper">
    <div class="over">
        <div class="tag-div">
            <p><strong>Every Success is a Dream First</strong></p>
        </div>
        
        @include("user.includes.search_bar")

    </div>
    <img class="hero-image" src="img/hero.jpg" alt="Hero Image">
</div>

<div class="categories-div">
    <div class="container-lg mt-5">

         <h3 class="heading text-center">Browse Categories</h3>

        {{-- Link for all categories --}}
        <div class="d-flex justify-content-end mb-2">
            <div class="all-categories-navlink">
                <a id="all-categories" href="{{route("all-categories")}}">
                    All Categories
                    <img src="img/right_arrow.svg" alt="">
                </a>
            </div>
        </div>
        {{-- Link for all categories ends here --}}

        {{-- Div which will conatin cards --}}
        <div class="cards-div">
            <div class="row1 d-flex justify-content-between  gap-2 row-gap-3 flex-wrap text-capitalize">
                {{-- The cards --}}
                @include('user.includes.categories_card')
            </div>
        </div>
        {{-- Div which will conatin cards  ends here--}}
    </div>
</div>


{{-- Featured jobs start here --}}
<div class="featured-jobs-div">
    <div class="container-lg mt-5">
        <h3 class="heading text-center">Featured Jobs</h3>

        <div class="cards-div">
            <div class="row d-flex justify-content-md-between justify-content-center row-gap-3">
                {{-- Card --}}
                @include("user.includes.job_card")
                {{-- Car end --}}

            </div>
        </div>
    </div>
</div>
{{-- Featured jobs ends here --}}

<div class="top-employers">
    <div class="container-lg mt-5">
        <div class="d-flex justify-content-center align-items-center mb-4 flex-column">
            <h3 class="heading text-center">Top Employers</h3>
            <p class="text-center text-capitalize">watch out for your dream companies</p>
        </div>

        <div class="cards-div">
            <div class="row d-flex justify-content-between row-gap-3 px-2">
                
                @foreach ($top_employers as $top)
                {{-- Card --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
                        <div class="d-flex gap-1">
                            <div class="image-div" style="width: 50px; height: 50px;">
                                <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <h3 style="font-size: 14px;" class="m-0 fw-bold">{{$top->emp_company ?? $top->name}}</h3>
                                <p style="font-size: 12px;">{{$top->jobs_count}} Job(s) Posted</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/location.svg" style="width: 14px;" alt="">
                                    <p style="font-size: 12px;">{{$top->city_name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Car end --}}
                @endforeach
 
            </div>
        </div>
    </div>
</div>

{{-- Feedbacks --}}
<div class="feedbacks container-lg" style="margin-top: 150px;">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h3 class="heading text-center">Feedbacks</h3>
        <p class="text-center text-capitalize">What Our Clients Say</p>
    </div>

    <div class="cards-div overflow-hidden">
        <div class="owl-carousel">
            @include("user.includes.feedbacks")
        </div>
    </div>
    
</div>
{{-- Feedbacks --}}

{{-- Leave a feedback/Comment div --}}
<div class="container-lg mt-5">
    <div class="d-flex justify-content-center align-items-center flex-column">
        <h3 class="heading text-center">Leave a Feedback</h3>
    </div>
    <div class="cards-div">
        <textarea name="feedback" class="p-3" id="feedback-textarea" placeholder="It is a great platform" cols="10" rows="5">{{ auth()->user()->getFeedback() ?? NULL }}</textarea>
        <button class="btn send-feedback shadow-lg bg-warning fw-bold text-white">Send</button>
        <span class="text-end" style="font-size: 12px;">270 Characters Max</span>
    </div>
</div>
{{-- Leave a feedback/Comment div --}}
@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
@endpush
{{-- @if(Session::has("success"))
    <script>
        let success =   "{{Session::get("success")}}"
        alertify.success(success) 
    </script>
@elseif(Session::has("error"))
    <script>
        let error   =   "{{Session::get("error")}}"
        alertify.error(error); 
    </script>
@endif --}}

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        @if(Session::has("success"))
            let success =   "{{Session::get("success")}}"
            alertify.success(success) 
        @elseif(Session::has("error"))
            let error   =   "{{Session::get("error")}}"
            alertify.error(error); 
        @endif

        $(".owl-carousel").owlCarousel({
            loop: true, // Infinite loop
            margin: 10, // Space between slides
            nav: false, // Hide navigation arrows
            dots: false, // Show dots for navigation
            autoplay: true, // Enable autoplay
            autoplayTimeout: 2000, // 3 seconds per slide
            autoplayHoverPause: true, // Pause on hover
            responsive: {
                0: { items: 1 },
                576: { items: 2 },
                768: { items: 3 },
                992: { items: 4 }
            }
        });

        // Add | Update feedback.
        $(".send-feedback").on("click", function() {
            const textarea = $(this).siblings("#feedback-textarea");
            const feedback = textarea.val().trim();
            
            if(feedback === undefined || feedback === null || feedback == "")
            {
                return;
            }
            else if(feedback.length < 10)
            {
                alertify.error("Feedback must not be less than 10 characters");
                return;
            }
            else if(feedback.length > 270)
            {
                alertify.error("Feedback must not be greater than 270 characters");
                return;
            }

            $.ajax(
            {
                url         :   "{{route('leave_a_feedback')}}",
                type        :   "post",
                dateType    :   "json",
                timeout: 10000,
                data        :   
                {
                    _token  :   "{{csrf_token()}}",
                    feedback:   feedback,
                },
                beforeSend  :   function()
                {
                    $(".loader").removeClass("d-none").addClass("d-flex");
                },
                complete    :   function()
                {
                    $(".loader").removeClass("d-flex").addClass("d-none");
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        alertify.success(response.message);
                        textarea.text(feedback);
                    }
                },
                error       :   function(xhr, status, error)
                {
                    const response = xhr.responseJSON;
                    alertify.error(response.message);
                }
            });
        });
    });
</script>