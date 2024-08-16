<?php
    
    @include 'include\config.php';

    session_start();

    if(!isset($_SESSION['id'])){
        header('location:login_admin.php');
    }

    if(!isset($_SESSION['unarchiveid'])){
        header('location:admin.php');
    }


    if(isset($_GET['unarchiveid'])){

        $id = $_GET['unarchiveid'];

        $sql = "INSERT INTO user_vaccine SELECT * FROM archive WHERE userid = $id";

        $sql2 = "DELETE FROM archive WHERE userid = $id";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        if ($result) {
            header("Location: user_archive.php?status=success&action=unarchive");
        }else {
            header("Location: user_archive.php?status=error&action=unarchive");
        }

    }else {
            header("Location: user_archive.php?");
    }