@extends('user.layouts.masterLayout')
@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
@section("title")
    Settings
@endsection

@section("main")
    <div class="container bg-white" style="margin-top: 80px; margin-bottom: 20px;">
        <h4 class="pt-4 fw-bold text-center">Settings</h4>
        <form method="post" action="{{route("user.changePassword")}}" class="container-fluid mt-3 pb-4">
            @csrf
            <div class="container row">
                <div class="d-flex flex-column col-lg-6 col-md-12">
                    <label for="date-of-birth" class="fw-semibold">Date of Birth</label>
                    <input type="date" value="{{$user->date_of_birth ? $user->date_of_birth: ""}}" id="date-of-birth" name="date-of-birth" class="form-control">
                    @error('date-of-birth')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    <button type="button" id="dob-save-btn" class="bg-warning rounded border-0 col-sm-2 col-4 mt-2 fw-semibold d-none">Save</button>
                </div>
                
                <div class="d-flex col-12 mt-3 row">
                    <h5 class="text-center mt-0 fw-bold col-12">Change Password</h5>
                    <div class="d-flex flex-column col-md-6 col-12">
                        <label for="old-password" class="fw-semibold">Old Password</label>
                        <input type="password" value="{{old("old-password")}}" id="old-password" name="old-password" class="form-control">
                        @error('old-password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                        @if(session("error"))
                            <span class="text-danger">{{session("error")}}</span>
                        @endif
                    </div>
                    <div class="d-flex flex-column col-md-6 col-12 mt-3 mt-md-0">
                        <label for="new-password" class="fw-semibold">New Password</label>
                        <input type="password" value="{{old("new-password")}}" id="new-password" name="new-password" class="form-control">
                        @error('new-password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    {{-- <span></span> --}}
                    <div class="col-12 d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-warning rounded border-0 text-dark fw-semibold">Change Password</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        $("#date-of-birth").flatpickr({
                dateFormat: "Y-m-d"
            });

        $("#date-of-birth").on("change", function()
        {
            $("#dob-save-btn").removeClass("d-none");
        });
        
        $("#dob-save-btn").on("click", function()
        {
            $.ajax(
            {
                url     :   "{{route('user.DOB')}}",
                type    :   "post",
                dateType    :   "json",
                data        :   
                {
                    _token  :   "{{csrf_token()}}",
                    dob     :   $("#date-of-birth").val()
                },
                success     :   function(response)
                {
                    if(response.success)
                    {
                        location.reload();
                    }
                }
            });
        }); 

    });
</script>