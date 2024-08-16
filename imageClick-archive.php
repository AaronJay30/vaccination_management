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
    <title>Vaccine Card Picture</title>
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
</head>

<body style="background-color: #cbebf6;">

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner pl-5 pr-5">
            <?php
                $uid = $_GET['uid'];

                $sql = "SELECT * FROM archive WHERE userid = $uid";
                $result = mysqli_query($conn, $sql); 

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        if($row['boosterCard'] == NULL) {
                            $vaccineCard = $row['vaccineCard']; ?>
                            
                            <h1 class="text-center pt-3 pb-3 pt-5" style="color: #024059; font-weight: 900; " id="textChange">VACCINE CARD PHOTO</h1>
                            <div class="carousel-item active">
                                <h2>Vaccine Card</h2>
                                <img class="d-block rounded float-left" src="image\vaccine_card\<?= $vaccineCard ?>" alt="Vaccine Card" style="width:50%">
                            </div>

                        <?php } else{
                            $vaccineCard = $row['vaccineCard'];
                            $boosterCard = $row['boosterCard']; ?>

                            <h1 class="text-center pt-3 pb-3 pt-5" style="color: #024059; font-weight: 900; " id="textChange">VACCINE CARD PHOTO</h1>
                            <div class="carousel-item active">
                                <h2 class="">Vaccine Card</h2>
                                <img class="d-block w-40 rounded float-left pr-4" src="image\vaccine_card\<?= $vaccineCard ?>" alt="Vaccine Card" style="width:50%">
                            </div>
                            <div class="carousel-item active">
                                <h2 class="float-right">Booster Card</h2><br><br>
                                <img class="d-block w-40 rounded float-right pl-4" src="image\booster_card\<?= $boosterCard ?>" alt="Booster Card "style="width:50%">
                            <?php
                        }
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>