@forelse($experiences as $exp)
    <div class="card">
        <div class="d-flex justify-content-between align-items-center card-header pb-0">
            <h5 class="fw-bold">{{$exp->designation}}</h5>
            <span class="pe-1 d-flex gap-2 align-items-center"><i role="button" class="bx bxs-pencil fs-5 pointer pencil-icon" data-bs-toggle="modal" data-bs-target="#editViewModal"></i> <i role="button" class="ri ri-delete-bin-5-line basket-icon fs-5 pointer"></i></span>
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