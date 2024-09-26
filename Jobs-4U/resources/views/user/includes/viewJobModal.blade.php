{{-- Booystrap modal for view jobs --}}

<div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="applyModalLabel">Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <p class="h6 fw-bold">Required Skills</p>
                <ul class="required-skills text-capitalize">
                    
                </ul>


                {{-- <p class="h6 fw-bold mb-0">Minimum Education</p>
                <div class="majors-div">
                    <span class="Degree h6 me-1 fw-normal">BS</span><span class="major h6 fw-normal">Software Engineering</span>
                </div>
                <div class="majors-div">
                    <span class="Degree h6 me-1 fw-normal">BS</span><span class="major h6 fw-normal">Computer Science</span>
                </div> --}}


                <div class="div-for-spacing mb-3"></div>

                <p class="h6 fw-bold">Job Description</p>
                <p class="job-summary"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary bg-warning w-100 border-0 " data-bs-target="#staticBackdrop" data-bs-toggle="modal">Apply</button>
            </div>
        </div>
    </div>
</div>
{{-- @endisset --}}
{{-- Bootstrap view Modal Ends here --}}
