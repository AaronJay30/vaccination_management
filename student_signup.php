<?php

    @include 'include\config.php';

    session_start();

    if(isset($_SESSION['id'])){
        header('location:student.php');
    }

    if(isset($_POST['submitbtn'])){
        
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $suffix = $_POST['suffix'];

        $name = $fname . " " . $mname . " " .  $lname . " " . $suffix;

        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];

        $email = $_POST['email'];

        $sql = "SELECT * FROM user_login WHERE email = '$email'";
        $result = mysqli_query($conn,$sql);

        if(mysqli_num_rows($result) > 0){
            echo '<script type="text/javascript"> setTimeout(function () { Swal.fire("Error!","Email already exist!","error");}, 1000);</script>';
        } else {
            $pass = $_POST['password'];
            $cpass = $_POST['cpassword'];

            if($pass != $cpass){
                echo '<script type="text/javascript"> setTimeout(function () { Swal.fire("Error!","Password did not match!","error");}, 1000);</script>';
            } else if(strlen($pass) < 8){
                echo '<script type="text/javascript"> setTimeout(function () { Swal.fire("Try Again!","Your password should atleast be 8 characters","error");}, 1000);</script>';
            } else {

                $enpass = md5($pass);
                $roles = $_POST['roles'];

                if($roles == "Student"){
                    $department = NULL;
                    $section = $_POST['section'];
                    $grade = $_POST['grade'];
                } else {
                    $department = $_POST['department'];
                    $section = NULL;
                    $grade = NULL;
                }

                if($gender == "Male"){
                    $profile = "male.png";
                } else{
                    $profile = "female.png";
                }

                if($roles == "Student"){
                    $sql = "INSERT INTO user_login (`name`, `address`, `birthday`, `gender`, `email`, `contact`, `password`, `roles`, `grade`, `section`, `department`, `profile`) VALUES ('$name', '$address','$birthday','$gender','$email','$contact','$enpass','$roles',$grade,$section,NULL,'$profile')";
                    mysqli_query($conn,$sql);
                }else {
                    $sql = "INSERT INTO user_login (`name`, `address`, `birthday`, `gender`, `email`, `contact`, `password`, `roles`, `grade`, `section`, `department`, `profile`) VALUES ('$name', '$address','$birthday','$gender','$email','$contact','$enpass','$roles',NULL ,NULL , '$department','$profile')";
                    mysqli_query($conn,$sql);
                }

                $sql = "SELECT * FROM user_login WHERE email = '$email'";
                $result = mysqli_query($conn,$sql);


                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $userid = $row['user_login_id'];
                        $sql = "INSERT INTO user_vaccine (`userid`) VALUES ($userid)";
                        mysqli_query($conn,$sql);

                        $sql = "INSERT INTO user_vaccine_history (`userid`) VALUES ($userid)";
                        mysqli_query($conn,$sql);

                        header('location:student_login.php');
                    }
                }

            }

            
        }

        
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" type="image/png" href="image/OKLogo.png">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="shortcut icon" type="image/png" href="image/OKLogo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/lightpick.css">

    <!-- Font Awesome -->
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
    <style>
        /* ===== Google Font Import - Poppins ===== */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        body{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #CBEBF6;
        }
        /* =================== Form Page =================== */
        .container{
            position: relative;
            max-width: 900px;
            width: 100%;
            border-radius: 6px;
            padding: 30px;
            margin: 0 15px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1)
        }
        /*  Sign Up text  */
        h2{
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #024059;
        }
        /* ===== grey bg form ===== */
        .container form{
            position: relative;
            min-height: 490px;
            margin-top: 16px;
            background-color: #fff;
        } 


        /*  Please fill out text  */
        .text-login{
            font-size: 14px;
            text-align: center;
            margin: 7px 0;
            color: #4A5568;
        }
        /*  Personal Info text...  */
        .text-info{
            text-align: left;
            font-size: 15px;
            font-weight: 600;
            color: #024059;
        }

        /*  Personal Info...  */
        .container form .title{
            font-size: 16px;
            font-weight: 500;
            margin: 2px 0;
            color: #024059;
        }

        /* =================== Input text =================== */
        .container form .fields{
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        /*  boxes 4 columned */
        form .fields .input-field{
            display: flex;
            width: calc(100% / 4 - 15px);
            flex-direction: column;
        }
        /* inside boxes 4 columns (inputs hinted) */
        .input-field input{
            border-bottom: 2px solid #024059;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            border-right: 2px solid transparent;
            outline: none;
            font-size: 14px;
            font-weight: 400;
            padding: 0 7px;
            height: 42px;
            margin: 8px 0;
        }

        /*  boxes 2 columned */
        form .fields .input-field2{
            display: flex;
            width: calc(100% / 2 - 15px);
            flex-direction: column;
        }

        /* inside boxes 2 columns (inputs hinted) */
        .input-field2 input{
            border-bottom: 2px solid #024059;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            border-right: 2px solid transparent;
            outline: none;
            font-size: 14px;
            font-weight: 400;
            padding: 0 7px;
            height: 42px;
            margin: 8px 0;
        }

        /*  roles display */
        form .fields .input-field3{
            display: flex;
            width: calc(100% / 3 - 15px);
            flex-direction: column;
            border: none;
        }

        form .fields .input-field4{
            display: flex;
            width: 50%;
            flex-direction: column;
            border: none;
        }

        /* inside boxes roles */
        .input-field3 select{
            border-bottom: 2px solid #024059;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            border-right: 2px solid transparent;
            outline: none;
            font-size: 14px;
            font-weight: 400;
            padding: 0 7px;
            height: 42px;
            margin: 8px 0;
        }

        /* inside boxes roles */
        .input-field4 select{
            border-bottom: 2px solid #024059;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            border-right: 2px solid transparent;
            outline: none;
            font-size: 14px;
            font-weight: 400;
            padding: 0 7px;
            height: 42px;
            margin: 8px 0;
        }
        /*  test box shadow : */

        /*
        .input-field input:is(:focus, :valid){
            box-shadow: 0 3px 6px rgba(0,0,0,0.13);
        }
        */

        .input-field input[type="date"]{
            color: #707070;
        }
        .input-field input[type="date"]:valid{
            color: #333;
        }


        .container .form .checkbox-content{
            margin-top: 15px; 
            margin: 4px;
            font-size: 15px;
            accent-color: #4A5568;
            
        }
        /* text: Accepting Terms*/
        .form .text {
            margin-top: 15px; 
            margin: 4px;
            color: #4A5568;
            font-size: 14px;
        }

        /* Register Account Button */
        .container .form button{
            margin-top: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 45px;
            max-width: 200px;
            width: 100%;
            border: none;
            border-radius: 5px;
            outline: none;
            color: #fff;
            background-color:#024059;

        }
        /* Already have an account? text*/
        .form .login-reg{
            margin-top: 15px;
            font-size: 14px;
            display: flex;
            color: #76797F;
        }
        /* Login text href */
        .form .login-reg .text .signup-link{
            margin-top: 15px;
            color: #0E84F2;
        }
        h1{
            display: flex;
        }


    </style>

    <title>Sign up</title>
</head>
<body>
    <div class="container"> <!-- .container -->
        <h2>Sign up</h2>
                <div class="text-login">
                    <span class="text">Please fill out the form</span>
                </div>
                
                <div class="text-info">
                    <span class="text">Personal Information</span>
                </div>

        <form method="POST">
            <div class="form first"> <!-- .form -->
                <div class="details personal">
                    <div class="fields"> <!-- .fields -->
                        
                       
                        <!-- 1st Row -->
                        <div class="input-field">
                            <input type="text" placeholder="First Name" required name="fname" autocomplete="off">
                        </div>

                        <div class="input-field">
                            <input type="text" placeholder="Middle Initial" required name="mname" autocomplete="off">
                        </div>

                        <div class="input-field">
                            <input type="text" placeholder="Last Name" required name="lname" autocomplete="off">
                        </div>

                        <div class="input-field">
                            <input type="text" placeholder="Suffix" name="suffix" autocomplete="off">
                        </div>

                        <!-- 2nd Row -->
                        <div class="input-field3">
                            <select required id="gender" name="gender">
                                <option disabled selected >Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <input type="date" placeholder="Birthday" required name="birthday" max="2015-12-12">
                        </div>

                        <div class="input-field">
                            <input type="text" placeholder="Barangay" required name="address" autocomplete="off">
                        </div>

                        

                        
                    

                    <!-- 3rd Row -->
                    <div class="input-field2">
                        <input type="text" placeholder="Email" required name="email" autocomplete="off">
                    </div>

                    <div class="input-field2">
                        <input type="number" placeholder="Contact Number" required name="contact" >
                    </div>

                    <div class="input-field2">
                        <input type="password" placeholder="Password" required name="password">
                    </div>

                    <div class="input-field2">
                        <input type="password" placeholder="Confirm Password" required name="cpassword">
                    </div>


                    <!-- Dropdown-->
                    <div class="input-field3">
                        <!-- <label>Roles</label> --> 
                        <select required id="roles" name="roles">
                            <option disabled selected>Roles</option>
                            <option value="Student">Student</option>
                            <option value="Faculty">Faculty</option>
                        </select>
                    </div>

                    <div class="input-field3">
                        <!-- <label>Roles</label> --> 
                        <select required id="grade" disabled name="grade">
                            <option disabled="disabled" selected value="" hidden>Grade</option>
                            <option value="7">Grade 7</option>
                            <option value="8">Grade 8</option>
                            <option value="9">Grade 9</option>
                            <option value="10">Grade 10</option>
                            <option value="11">Grade 11</option>
                            <option value="12">Grade 12</option>
                        </select>
                    </div>

                    <div class="input-field3">
                        <!-- <label>Roles</label> --> 
                        <select required id="section" disabled name="section">
                            <option disabled="disabled" selected value="">Section</option>
                            <option value="1">Section 1</option>
                            <option value="2">Section 2</option>
                        </select>
                    </div> <!--End Boxes Checkpoint -->

                    <div class="input-field4">
                        <select required id="department" disabled name="department">
                            <option disabled="disabled" selected value="">Department</option>
                            <option value="Math Department">Math Department</option>
                            <option value="Science Department">Science Department</option>
                            <option value="ESP Department">ESP Department</option>
                            <option value="English Department">English Department</option>
                            <option value="Filipino Department">Filipino Department</option>
                        </select>
                    </div>
                    
                    <!-- Checkbox Terms & Conditions-->
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon" required>
                            
                            <label for="termCon" class="text">I accept the terms and conditions and I have read the privacy policy</label>
    
                        </div>
                    </div>
                    
                    
                    
                    </div><button class="input-field button" type='submit' name="submitbtn">
                        <span class="btnText">Register Account</span>
                    </button>


                    </div> <!--End Checkpoint -->
                    <div class="login-reg">
                        <span class="text">Already have an account? 
                            <a href="student_login.php" class="text signup-link">Login</a>
                        </span>
                    </div>
                </div>
                </div>
            </div>
            

        </form>

        
    </div>

    <script>
        $(document).ready(function(){   

            

            $('#roles').change(function(){
                var roles = $('#roles :selected').text();

                if (roles == "Student"){
                    document.getElementById("department").disabled = true;
                    document.getElementById("department").value = "";
                    document.getElementById("section").disabled = false;
                    document.getElementById("grade").disabled = false;
                } else{
                    document.getElementById("section").disabled = true;
                    document.getElementById("section").value = "";
                    document.getElementById("grade").disabled = true;
                    document.getElementById("grade").value = "";
                    document.getElementById("department").disabled = false;
                }

            });

        });

    </script>
   
   
</body>
</html>
