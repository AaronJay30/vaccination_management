<?php

    @include 'include\config.php';

    session_start();

    if(isset($_SESSION['id'])){
        header('location:admin.php');
    }

    if(isset($_POST['submit'])){

        $email = $_POST['email'];
        $pass = md5($_POST['password']);

        $select = "SELECT * FROM admin_login WHERE email = '$email' && password = '$pass' ";

        $result = mysqli_query($conn, $select);

        if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $_SESSION['id'] = $row['id'];
                header('location:admin.php');
        }else{
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Oops...","Incorrect email or password!!","error");';
            echo '}, 1000);</script>';
        }
          
    }

    if(isset($_POST['reset'])){
        $email = $_COOKIE['email'];
        $code = $_COOKIE['code'];

        $vcode = $_POST['Vcode'];
        $npass = $_POST['npass'];
        $cnpass = $_POST['cnpass'];

        if($code != $vcode){
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Oops...","Code did not match","error");';
            echo '}, 1000);</script>';
        } else if(strlen($npass) < 8) {
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Try Again!","Your password should have atleast 8 character","error");';
            echo '}, 1000);</script>';
        } else if($npass != $cnpass){
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("Oops...","Password did not match","error");';
            echo '}, 1000);</script>';
        } else{
            $enpass = md5($npass);

            $sql = "UPDATE admin_login SET password = '$enpass' WHERE email = '$email'";

            $result = mysqli_query($conn,$sql);

            header('location:login_admin.php'); 
        }
        
    }
    


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <link rel="shortcut icon" type="image/png" href="image/OKLogo.png">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="/css/style.css">        

    <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
    <!-- SweetAlert2 -->
    <script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
    <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <title>Login</title>


    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #CBEBF6;
        }       
        .container{
            position: relative;
            max-width: 430px;
            width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin: 0 20px;
        }
        .container .forms{
            display: flex;
            align-items: center;
            height: 440px;
            width: 200%;
            transition: height 0.2s ease;
        }



        .container .form{
            width: 50%;
            padding: 30px;
            background-color: #fff;
            transition: margin-left 0.18s ease;
        }


        .container.active .login{
            margin-left: -50%;
            opacity: 0;
            transition: margin-le
            ft 0.18s ease, opacity 0.15s ease;
        }


        .container .signup{
            opacity: 0;
            transition: opacity 0.09s ease;
        }
        .container.active .signup{
            opacity: 1;
            transition: opacity 0.2s ease;
        }
        .container.active .forms{
            height: 600px;
        }
        .container .form .title{
            position: relative;
            font-size: 27px;
            font-weight: 600;
        }
        .form .input-field{
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 30px;
        }
        .input-field input{
            position: absolute;
            height: 100%;
            width: 100%;
            padding: 0 35px;
            border: none;
            outline: none;
            font-size: 16px;
            border-bottom: 2px solid #ccc;
            border-top: 2px solid transparent;
            transition: all 0.2s ease;
        }
        .input-field input:is(:focus, :valid){
            border-bottom-color: #024059;
        }

        .input-field i{
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            color: #037AA6;
            font-size: 23px;
            transition: all 0.2s ease;
        }
        .input-field input:is(:focus, :valid) ~ i{
            color: #024059;
        }

        .input-field i.icon{
            left: 0;
        }
        .input-field i.showHidePw{
            right: 0;
            cursor: pointer;
            padding: 10px;
        }
        .form .checkbox-text{
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
        }
        .checkbox-text .checkbox-content{
            display: flex;
            align-items: center;
        }
        .checkbox-content input{
            margin: 0 8px -2px 4px;
            accent-color: #4A5568;
        }
        .form .text{
            color: #4A5568;
            font-size: 14px;
        }


        .form a.text{
            color: #037AA6;
            text-decoration: none;
        }


        .form a:hover{
            text-decoration: underline;
        }
        .form .button{
            margin-top: 20px;
        }
        .form .Cancelbtn{
            margin-top: 15px;
        }
        .form .button input{
            border: none;
            color: #fff;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 6px;
            background-color: #037AA6;
            transition: all 0.3s ease;
        }
        .form .Cancelbtn input{
            border: #024059;
            color: #024059;
            font-size: 16px;
            font-weight: 500;
            letter-spacing: 1px;
            border-radius: 6px;
            background-color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 50px;
            
        }
        .button input:hover{
            background-color: #024059;
        }
        .Cancelbtn input:hover{
            background-color: #4A5568;
            color: #fff;
        }
        .form .login-signup{
            margin-top: 10px;
            text-align: center;

            
        }
        .form .login-reg{
            margin-top: 30px;
            text-align: center;  
        }
        .form .login-forgot{
            
            text-align: center;  
        }
        h2{
            text-align: center;
            color: #024059;
        
        }
        .text-login{
            text-align: center;
            color: #024059;
        }

        .error-msg{
            margin: 10px 0;
            display: block;
            background: #E50914;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
            padding: 10px;
        }


    </style>



