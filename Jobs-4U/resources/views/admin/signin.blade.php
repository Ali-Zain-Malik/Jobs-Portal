<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="{{asset('css/signin.css')}}" />
    <title>Sign in Jobs 4U Admin</title>
  </head>
  <body>
    
    @include('admin.loader')

    <div class="container">
      
        @if (Session::has("success"))
          <div class="alert alert-success mt-4">
            {{Session::get("success")}}
          </div>
        @elseif(Session::has("error"))
          <div class="alert alert-danger mt-4">
            {{Session::get("error")}}
          </div>
        @endif
      
      <form id="signin_form" method="POST" action="{{route("admin.authenticate")}}" class="w-100 d-flex align-items-center flex-column">
        @csrf
        <div class="title">
          <h2 class="fw-bold">Sign in</h2>
        </div>
        <div class="inputs">
          <div class="email-input input">
            <label for="email" id="email-label">Enter Your Email</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="example@example.com"
              value="{{old("email")}}"
            />
            @error('email')
              <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="password-input input">
            <label for="password" id="password-label">Enter Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="********"
            />
            @error('password')
              <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="show-pass">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox" id="checkbox-label">Show Password</label>
          </div>
        </div>
        <div class="signin mb-3">
          <button type="submit" id="signin-button">Sign in</button>
        </div>
      </form>
    </div>
  </body>
</html>



{{-- To show the loader --}}
<script>
  const form  = document.querySelector("#signin_form");
  const loader =  document.querySelector(".loader");

  form.addEventListener("submit", function()
  {
    loader.classList.remove("d-none");
    loader.classList.add("d-flex");
  });
</script>