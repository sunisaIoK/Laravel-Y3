<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

  </head>
  <body style="background: #265df2;">

    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form action="{{ route('login.process') }}" method="post">
                    @csrf
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Enter your username" required>
                        <i class="uil uil-user"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>

                        <a href="#" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <input type="submit" value="Login">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a>
                    </span>
                </div>
            </div>

            <script>
                const container = document.querySelector(".container"),
                pwShowHide = document.querySelectorAll(".showHidePw"),
                pwFields = document.querySelectorAll(".password");

                pwShowHide.forEach(eyeIcon =>{
                  eyeIcon.addEventListener("click", ()=>{
                      pwFields.forEach(pwField =>{
                          if(pwField.type ==="password"){
                              pwField.type = "text";
                              pwShowHide.forEach(icon =>{
                                  icon.classList.replace("uil-eye-slash", "uil-eye");
                              })
                          }else{
                              pwField.type = "password";
                              pwShowHide.forEach(icon =>{
                                  icon.classList.replace("uil-eye", "uil-eye-slash");
                              })
                          }
                      });
                  });
              });
              </script>

    <script src="script.js"></script>

  </body>
</html>
