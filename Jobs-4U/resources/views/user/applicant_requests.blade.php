@extends("user.layouts.masterLayout")
@push('styles')
    <link rel="stylesheet" href="css/applicant_requests.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
@endpush
@section("title")
    Applicants' Requests
@endsection

@section("main")
<div class="main-holder d-grid">
    <div class="container main-container">
        @if(Session::has("notFound"))
        <div class="mx-auto mb-0 mt-2 w-50 alert alert-danger">{{Session::get("notFound")}}</div>
        @endif 
        {{Session::get("notFound")}}
            <p class="h5 pt-4 fw-bold text-center heading"></p>
            <table id="myTable" class="display text-center">
                <thead>
                    <tr>
                        <th class="text-center">Sr. No.</th>
                        <th class="text-center">Job</th>
                        <th class="text-center">Applicant</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($job_applicants as $applicant)
                        <tr>
                            <td class="text-center">{{$loop->index + 1}}</td>
                            <td class="text-center fw-semibold">{{$applicant->job_title}}</td>
                            <td>
                                <a class="applicant text-decoration-none" href="{{route("user.viewProfile", ["id" => $applicant->applicant_id, "name" => \Str::slug($applicant->name)])}}">
                                    <div class="image-div">
                                        <img src="{{asset($applicant->profile_pic ? "storage/". $applicant->profile_pic : "img/demo_image.png")}}" alt="Profile Pic">
                                    </div>
                                    <p class="name m-0 text-dark fw-semibold">{{$applicant->name}}</p>
                                </a>
                            </td>

                            <td> 
                                <div class="action-div">
                                    <div class="dropdown text-end">
                                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                            <img src="img/caret-down-fill.svg" alt="">
                                            <img src="img/card-list.svg" alt="">
                                        </a>

                                        <ul class="dropdown-menu text-small">
                                            <li><a class="dropdown-item" href="#">View</a></li>
                                            <li><a class="dropdown-item" href="#">Download</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        let table = new DataTable('#myTable');
    });
</script>