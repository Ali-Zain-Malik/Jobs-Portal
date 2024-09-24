@foreach ($users as $user)
<div class="col-lg-6 col-md-12 col-11">
    <div class="job-card mx-2 shadow-lg">
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex gap-1">
                <div class="image-div" style="width: 50px; height: 50px;">
                    <img src="img/demo_image.png" class="w-100 h-100 object-fit-cover" alt="">
                </div>
                <div class="d-flex flex-column">
                    <h4 style="font-size: 12px;" class="m-0">{{$user->name}}</h4>
                    <h3 style="font-size: 16px;" class="m-0 fw-bold">Job Title</h3>
                    <div class="d-flex align-items-center">
                        <img src="img/location.svg" style="width: 14px;" alt="">
                        <p style="font-size: 12px;">City Name</p>

                        <div class="ms-3 gap-1 d-flex align-items-center">
                            <img src="img/clock-regular.svg" style="width: 12px;" alt="">
                            <span style="font-size: 10px;">Start Date</span>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 25px; height: 25px;">
                <img class="w-100" role="button" job-id = "jobid" src="img/heart-regular.svg" alt="favorite">
            </div>
        </div>

        <div class="d-flex justify-content-between flex-sm-row flex-column align-items-center row-gap-2  mt-3">
            <div class="job-types d-flex gap-2">
                <span class="px-2 py-1 rounded-pill text-white fw-semibold text-capitalize" style="font-size: 12px; background-color: orange;">Employment</span>
                <span class="px-2 py-1 rounded-pill text-white fw-semibold text-capitalize" style="font-size: 12px; background-color: orange;">Location</span>
            </div>

            <div class="view-apply d-flex gap-2">
                <button type="button" class="view-btn px-3 py-1 rounded-pill text-white border-0">View</button>
                <button type="button" class="apply-btn px-3 py-1 rounded-pill text-white border-0">Apply</button>
            </div>
        </div>

        <hr class="mt-2">

        <div class="d-flex justify-content-between align-items-center">
            <span class="d-flex salary-span"><span class="currency me-1">PKR</span><span class="fw-bold amount">2000</span><p>/</p><span class="period">month</span></span>
            <span class="d-flex" style="font-size: 10px;"><span class="remaining-days me-1">20</span><span> day(s) left to apply</span></span>
        </div>
    </div>
</div>
@endforeach