<?php
    
    @include 'include\config.php';

    session_start();

    if(!isset($_SESSION['archiveid'])){
        header('location:admin.php');
    }


    if(isset($_GET['archiveid'])){

        $id = $_GET['archiveid'];

        $sql = "INSERT INTO archive SELECT * FROM user_vaccine WHERE userid = $id";
        $sql2 = "DELETE FROM user_vaccine WHERE userid = $id";

        $result = mysqli_query($conn, $sql);
        $result2 = mysqli_query($conn, $sql2);

        if ($result) {
            header("Location: admin.php?status=success&action=archive");
        }else {
            header("Location: admin.php?status=error&action=archive");
        }

    }else {
            header("Location:admin.php?");
    }