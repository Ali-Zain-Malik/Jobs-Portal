@foreach ($cateogries as $category)   
<div class="col-md-3 col-sm-5 col-12">
    <div class="mx-2 shadow d-flex flex-column align-items-center py-2 rounded" style="background-color: rgba(244, 244, 226, 0.744)">
        <h3 style="font-size: 18px;">
            {{$category->category_name}}
        </h3>
        <span style="font-size: 14px;">
            120 Jobs Available
        </span>
        <button class="explore-btn" category-id = "1">
            Explore
        </button>
    </div>
</div>
@endforeach