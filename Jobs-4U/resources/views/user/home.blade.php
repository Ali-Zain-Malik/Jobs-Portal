@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="css/home.css">
    {{-- <link rel="stylesheet" href="css/search_bar.css"> --}}
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
                <a id="all-categories" href="#">
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
                {{-- Card --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
                        <div class="d-flex gap-1">
                            <div class="image-div" style="width: 50px; height: 50px;">
                                <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <h3 style="font-size: 14px;" class="m-0 fw-bold">Job Title</h3>
                                <p style="font-size: 12px;">120 Jobs Posted</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/location.svg" style="width: 14px;" alt="">
                                    <p style="font-size: 12px;">City Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Car end --}}
                {{-- Card --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
                        <div class="d-flex gap-1">
                            <div class="image-div" style="width: 50px; height: 50px;">
                                <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <h3 style="font-size: 14px;" class="m-0 fw-bold">Job Title</h3>
                                <p style="font-size: 12px;">120 Jobs Posted</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/location.svg" style="width: 14px;" alt="">
                                    <p style="font-size: 12px;">City Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Car end --}}
                {{-- Card --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
                        <div class="d-flex gap-1">
                            <div class="image-div" style="width: 50px; height: 50px;">
                                <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <h3 style="font-size: 14px;" class="m-0 fw-bold">Job Title</h3>
                                <p style="font-size: 12px;">120 Jobs Posted</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/location.svg" style="width: 14px;" alt="">
                                    <p style="font-size: 12px;">City Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Car end --}}
                {{-- Card --}}
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
                        <div class="d-flex gap-1">
                            <div class="image-div" style="width: 50px; height: 50px;">
                                <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                            </div>
                            <div class="d-flex flex-column">
                                <h3 style="font-size: 14px;" class="m-0 fw-bold">Job Title</h3>
                                <p style="font-size: 12px;">120 Jobs Posted</p>
                                <div class="d-flex align-items-center">
                                    <img src="img/location.svg" style="width: 14px;" alt="">
                                    <p style="font-size: 12px;">City Name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Car end --}}
            </div>
        </div>
    </div>
</div>

@endsection
