

<!-- loader -->
<div class="loader d-none justify-content-center align-items-center">
    <img src="{{ asset("img/loader.gif") }}" alt="" style="object-fit: cover; width: 50px;">
</div>



<style>
    .loader
    {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        z-index: 999;
        background-color: rgba(0, 0, 0, 0.228);
    }
</style>