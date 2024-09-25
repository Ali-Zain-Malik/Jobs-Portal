@extends('user.layouts.masterLayout')
@push('styles')
<link rel="stylesheet" href="css/home.css">
@endpush
@section('title')
    All Categories
@endsection

@section('main')
<div class="pt-3 mt-3 text-center" style="position: relative; top: 60px;">
    <h3 class="mb-5 fw-bold" style="font-size: 22px;">All Categories</h3>
    <div class="container d-flex justify-content-between  gap-2 row-gap-3 flex-wrap py-4" style="background-color:  rgb(235, 235, 229);">
        @include('user.includes.categories_card')
    </div>
</div>
@endsection