</head>

<body>
    
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                
                <h2>Login</h2>
                <div class="text-login">
                <span class="text">Sign in to your Account
                </span>
                </div>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" required name="email">
                        <i class="uil uil-user icon"></i>
                    </div>

                    <div class="input-field">
                        <input type="password" class="password" placeholder="Enter your password" required name="password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="submit" value="Login">
                    </div>

                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="logCheck" name="remember">
                            <label for="logCheck" class="text">Remember me</label>
                        </div>
                        
                        <div class="login-forgot">
                            <span class="text">
                                 <a href="#" class="text signup-link">Forgot password?</a>
                            </span>
                        </div>
                    </div>                 
                </form>
                
            </div>

            <!-- Reset Password Form -->
            <div class="form forgot">
                <h2>Reset Password</h2>

                <form action="" method="POST">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" required id="femail">
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    
                    <button type="button" class="btn btn-primary text-capitalize code_btn btn-block mt-3 shadow-none" id="sendCode" style="font-size: 16px; padding:13px; background: #037AA6; ">Send Code</button>
                    <div class="input-field">
                        <input type="text" placeholder="Verification Code" required name="Vcode">
                        <i class="uil uil-key-skeleton icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="New Password" required name="npass">
                        <i class="uil uil-lock icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Confirm Password" required name="cnpass">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="input-field button">
                        <input type="submit" name="reset" value="Reset">
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Already have an account?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        const container = document.querySelector(".container"),
        pwShowHide = document.querySelectorAll(".showHidePw"),
        pwFields = document.querySelectorAll(".password"),
        forgot = document.querySelector(".forgot-link"),
        signUp = document.querySelector(".signup-link"),
        login = document.querySelector(".login-link");

        //   js code to show/hide password and change icon
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
                }) 
            })
        })

        // js code to appear signup and login form
        signUp.addEventListener("click", ( )=>{
            container.classList.add("active");
        });
        login.addEventListener("click", ( )=>{
            container.classList.remove("active");
        });

    </script>

<script>

    $(document).ready(function(){

            $(".code_btn").click(function(){
                var action = 'data';
                var email = document.getElementById("femail");

                if (!email.value){
                    setTimeout(function () { swal("Error!","Please input your email address first","error");}, 1000);
                    
                } else{

                    var code = Math.floor(100000 + Math.random() * 900000);
                    var timer = 60;

                    var myTimer = setInterval(function(){
                    const button = document.getElementById('sendCode');

                    button.disabled = true;
                    button.innerHTML = 'Please wait for '+ timer-- +" sec";

                    if(timer == 0 ){
                        clearInterval(myTimer);
                        button.disabled = false;
                        button.innerHTML = 'Resend Code';
                    }
                    }, 1000);
                    

                    document.cookie='email='+email.value;
                    document.cookie='code='+code;

                    $.post("forgot-password.php", {
                        action: action, 
                        email: email.value,
                        code:code
                    },function(){
                            setTimeout(function () { swal("Successfully","Please check your email for the code","success");}, 1000);
                    });   

                }

                

            });
        });
        
        

</script>

    


</body>
</html>
