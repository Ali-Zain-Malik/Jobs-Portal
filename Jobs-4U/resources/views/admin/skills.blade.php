@extends('admin.layouts.masterLayout')
@section("title")
    Skills Management
@endsection
@section('main')
    <main class="main" id="main">
        {{-- Start page title --}}
        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div class="div">
                <h1>Skills</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item">Skills Management</li>
                        <li class="breadcrumb-item active">Skills</li>
                    </ol>
                </nav>
            </div>
            <div class="add-skill-div py-3">
                <button type="button" data-bs-toggle="modal" data-bs-target="#skillsModal" class="btn btn-info text-light fw-bold" id="add-skill-btn">Add Skill</button>
            </div>
        </div>
        {{-- End page title --}}

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th class="table-heading">
                                            <b>S</b>kill
                                        </th>
                                        <th class="table-heading">Status</th>
                                        <th class="table-heading text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($skills as $skill)
                                        <tr>
                                            <td class="text-capitalize skill-name">{{$skill->skill_name}}</td>
                                            <td class="status">{{$skill->is_approved ? "Active" : "Inactive"}}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="action-div d-flex justify-content-center">
                                                <div class="dropdown text-start">
                                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('img/card-list.svg')}}" alt="">
                                                    </a>
                                                    <ul class="dropdown-menu text-small">
                                                        <li><span class="dropdown-item pointer edit-skill" data-bs-toggle="modal" data-bs-target="#skillsModal" skill-id="{{$skill->id}}">Edit</span></li>
                                                        <li><span class="dropdown-item pointer delete-skill" skill-id="{{$skill->id}}">Delete</span></li>
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

    {{-- Modal --}}
        <div class="modal fade" id="skillsModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fw-bold" id="modal-title"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <input type="text" class="form-control text-capitalize" id="skill-input" placeholder="Enter a skill" value="">
                            <span class="skill-error text-danger fs-6 d-none">Skill can't empty</span>
                        </div>
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <input type="radio" name="skill-status" id="active" value="1">
                                <label for="active" class="pointer">Activate</label>
                            </div>

                            <div class="d-flex align-items-center gap-2 mt-2">
                                <input type="radio" name="skill-status" id="deactive" value="0">
                                <label for="deactive" class="pointer">Deactivate</label>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="skill-save-btn">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">Back</button>

                    </div>
                </div>
            </div>
        </div>
    {{-- Modal end --}}

    {{-- Script --}}
        <script>
            document.addEventListener("DOMContentLoaded", function()
            {
                let route;
                $("#add-skill-btn").on("click", function()
                {
                    $("#modal-title").text("Add Skill");
                    route = "{{route('add_skill')}}";
                });

                $(".edit-skill").each(function()
                {
                    $(this).on("click", function()
                    {
                        $("#modal-title").text("Edit Skill");
                        const skill_id = $(this).attr("skill-id");
                        route = "{{route('edit_skill', '__id__')}}".replace("__id__", skill_id);

                        $.ajax(
                        {
                            url: "{{route('get_skill', '__id__')}}".replace("__id__", skill_id),
                            type: "get",
                            timeout: 10000,
                            beforeSend: function()
                            {
                                $(".loader").addClass("d-flex").removeClass("d-none");
                            },
                            complete: function()
                            {
                                $(".loader").addClass("d-none").removeClass("d-flex");
                            },
                            success: function(response)
                            {
                                $("#skill-input").val(response.skill_name);
                                response.is_approved ? $("#active").prop("checked", true) : $("#deactive").prop("checked", true);
                            }
                        });
                    });
                });

                $("#skill-save-btn").on("click", function(event)
                {
                    event.preventDefault();
                    const skill = $("#skill-input").val().trim();
                    const status = $("[name = 'skill-status']:checked").val();

                    if(skill == "")
                    {
                        $(".skill-error").removeClass("d-none");
                        return;
                    }

                    $.ajax(
                    {
                        url: route,
                        type: "post",
                        timeout: 10000,
                        beforeSend: function()
                        {
                            $(".loader").addClass("d-flex").removeClass("d-none");
                        },
                        complete: function()
                        {
                            $(".loader").addClass("d-none").removeClass("d-flex");
                        },
                        data:
                        {
                            _token: "{{csrf_token()}}",
                            skill: skill,
                            status: status,
                        },
                        success: function(response)
                        {
                            if(!response.success)
                            {
                                $(".skill-error").text(response.message).removeClass("d-none");
                            }
                            else
                            {
                                location.reload();
                            }
                        }
                    });

                });

                $(".delete-skill").each(function()
                {
                    $(this).on("click", function()
                    {
                        const skill_id = $(this).attr("skill-id");
                        $.ajax(
                        {
                            url: "{{route('delete_skill', '__id__')}}".replace("__id__", skill_id),
                            type: "post",
                            timeout: 10000,
                            data: { _token: "{{csrf_token()}}"},
                            beforeSend: function()
                            {
                                $(".loader").removeClass("d-none").addClass("d-flex")
                            },
                            complete: function()
                            {
                                $(".loader").removeClass("d-flex").addClass("d-none")
                            },
                            success: function(response)
                            {
                                if(response.success)
                                {
                                    location.reload();
                                }
                            }
                        });
                    });

                });
            });
        </script>
    {{-- End script --}}
@endsection