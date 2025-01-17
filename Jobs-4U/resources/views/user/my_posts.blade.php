@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/job_card.css"> 
@endpush
@section('title')
    My Posts
@endsection


@section('main')
<div class="featured-jobs-div">
    <div class="container-lg mt-5">
        <h3 class="heading text-center">My Posts</h3>

        <div class="cards-div" style="margin-bottom: 60px;">
            <div class="row d-flex justify-content-md-between justify-content-center row-gap-3">
                {{-- Card --}}
                @include("user.includes.job_card")
                {{-- Car end --}}

            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function()
    {       
        $.each($(".mypost-delete-btn"), function(index, button)
        {
            $(button).on("click", function()
            {
                let post_id =   $(button).attr("job-id");
                alertify.confirm("Deleting Your Post", "Are you sure you want to delete your post ?",
                    function() 
                    {
                        $.ajax(
                        {
                            url         :   "{{route("user.deletePost")}}",
                            type        :   "post",
                            dataType    :   "json",
                            timeout     :   10000,
                            data        :
                            {
                                _token  :   "{{ csrf_token() }}",
                                post_id :   post_id
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
                                if(response.success)
                                {
                                    alertify.success(response.message) 
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1200);
                                }
                                else
                                {
                                    alertify.error(response.error);
                                }
                            },
                            error       :   function()
                            {
                                $("#toast-inner").text("Some thing went wrong");
                                $("#myToast").fadeIn().addClass("d-block");
                                setTimeout(() => 
                                {
                                    $("#myToast").fadeOut().removeClass("d-block");
                                }, 1500);
                            }
                        });
                    },
                    function() 
                    {
                        console.log("Cancelled deletion");
                    }
                );
            });
        })
        
    });
</script>