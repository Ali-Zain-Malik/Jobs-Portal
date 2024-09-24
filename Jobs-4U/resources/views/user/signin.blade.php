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
    {{-- <link rel="stylesheet" href="assets/css/notify.css"> --}}
    <link rel="stylesheet" href="css/signin.css" />
    <title>Sign in Jobs 4U</title>
  </head>
  <body>
    
    @include('user.includes.loader')

    <div class="container">
      <form id="signin_form" class="w-100 d-flex align-items-center flex-column">
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
            />
            <small></small>
          </div>
          <div class="password-input input">
            <label for="password" id="password-label">Enter Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="********"
            />
            <small></small>
          </div>
          <div class="show-pass">
            <input type="checkbox" name="checkbox" id="checkbox" />
            <label for="checkbox" id="checkbox-label">Show Password</label>
          </div>
        </div>
        <div class="signin">
          <button type="submit" id="signin-button">Sign in</button>
        </div>
        <div class="signup">
          <p>Don't have an account? <a href="/signup">Sign up here</a></p>
        </div>
      </form>
    </div>
  </body>
  {{-- <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
  ></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"
  ></script>
  <script src="assets/js/jquery.js"></script>
  <script src="assets/js/notify.js"></script>
  <script src="assets/js/sign_in.js"></script> --}}
</html>
