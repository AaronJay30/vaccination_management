<?php

    @include 'include\config.php';

    session_start();

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
    <link rel="stylesheet" href="css/style.css">        

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


</head>

<body style="background-color: #cbebf6;">

    <div class="row no-gutters">
        <div class="col-md-6 no-gutters">
            <div class="leftside p-5">
                <img src="image/OKLogo.gif" class='img-fluid' alt="">
            </div>
        </div>
        <div class="col-md-6 no-gutters">
            <div class="rightside">

                <h1 class="text-center pt-5" style="color: #fff; font-weight: 900; font-size: 80px;">LOGIN AS</h1>
                <hr style="background:#fff">
                
                <div class="container-fluid text-center" style="height: 80%; padding-top: 25%">
                        <div class="col">
                            <a href="student_login.php"><button type="button" class="btn btn-light text-center" style="font-size:2vw; width:50%; color:#024059; font-weight: 500;">Student/Faculty</button></a>
                        </div>
                        <div class="col mt-5">
                            <a href="login_admin.php"><button type="button" class="btn btn-light text-center" style="font-size:2vw; width:50%; color:#024059; font-weight: 500; ">Principal</button></a>
                        </div>
                </div>


                

            </div>
        </div>
    </div>

</body>
</html>
