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
                            <td class="job-title text-center fw-semibold">{{$applicant->job_title}}</td>
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
                                            <li class="dropdown-item view-application" application-id="{{$applicant->application_id}}">View</li>
                                            <li><a href="{{ route("profile.pdfDownload", ["id" => $applicant->applicant_id]) }}" class="dropdown-item download-profile">Download</a></li>
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



{{-- Modal --}}
<div class="modal fade" id="applicationDetails" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" style="font-size: 18px;">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-semibold mb-1" style="font-size: 16px;">Applicant</p>
                <p class="applicant-name"></p>
                <p class="fw-semibold mb-1" style="font-size: 16px;">Applied For</p>
                <p class="applied-for"></p>
                <p class="fw-semibold mb-1" style="font-size: 16px;">Description</p>
                <p class="description"></p>
                <p class="fw-semibold mb-1" style="font-size: 16px;">Date Applied</p>
                <p class="date-applied"></p>
            </div>
        </div>
    </div>
</div>
{{-- End modal --}}


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        let table = new DataTable('#myTable');

        const viewApplications  =   document.querySelectorAll(".view-application");
        viewApplications.forEach(function(btn)
        {
            btn.addEventListener("click", function()
            {
                const application_id    =   this.getAttribute("application-id");
                $.ajax(
                {
                    url         :   "{{route("applicant.details")}}",
                    type        :   "post",
                    dataType    :   "json",
                    timeout     :   10000,
                    data        :   
                    {
                        _token          :   "{{ csrf_token() }}",
                        application_id  :   application_id
                    },
                    beforeSend  :   function()
                    {
                        $(".loader").addClass("d-flex").removeClass("d-none");
                    },
                    complete    :   function()
                    {
                        $(".loader").addClass("d-none").removeClass("d-flex");
                    },
                    success     :   function(response)
                    {
                        if(response.success)
                        {
                            const row               =   btn.closest("tr");
                            const applicant_name    =   row.querySelector(".name").textContent;
                            const job_title         =   row.querySelector(".job-title").textContent;
                            $('#applicationDetails').modal('show'); 

                            $(".applicant-name").text(applicant_name);
                            $(".applied-for").text(job_title);
                            $(".description").text(response.details.description);
                            $(".date-applied").text(response.details.date_applied);
                        }   
                    },
                    error       :   function(xhr, status, error)
                    {
                        $("#myToast").fadeIn().addClass("d-block");

                        if (status === 'timeout') 
                        {
                            $("#toast-inner").text("Request timeout. Unstable connection");
                        } 
                        else if (status === 'error') 
                        {
                            if(xhr.responseText)
                            {
                                try 
                                {
                                    let response    = JSON.parse(xhr.responseText);
                                    if(response.error.application_id)
                                    {
                                        $("#toast-inner").text(response.error.application_id);
                                    }
                                    else
                                    {
                                        $("#toast-inner").text(response.error);
                                    }
                                    
                                }
                                catch (e) 
                                {
                                    $("#toast-inner").text("Something went wrong.");
                                }
                            }
                            
                        } 
                        else 
                        {
                            $("#toast-inner").text("Something went wrong.");
                        }

                        
                        setTimeout(() => 
                        {
                            $("#myToast").fadeOut().removeClass("d-block");
                        }, 1500);
                    }
                });
            });
        });
    });
</script>