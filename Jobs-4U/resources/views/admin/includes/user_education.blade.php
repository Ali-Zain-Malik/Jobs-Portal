@push("styles")
<link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"
  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="
  crossorigin="anonymous"
  referrerpolicy="no-referrer"
/>
@endpush
@forelse($education as $edu)
<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header pb-0">
        <h5 class="fw-bold">{{ $edu->major }}</h5>
        <span class="pe-1 d-flex gap-2 align-items-center"><i role="button" class="bx bxs-pencil fs-5 pointer edu-pencil-icon" edu-id="{{ $edu->id }}" data-bs-toggle="modal" data-bs-target="#editEducation"></i> <i role="button" edu-id="{{ $edu->id }}" class="ri ri-delete-bin-5-line edu-basket-icon fs-5 pointer"></i></span>
    </div>
    <div class="card-body mt-3">
      <h5 class="card-title mb-0">{{ $edu->institute }}</h5>
        <h5 class="text-capitalize" style="font-size: 16px;">{{ $edu->program }}</h5>
        <p class="card-text fs-6 d-flex align-items-center gap-2">
            <span><i class="bx bx-calendar"></i></span>
            <span style="font-size: 14px;">{{ $edu->start_date }}</span> - 
            <span style="font-size: 14px;">{{ $edu->end_date ?? "Currently Enrolled" }}</span>
        </p>

        <p class="card-text">
            <span class="me-3 bg-info rounded-pill px-3 py-1 text-white fw-bold text-capitalize">{{ $edu->grade ?? "N/A" }}</span>
        </p> 
    </div>
</div>
@empty
    <div class="alert alert-info fs-6">No education added yet</div>
@endforelse


