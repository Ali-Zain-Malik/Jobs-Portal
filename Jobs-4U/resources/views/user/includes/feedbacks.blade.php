
@forelse($feedbacks as $feedback)
    <div class="slide col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="mx-2 p-2 shadow" style="background-color: rgba(244, 244, 226, 0.744);">
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

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        const slider = $(".slider");
        const slides = $(".slide");
        const totalSlides = slides.length;

        let index = 1; // Start at the first real slide
        const slideWidth = $(".slide").outerWidth(true); // Get the width including margin

        // Clone first and last slides
        const firstClone = slides.first().clone();
        const lastClone = slides.last().clone();

        // Append/prepend clones
        slider.append(firstClone);
        slider.prepend(lastClone);

        // Adjust slider position to start from the first real slide
        slider.css("transform", `translateX(-${slideWidth}px)`);

        function moveSlider(newIndex) {
            index = newIndex;
            slider.css({
                transform: `translateX(-${index * slideWidth}px)`,
                transition: "transform 0.5s ease-in-out",
            });

            // Reset position when reaching the cloned slides
            setTimeout(() => {
                if (index >= totalSlides + 1) {
                    index = 1;
                    slider.css({
                        transform: `translateX(-${index * slideWidth}px)`,
                        transition: "none",
                    });
                } else if (index <= 0) {
                    index = totalSlides;
                    slider.css({
                        transform: `translateX(-${index * slideWidth}px)`,
                        transition: "none",
                    });
                }
            }, 500);
        }

        // Auto-slide every 3 seconds
        setInterval(() => {
            moveSlider(index + 1);
        }, 3000);
    });
</script>