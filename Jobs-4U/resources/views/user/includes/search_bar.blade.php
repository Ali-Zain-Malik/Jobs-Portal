<div class="search-div flex-column">
    <div class="search-box">
        <input type="search" name="search-input" id="search-input" placeholder="Search For a Job">
    </div>

    <hr class="my-0">

    <div class="filters d-flex" style="height: 100%;">
        <div class="location-div">
                <div class="location-image">
                    <img class="location-icon" src="img/location.svg" alt="">
                </div>
                <select name="city-selector" id="city-selector">
                    <option value="">All Locations</option>
                    <option value="">Lahore</option>
                </select>
        </div>
        <div class="d-flex align-items-center bg-white border-start border-dark px-1" style="height: 100%; width: 40%;">
            <i class="bx bxs-category fs-4"></i>
            <select name="category" id="category" class="w-100 border-0" role="button" style="height: 100%;">
                <option value="">All Categories</option>
                <option value="">Cat 1</option>
            </select>
        </div>
        <div class="search-image search-btn">
            <img class="search-icon" src="img/search_icon.svg" alt="">
        </div>
    </div>
    
</div>