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
                                <option value="bachelors">Bachelors</option>
                                <option value="masters">Masters</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                        <div class="d-flex flex-column" style="width: 70%;">
                            <label for="major">Major</label>
                            <input type="text" name="major" id="major" class="form-control" placeholder="e.g Engineering">
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <label for="institute">Institute</label>
                        <input id="institute" name="institute" class="form-control" type="text" placeholder="e.g Oxford">
                    </div>
                    
                    <div class="d-flex gap-2 start-date-div">
                        <div class="d-flex flex-column w-50">
                            <label for="start-month">Start Month</label>
                            <select name="start-month" class="form-select" id="start-month"></select>
                        </div>
                        <div class="d-flex-flex-column w-50">
                            <label for="start-year">Start Year</label>
                            <select name="start-year" class="form-select" id="start-year">
                                <option value="">Year</option>     
                            </select>
                        </div>
                    </div>
            
                    <div class="d-flex flex-column gap-2">
                        <label for="grade">Grade</label>
                        <select name="grade" id="grade" class="form-select">
                            <option value="a+">A+</option>
                            <option value="a">A</option>
                            <option value="a-">A-</option>
                            <option value="b">B</option>
                            <option value="b-">B-</option>
                            <option value="c">C</option>
                            <option value="d">D</option>
                        </select>
                    </div>

                    <div class="d-none gap-2 end-date-div">
                        <div class="d-flex flex-column w-50">
                            <label for="end-month">End Month</label>
                            <select name="end-month" class="form-select" id="end-month"></select>
                        </div>
                        <div class="d-flex-flex-column w-50">
                            <label for="end-year">End Year</label>
                            <select name="end-year" class="form-select" id="end-year"></select>
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