<div class="modal fade" id="editEducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="add-education-form">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold modal-heading" id="staticBackdropLabel">Add Education</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3">
                        <label for="major">Course of Study <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex gap-2">
                            <select name="program" id="program" style="width: 35%;">
                                <option value="">Program</option>
                                <option value="fsc">Fsc</option>
                                <option value="bachelors">Bachelors</option>
                                <option value="masters">Masters</option>
                            </select>
                            <input type="text" name="major" id="major" class="form-control" placeholder="Major e.g Engineering">
                        </div>
                        <span class="text-danger fs-6 major-error d-none">Major can't be empty</span>
                    </div>
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3">
                        <label for="institute">Institute <span style="color: red; font-size: 10px;">*</span></label>
                        <input type="text" name="institute" class="form-control" id="institute">
                        <span class="text-danger fs-6 institute-error d-none">Institute can't be empty</span>
                    </div>

                    <div class="my-3">
                        <input type="checkbox" name="currently_studying" id="currently_studying" class="pointer form-check-input">
                        <label for="currently_studying" class="pointer">Currently Studying here</label>
                    </div>
        
                    <div class="d-flex flex-column fw-semibold fs-6 mb-3 start-date-div">
                        <label for="start_month">Start Date <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex w-100 gap-1">
                            <select name="start_month" id="edu_start_month" class="w-50">
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
                            <select name="start_year" id="edu_start_year" class="w-50"></select>
                        </div>
                        <span class="text-danger fs-6 d-none date-error">End date can't be earlier than start date</span>
                    </div>

                    <div class="flex-column fw-semibold fs-6 mb-3 edu-end-date-div">
                        <label for="end_month">End Date <span style="color: red; font-size: 10px;">*</span></label>
                        <div class="d-flex w-100 gap-1">
                            <select name="end_month" id="edu_end_month" class="w-50">
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
                            <select name="end_year" id="edu_end_year" class="w-50"></select>
                        </div>
                    </div>

                    <div class="d-flex flex-column fw-semibold fs-6 mb-3 grade-div">
                        <label for="grade">Grade <span style="color: red; font-size: 10px;">*</span></label>
                        <select name="grade" id="grade">
                            <option value="a+">A+</option>
                            <option value="a-">A-</option>
                            <option value="b">B</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" edu-id="" class="btn btn-primary w-100" id="education-save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
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
        toggleEndDate();

        $("#currently_studying").on("click", function()
        {
           toggleEndDate();
        });

        const pencilIcons = document.querySelectorAll(".edu-pencil-icon");
        pencilIcons.forEach(btn => 
        {
            btn.addEventListener("click", function()
            {
                const edu_id = this.getAttribute("edu-id");
                $.ajax(
                {
                    url: "{{ route("get_education", '__id__') }}".replace('__id__', edu_id),
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
                        $("#major").val(response.major);
                        $("#institute").val(response.institute);
                        $("#currently_studying").prop("checked", response.is_currently_studying);

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

                        const program = $("#program")[0].selectize;
                        const startMonth = $("#edu_start_month")[0].selectize;
                        const startYear = $("#edu_start_year")[0].selectize;
                        const endMonth = $("#edu_end_month")[0].selectize;
                        const endYear = $("#edu_end_year")[0].selectize;

                        program.setValue(response.program);
                        startMonth.setValue(start_month);
                        startYear.setValue(start_year);
                        endMonth.setValue(end_month);
                        endYear.setValue(end_year);

                        let grades = ["a+", "a-", "b", "c", "d"];
                        let text = ["A+", "A-", "B", "C", "D"];
                        $("#grade").selectize({
                            options: grades,
                            labelField: "text",
                            valueField: "value",
                            create: false,
                            selected: response.grade,
                        });
                        
                        $(this).attr("edu-id", response.id);
                    },
                    error: function(xhr, status, error)
                    {
                        console.log(error)
                    }
                });
            })
        });
        

        $("#edu_start_month, #edu_end_month, #program").selectize();
        const currentYear = new Date().getFullYear();
        const leastYear = 1947;
        let options = [];
        for(let i = currentYear; i >= leastYear; i--)
        {
            options.push({value: i, text: i});
        }
        $("#edu_start_year, #edu_end_year").selectize(
        {
            options: options,
            labelField: "text",
            valueField: "value",
            searchField: "value",
            create:false,
            selected: 2024,
        });

        function toggleEndDate()
        {
            if(!$("#currently_studying").prop("checked"))
            {
                $(".edu-end-date-div").removeClass("d-none").addClass("d-flex");
            }
            else
            {
                $(".edu-end-date-div").removeClass("d-flex").addClass("d-none");
            }
        }

        function isDateValid()
        {
            const startMonth = parseInt($("#edu_start_month").val());
            const startYear = parseInt($("#edu_start_year").val());
            const endMonth = parseInt($("#edu_end_month").val());
            const endYear = parseInt($("#edu_end_year").val());  

            const startNumeric = startYear * 100 + startMonth;
            const endNumeric = endYear * 100 + endMonth;

            return startNumeric < endNumeric;
        }

        function isInputValid()
        {
            if($("#major").val().trim() === "")
            {
                $(".major-error").removeClass("d-none");
            }

            if($("#institute").val().trim() === "")
            {
                $(".institute-error").removeClass("d-none");
            }

            if($("#major").val().trim() === "" || $("#institute").val().trim() === "")
            {
                return false;
            }

            return true;
        }

        // Saving edited education Info
        $("#education-save-btn").on("click", function()
        {
            const education_id = $(this).attr("edu-id");
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
                url: "{{ route("edit_education", '__id__') }}".replace("__id__", education_id),
                type: "post",
                timeout: 10000,
                data:
                {
                    _token: "{{ csrf_token() }}",
                    program: $("#program").val(),
                    major: $("#major").val().trim(),
                    institute: $("#institute").val().trim(),
                    grade: $("#grade").val(),
                    start_date: `${$("#edu_start_year").val()}-${$("#edu_start_month").val()}-01`,
                    end_date: `${$("#edu_end_year").val()}-${$("#edu_end_month").val()}-01`,
                    is_currently_studying: $("#is_currently_studying").prop("checked") ? 1 : 0,
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

        // Delete Education
        $(".edu-basket-icon").each(function()
        {
            $(this).on("click", function()
            {
                const education_id = $(this).attr("edu-id");
                $.ajax(
                {
                    url: "{{ route("delete_education", '__id__' ) }}".replace("__id__", education_id),
                    type: "post",
                    timeout: 10000,
                    data:
                    {
                        _token: "{{ csrf_token() }}"
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

    });
</script>