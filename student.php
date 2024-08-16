<?php 
    @include 'include\config.php'; 

    session_start();

    if(!isset($_SESSION['id'])){
        header('location:student_login.php');
    }

    function current_url()
    {
        $url = $_SERVER["REQUEST_URI"];
        $trimUrl = trim($url, " /Scrum/");
        $validURL = str_replace("&", "&amp;", $trimUrl);
        return $validURL;
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
            .home-section{
                position: relative;
                background: #E4E9F7;
                min-height: 100vh;
                top: 0;
                left: 78px;
                width: calc(100% - 78px);
                transition: all 0.5s ease;
            }
            
            .home-section .home-title{
                color: #024059; 
                font-weight: 900;
                position: relative;
                top: 40px;
                font-size: 3rem;
            }

            .home-section .home-col-top-content{
                position: relative;
                background: #fff;
                min-height: 30vh;
                top: 100px;
                left: 78px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width: calc(100% - 78px - 78px);
                border-radius: 60px;
                transition: all 0.5s ease;
                z-index: 3;
            }

            .home-section .home-col-top-title{
                background: #024059;
                position: absolute;
                top: 13vh;
                left: 78px;
                min-height: 30vh;
                border-radius: 60px;
                width: calc(24% + 78px + 78px);
            }

            .home-section .home-col-top-title h2{
                color: #fff; 
                font-weight: 900;
                padding-top: 10px;
                font-size: 3vh;
                text-align: center;
            }

            .home-col-bot{
                display: none;
            }

           .active{
                display: block;
            }

            .home-section .home-col-bot-content{
                position: relative;
                background: #fff;
                min-height: 35vh;
                margin-top: 9%;
                left: 78px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width: calc(100% - 78px - 78px);
                border-radius: 60px;
                transition: all 0.5s ease;
            }
            .home-section .home-col-bot-title{
                background: #024059;
                position: absolute;
                top: 51%;
                left: 78px;
                min-height: 14vh;
                border-radius: 60px;
                width: calc(24% + 78px + 78px);

            }
            .home-section .home-col-bot-title h2{
                color: #fff; 
                font-weight: 900;
                padding-top: 5px;
                font-size: 4vh;
                text-align: center;
            }

            .fa-solid, .fas{
                color: #fff;
            }

            .home-section .home-col-bot-title h2 a{
                text-decoration: none;
            }

            @media (max-width: 420px) {
                .sidebar li .tooltip{
                    display: none;
                }
            }
    </style>
</head>

<body>
    <?php @include 'include\sidebar-nav.php'; ?>
    
    <section class="home-section" style="background-color: #cbebf6;">
        <h1 class="home-title text-center">STUDENT INFORMATION</h1>
        
        
        <div class="home-col-top">
            <br>

            <?php

                $userid = $_SESSION['id'];
                $sql = "SELECT * FROM user_vaccine INNER JOIN user_login ON user_vaccine.userid = user_login.user_login_id WHERE user_login.user_login_id = $userid";
                $result = mysqli_query($conn, $sql);

                if($result){
                    while($row = mysqli_fetch_assoc($result)){
                        $name = $row['name'];
                        $birthday = $row['birthday'];
                        $vaccineCardNumber = $row['vaccineCardNumber'];
                        $boosterCardImg = $row['boosterCard'];
                        $vaccineCardImg = $row['vaccineCard'];
                        $philhealth = $row['philhealth'];
                        $address = $row['address'];
                        $category = $row['category'];
                        $contact = $row['contact'];
                        $firstDoseid = $row['firstDoseid'];
                        $secondDoseid = $row['secondDoseid'];
                        $boosterDoseid = $row['boosterDoseid'];
                        $facilityName = $row["facilityName"];
                        $facilityContact = $row["facilityContact"];

                        if($firstDoseid != NULL){
                            $sql_firstDose = "SELECT * FROM first_dose WHERE userid = $userid";
                            $result_first = mysqli_query($conn, $sql_firstDose);
                            if($result_first){
                                while($row_first = mysqli_fetch_assoc($result_first)){
                                    $vaccineDateFirst = $row_first["date"];
                                    $manufacturerFirst = $row_first["manufacturer"];
                                    $batchFirst = $row_first["batchNumber"];
                                    $lotFirst = $row_first["lotNumber"];
                                    $vaccinatorFirst = $row_first["vaccinatorName"];
                                }
                            }
                        } else{
                            $vaccineDateFirst = NULL;
                            $manufacturerFirst = NULL;
                            $batchFirst = NULL;
                            $lotFirst = NULL;
                            $vaccinatorFirst = NULL;
                        }
            
                        if($secondDoseid != NULL){
                            $sql_secondDose = "SELECT * FROM second_dose WHERE userid = $userid";
                            $result_second = mysqli_query($conn, $sql_secondDose);
                            if($result_second){
                                while($row_second = mysqli_fetch_assoc($result_second)){
                                    $vaccineDateSecond = $row_second["date"];
                                    $manufacturerSecond= $row_second["manufacturer"];
                                    $batchSecond = $row_second["batchNumber"];
                                    $lotSecond = $row_second["lotNumber"];
                                    $vaccinatorSecond = $row_second["vaccinatorName"];
                                }
                            }
                        } else{
                            $vaccineDateSecond = NULL;
                            $manufacturerSecond= NULL;
                            $batchSecond = NULL;
                            $lotSecond = NULL;
                            $vaccinatorSecond = NULL;
                        }
            
                        if($boosterDoseid != NULL){
                            $sql_boosterDose = "SELECT * FROM booster_dose WHERE userid = $userid";
                            $result_booster = mysqli_query($conn, $sql_boosterDose);
                            if($result_booster){
                                while($row_booster = mysqli_fetch_assoc($result_booster)){
                                    $vaccineDateBooster = $row_booster["date"];
                                    $manufacturerBooster= $row_booster["manufacturer"];
                                    $batchBooster = $row_booster["batchNumber"];
                                    $lotBooster = $row_booster["lotNumber"];
                                    $vaccinatorBooster = $row_booster["vaccinatorName"];
                                }
                            }
                        } else{
                            $vaccineDateBooster = NULL;
                            $manufacturerBooster= NULL;
                            $batchBooster = NULL;
                            $lotBooster = NULL;
                            $vaccinatorBooster = NULL;
                        }


                        $status = "";

                        if($firstDoseid == NULL && $secondDoseid  == NULL && $boosterDoseid == NULL){
                            $status = "Not Vaccinated";
                        } else if($firstDoseid != NULL && $manufacturerFirst == "Jansen" && $secondDoseid == NULL && $boosterDoseid == NULL){
                            $status = "One Dose Vaccination";
                        } else if($firstDoseid != NULL && $secondDoseid == NULL && $boosterDoseid == NULL){
                            $status = "Half Vaccinated";
                        } else if($firstDoseid != NULL && $secondDoseid != NULL && $boosterDoseid == NULL){
                            $status = "Fully Vaccinated";
                        } else if($firstDoseid != NULL && $secondDoseid != NULL && $boosterDoseid != NULL){
                            $status = "Fully Vaccinated with Booster";
                        }


                    }
                }

            ?>
            <div class="home-col-top-title">
                <h2 >VACCINE INFORMATION</h2>
            </div>
            <div class="home-col-top-content">
                <div class="row ml-5">
                    <div class="col-6 ml-5 mt-5" style="margin-left: 30px;">
                        <h4 style="color: #024059"><span class="font-weight-bold">Name: </span><?php echo $name; ?></h4>
                    </div>
                    <div class="col-5 ml-5 mt-5">
                        <h4 style="color: #024059"><span class="font-weight-bold">Vaccine Card Number: </span><?php echo $vaccineCardNumber; ?></h4>
                    </div>
                </div>
                <div class="row ml-5">
                    <div class="col-6 ml-5 mt-4" style="margin-left: 30px;">
                        <h4 style="color: #024059"><span class="font-weight-bold">Birthday: </span><?php echo $birthday; ?></h4>
                    </div>
                    <div class="col-5 ml-5 mt-4">
                        <h4 style="color: #024059"><span class="font-weight-bold">Phil-Health Number: </span><?php echo $philhealth; ?></h4>
                    </div>
                </div>
                <div class="row ml-5">
                    <div class="col-6 ml-5 mt-4" style="margin-left: 30px;">
                        <h4 style="color: #024059"><span class="font-weight-bold">Address: </span><?php echo $address; ?></h4>
                    </div>
                    <div class="col-5 ml-5 mt-4">
                        <h4 style="color: #024059"><span class="font-weight-bold">Category: </span><?php echo $category; ?></h4>
                    </div>
                </div>
                <div class="row ml-5">
                    <div class="col-6 ml-5 mt-4" style="margin-left: 30px;">
                        <h4 style="color: #024059"><span class="font-weight-bold">Contact: </span><?php echo $contact; ?></h4>
                    </div>
                    <div class="col-5 ml-5 mt-4" style="margin-left: 30px;">
                        <h4 style="color: #024059"><span class="font-weight-bold">Status of Vaccination: </span><?php echo $status; ?></h4>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="home-col-bot active" id="first">
            <br>
            <div class="home-col-bot-title">
            
                <h2 ><button class="btn float-left ml-5" id="btnl1"><i class="fa-solid fa-caret-left" style="font-size:45px"></i></button> FIRST DOSE <button class="btn float-right mr-5" id="btnr1"><i class="fa-solid fa-caret-right" style="font-size:45px"></i></button></h2>
            </div>
            
            <div class="home-col-bot-content">
                <div class="row">
                    <div class="col-4 text-center mt-4 mb-4 mr-2 ml-5">
                        <img src="image/vaccine.png" class="" style="width: 36vh;">
                    </div>
                    <div class="col-7 mt-3">
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Date: </span><?php echo $vaccineDateFirst ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Manufacturer: </span><?php echo $manufacturerFirst ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Batch Number: </span><?php echo $batchFirst ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Lot Number: </span><?php echo $lotFirst ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Vaccinator Name: </span><?php echo $vaccinatorFirst ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Name: </span><?php echo $facilityName ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Contact: </span><?php echo $facilityContact ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold"><?php if($firstDoseid != NULL) { echo "<a href='student_image-vaccine.php'>Click Here for Vaccine Card Image</a> </span> <a href='student_update.php?fdid=".$firstDoseid."'><button type='button' class='btn btn-lg btn-primary float-right' style='margin-top: -10px; background: #024059; border-radius: 10px; width: 10vw'>Update</button></a>"; } ?></h4>
                    </div>
                </div>
                
            </div>
        </div>

        <div class="home-col-bot" id="second">
            <br>
            <div class="home-col-bot-title">
            
                <h2 ><button class="btn float-left ml-5" id="btnl2"><i class="fa-solid fa-caret-left" style="font-size:45px"></i></button>SECOND DOSE <button class="btn float-right mr-5" id="btnr2"><i class="fa-solid fa-caret-right" style="font-size:45px"></i></button></h2>
            </div>
            
            <div class="home-col-bot-content">
                <div class="row">
                    <div class="col-4 text-center mt-4 mb-4 mr-2 ml-5">
                        <img src="image/vaccine.png" class="" style="width: 36vh;">
                    </div>
                    <div class="col-7 mt-3">
                    <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Date: </span><?php echo $vaccineDateSecond ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Manufacturer: </span><?php echo $manufacturerSecond ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Batch Number: </span><?php echo $batchSecond ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Lot Number: </span><?php echo $lotSecond ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Vaccinator Name: </span><?php echo $vaccinatorSecond ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Name: </span><?php if($secondDoseid != NULL) {echo $facilityName; } else { echo "";} ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Contact: </span><?php if($secondDoseid != NULL) {echo $facilityContact; } else { echo "";} ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold"><?php if($secondDoseid != NULL) { echo "<a href='student_update.php?sdid=".$secondDoseid."'><button type='button' class='btn btn-lg btn-primary float-right' style='margin-top: -10px; background: #024059; border-radius: 10px; width: 10vw'>Update</button></a>"; } ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-col-bot" id="booster">
            <br>
            <div class="home-col-bot-title">
            
                <h2 ><button class="btn float-left ml-5" id="btnl3"><i class="fa-solid fa-caret-left" style="font-size:45px"></i></button>BOOSTER DOSE <button class="btn float-right mr-5" id="btnr3"><i class="fa-solid fa-caret-right" style="font-size:45px"></i></button></h2>
            </div>
            
            <div class="home-col-bot-content">
                <div class="row">
                    <div class="col-4 text-center mt-4 mb-4 mr-2 ml-5">
                        <img src="image/vaccine.png" class="" style="width: 36vh;">
                    </div>
                    <div class="col-7 mt-3">
                    <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Date: </span><?php echo $vaccineDateBooster ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Manufacturer: </span><?php echo $manufacturerBooster ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Batch Number: </span><?php echo $batchBooster ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Lot Number: </span><?php echo $lotBooster ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Vaccinator Name: </span><?php echo $vaccinatorBooster ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Name: </span><?php if($boosterDoseid != NULL) {echo $facilityName; } else { echo "";}  ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold">Health Facility Contact: </span><?php if($boosterDoseid != NULL) {echo $facilityContact; } else { echo "";} ?></h4>
                        <h4 style="color: #024059" class="mt-3"><span class="font-weight-bold"><?php if($boosterDoseid != NULL) { echo "<a href='student_image-booster.php'>Click Here for Vaccine Card Image</a> </span> <a href='student_update.php?bdid=".$boosterDoseid."'><button type='button' class='btn btn-lg btn-primary float-right' style='margin-top: -10px; background: #024059; border-radius: 10px; width: 10vw'>Update</button></a>"; } ?></h4>                    
                    </div>
                </div>
            </div>
        </div>

    </section>
  
    <script>
        let sidebar = document.querySelector(".sidebar");
        let closeBtn = document.querySelector("#btn");

        closeBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("open");
            menuBtnChange();//calling the function(optional)
        });


        // following are the code to change sidebar button(optional)
        function menuBtnChange() {
        if(sidebar.classList.contains("open")){
            closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");//replacing the iocns class
        }else {
            closeBtn.classList.replace("bx-menu-alt-right","bx-menu");//replacing the iocns class
        }
        }
    </script>

    <?php if(isset($_GET['success'])) {
        $success = $_GET['success']; ?>
        <script>
            setTimeout(function () { Swal.fire("Success","<?php echo $success; ?>","success");}, 1000);
        </script>
    <?php } ?>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#btnl1').click(function(){

                document.getElementById('first').classList.remove("active");
                document.getElementById('booster').classList.add("active");
            });

            $('#btnr1').click(function(){

                document.getElementById('first').classList.remove("active");
                document.getElementById('second').classList.add("active");
            });

            $('#btnl2').click(function(){

                document.getElementById('second').classList.remove("active");
                document.getElementById('first').classList.add("active");
            });

            $('#btnr2').click(function(){

                document.getElementById('second').classList.remove("active");
                document.getElementById('booster').classList.add("active");
            });

            $('#btnl3').click(function(){

                document.getElementById('booster').classList.remove("active");
                document.getElementById('second').classList.add("active");
            });

            $('#btnr3').click(function(){

                document.getElementById('booster').classList.remove("active");
                document.getElementById('first').classList.add("active");
            });
        });

    </script>

</body>
</html>
