@push("styles")
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
@endpush
@forelse($experiences as $exp)
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header pb-0">
            <h5 class="fw-bold">{{$exp->designation}}</h5>
            <span class="pe-1 d-flex gap-2 align-items-center"><i role="button" class="bx bxs-pencil fs-5 pointer pencil-icon" exp-id="{{ $exp->id }}" data-bs-toggle="modal" data-bs-target="#editExperienceModal"></i> <i role="button" class="ri ri-delete-bin-5-line basket-icon fs-5 pointer" exp-id="{{ $exp->id }}" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal"></i></span>
        </div>
        <div class="card-body mt-3">
            <h5 class="card-title">{{$exp->company}}</h5>
            <p class="card-text fs-6 d-flex align-items-center gap-2">
                <span><i class="bx bx-calendar"></i></span>
                <span style="font-size: 14px;">{{$exp->start_date}}</span> - 
                <span style="font-size: 14px;">{{$exp->end_date ?? "Present"}}</span>
            </p>

            <p class="card-text">
                <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{$exp->employment_type}}</span>
                <span class="bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{$exp->location_type}}</span>
            </p> 
        </div>
    </div>
@empty
    <div class="alert alert-info fs-6">No experience added yet</div>
@endforelse


{{-- Modal for editing/updating experience --}}
<div class="modal fade" id="editExperienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form class="mb-0" id="edit-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="staticBackdropLabel">Edit Experience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3">
                        <label for="company">Compnay <span style="color: red; font-size: 10px;">*</span></label>
                        <input type="text" name="company" class="form-control" id="company">
                        <span class="text-danger fs-6 company-error d-none">Company can't be empty</span>
                    </div>
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3">
                        <label for="designation">Designation <span style="color: red; font-size: 10px;">*</span></label>
                        <input type="text" name="designation" class="form-control" id="designation">
                        <span class="text-danger fs-6 designation-error d-none">Designation can't be empty</span>
                    </div>

                    <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
                        <label for="employment_type">Employment Criteria <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex w-100 gap-1">
                            <select name="employment_type" id="employment_type" class="w-50">
                                <option value="permanent">Permanent</option>
                                <option value="temporary">Temporary</option>
                                <option value="part-time">Part Time</option>
                                <option value="contract">Contract</option>
                                <option value="temporary">Temporary</option>
                            </select>
  
                            <select name="location_type" id="location_type" class="w-50">
                                <option value="on-site">On-site</option>
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                    </div>

                    <div class="my-3">
                        <input type="checkbox" name="currently_working" id="currently_working" class="form-check-input pointer">
                        <label for="currently_working" class="pointer">Currently working here</label>
                    </div>
  
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3">
                        <label for="start_month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex w-100 gap-1">
                            <select name="start_month" id="start_month" class="w-50">
                                <option value="1">January</option>
                                <option value="2">Febraury</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
  
                            <select name="start_year" id="start_year" class="w-50"></select>
                        </div>
                        <span class="text-danger fs-6 date-error d-none">End date can't be earlier than start date</span>
                    </div>
  
  
  
                    <div class="d-none flex-column fw-semibold fs-6 mb-3 end-date-div">
                        <label for="end_month">End Date <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex w-100 gap-1">
                            <select name="end_month" id="end_month" class="w-50">
                                <option value="1">January</option>
                                <option value="2">Febraury</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
    
                            <select name="end_year" id="end_year" class="w-50"></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" exp-id="" class="btn btn-primary w-100" id="exp-save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- Edit/Update Modal ends --}}

{{-- Modal for delete confirmation --}}
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <strong class="h6 fw-bold">Are you sure you want to delete this experience?</strong>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary px-2 py-1" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary px-2 py-1" id="confirm-delete">Yes</button>
            </div>
        </div>
    </div>
</div>
{{-- Modal ends --}}
@push("scripts")
<script
  src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
  integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
