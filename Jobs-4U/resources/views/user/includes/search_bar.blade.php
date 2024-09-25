<div class="search-div flex-column">
    <form action="{{route("search-jobs")}}" method="get">
    <div class="search-box">
        <input type="search" value="@isset($search_input) {{$search_input}} @endisset" name="search-input" id="search-input" placeholder="Search For a Job">
    </div>

    <hr class="my-0">

    <div class="filters d-flex" style="height: 100%;">
        <div class="location-div">
                <div class="location-image">
                    <img class="location-icon" src="img/location.svg" alt="">
                </div>
                <select name="city-id" id="city-id">
                    <option value="">All Locations</option>

                    @foreach ($locations as $city)
                        <option value="{{$city->id}}">{{$city->city_name}}</option>
                    @endforeach
                    
                </select>
        </div>
        <div class="d-flex align-items-center bg-white border-start border-dark px-1" style="height: 100%; width: 40%;">
            <i class="bx bxs-category fs-4"></i>
            <select name="category" id="category" class="w-100 border-0" role="button" style="height: 100%;">
                <option value="">All Categories</option>

                @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="search-image search-btn">
            <button type="submit" class="w-100 d-flex justify-content-center border-0 bg-transparent">
            <img class="search-icon" src="img/search_icon.svg" alt="">
            </button>
        </div>
    </div>
</form>
</div>