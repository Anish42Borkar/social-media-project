<!DOCTYPE html>
<html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="loginForm.css">
    </head>
    <body>
        <?php
            session_start();
            if(isset($_SESSION['userName'])){
                header('Location:index.php');
            }
        ?>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form action="#">
                    <h1>Create Account</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span>
                    <input class="userName_signup" type="text" placeholder="Name" />
                    <input class="userPhone_signup" type="number" placeholder="Phone" />
                    <input class="userDate_signup" type="date" placeholder="Date" />
                    <input class="email_signup" type="email" placeholder="Email" />
                    <input class="pass_signup" type="password" placeholder="Password" />
                    <button class = 'userRegistration'>Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="#">
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input class="userName_login" type="text" placeholder="User Name" />
                    <input class="pass_login" type="password" placeholder="Password" />
                    <a href="#">Forgot your password?</a>
                    <button class="login">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <img src="Images/logo2" alt="">
                        <h1>Welcome Back!</h1>
                        <p>To connect with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <img src="Images/logo2" alt="">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>


    </body>
    <script src="js/utility.js"></script>
    <script src="js/loginInfo.js"></script>
</html>