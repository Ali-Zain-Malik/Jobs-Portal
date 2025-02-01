@foreach ($categories as $category)   
<div class="col-md-3 col-sm-5 col-12">
    <div class="mx-2 shadow d-flex flex-column align-items-center py-2 rounded" style="background-color: rgba(244, 244, 226, 0.744)">
        <h3 class="fw-semibold mb-1" style="font-size: 16px;">
            {{$category->category_name}}
        </h3>
        <span style="font-size: 14px;">
            {{$category->jobs_count}} Job(s) Available
        </span>
        <a href="{{ route("explore_category", $category->id) }}" class="explore-btn">
            Explore
        </a>
    </div>
</div>
@endforeach