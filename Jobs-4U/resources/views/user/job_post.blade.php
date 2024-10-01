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
            @csrf
            <div class="container row">
                <div class="d-flex flex-column col-lg-6 col-md-12">
                    <label for="job-title" class="fw-semibold">Job Title</label>
                    <input type="text" value="{{old("job-title")}}" id="job-title" name="job-title" class="form-control">
                    @error('job-title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3 mt-lg-0">
                    <label for="company" class="fw-semibold">Company</label>
                    <input type="text" value="{{old('company', Auth::user()->emp_company)}}" id="company" name="company" class="form-control">
                    @error('company')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="required-skills" class="fw-semibold">Required Skills</label>
                    <select name="required-skills[]" id="required-skills" multiple="multiple" class="form-select">
                        @foreach($skills as $sk)
                            <option @selected(old("required-skills")) value="{{$sk->id}}">{{$sk->skill_name}}</option>
                        @endforeach
                    </select>
                    @error('required-skills')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="category" class="fw-semibold">Job Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="" selected disabled>-- Select a category --</option>
                        @foreach($categories as $category)
                            <option @selected(old("category")) value="{{$category->id}}">{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="employment-type" class="fw-semibold">Employment-Type</label>
                    <select name="employment-type" id="employment-type" class="form-select">
                        <option @selected(old("employment-type")) value="permanent">Permanent</option>
                        <option @selected(old("employment-type")) value="temporary">Temporary</option>
                        <option @selected(old("employment-type")) value="contract">Contract</option>
                        <option @selected(old("employment-type")) value="part-time">Part Time</option>
                    </select>
                    @error('employment-type')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="location-type" class="fw-semibold">Location-Type</label>
                    <select name="location-type" id="location-type" class="form-select">
                        <option @selected(old("location-type")) value="on-site">On-site</option>
                        <option @selected(old("location-type")) value="hybrid">Hybrid</option>
                        <option @selected(old("location-type")) value="remote">Remote</option>
                    </select>
                    @error('location-type')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="start-date" class="fw-semibold">Start Date</label>
                    <input type="date" value="{{old("start-date")}}" id="start-date" name="start-date" class="form-control">
                    @error('start-date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="end-date" class="fw-semibold">End Date</label>
                    <input type="date" value="{{old("end-date")}}" id="end-date" name="end-date" class="form-control">
                    @error('end-date')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="city" class="fw-semibold">City</label>
                    <select name="city" id="city" class="form-control">
                        <option value="" disabled selected>-- Select a city --</option>
                        @foreach($cities as $city)
                            <option @selected(old("city")) value="{{$city->id}}">{{$city->city_name}}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="salary" class="fw-semibold">Approx. Salary</label>
                    <input type="number" value="{{old("salary")}}" id="salary" name="salary" class="form-control">
                    @error('salary')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="currency" class="fw-semibold">Salary Currency</label>
                    <select name="currency" id="currency" class="form-select">
                        <option @selected(old("currency")) value="pkr">PKR</option>
                        <option @selected(old("currency")) value="usd">USD</option>
                        <option @selected(old("currency")) value="aud">AUD</option>
                    </select>
                    @error('currency')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="d-flex flex-column col-lg-6 col-md-12 mt-3">
                    <label for="per-period" class="fw-semibold">Per Period</label>
                    <select name="per-period" id="per-period" class="form-select">
                        <option @selected(old("per-period")) value="month">Monthly</option>
                        <option @selected(old("per-period")) value="year">Yearly</option>
                    </select>
                    @error('per-period')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                
                <div class="d-flex flex-column col-l2 mt-3">
                    <label for="description" class="fw-semibold">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="7" style="resize: none;">{{old("description")}}</textarea>
                    @error('description')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
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

        $("#job-post-form").on("submit", function()
        {
            $(".loader").removeClass("d-none").addClass("d-flex");
        });
    });
</script>