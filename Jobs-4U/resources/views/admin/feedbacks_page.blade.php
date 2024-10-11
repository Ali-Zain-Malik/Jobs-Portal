@extends('admin.layouts.masterLayout')
@section("title") Feedbacks @endsection

@section("main")
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>Feedbacks</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route("admin.dashboard") }}">Home</a></li>
                    <li class="breadcrumb-item active">Feedbacks</li>
                </ol>
            </nav>
        </div>
        
        @session('error')
            <div class="alert alert-danger">{{ session("error") }}</div>
        @endsession
        @session('success')
            <div class="alert alert-success">{{ session("success") }}</div>
        @endsession

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    @include("admin.includes.feedbacks")
                </div>
            </div>
        </section>
    </main> 
@endsection