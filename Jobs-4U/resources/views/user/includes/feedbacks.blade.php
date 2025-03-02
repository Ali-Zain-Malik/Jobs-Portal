@push('styles')
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Owl Carousel CSS -->
@endpush

@forelse($feedbacks as $feedback)
    <div class="slide">
        <div class="mx-2 p-2 shadow child">
            <div class="d-flex flex-column align-items-center gap-1">
                <div class="image-div" style="width: 50px; height: 50px;">
                    <img src="{{ asset($feedback->profile_pic ? 'storage/' . $feedback->profile_pic : 'img/demo_image.png') }}" class="w-100 h-100 object-fit-cover" alt="">
                </div>
                <div class="d-flex flex-column align-items-center">
                    <h3 style="font-size: 14px;" class="m-0 fw-bold">{{ $feedback->user_name }}</h3>
                    <div class="d-flex align-items-center">
                        <img src="img/location.svg" style="width: 14px;" alt="">
                        <p style="font-size: 12px;">{{ $feedback->city_name ?? "N/A" }}</p>
                    </div>
                </div>
            </div>
            <div class="mt-2 px-2 text-start" style="font-size: 14px;">{{ $feedback->feedback }}</div>
        </div>
    </div>
@empty
    <strong>No Feedbacks Yet</strong>
@endforelse