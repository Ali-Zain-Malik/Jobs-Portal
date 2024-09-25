@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="css/home.css">
    {{-- <link rel="stylesheet" href="css/search_bar.css"> --}}
    <link rel="stylesheet" href="css/job_card.css">
@endpush


@section('title')
    Jobs 4U - Find Jobs
@endsection



@section('main')
<div class="d-flex justify-content-center mt-5">
@include('user.includes.search_bar')
</div>
{{-- <div class="text-center mt-5">Search Results</div> --}}
<div class="featured-jobs-div pt-0">
    <div class="container-lg mt-5">
        <h3 class="heading text-center"></h3>

        <div class="cards-div">
            <div class="row d-flex justify-content-md-between justify-content-center row-gap-3">
                {{-- Card --}}
                @include("user.includes.job_card")
                {{-- Car end --}}

            </div>
        </div>
    </div>
</div>

@endsection
