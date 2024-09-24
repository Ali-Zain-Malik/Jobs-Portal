<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="assets/css/notify.css"> --}}
    <link rel="stylesheet" href="css/signup.css" />
    <title>Sign up Jobs 4U</title>
  </head>

  <body>

    @include('user.includes.loader')

    <div class="container">
      <div class="title">
        <h2 id="h2" class="fw-semibold">Create an Account</h2>
      </div>
      <form id="sign-up-form">
      <div class="inputs-div">
          <div class="input">
            <label for="email" id="email-label">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              placeholder="example@example.com"
            />
            <small></small>
          </div>
          <div class="input">
            <label for="name" id="name-label">Name</label>
            <input type="text" name="name" id="name" placeholder="Einstein" />
            <small></small>
          </div>
          <div class="input">
            <label for="role" id="name-label">Role</label>
            <select name="role" id="role">
              <option value="0">Applicant</option>
              <option value="1">Employer</option>
            </select>
          </div>
        
          <div class="input emp-company-div">
            <label for="emp-company">Company Name</label>
            <input type="text" id="emp-company" name="emp-company" class="" placeholder="e.g Microsoft">
            <small></small>
          </div>

          <div class="input">
            <label for="password" id="password-label">Password</label>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="********"
            />
            <small></small>
          </div>
          <div class="input">
            <label for="confirm-password" id="con-password-label">Confirm Password</label>
            <input
              type="password"
              name="confirm-password"
              id="confirm-password"
              placeholder="********"
            />
            <small></small>
          </div>
          
          <div class="signin-button">
            <button type="submit" id="signup-btn">Sign up</button>
          </div>
        </div>
    </form>
      <div class="signup">
        <p>Already have an account? <a href="/signin">Sign in here</a></p>
      </div>
    </div>
  </body>
</html>