></script>
@endpush
<script>
    document.addEventListener("DOMContentLoaded", function()
    {

        const pencilIcons = document.querySelectorAll(".pencil-icon");
        pencilIcons.forEach(btn => {
            btn.addEventListener("click", function()
            {
                const exp_id = this.getAttribute("exp-id");
                $.ajax(
                {
                    url: "{{ route("get_experience", '__id__') }}".replace('__id__', exp_id),
                    type: "get",
                    timeout: 10000,
                    beforeSend: function()
                    {
                        $(".loader").removeClass("d-none").addClass("d-flex");
                    },
                    complete: function()
                    {
                        $(".loader").removeClass("d-flex").addClass("d-none");
                    },
                    success: function(response)
                    {
                        $("#company").val(response.company);
                        $("#designation").val(response.designation);
                        $("#currently_working").prop("checked", response.is_currently_working);

                        const start_month = new Date(response.start_date).getMonth() + 1;
                        const start_year = new Date(response.start_date).getFullYear();
                        let end_month, end_year;
                        if(response.end_date != null)
                        {
                            end_month = new Date(response.end_date).getMonth() + 1;
                            end_year = new Date(response.end_date).getFullYear();
                        }
                        else
                        {
                            end_month = new Date().getMonth() + 1;
                            end_year = new Date().getFullYear();
                        }

                        const employmentType = $("#employment_type")[0].selectize;
                        const locationType = $("#location_type")[0].selectize;
                        const startMonth = $("#start_month")[0].selectize;
                        const startYear = $("#start_year")[0].selectize;
                        const endMonth = $("#end_month")[0].selectize;
                        const endYear = $("#end_year")[0].selectize;

                        employmentType.setValue(response.employment_type);
                        locationType.setValue(response.location_type);
                        startMonth.setValue(start_month);
                        startYear.setValue(start_year);
                        endMonth.setValue(end_month);
                        endYear.setValue(end_year);
                        
                        $("#exp-save-btn").attr("exp-id", response.id);
                    },
                    error: function(xhr, status, error)
                    {
                        console.log(error)
                    }
                });
            })
        });

        toggleEndDate();
        $("#start_month, #end_month, #employment_type, #location_type").selectize();
        const currentYear = new Date().getFullYear();
        const leastYear = 1947;
        let options = [];
        for(let i = currentYear; i >= leastYear; i--)
        {
            options.push({value: i, text: i});
        }
        $("#start_year, #end_year").selectize(
        {
            options: options,
            labelField: "text",
            valueField: "value",
            searchField: "value",
            create:false,
            selected: 2024,
        });

        $("#currently_working").on("click", function()
        {
           toggleEndDate();
        });


        function isDateValid()
        {
            const startMonth = parseInt($("#start_month").val());
            const startYear = parseInt($("#start_year").val());
            const endMonth = parseInt($("#end_month").val());
            const endYear = parseInt($("#end_year").val());  

            const startNumeric = startYear * 100 + startMonth;
            const endNumeric = endYear * 100 + endMonth;
            return startNumeric < endNumeric;
        }
    
        function toggleEndDate()
        {
            if(!$("#currently_working").prop("checked"))
            {
                $(".end-date-div").removeClass("d-none").addClass("d-flex");
            }
            else
            {
                $(".end-date-div").removeClass("d-flex").addClass("d-none");
            }
        }

        //Delete functionality
        let deleteExperienceId;
        const deleteIcons = document.querySelectorAll(".basket-icon");
        deleteIcons.forEach(function(btn)
        {
            btn.addEventListener("click", function()
            {
                deleteExperienceId = this.getAttribute("exp-id");
            });
        });

        const confirmDelete = document.querySelector("#confirm-delete");
        confirmDelete.addEventListener("click", function()
        {
            $.ajax(
            {
                url: "{{route("deleteExperience", '__id__')}}".replace('__id__', deleteExperienceId),
                type: "delete",
                timeout: 10000,
                data: {
                    _token : "{{ csrf_token() }}",
                },
                beforeSend: function()
                {
                    $(".loader").removeClass("d-none").addClass("d-flex");
                },
                complete: function()
                {
                    $(".loader").removeClass("d-flex").addClass("d-none");
                },
                success: function()
                {
                    window.location.reload(); //For simplicity right now.
                }
            });
        });

        function isInputValid()
        {
            if($("#company").val().trim() === "")
            {
                $(".company-error").removeClass("d-none");
            }

            if($("#designation").val().trim() === "")
            {
                $(".designation-error").removeClass("d-none");
            }

            if($("#company").val().trim() === "" || $("#designation").val().trim() === "")
            {
                return false;
            }

            return true;
        }


        // Edit Experience
        $("#exp-save-btn").on("click", function()
        {
            const experience_id = $(this).attr("exp-id");
            if(!isDateValid())
            {
                $(".date-error").removeClass("d-none");
                return;
            }
            if(!isInputValid())
            {
                return;
            }

            $.ajax(
            {
                url: "{{ route("edit_experience", '__id__') }}".replace("__id__", experience_id),
                type: "post",
                timeout: 10000,
                data:
                {
                    _token: "{{ csrf_token() }}",
                    company: $("#company").val().trim(),
                    designation: $("#designation").val().trim(),
                    employment_type: $("#employment_type").val(),
                    location_type: $("#location_type").val(),
                    start_date: `${$("#start_year").val()}-${$("#start_month").val()}-01`,
                    end_date: `${$("#end_year").val()}-${$("#end_month").val()}-01`,
                    currently_working: $("#is_currently_working").prop("checked") ? 1 : 0,
                },
                beforeSend: function()
                {
                    $(".loader").removeClass("d-none").addClass("d-flex");
                },
                complete: function()
                {
                    $(".loader").removeClass("d-flex").addClass("d-none");
                },
                success: function(response)
                {
                    location.reload();
                }
            });

        });

    });
</script>