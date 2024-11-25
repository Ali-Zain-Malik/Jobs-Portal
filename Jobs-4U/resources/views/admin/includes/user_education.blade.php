@forelse($education as $edu)
<div class="card">
    <div class="d-flex justify-content-between align-items-center card-header pb-0">
        <h5 class="fw-bold">{{ $edu->major }}</h5>
        <span class="pe-1 d-flex gap-2 align-items-center"><i role="button" class="bx bxs-pencil fs-5 pointer edu-pencil-icon" data-bs-toggle="modal" data-bs-target="#editEducation"></i> <i role="button" class="ri ri-delete-bin-5-line edu-basket-icon fs-5 pointer"></i></span>
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
    