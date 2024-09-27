<div class="modal fade" id="educationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="d-flex gap-4 flex-column fw-semibold">
                    <div class="d-flex gap-2">
                        <div class="d-flex flex-column" style="width: 30%;">
                            <label for="program">Program</label>
                            <select name="program" id="program" class="form-select">
                                <option value="fsc">Fsc</option>
                                <option value="bachelors">Bachelors</option>
                                <option value="masters">Masters</option>
                            </select>
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        <div class="d-flex flex-column" style="width: 70%;">
                            <label for="major">Major</label>
                            <input type="text" name="major" id="major" class="form-control" placeholder="e.g Engineering">
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="institute">Institute</label>
                        <input id="institute" class="form-control" type="text" placeholder="e.g Oxford">
                        <small class="error-msg fw-light text-danger d-none">This field is required</small>
                    </div>
                    
                    <div class="d-flex gap-2 start-date-div">
                        <div class="d-flex flex-column w-50">
                            <label for="start-month">Start Month</label>
                            <select name="start-month" class="form-select" id="start-month">
                                
                            </select>
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        <div class="d-flex-flex-column w-50">
                            <label for="start-year">Start Year</label>
                            <select name="start-year" class="form-select" id="start-year">
                                <option value="">Year</option>
                                
                            </select>
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                    </div>
            
                    <div class="d-none gap-2 end-date-div">
                        <div class="d-flex flex-column w-50">
                            <label for="end-month">End Month</label>
                            <select name="end-month" class="form-select" id="end-month"></select>
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                        <div class="d-flex-flex-column w-50">
                            <label for="end-year">End Year</label>
                            <select name="end-year" class="form-select" id="end-year"></select>
                            <small class="error-msg fw-light text-danger d-none">This field is required</small>
                        </div>
                    </div>


                    <div class="d-flex gap-2">
                        <input type="checkbox" name="currently-studying" id="currently-studying" checked class="pointer form-check-input">
                        <label for="currently-studying" class="pointer fw-light">I am currently studying here</label>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="edu-save-btn" class="btn btn-primary w-100">Save</button>
            </div>
        </div>
    </div>
</div>