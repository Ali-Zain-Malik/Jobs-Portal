@extends('admin.layouts.masterLayout')
@section("title")
    Skills' Categories
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
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </nav>
            </div>
            <div class="add-skill-div py-3">
                <button type="button" data-bs-toggle="modal" data-bs-target="#categoryModal" class="btn btn-info text-light fw-bold" id="add-category-btn">Add Categories</button>
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
                                            <b>C</b>ategory
                                        </th>
                                        <th>Jobs</th>
                                        <th class="table-heading">Status</th>
                                        <th class="table-heading text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td class="text-capitalize pointer viewCategory" category-id="{{$category->id}}" data-bs-toggle="modal" data-bs-target="#categoryModal">{{$category->category_name}}</td>
                                            <td>{{$category->job_count}}</td>
                                            <td class="status">{{$category->is_active ? "Active" : "Inactive"}}</td>
                                            <td class="d-flex justify-content-center">
                                                <div class="action-div d-flex justify-content-center">
                                                <div class="dropdown text-start">
                                                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle action" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <img src="{{asset('img/card-list.svg')}}" alt="">
                                                    </a>
                                                    <ul class="dropdown-menu text-small">
                                                        <li><span class="dropdown-item pointer viewCategory" data-bs-toggle="modal" data-bs-target="#categoryModal" category-id="{{$category->id}}">Edit</span></li>
                                                        <li><span class="dropdown-item pointer" category-id="{{$category->id}}">Delete</span></li>
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
    <div class="modal fade" id="categoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-bold" id="modal-title"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <input type="text" class="form-control text-capitalize" id="category-input" placeholder="Enter a category" value="">
                        <span class="category-error text-danger fs-6 d-none">Category can't empty</span>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <input type="radio" name="category-status" id="active" value="1">
                            <label for="active" class="pointer">Activate</label>
                        </div>

                        <div class="d-flex align-items-center gap-2 mt-2">
                            <input type="radio" name="category-status" id="deactive" value="0">
                            <label for="deactive" class="pointer">Deactivate</label>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="category-save-btn">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>

                </div>
            </div>
        </div>
    </div>
{{-- Modal end --}}


{{-- script --}}
    <script>
        document.addEventListener("DOMContentLoaded", function()
        {
            let addOrEditRoute;
            $(".viewCategory").each(function()
            {
                $(this).on("click", function()
                {
                    const category_id = $(this).attr("category-id")
                    if(category_id == null)
                    {
                        return;
                    }
                    $(".category-error").addClass("d-none")
                    // Dynamically changing modal title
                    $("#modal-title").text("Edit Category")
                    // Dynamically changing route. This will be in action if current category is updated.
                    addOrEditRoute = "{{route('edit_category', '__id__')}}".replace("__id__", category_id)
                    // Route which will be used to get the current category data
                    let route = "{{route('get_category', '__id__')}}".replace("__id__", category_id)
                    AjaxCall(route, null, "get")
                        .then(function(response)
                        {
                            if(response.success)
                            {
                                let category = response.category;
                                $("#category-input").val(category.category_name)
                                category.is_active ? $("#active").prop("checked", true) : $("#deactive").prop("checked", true)
                                $("#category-save-btn").attr("category-id", category.id)
                            }
                        })
                        .catch(function(error)
                        {
                            error = error.responseJSON
                            console.log(error)
                        })
                })
            })

            $("#add-category-btn").on("click", function()
            {
                $(".category-error").addClass("d-none")
                // Dynamically updating modal title and route.
                $("#modal-title").text("Add a Category")
                addOrEditRoute = "{{route('add_category')}}"
            })

            $("#category-save-btn").on("click", function()
            {
                const is_active = $("[name='category-status']:checked").val()
                const category_name = $("#category-input").val().trim()
                if(category_name == "")
                {
                    $(".category-error").removeClass("d-none")
                    return;
                }

                let data = {
                    _token: "{{csrf_token()}}",
                    category_name: category_name,
                    is_active: is_active,
                }
                // Route will be dynamically updated, depending whether we're updating a category or adding a new one.
                AjaxCall(addOrEditRoute, data)
                    .then(function(response)
                    {
                        if(response.success)
                        {
                            location.reload();
                        }
                    })
                    .catch(function(error)
                    {
                        error = error.responseJSON
                        $(".category-error").text(error.message).removeClass("d-none")
                    })
            })


            // $(".deleteJob").each(function()
            // {
            //     $(this).on("click", function()
            //     {
            //         const job_id = $(this).attr("job-id")
            //         if(job_id == null)
            //         {
            //             return;
            //         }

            //         let route = "{{route('delete_job', '__id__')}}".replace("__id__", job_id)
            //         let data = { _token: "{{csrf_token()}}"}

            //         AjaxCall(route, data)
            //             .then(function(response)
            //             {
            //                 if(response.success)
            //                 {
            //                     location.reload()
            //                 }
            //             })
            //             .catch(function(error)
            //             {
            //                 error = error.responseJSON
            //                 console.log(error)
            //             })

            //     })
            // })
            
            function AjaxCall(route, data, type = "post")
            {
                return $.ajax({
                        url: route,
                        type: type,
                        timeout: 10000,
                        data: data,
                        beforeSend: function()
                        {
                            $(".loader").addClass("d-flex").removeClass("d-none")
                        },
                        complete: function()
                        {
                            $(".loader").addClass("d-none").removeClass("d-flex")
                        }
                    })
            }
        })
    </script>
{{-- end script --}}