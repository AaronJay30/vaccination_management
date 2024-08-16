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
                height: 100vh;
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

            .home-section .home-col-top-content .input-form label{
                margin-left: 70px;
                font-size: 20px;
                color: #024059;
            }
            .home-section .home-col-bot-content .input-form label{
                margin-left: 70px;
                font-size: 20px;
                color: #024059;
            }

            .home-section .home-col-top-content .input-form .read-only{
                font-size: 20px;
                color: #024059;
                background: #fff;
                width: 100%;
                border: none;
                padding-top:13px;
                opacity: 0.7;
            }

            .home-section .home-col-top-content .input-form .vaccine-form{
                font-size: 20px;
                color: #024059;
                width: 100%;
                border: 1px solid #024059;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                padding-right: 10px;
                background: #cbebf6;
            }

            .home-section .home-col-bot-content .input-form .vaccine-form{
                font-size: 20px;
                color: #024059;
                border: 1px solid #024059;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                background: #cbebf6;
                width: 100%;
            }

            .home-section .home-col-top-content .input-form .status-form{
                font-size: 18px;
                color: #024059;
                width: 100%;
                border: 1px solid #024059;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                padding-right: 10px;
                background: #cbebf6;
            }

            .home-section .home-col-bot-content .input-form .status-form{
                font-size: 20px;
                color: #024059;
                border: 1px solid #024059;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                background: #cbebf6;
                padding: 4px;
                width: 100%;
            }

            .home-section .home-col-top-title{
                background: #024059;
                position: absolute;
                width: 100%;
                top: 12%;
                left: 78px;
                min-height: 20vh;
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
                margin-top: 10%;
                left: 78px;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                width: calc(100% - 78px - 78px);
                border-radius: 60px;
                transition: all 0.5s ease;
            }
            .home-section .home-col-bot-title{
                background: #024059;
                position: absolute;
                width: 100%;
                top: 51%;
                left: 78px;
                min-height: 20vh;
                border-radius: 60px;
                width: calc(24% + 78px + 78px);

            }
            .home-section .home-col-bot-title h2{
                color: #fff; 
                font-weight: 900;
                padding-top: 5px;
                font-size: 3vh;
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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"  type='text/css'>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

</head>

<body>
    <?php @include 'include\sidebar-nav.php'; ?>
    
    <section class="home-section" style="background-color: #cbebf6;">
        <h1 class="home-title text-center">STUDENT INFORMATION</h1>
        
        <form action="student_vaccine-upload.php" method="POST" enctype="multipart/form-data">
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
                    <div class="form-group row ml-5 pt-3 input-form">
                        
                        <label for="name" class="col-sm-1 col-form-label">Name:</label>
                        <div class="col-sm-3">
                            <input type="text" disabled class="read-only" id="name" value="<?php echo $name; ?>">
                        </div>

                        <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccine Card Number:</label>
                        <div class="col-sm-4">
                            <input type="text" required class="vaccine-form py-1 mt-2 px-3" id="vaccineCardNumber" placeholder="Enter Vaccine Card Number" name="vaccineCardNumber">
                        </div>
                    </div>

                    <div class="form-group row ml-5 input-form">
                        
                        <label for="staticEmail" class="col-sm-1 col-form-label">Address:</label>
                        <div class="col-sm-3">
                            <input type="text" disabled class="read-only" id="staticEmail" value="<?php echo $address; ?>">
                        </div>

                        <label for="inputPassword" class="col-sm-2 col-form-label">Phil-Health Number:</label>
                        <div class="col-sm-4">
                            <input type="text" required name="philhealthNumber" class="vaccine-form py-1 mt-2 px-3" id="inputPassword" placeholder="Enter Phil-Health Number">
                        </div>
                    </div>

                    <div class="form-group row ml-5 input-form">
                        
                        <label for="staticEmail" class="col-sm-1 col-form-label">Birthday:</label>
                        <div class="col-sm-3">
                            <input type="text" disabled class="read-only" id="staticEmail" value="<?php echo $birthday; ?>">
                        </div>

                        <label for="inputPassword" class="col-sm-2 col-form-label">Category:</label>
                        <div class="col-sm-4">
                            <select class="form-control py-1 mt-2 px-3 status-form" id="category" required name="category">
                                <option selected disabled value="NULL">Select category</option>
                                <option value="A1">A1</option>
                                <option value="A2">A2</option>
                                <option value="A3">A3</option>
                                <option value="A4">A4</option>
                                <option value="A5">A5</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row ml-5 input-form">
                        
                        <label for="staticEmail" class="col-sm-1 col-form-label">Contact:</label>
                        <div class="col-sm-3">
                            <input type="text" disabled class="read-only" id="staticEmail" value="<?php echo $contact; ?>">
                        </div>

                        <label for="inputPassword" class="col-sm-2 col-form-label">Status of Vaccination:</label>
                        <div class="col-sm-4">
                            <select class="form-control py-1 mt-2 px-3 status-form" id="status" required name="status">
                                <option selected disabled value="NULL">Select vaccination status</option>
                                <option value="OD">One Dose Vaccination</option>
                                <option value="HV">Half Vaccinated</option>
                                <option value="FV">Fully Vaccinated</option>
                                <option value="FVB">Fully Vaccinated with Booster</option>
                            </select>
                        </div>
                    </div>
                </div>
        
                <div class="home-col-bot active" id="first">
                    <br>
                    
                </div>
                <div class="home-col-bot" id="second">
                    <br>
                    
                </div>

                <div class="home-col-bot" id="booster">
                    <br>
                    
                </div>


            </div>
        </form>
        
        
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

    <script type="text/javascript">
        $(document).ready(function(){

            $status = "";
            
            function bindingFunction(){
                $('#btnl1f').click(function(){
                    document.getElementById('first').classList.remove("active");
                    document.getElementById('second').classList.add("active");
                });
                
                $('#btnr1f').click(function(){
                    document.getElementById('first').classList.remove("active");
                    document.getElementById('second').classList.add("active");
                });

                $('#btnl2f').click(function(){
                    document.getElementById('second').classList.remove("active");
                    document.getElementById('first').classList.add("active");
                });

                $('#btnr2f').click(function(){
                    document.getElementById('second').classList.remove("active");
                    document.getElementById('first').classList.add("active");
                });
            }
            function bindingFunctionB(){
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

            }


            $('#status').change(function(){
                
                var status = $('#status :selected').text();   

                if (status == "One Dose Vaccination") {

                    document.getElementById("first").innerHTML = ""; 
                    document.getElementById("first").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 >FIRST DOSE</h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturer">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Jansen">Jansen</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required name="vaccineDate">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="lot" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="batch" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="vaccinator" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter vaccinator name">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Health Facility Name:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="healthFacility" class="vaccine-form py-1 mt-2 px-3" id="facilityName" required placeholder="Enter health facility name">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Health Facility Contact:</label>
                                <div class="col-sm-3">
                                    <input type="number" name="healthFacilityContact" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter health facility contact">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Vaccine Card Picture:</label>
                                <div class="col-sm-3 mt-3">
                                    <input type="file" name="file" required>
                                </div>
                            </div>` + 
                        `<button type="submit" class="btn btn-primary btn-sm col-5 my-3 ml-5 " name="submitOne" style="font-size: 20px; background: #024059;">Submit</button>` + '</div>';
                } else if (status == "Half Vaccinated"){
                    
                    document.getElementById("first").innerHTML = "";
                    document.getElementById("first").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 >FIRST DOSE</h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturer">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Pfizer">Pfizer</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Sinovac">Sinovac</option>
                                        <option value="Astrazenica">Astrazenica</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required name="vaccineDate">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="lot" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="batch" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="vaccinator" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter vaccinator name">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Health Facility Name:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="healthFacility" class="vaccine-form py-1 mt-2 px-3" id="facilityName" required placeholder="Enter health facility name">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Health Facility Contact:</label>
                                <div class="col-sm-3">
                                    <input type="number" name="healthFacilityContact" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter health facility contact">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Vaccine Card Picture:</label>
                                <div class="col-sm-3 mt-3">
                                    <input type="file" name="file" required>
                                </div>
                            </div>` + 
                        `<button type="submit" class="btn btn-primary btn-sm col-5 my-3 ml-5 " name="submitHalf" style="font-size: 20px; background: #024059;">Submit</button>` + '</div>';
                } else if (status == "Fully Vaccinated"){
                    document.getElementById("first").innerHTML = " ";
                    document.getElementById("first").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 ><button class="btn float-left ml-5" type="button" id="btnl1f"><i class="fa-solid fa-caret-left" style="font-size:3vh"></i></button> FIRST DOSE <button class="btn float-right mr-5" type="button" id="btnr1f"><i class="fa-solid fa-caret-right" style="font-size:3vh"></i></button></h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturerFirst">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Pfizer">Pfizer</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Sinovac">Sinovac</option>
                                        <option value="Astrazenica">Astrazenica</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required name="vaccineDateFirst">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number" name="lotFirst">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number" name="batchFirst">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" name="vaccinatorFirst" id="vaccinator" required placeholder="Enter vaccinator name">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Health Facility Name:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="facilityName" name="healthFacility" required placeholder="Enter health facility name">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Health Facility Contact:</label>
                                <div class="col-sm-3">
                                    <input type="number" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" name="healthFacilityContact" required placeholder="Enter health facility contact">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Vaccine Card Picture:</label>
                                <div class="col-sm-3 mt-3">
                                    <input type="file" name="file" required>
                                </div>
                            </div>
                        </div>`;

                    document.getElementById("second").innerHTML = " ";
                    document.getElementById("second").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 ><button class="btn float-left ml-5" type="button" id="btnl2f"><i class="fa-solid fa-caret-left" style="font-size:3vh"></i></button> SECOND DOSE <button class="btn float-right mr-5" type="button" id="btnr2f"><i class="fa-solid fa-caret-right" style="font-size:3vh"></i></button></h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturerSecond">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Pfizer">Pfizer</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Sinovac">Sinovac</option>
                                        <option value="Astrazenica">Astrazenica</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" name="vaccineDateSecond" required>
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number" name="lotSecond">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number" name="batchSecond">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" name="vaccinatorSecond" id="vaccinator" required placeholder="Enter vaccinator name">
                                </div>
                            </div>` + 
                        `<button type="submit" class="btn btn-primary btn-sm col-5 my-3 ml-5 " name="submitFull" style="font-size: 20px; background: #024059;">Submit</button>` + '</div>';

                        bindingFunction();
                } else if (status == "Fully Vaccinated with Booster"){
                    document.getElementById("first").innerHTML = " ";
                    document.getElementById("first").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 ><button class="btn float-left ml-5" type="button" id="btnl1"><i class="fa-solid fa-caret-left" style="font-size:3vh"></i></button> FIRST DOSE <button class="btn float-right mr-5" type="button" id="btnr1"><i class="fa-solid fa-caret-right" style="font-size:3vh"></i></button></h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturerFirst">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Pfizer">Pfizer</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Sinovac">Sinovac</option>
                                        <option value="Astrazenica">Astrazenica</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required name="vaccineDateFirst">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number" name="lotFirst">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number" name="batchFirst">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter vaccinator name" name="vaccinatorFirst">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Health Facility Name:</label>
                                <div class="col-sm-3">
                                    <input type="text" class="vaccine-form py-1 mt-2 px-3" id="facilityName" required placeholder="Enter health facility name" name="healthFacilityFirst">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Health Facility Contact:</label>
                                <div class="col-sm-3">
                                    <input type="number" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter health facility contact" name="healthFacilityContactFirst">
                                </div>

                                <label for="facilityName" class="col-sm-2 col-form-label">Vaccine Card Picture:</label>
                                <div class="col-sm-3 mt-3">
                                    <input type="file" name="fileFirst" required>
                                </div>
                            </div>
                        </div>`;

                    document.getElementById("second").innerHTML = " ";
                    document.getElementById("second").innerHTML = 
                        `<div class="home-col-bot-title">
                            <h2 ><button class="btn float-left ml-5" type="button" id="btnl2"><i class="fa-solid fa-caret-left" style="font-size:3vh"></i></button> SECOND DOSE <button class="btn float-right mr-5" type="button" id="btnr2"><i class="fa-solid fa-caret-right" style="font-size:3vh"></i></button></h2>
                        </div>
                        <div class="home-col-bot-content">
                            <div class="form-group row mr-2 pt-3 input-form">
                                
                                <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                                <div class="col-sm-3">
                                    <select class="form-control py-1 mt-2 px-3 status-form" name="manufacturerSecond" id="status">
                                        <option selected disabled value="NULL">Select manufacturer</option>
                                        <option value="Pfizer">Pfizer</option>
                                        <option value="Moderna">Moderna</option>
                                        <option value="Sinovac">Sinovac</option>
                                        <option value="Astrazenica">Astrazenica</option>
                                    </select>
                                </div>

                                <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" name="vaccineDateSecond" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required>
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="lotSecond" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number">
                                </div>

                                <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="batchSecond" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number">
                                </div>
                            </div>

                            <div class="form-group row mr-3 input-form">
                                
                                <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                                <div class="col-sm-3">
                                    <input type="text" name="vaccinatorSecond" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter vaccinator name">
                                </div>
                            </div>`+ '</div>';
                        
                        document.getElementById("booster").innerHTML = " ";
                        document.getElementById("booster").innerHTML = ` 
                        <div class="home-col-bot-title">
                        <h2 ><button class="btn float-left ml-5" type="button" id="btnl3"><i class="fa-solid fa-caret-left" style="font-size:3vh"></i></button> BOOSTER DOSE <button class="btn float-right mr-5" type="button" id="btnr3"><i class="fa-solid fa-caret-right" style="font-size:3vh"></i></button></h2>
                    </div>
                    
                    <div class="home-col-bot-content">
                        <div class="form-group row mr-2 pt-3 input-form">
                            
                            <label for="dateVaccine" class="col-sm-2 col-form-label " >Manufacturer:</label>
                            <div class="col-sm-3">
                                <select class="form-control py-1 mt-2 px-3 status-form" id="status" name="manufacturerBooster">
                                    <option selected disabled value="NULL">Select manufacturer</option>
                                    <option value="Pfizer">Pfizer</option>
                                    <option value="Moderna">Moderna</option>
                                    <option value="Sinovac">Sinovac</option>
                                    <option value="Astrazenica">Astrazenica</option>
                                    <option value="Jansen">Jansen</option>
                                </select>
                            </div>

                            <label for="vaccineCardNumber" class="col-sm-2 col-form-label">Vaccination Date:</label>
                            <div class="col-sm-3">
                                <input type="date" name="vaccineDateBooster" class="vaccine-form py-1 mt-2 px-3" id="dateVaccine" required>
                            </div>
                        </div>

                        <div class="form-group row mr-3 input-form">
                            
                            <label for="batchNumber" class="col-sm-2 col-form-label " >Lot Number:</label>
                            <div class="col-sm-3">
                                <input type="text" name="lotBooster" class="vaccine-form py-1 mt-2 px-3" id="lotNumber" required placeholder="Enter lot number">
                            </div>

                            <label for="batchNumber" class="col-sm-2 col-form-label">Batch Number:</label>
                            <div class="col-sm-3">
                                <input type="text" name="batchBooster" class="vaccine-form py-1 mt-2 px-3" id="batchNumber" required placeholder="Enter batch number">
                            </div>
                        </div>

                        <div class="form-group row mr-3 input-form">
                            
                            <label for="vaccinator" class="col-sm-2 col-form-label " >Vaccinator:</label>
                            <div class="col-sm-3">
                                <input type="text" name="vaccinatorBooster" class="vaccine-form py-1 mt-2 px-3" id="vaccinator" required placeholder="Enter vaccinator name">
                            </div>

                            <label for="facilityName" class="col-sm-2 col-form-label">Vaccine Card Picture:</label>
                            <div class="col-sm-3 mt-3">
                                <input type="file" name="fileBooster" required>
                            </div>
                        </div>` + `<button type="submit" class="btn btn-primary btn-sm col-5 my-3 ml-5 " name="submitFullwithBooster" style="font-size: 20px; background: #024059;">Submit</button>` + `</div>`;
                        
                        bindingFunctionB();
                }

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
