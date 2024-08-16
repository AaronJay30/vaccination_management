<?php 
    @include 'include\config.php'; 

    session_start();

    if(!isset($_SESSION['id'])){
        header('location:student_login.php');
    }
    $userid = $_SESSION['id'];
    $sql = "SELECT * FROM user_login WHERE user_login_id = $userid";
    $result = mysqli_query($conn, $sql);

    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $gender = $row['name'];
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="shortcut icon" type="image/png" href="image/OKLogo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
     <!-- SweetAlert2 -->
     <script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
    <style>
        /* Google Font Link */
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Poppins" , sans-serif;
            }
            .sidebar{
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                width: 78px;
                background: #024059;
                padding: 6px 14px;
                z-index: 99;
                transition: all 0.5s ease;
            }
            .sidebar.open{
                width: 300px;
            }
            .sidebar .logo-details{
                height: 60px;
                display: flex;
                align-items: center;
                position: relative;
            }
            .sidebar .logo-details .icon{
                opacity: 0;
                transition: all 0.5s ease;
            }
            .sidebar .logo-details .logo_name{
                color: #fff;
                font-size: 20px;
                line-height: 18px;
                font-weight: 600;
                opacity: 0;
                transition: all 0.5s ease;
            }
            .sidebar.open .logo-details .icon,
            .sidebar.open .logo-details .logo_name{
                opacity: 1;
            }
            .sidebar .logo-details #btn{
                position: absolute;
                top: 50%;
                right: 0;
                transform: translateY(-50%);
                font-size: 22px;
                transition: all 0.4s ease;
                font-size: 23px;
                text-align: center;
                cursor: pointer;
                transition: all 0.5s ease;
            }
            .sidebar.open .logo-details #btn{
                text-align: right;
            }
            .sidebar i{
                color: #fff;
                height: 60px;
                min-width: 50px;
                font-size: 28px;
                text-align: center;
                line-height: 60px;
            }
            .sidebar .nav-list{
                margin-top: 20px;
                height: 100%;
            }
            .sidebar li{
                position: relative;
                margin: 8px 0;
                list-style: none;
            }
            .sidebar li .tooltip{
                position: absolute;
                top: -20px;
                left: calc(100% + 15px);
                z-index: 3;
                background: #fff;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
                padding: 6px 12px;
                border-radius: 4px;
                font-size: 15px;
                font-weight: 400;
                opacity: 0;
                white-space: nowrap;
                pointer-events: none;
                transition: 0s;
            }
            .sidebar li:hover .tooltip{
                opacity: 1;
                pointer-events: auto;
                transition: all 0.4s ease;
                top: 50%;
                transform: translateY(-50%);
            }
            .sidebar.open li .tooltip{
                display: none;
            }
            .sidebar input{
                font-size: 15px;
                color: #FFF;
                font-weight: 400;
                outline: none;
                height: 50px;
                width: 100%;
                width: 50px;
                border: none;
                border-radius: 12px;
                transition: all 0.5s ease;
                background: #1d1b31;
            }
            .sidebar.open input{
                padding: 0 20px 0 50px;
                width: 100%;
            }
            .sidebar .bx-search{
                position: absolute;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                font-size: 22px;
                background: #1d1b31;
                color: #FFF;
            }
            .sidebar li a{
                display: flex;
                height: 100%;
                width: 100%;
                border-radius: 12px;
                align-items: center;
                text-decoration: none;
                transition: all 0.4s ease;
                background: #024059;
            }
            .sidebar li a:hover{
                background: #FFF;
            }
            .sidebar li a .links_name{
                color: #fff;
                font-size: 15px;
                font-weight: 400;
                white-space: nowrap;
                opacity: 0;
                pointer-events: none;
                transition: 0.4s;
            }
            .sidebar.open li a .links_name{
                opacity: 1;
                pointer-events: auto;
            }
            .sidebar li a:hover .links_name,
            .sidebar li a:hover i{
                transition: all 0.5s ease;
                color: #11101D;
            }
            .sidebar li i{
                height: 50px;
                line-height: 50px;
                font-size: 18px;
                border-radius: 12px;
            }
            .sidebar li.profile{
                position: fixed;
                height: 60px;
                width: 78px;
                left: 0;
                bottom: -8px;
                padding: 10px 14px;
                background: #1d1b31;
                transition: all 0.5s ease;
                overflow: hidden;
            }
            .sidebar.open li.profile{
                width: 300px;
                height: 70px;
            }
            .sidebar li .profile-details{
                display: flex;
                align-items: center;
                flex-wrap: nowrap;
            }
            .sidebar li img{
                height: 45px;
                width: 45px;
                object-fit: cover;
                border-radius: 6px;
                margin-right: 10px;
            }
            .sidebar li.profile .name,
            .sidebar li.profile .job{
                font-size: 15px;
                font-weight: 400;
                color: #fff;
                white-space: nowrap;
            }
            .sidebar li.profile .job{
                font-size: 12px;
            }
            .sidebar .profile #log_out{
                position: absolute;
                top: 50%;
                right: 0;
                transform: translateY(-50%);
                background: #1d1b31;
                width: 100%;
                height: 60px;
                line-height: 60px;
                border-radius: 0px;
                transition: all 0.5s ease;
            }
            .sidebar.open .profile #log_out{
                width: 50px;
                background: none;
            }
            .sidebar.open ~ .home-section{
                left: 250px;
                width: calc(100% - 250px);
            }
            .sidebar .profile #log_out:hover{
                color: #fff;
            }
            section{
                position: relative;
                background: #cbebf6;
                min-height: 100vh;
                top: 0;
                left: 78px;
                width: calc(100% - 78px);
                transition: all 0.5s ease;
            }
            /* =================== Form Page =================== */
        
        .container{
            max-width: 1400px;
            width: 80%;
            border-radius: 6px;
            padding: 30px;
            margin: 0 15px;
            background-color: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transform: translate(-50%,-50%);
            position: absolute;
            left: 50%;
            top: 50%;
        }
        /*  Sign Up text  */
        h2{
            font-size: 40px;
            font-weight: 900;
            color: #024059;
        }
        /* ===== grey bg form ===== */
        .container form{
            position: relative;
            min-height: 490px;
            margin-top: 16px;
            background-color: #fff;
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
        /*  boxes 4 columned */
        form .fields .input-field1{
            display: flex;
            width: calc(100% /2 - 15px);
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
        /* inside boxes 4 columns (inputs hinted) */
        .input-field1 input{
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
        .left-side{
            border-right: 1px solid rgba(0,0,0,0.1);
        }
        /*  roles display */
        form .fields .input-field3{
            display: flex;
            width: calc(100% / 2 - 15px);
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

        .left-side button{
            background: #fff;
            transition: 0.6s;
        }

        .left-side .active{
            background: #cbebf6;
            transition: 0.6s;

        }

        .left-side button:hover{
            background: #cbebf6;
            transition: 0.6s;

        }

        .right-side h2{
            font-size: 40px;
            font-weight: 900;
            color: #024059;
        }

        .right-side .password input{

            width: calc(50% - 15px);
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




            @media (max-width: 420px) {
                .sidebar li .tooltip{
                    display: none;
                }
            }
    </style>

    <style media="screen">
        .upload{
        width: 240px;
        position: relative;
        margin: auto;
        text-align: center;
        }
        .upload img{
        border-radius: 50%;
        border: 8px solid #DCDCDC;
        width: 225px;
        height: 225px;
        }
        .upload .rightRound{
        position: absolute;
        bottom: 0;
        right: 0;
        background: #00B4FF;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        }
        .upload .leftRound{
        position: absolute;
        bottom: 0;
        left: 0;
        background: red;
        width: 32px;
        height: 32px;
        line-height: 33px;
        text-align: center;
        border-radius: 50%;
        overflow: hidden;
        cursor: pointer;
        }
        .upload .fa{
        color: white;
        }
        .upload input{
        position: absolute;
        transform: scale(2);
        opacity: 0;
        }
        .upload input::-webkit-file-upload-button, .upload input[type=submit]{
        cursor: pointer;
        }
    </style>
</head>

<body>
    <?php @include 'include\sidebar-nav.php'; ?>

                                    
    <?php
        $userid = $_SESSION['id'];
        $sql = "SELECT * FROM user_login WHERE user_login_id = $userid";
        $result = mysqli_query($conn, $sql);

        if ($result){
            while($row = mysqli_fetch_assoc($result)){
                $name = $row['name'];
                $gender = $row['gender'];
                $birthday = $row['birthday'];
                $address = $row['address'];
                $email = $row['email'];
                $contact = $row['contact'];
                $profile = $row['profile'];
            }
        }

    ?>

    <section>
        <div class="container"> <!-- .container -->
            <div class="row">
                <div class="col-3 pt-4 left-side">
                    <button type="button" class="btn btn-lg btn-block active" id="accountBtn">Account Setting</button>
                    <button type="button" class="btn btn-lg btn-block" id="passwordBtn">Change Password</button>
                </div>
                
                <div class="col-9 pt-4 right-side">

                    <form class="form" id = "form" action="student_setting-update.php" enctype="multipart/form-data" method="post">
                        <div class="account" id="accountSetting">
                            
                        </div>

                        <div class="password" id="passwordSetting">
                            

                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <script>
        $(document).ready(function(){

                document.getElementById("accountSetting").innerHTML = `
                    <h2>GENERAL INFORMATION</h2>
                            <hr>

                            <div class="upload">
                                <img src="image/avatar/<?php echo $profile ?>" id = "image">

                                <div class="rightRound" id = "upload">
                                    <input type="file" name="file" id = "fileImg" accept=".jpg, .jpeg, .png">
                                    <i class = "fa fa-camera" style="color: #fff;"></i>
                                </div>

                                <div class="leftRound" id = "cancel" style = "display: none;">
                                    <i class = "fa fa-times"></i>
                                </div>

                                <div class="rightRound" id = "confirm" style = "display: none;">
                                    
                                </div>
                            </div>

                            <div class="form first pb-3"> <!-- .form -->
                                <div class="details personal">
                                    <div class="fields"> <!-- .fields -->
                                        

                                        <!-- 1st Row -->
                                        <div class="input-field1">
                                            <input type="text" placeholder="Enter Full Name" required name="name" autocomplete="off" style="width: 100%;" value="<?php echo $name ?>">
                                        </div>

                                        <!-- 2nd Row -->
                                        <div class="input-field3">
                                            <select required id="gender" name="gender" style="width: 100%;">
                                                <option disabled selected >Gender</option>
                                                <option value="Male" <?php if($gender == "Male") { echo "Selected"; } ?> >Male</option>
                                                <option value="Female" <?php if($gender == "Female") { echo "Selected"; } ?>>Female</option>
                                            </select>
                                        </div>

                                        <br>

                                        <div class="input-field">
                                            <input type="date" placeholder="Birthday" required name="birthday" value="<?php echo $birthday ?>">
                                        </div>

                                        <div class="input-field">
                                            <input type="text" placeholder="Barangay" required name="address" autocomplete="off" value="<?php echo $address ?>">
                                        </div>

                                        <!-- 3rd Row -->
                                        <div class="input-field2">
                                            <input type="text" placeholder="Email" required name="email" autocomplete="off" value="<?php echo $email ?>">
                                        </div>

                                        <div class="input-field2">
                                            <input type="number" placeholder="Contact Number" required name="contact" value="<?php echo $contact ?>">
                                        </div>

                                        <br>
                                        <div id="submitBtn" style="display:none;"><button class="input-field button float-right px-4" type='submit' name="accountBtn">
                                                <span class="btnText">Save Changes</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                `;

                document.getElementById("fileImg").onchange = function(){
                    document.getElementById("image").src = URL.createObjectURL(fileImg.files[0]); // Preview new image

                    document.getElementById("cancel").style.display = "block";
                    document.getElementById("confirm").style.display = "none";

                    document.getElementById("upload").style.display = "none";
                }

                var userImage = document.getElementById('image').src;

                document.getElementById("cancel").onclick = function(){
                    document.getElementById("image").src = userImage; // Back to previous image
                    document.getElementById("submitBtn").style.display = "none";

                    document.getElementById("cancel").style.display = "none";
                    document.getElementById("confirm").style.display = "none";

                    document.getElementById("upload").style.display = "block";
                }
            
            
                $("#accountBtn").click(function(){
                document.getElementById("passwordBtn").classList.remove("active");
                document.getElementById("accountBtn").classList.add("active");


                document.getElementById("accountSetting").innerHTML = `
                <h2>GENERAL INFORMATION</h2>
                            <hr>

                            <div class="upload">
                                <img src="image/avatar/<?php echo $profile ?>" id = "image">

                                <div class="rightRound" id = "upload">
                                    <input type="file" name="file" id = "fileImg" accept=".jpg, .jpeg, .png">
                                    <i class = "fa fa-camera" style="color: #fff;"></i>
                                </div>

                                <div class="leftRound" id = "cancel" style = "display: none;">
                                    <i class = "fa fa-times"></i>
                                </div>

                                <div class="rightRound" id = "confirm" style = "display: none;">
                                    
                                </div>
                            </div>

                            <div class="form first pb-3"> <!-- .form -->
                                <div class="details personal">
                                    <div class="fields"> <!-- .fields -->
                                        

                                        <!-- 1st Row -->
                                        <div class="input-field1">
                                            <input type="text" placeholder="Enter Full Name" required name="name" autocomplete="off" style="width: 100%;" value="<?php echo $name ?>">
                                        </div>

                                        <!-- 2nd Row -->
                                        <div class="input-field3">
                                            <select required id="gender" name="gender" style="width: 100%;">
                                                <option disabled selected >Gender</option>
                                                <option value="Male" <?php if($gender == "Male") { echo "Selected"; } ?> >Male</option>
                                                <option value="Female" <?php if($gender == "Female") { echo "Selected"; } ?>>Female</option>
                                            </select>
                                        </div>

                                        <br>

                                        <div class="input-field">
                                            <input type="date" placeholder="Birthday" required name="birthday" value="<?php echo $birthday ?>">
                                        </div>

                                        <div class="input-field">
                                            <input type="text" placeholder="Barangay" required name="address" autocomplete="off" value="<?php echo $address ?>">
                                        </div>

                                        <!-- 3rd Row -->
                                        <div class="input-field2">
                                            <input type="text" placeholder="Email" required name="email" autocomplete="off" value="<?php echo $email ?>">
                                        </div>

                                        <div class="input-field2">
                                            <input type="number" placeholder="Contact Number" required name="contact" value="<?php echo $contact ?>">
                                        </div>

                                        <br>
                                        <div id="submitBtn" style="display:none;"><button class="input-field button float-right px-4" type='submit' name="accountBtn">
                                                <span class="btnText">Save Changes</span>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>`;
                
                document.getElementById("passwordSetting").innerHTML = "";
            });


            $("#passwordBtn").click(function(){
                document.getElementById("accountBtn").classList.remove("active");
                document.getElementById("passwordBtn").classList.add("active");

                document.getElementById("accountSetting").innerHTML = "";
                document.getElementById("passwordSetting").innerHTML = `
                <h2>CHANGE PASSWORD</h2>
                            <hr>
                            <div class="form-password ml-4">
                                <input type="password" name="oldpass" placeholder="Enter password"><br>
                                <input type="password" name="newpass" placeholder="New password"><br>
                                <input type="password" name="conpass" placeholder="Confirm password"><br>
                                
                                <div>
                                    <button class="input-field button float-right px-4" type='submit' name="passwordBtn">
                                        <span class="btnText">Change Password</span>
                                    </button>
                                </div>

                            </div>
                `;
            });

            $("#form :input").change(function() {
                document.getElementById("submitBtn").style.display = "block";
            });
        });


    </script>

    <?php if(isset($_GET['error'])) {
        $error = $_GET['error']; ?>
        <script>
            setTimeout(function () { Swal.fire("Opsss...","<?php echo $error; ?>","error");}, 1000);
        </script>
    <?php } ?>
    
</body>
</html>