<?php

    @include 'include\config.php'; 


    session_start();
    
    if(!isset($_SESSION['id'])){
        header('location:login_admin.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="shortcut icon" type="image/png" href="image/OKLogo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/lightpick.css">
    <!-- SweetAlert2 -->
    <script type="text/javascript" src='../files/bower_components/sweetalert/js/sweetalert2.all.min.js'> </script>
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href='../files/bower_components/sweetalert/css/sweetalert2.min.css' media="screen" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
</head>


<body style="background-color: #cbebf6;">
    <?php @include 'include\header.php'; ?>

    <div class="contaier-fluid rounded shadow" style="background:#fff; margin-left: 30%; margin-right: 30%; margin-top: 5%;">
        <div class="row">
                <div class="tab-content" id="nav-tabContent">
                        <h1 class="text-center mt-5" style="color: #024059; font-weight: 900;" id="textChange">CHANGE PASSWORD</h1>
                        <hr>
                            <form class="ml-4 mr-4" method="post">
                            
                            <div class="form-group">
                                <label for="oldPassword">Old Password</label>
                                <input type="password" name="old" class="form-control" id="oldPassword" placeholder="Old password">
                            </div>

                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" name="new" class="form-control" id="newPassword" placeholder="New password">
                            </div>
                            
                            <div class="form-group">
                                <label for="confirm">Confirm Password</label>
                                <input type="password" name="confirm" class="form-control" id="confirm" placeholder="Confirm Password">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm col-4 mt-2 p-2" name="btnsubmit" style="float: right">Change Password</button>
                            </div>
                            </form>
                            <a href="admin.php"><button class="btn btn-danger btn-sm col-2 mb-3 ml-2 mt-2 mr-3 p-2" style="float: right">Cancel</button></a>
                        
                </div>
        </div>

    </div>


    <?php
        if(isset($_POST['btnsubmit'])){

            $old = md5($_POST['old']);
            $new = md5($_POST['new']);
            $confirm = md5($_POST['confirm']);
            $id = $_SESSION['id'];

            $sql = "SELECT * FROM admin_login WHERE id = $id";

            $result = mysqli_query($conn, $sql);

            if($result){
                while($row = mysqli_fetch_assoc($result)){

                    if($row['password'] != $old) {
                        echo '<script> window.location.href="admin.php?status=error&action=password&errorid=1"; </script>';
                    }

                    $userid = $row['id'];

                    if($new != $confirm){
                        echo '<script> window.location.href="admin.php?status=error&action=password&errorid=2"; </script>';
                    }

                    if(strlen($new) < 8){
                        echo '<script> window.location.href="admin.php?status=error&action=password&errorid=3"; </script>';
                    }

                    $sql1 = "UPDATE admin_login SET password = '$new' WHERE id = $userid";

                    $result = mysqli_query($conn, $sql1);
                    
                    if($result){
                        echo '<script> window.location.href="admin.php?status=success&action=password"; </script>';
                    }
                }
            }
        }
    ?>

</body>
</html>