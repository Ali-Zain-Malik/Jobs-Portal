@extends('user.layouts.masterLayout')

@push('styles')
    <link rel="stylesheet" href="{{ asset("css/home.css") }}">
    <link rel="stylesheet" href="{{ asset("css/job_card.css") }}">
@endpush

@section('title')
    {{ $category->category_name }}
@endsection

@section("main")
    <div class="container" style="margin-top: 60px;">
        <div class="container d-flex justify-content-center gap-3 mb-2" style="margin-top: 100px;">
            <h5 class="fw-bold">{{ $category->category_name }}</h5> <span> Jobs({{ $jobs->count() }})</span>
        </div>
        <div class="cards-div">
            <div class="row d-flex justify-content-md-between justify-content-center row-gap-3">
                {{-- Card --}}
                @include("user.includes.job_card")
                {{-- Car end --}}
            </div>
        </div>
    </div>
@endsection