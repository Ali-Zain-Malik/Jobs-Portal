<div class="card">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th class="table-heading">
                    <b>N</b>ame
                    </th>
                    <th data-type="date" data-format="YYYY/DD/MM" class="table-heading">Posted</th>
                    <th class="table-heading">Display</th>
                    <th class="table-heading">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user_feedbacks as $feedbacks)
                    <tr>
                        <td>{{$feedbacks->user_name}}</td>
                        <td>{{ $feedbacks->feedback_date }}</td>
                        {{-- Toggle button --}}
                        <td>
                            <div class='form-check form-switch ms-4'>
                                <input class='form-check-input approve-toggle toggle-btn' style="cursor: pointer" @checked($feedbacks->is_displayed == 1) type='checkbox' role='switch' feedback-id='{{ $feedbacks->id }}'>
                            </div>
                        </td>
                        {{-- Toggle button ends --}}

                        {{-- Action buttons --}}
                        <td>
                            <div class='action-div d-flex justify-content-center'>
                                <div class='dropdown text-end'>
                                    <a href='#' class='d-block link-dark text-decoration-none dropdown-toggle action' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <img src='{{ asset("img/card-list.svg") }}'>
                                    </a>
                                    <ul class='dropdown-menu text-small'>
                                        <li> <span class='dropdown-item view-feedback' role="button" feedback-id='{{ $feedbacks->id }}'>View</span> </li>
                                        <li> <a href="{{ route("feedback.delete", ["id" => $feedbacks->id]) }}" class='dropdown-item delete-feedback' role="button" feedback-id='{{ $feedbacks->id }}'>Delete</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Action buttons end --}}
                @endforeach
            </tbody>
        </table>
    </div>
</div>


{{-- Modal --}}
<div class="modal fade" id="viewFeedback" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-semibold" style="font-size: 18px;">Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex flex-column">
                    <h6 id="feedback-giver" class="mb-0 fw-semibold"></h6>
                    <p id="feedback-date" style="font-size:12px;"></p>
                    <p id="feedback-text" style="font-size:16px;"></p>
                    <div class="actions d-flex align-items-center">
                        <div>
                            <input id="toggle-in-modal" class='form-check-input approve-toggle toggle-btn me-1' style="cursor: pointer" type='checkbox' role='switch' feedback-id=''>
                            <label for="toggle-in-modal" class="me-4" style="cursor: pointer;">Display</label>
                        </div>
                        <a id="delete-route" href="{{ route("feedback.delete") }}"><button id="delete-in-modal" class="btn btn-danger px-2 py-1 delete-feedback" feeback-id="">Delete</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End modal --}}


<script>
    document.addEventListener("DOMContentLoaded", function()
    { 
        const   togglebtns  =   document.querySelectorAll(".toggle-btn");
        togglebtns.forEach(function(btn)
        {
            btn.addEventListener("click", function()
            {
                const feedback_id   =   this.getAttribute("feedback-id");

                $.ajax(
                {
                    url         :   "{{ route("feedbackDisplay.toggle") }}",
                    type        :   "put",
                    dataType    :   "json",
                    timeout     :   10000,
                    data        :
                    {
                        _token          :   "{{ csrf_token() }}",
                        feedback_id     :   feedback_id
                    },
                    beforeSend  :   function()
                    {
                        $(".loader").removeClass("d-none").addClass("d-flex");
                    },
                    complete    :   function()
                    {
                        $(".loader").removeClass("d-flex").addClass("d-none");
                    },
                    success     :   function(response)
                    {
                        toast(response.message);
                    },
                    error       :   function(xhr, status, error)
                    {
                        let response    = JSON.parse(xhr.responseText);
                        if(response)
                        {
                            toast(response.message);
                        }
                        if(status == "timeout")
                        {
                            toast("Request timeout. Unstable Connection.")
                        }
                    }
                });
            });
        });


        const viewFeedbacks =   document.querySelectorAll(".view-feedback");
        viewFeedbacks.forEach(function(btn)
        {
            btn.addEventListener("click", function()
            {
                const feedback_id   =   this.getAttribute("feedback-id");
                $.ajax(
                {
                    url         :   "{{ route("feedback.viewDetails") }}",
                    type        :   "post",
                    dataType    :   "json",
                    timeout     :   10000,
                    data        :
                    {
                        _token          :   "{{ csrf_token() }}",
                        feedback_id     :   feedback_id
                    },
                    beforeSend  :   function()
                    {
                        $(".loader").removeClass("d-none").addClass("d-flex");
                    },
                    complete    :   function()
                    {
                        $(".loader").removeClass("d-flex").addClass("d-none");
                    },
                    success     :   function(response)
                    {
                        $("#viewFeedback").modal("show");
                        $("#feedback-giver").text(response.data.user_name);
                        $("#feedback-date").text(response.data.feedback_date);
                        $("#feedback-text").text(response.data.feedback);
                        $("#toggle-in-modal").prop("checked", response.data.is_displayed == 1 ? true : false).attr("feedback-id", response.data.id);
                        $("#delete-in-modal").attr("feedback-id", response.data.id);
                        
                        const $delete_link  =   $("#delete-route");
                        const url           =   new URL($delete_link.attr("href"));
                        url.search = ""; // Clear previous id
                        url.searchParams.append("id", response.data.id);
                        $delete_link.attr("href", url.toString());
                    }
                });
            });
        });

        function toast(message)
        {
            $("#toast-inner").text(message);
            $("#myToast").fadeIn().addClass("d-block");
            setTimeout(() => 
            {
                $("#myToast").fadeOut().removeClass("d-block");
            }, 1500);
        }
    });
</script>