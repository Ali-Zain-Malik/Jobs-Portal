@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/job_card.css"> 
@endpush
@section('title')
    My Posts
@endsection


@section('main')
<div class="featured-jobs-div">
    <div class="container-lg mt-5">
        <h3 class="heading text-center">My Posts</h3>

        <div class="cards-div" style="margin-bottom: 60px;">
            <div class="row d-flex justify-content-md-between justify-content-center row-gap-3">
                {{-- Card --}}
                @include("user.includes.job_card")
                {{-- Car end --}}

            </div>
        </div>
    </div>
</div>
@endsection