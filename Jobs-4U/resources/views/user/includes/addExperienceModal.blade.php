{{-- Experience Modal Starts --}}
<div class="modal fade" id="experienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form class="w-100">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex gap-4 flex-column fw-semibold">
                        <div class="d-flex flex-column">
                            <label for="designation">Designation</label>
                            <input id="designation" name="designation" class="form-control" type="text" placeholder="e.g Front-end developer">
                        </div>
                        <div class="d-flex flex-column">
                            <label for="company">Company</label>
                            <input id="company" name="company" class="form-control" type="text" placeholder="e.g Microsoft">
                        </div>
                        <div class="d-flex gap-2">
                            <div class="d-flex flex-column w-50">
                                <label for="employment-type">Employment Type</label>
                                <select name="employment-type" id="employment-type" class="form-select">
                                    <option value="permanent">Permanent</option>
                                    <option value="part-time">Part Time</option>
                                    <option value="contract">Contract</option>
                                    <option value="temporary">Temporary</option>
                                    {{-- <option value="internship">Internship</option> --}}
                                </select>
                            </div>
                            <div class="d-flex flex-column w-50">
                                <label for="location-type">Location Type</label>
                                <select name="location-type" id="location-type" class="form-select">
                                    <option value="on-site">On-site</option>
                                    <option value="remote">Remote</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
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
                
                        <div class="d-none gap-2 end-date-div">
                            <div class="d-flex flex-column w-50">
                                <label for="end-month">End Month</label>
                                <select name="end-month" class="form-select" id="end-month"></select>
                                <div class="w-100" id="end_date" name="end_date"></div>
                            </div>
                            <div class="d-flex-flex-column w-50">
                                <label for="end-year">End Year</label>
                                <select name="end-year" class="form-select" id="end-year">
                                    <option value="">Year</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <input type="checkbox" name="currently-working" id="currently-working" checked class="pointer form-check-input">
                            <label for="currently-working" class="pointer fw-light">I am currently working here</label>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="exp-save-btn" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
 {{-- Experience Modal ends here  --}}
