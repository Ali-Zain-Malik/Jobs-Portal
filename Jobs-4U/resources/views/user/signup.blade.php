<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/signup.css" />
    <title>Sign up Jobs 4U</title>
  </head>

  <body>

    @include('user.includes.loader')

    <div class="container">
      <div class="title">
        <h2 id="h2" class="fw-semibold">Create an Account</h2>
      </div>
      <form id="sign-up-form" method="POST" action="{{route("user.createAccount")}}">
        @csrf 
      <div class="inputs-div">
          <div class="input">
            <label for="email" id="email-label">Email</label>
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
          <div class="input">
            <label for="name" id="name-label">Name</label>
            <input type="text" name="name" id="name" placeholder="Einstein" value="{{old("name")}}"/>
            @error('name')
              <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          <div class="input">
            <label for="role" id="name-label">Role</label>
            <select name="role" id="role">
              <option value="applicant">Applicant</option>
              <option value="employer">Employer</option>
            </select>
          </div>
        
          <div class="input emp-company-div">
            <label for="emp-company">Company Name</label>
            <input type="text" id="emp-company" name="emp-company" class="" placeholder="e.g Microsoft" value="{{old("emp-company")}}">
          </div>

          <div class="input">
            <label for="password" id="password-label">Password</label>
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
          <div class="input">
            <label for="password_confirmation">Confirm Password</label>
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              placeholder="********"
            />
            @error('password_confirmation')
              <small class="text-danger">{{$message}}</small>
            @enderror
          </div>
          
          <div class="signin-button">
            <button type="submit" id="signup-btn">Sign up</button>
          </div>
        </div>
    </form>
      <div class="signup">
        <p>Already have an account? <a href="{{route("user.signin")}}">Sign in here</a></p>
      </div>
    </div>
  </body>
</html>

{{-- To show the loader --}}
<script>
  const form  = document.querySelector("#sign-up-form");
  const loader =  document.querySelector(".loader");

  form.addEventListener("submit", function()
  {
    loader.classList.remove("d-none");
    loader.classList.add("d-flex");
  });
</script>