@extends('user.layouts.masterLayout')
@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@section('title')
    Post a Job
@endsection

@section('main')
    <div class="container bg-white" style="margin-top: 60px;">
        <h4 class="pt-4 fw-bold text-center">Create a Job</h4>
        <form class="container-fluid mt-3 pb-4" action="{{route("job.post")}}" method="POST" id="job-post-form">
            <div class="container row">
                <div class="d-flex flex-column col-lg-6 col-md-12">
                    <label for="job-title" class="fw-semibold">Job Title</label>
                    <input type="text" id="job-title" name="job-title" class="form-control">
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3 mt-lg-0">
                    <label for="company" class="fw-semibold">Company</label>
                    <input type="text" id="company" name="company" class="form-control">
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="required-skills" class="fw-semibold">Required Skills</label>
                    <select name="required-skills" id="required-skills" multiple="multiple" class="form-select">
                        @foreach($skills as $sk)
                            <option value="{{$sk->id}}">{{$sk->skill_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="category" class="fw-semibold">Job Category</label>
                    <select name="category" id="category" multiple="multiple" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="employment-type" class="fw-semibold">Employment-Type</label>
                    <select name="employment-type" id="employment-type" class="form-select">
                        <option value="permanent">Permanent</option>
                        <option value="temporary">Temporary</option>
                        <option value="contract">Contract</option>
                        <option value="part-time">Part Time</option>
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="location-type" class="fw-semibold">Location-Type</label>
                    <select name="location-type" id="location-type" class="form-select">
                        <option value="on-site">On-site</option>
                        <option value="hybrid">Hybrid</option>
                        <option value="remote">Remote</option>
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="start-date" class="fw-semibold">Start Date</label>
                    <input type="date" id="start-date" name="start-date" class="form-control">
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="end-date" class="fw-semibold">End Date</label>
                    <input type="date" id="end-date" name="end-date" class="form-control">
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="city" class="fw-semibold">City</label>
                    <select name="city" id="city" class="form-control">
                        <option value="" disabled selected>-- Select a city --</option>
                        @foreach($cities as $city)
                            <option value="{{$city->id}}">{{$city->city_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="salary" class="fw-semibold">Approx. Salary</label>
                    <input type="number" id="salary" name="salary" class="form-control">
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="currency" class="fw-semibold">Salary Currency</label>
                    <select name="currency" id="currency" class="form-select">
                        <option value="pkr">PKR</option>
                        <option value="usd">USD</option>
                        <option value="aud">AUD</option>
                    </select>
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="per-period" class="fw-semibold">Per Period</label>
                    <select name="per-period" id="per-period" class="form-select">
                        <option value="month">Monthly</option>
                        <option value="year">Yearly</option>
                    </select>
                </div>
                
                <div class="d-flex flex-column col-l2 mt-3">
                    <label for="description" class="fw-semibold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="7" style="resize: none;"></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" class="w-100 btn btn-warning mt-4 rounded border-0 py-2 text-dark fw-bold fs-5">Post</button>
                </div>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        const date    =   new Date();
        const today_date    =   date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
        $("#start-date, #end-date").flatpickr({
            dateFormat: "Y-m-d",
            defaultDate: today_date
        });

        $("#start-date").on("change", function()
        {
            $("#end-date").val("");
            $("#end-date").flatpickr({
                minDate :   $("#start-date").val()
            });
        });

        $("#required-skills, #category").select2();
    });
</script>