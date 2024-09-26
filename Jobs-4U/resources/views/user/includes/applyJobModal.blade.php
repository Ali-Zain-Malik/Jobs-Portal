{{-- Apply job modal --}}
<div class="modal fade" id="applyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-6 fw-bold" id="applyheading">Apply Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Description (Optional)" id="description"></textarea>
                    <label for="floatingTextarea">Description (Optional)</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="submit-btn" class="btn btn-primary border-0 bg-warning w-100 fw-bold" data-bs-toggle="modal" data-bs-target="#success-popup">Submit</button>
            </div>
        </div>
    </div>
</div>
{{-- Apply job modal ends here --}}