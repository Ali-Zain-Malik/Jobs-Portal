@extends('admin.layouts.masterLayout')
@section("title")
    Jobs
@endsection
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Jobs</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">Jobs Management</li>
                    <li class="breadcrumb-item active">Jobs</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">  
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                        <b>T</b>itle
                                        </th>
                                        <th>Employer</th>
                                        <th>Approve</th>
                                        <th>Feature</th>
                                        <th>Posted</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($jobs as $job)
                                        <tr>
                                            <td class="pointer" data-bs-toggle="modal" data-bs-target="#jobsDetailModal" job-id="$job->id" data-bs-toggle="modal" data-bs-target="#exampleModal">{{$job->job_title}}</td>
                                            <td class="pointer"><a class="employer-name" style="color:black;" href="{{route('profile.view', $job->user_id)}}">{{$job->employer}}</a></td>
                                            <td class="d-flex justify-content-center">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input approve-toggle pointer" @checked($job->is_approved) job-id="$job->id" type="checkbox" role="switch">
                                                    <label class="form-check-label" for="approve-toggle"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input feature-toggle pointer" @checked($job->is_featured) job-id="$job->id" type="checkbox" role="switch">
                                                    <label class="form-check-label" for="approve-toggle"></label>
                                                </div>
                                            </td>
                                            <td>{{$job->created_at}}</td>
                                            <td class="status">{{$job->expiry_date > date("Y-m-d") ? "Live" : "Expired" }}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="action-div d-flex justify-content-center">
                                                <div class="dropdown text-end">
                                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset("img/card-list.svg")}}" alt="">
                                                    </a>
                                
                                                    <ul class="dropdown-menu text-small">
                                                        <li><a class="dropdown-item pointer viewJob" data-bs-toggle="modal" data-bs-target="#jobsDetailModal" job-id="$job->id">View</a></li>
                                                        <li><span class="dropdown-item pointer deleteJob" job-id="$job->id">Delete</span></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


{{-- Modal --}}
<div class="modal fade" id="jobsDetailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container-fluid p-0">
                    <h1 class="modal-title fs-5 fw-bold job-title text-capitalize" id="exampleModalLabel"></h1>
                    <span class="fw-bold m-0 salary-amount"></span><span class="salary-currency mx-1 text-uppercase" style="font-size: 12px;"></span>/<span class="per-period text-lowercase" style="font-size: 14px;"></span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="fw-bold company-name text-capitalize"></h5>
                <p class="m-0 d-flex gap-3"><span class="start-date"></span> - <span class="expiry-date"></span></p>
                <p class="m-0 d-flex gap-3"><span class="employement-type text-capitalize"></span> <span class="location-type text-capitalize"></span></p>
                <h6 class="mt-3 fw-bold">Description</h6>
                <p class="description-text"></p>
            </div>
        </div>
    </div>
</div>
{{-- End Modal --}}