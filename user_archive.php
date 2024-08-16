<?php 
    @include 'include\config.php'; 

    session_start();

    if(!isset($_SESSION['id'])){
        header('location:login_admin.php');
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
    <title>Admin - Archive</title>

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
        #myBtn {
            display: none; /* Hidden by default */
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 99; /* Make sure it does not overlap */
            border: none; /* Remove borders */
            outline: none; /* Remove outline */
            background-color: #024059; /* Set a background color */
            color: white; /* Text color */
            cursor: pointer; /* Add a mouse pointer on hover */
            padding: 8px 15px;
            border-radius: 600px; /* Rounded corners */
        }
        
        #myBtn:hover {
            background-color: #014eb8; /* Add a dark-grey background on hover */
        }

    </style>
</head>


<body style="background-color: #cbebf6;">
    <?php @include 'include\header.php'; ?>

    
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa-solid fa-caret-up" style="color: #fff; font-size:40px;"></i></button>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 pt-5 pb-4" style="background: #fff;">
                <div class="input-group rounded mt-2" style="width: 100%">
                    <h5 style="color: #024059; font-weight: 900;">FILTER DATA </h5>
                    <button type="button" class="btn btn-danger clear_filter " style="margin-left: 30%" onclick="uncheckAll()">Clear</button>
                </div>
                
                <hr>
                
                <div class="input-group rounded mt-2">
                    <input type="search" class="form-control rounded" onkeyup="tableSearch()" id="myInput" placeholder="Search for name" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search" style="color: #024059;"></i>
                    </span>
                </div>
                 
                <h6 class="mt-4" style="color: #024059;">Select Gender</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT gender FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY gender";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['gender']; ?>" id="gender"> <?= $row['gender']; ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Role</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT roles FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY roles";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['roles']; ?>" id="roles"> <?= $row['roles']; ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Address</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT address FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY address";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['address']; ?>" id="address"> <?= $row['address']; ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Year Level</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT grade FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY grade";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            if($row['grade'] == NULL){
                                continue;
                            }
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['grade'] ?>" id="grade"> <?= $row['grade'] ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Section</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT section FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY section";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            if($row['section'] == NULL){
                                continue;
                            }
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['section'] ?>" id="section"> <?= $row['section'] ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Department</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT DISTINCT department FROM user_login WHERE user_login_id IN (SELECT archive_id FROM archive) 
                        ORDER BY department";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            if($row['department'] == NULL){
                                continue;
                            }
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['department'] ?>" id="department"> <?= $row['department'] ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>
                
                <h6 class="mt-3" style="color: #024059;">Select Vaccination Date</h6>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-check">
                            <label for="start">Start date:&nbsp;&nbsp;</label>
                            <input type="date" id="start" name="date-start" value="" >
                            <label for="end">&nbsp;End date: &nbsp;&nbsp;</label>
                            <input type="date" id="end" name="end-start" value="" >
                            <br>
                            <button type="button" class="btn btn-primary btn-sm mt-3 btn_filter">Filter</button>
                            <button type="button" class="btn btn-success btn-sm mt-3 reset_date" onclick="clearDate()">Clear</button>
                        </div>
                    </li> 
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Vaccination Status</h6>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="NV" id="status">Not Vaccinated
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="OD" id="status">One Dose Vaccination
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="HV" id="status">Half Vaccinated
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="FV" id="status">Fully Vaccinated
                            </label>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="FVB" id="status">Fully Vaccinated + Booster
                            </label>
                        </div>
                    </li>

                    
                </ul>

                <h6 class="mt-3" style="color: #024059;">Select Vaccine Manufacturer</h6>
                <ul class="list-group">
                    <?php
                        $sql = "SELECT manufacturer FROM first_dose UNION SELECT manufacturer FROM second_dose UNION SELECT manufacturer FROM booster_dose 
                        ORDER BY manufacturer";

                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            if($row['manufacturer'] == NULL){
                                continue;
                            }
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input filter_check" value="<?= $row['manufacturer'] ?>" id="manufacturer"> <?= $row['manufacturer'] ?>
                            </label>
                        </div>
                    </li>
                        
                    <?php } ?>
                    
                </ul>



            </div>
            
            <div class="col-lg-10 mt-5">
                
                <h1 class="text-center" style="color: #024059; font-weight: 900;" id="textChange">VACCINE INFORMATION</h1>
                <hr>
                
                
                <div class="container_admin-table">
                    <p class="text-secondary">Showing <span id="row_count"></span> entries in the table</p>
                    <?php 
                        if(isset($_GET['status'])){
                            if($_GET['action'] == "update"){
                                if($_GET['status'] == "success"){ ?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: #007820; background-color: #8af3a6; border-color: #0ee948;">
                                        <strong>Update Success!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                <?php } else { ?>

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error updating info!</strong> Invalid input please try again
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                            }
                            else if($_GET['action'] == "unarchive"){
                                if($_GET['status'] == "success"){ ?>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="color: #007820; background-color: #8af3a6; border-color: #0ee948;">
                                        <strong>You've succesfully unarchive data!</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                <?php } else { ?>

                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Error unarchiving!</strong> Please try again
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php }
                            }
                        }   
                    ?>
                    <table class="table table-striped text-center" id="myTable">
                        <thead class="bg-color text-light expand">
                            <tr>
                                <th scope="col" class = "expand">#</th>
                                <th scope="col" >Name</th>
                                <th scope="col" >Address</th>
                                <th scope="col" >Gender
                                <th scope="col" >Contact</th>
                                <th scope="col" >Birthday</th>
                                <th scope="col" >Role</th>
                                <th scope="col" class = "expand">Year & Section</th>
                                <th scope="col" >Department</th>
                                <th scope="col" class = "expand">Phil-Health Number</th>
                                <th scope="col" >Category</th>
                                <th scope="col" class = "expand">Vaccine Card Number</th>
                                <th scope="col" >First Dose</th>
                                <th scope="col" >Second Dose</th>
                                <th scope="col" >Booster Dose</th>
                                <th scope="col" class = "expand">Health Facility Name</th>
                                <th scope="col" class = "expand">Health Facility Contact</th>
                                <th scope="col" class = "expand">Proof of Vaccination</th>
                                <th scope="col" >Operation</th>
                            </tr>
                        </thead>
                        <tbody class="expand" id="result">
                            <?php

                                $sql = "SELECT * FROM archive INNER JOIN user_login ON archive.userid = user_login.user_login_id";
                                $result = mysqli_query($conn, $sql);
                                
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row["archive_id"];
                                        $userid = $row["userid"];
                                        $name = $row["name"];
                                        $gender = $row["gender"];
                                        $birthday = $row["birthday"];
                                        $address = $row["address"];
                                        $contact = $row["contact"];
                                        $role = $row["roles"];
                                        $grade = $row["grade"];
                                        $section = $row["section"];
                                        $department = $row["department"];
                            
                                        $philHealth = $row["philhealth"];
                                        $category = $row["category"];
                                        $cardNumber = $row["vaccineCardNumber"];
                                        $firstDoseid = $row["firstDoseid"];
                                        $secondDoseid = $row["secondDoseid"];
                                        $boosterDoseid = $row["boosterDoseid"];
                                        
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
                                        }
                            
                                        $facilityName = $row["facilityName"];
                                        $facilityContact = $row["facilityContact"];
                                        $vaccineCard = $row["vaccineCard"];
                                        $boosterCard = $row["boosterCard"];
                                        
                                        echo '
                                            <tr>
                                                <th scope="row">'.$id.'</th>
                                                <td>'.$name.'</td>
                                                <td>'.$address.'</td>
                                                <td>'.$gender.'</td>
                                                <td>'.$contact.'</td>
                                                <td>'.$birthday.'</td>
                                                <td>'.$role.'</td>
                                                <td>'.$grade. " - " .$section. '</td>
                                                <td>'.$department.'</td>
                                                <td>'.$philHealth.'</td>
                                                <td>'.$category.'</td>
                                                <td>'.$cardNumber.' </td>';

                                                if ($firstDoseid != NULL){
                                                    echo '
                                                        <td class="text-justify">
                                                            <h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateFirst.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerFirst.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchFirst.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotFirst.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorFirst.'</h5> <br>
                                                        </td>
                                                    ';
                                                } else {
                                                    echo '<td> </td>';
                                                }

                                                if ($secondDoseid != NULL){
                                                    echo '
                                                        <td class="text-justify">
                                                            <h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateSecond.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerSecond.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchSecond.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotSecond.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorSecond.'</h5> <br>
                                                        </td>
                                                    ';
                                                } else {
                                                    echo '<td> </td>';
                                                }

                                                if ($boosterDoseid != NULL){
                                                    echo '
                                                        <td class="text-justify">
                                                            <h5 class="font-weight-bold text-uppercase"> Date: </h5> <h5>'.$vaccineDateBooster.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Manufacturer: </h5> <h5>'.$manufacturerBooster.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Batch Number: </h5> <h5>'.$batchBooster.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Lot Number: </h5> <h5>'.$lotBooster.'</h5> <br>
                                                            <h5 class="font-weight-bold text-uppercase"> Vaccinator: </h5> <h5>'.$vaccinatorBooster.'</h5> <br>
                                                        </td>
                                                    ';
                                                } else {
                                                    echo '<td> </td>';
                                                }
                                                
                                                echo '
                                                <td>'.$facilityName.'</td>
                                                <td>'.$facilityContact.'</td>
                                                <td>
                                                    <a href="imageClick-archive.php?uid='.$userid.'" target="_blank">Click Here</a>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger"><a href="unarchive.php?unarchiveid='.$userid.'" class="text-light">Unarchive</a></button>
                                                    <button class="btn btn-success"><a href="user_history.php?uid='.$userid.'" class="text-light">History</a></button>
                                                </td>
                                            </tr>
                                        ';

                                    }

                                }

                            ?>
                    </tbody>
                    </table>
                </div> 
            </div>

        </div>
    </div>

    
    <script type="text/javascript">
        
        $(document).ready(function(){

            var gender;
            var action = 'data';
            var roles;
            var grade;
            var section;
            var department;
            var address;
            var manufacturer;
            var status;
            var start_date;
            var end_date;
            



            $(".filter_check").click(function(){
                
                action = 'data';
                gender = get_filter_text('gender');
                roles = get_filter_text('roles');
                grade = get_filter_text('grade');
                section = get_filter_text('section');
                department = get_filter_text('department');
                address = get_filter_text('address');
                manufacturer = get_filter_text('manufacturer');
                status = get_filter_text('status');

                $.post("action_archive.php", {
                        action: action, 
                        gender: gender, 
                        roles: roles, 
                        grade: grade, 
                        section: section, 
                        department: department, 
                        manufacturer: manufacturer,
                        address: address,
                        status: status,
                        start_date:start_date,
                        end_date:end_date
                    },function(data, status){
                        $("#result").html(data);
                        var rowCount = $("#myTable tr").length - 1;
                        document.getElementById("row_count").innerHTML = rowCount;
                        $("#textChange").text("FILTERED VACCINE INFORMATION");
                    });
            });

            $(".btn_filter").click(function(){

                    start_date = get_date('start');
                    end_date = get_date('end');

                    $.post("action_archive.php", {
                        action: action, 
                        gender: gender, 
                        roles: roles, 
                        grade: grade, 
                        section: section, 
                        department: department, 
                        manufacturer: manufacturer,
                        address: address,
                        status: status,
                        start_date:start_date,
                        end_date:end_date
                    },function(data, status){
                        $("#result").html(data);
                        var rowCount = $("#myTable tr").length - 1;
                        document.getElementById("row_count").innerHTML = rowCount;
                        $("#textChange").text("FILTERED VACCINE INFORMATION");
                    });
            });

            $(".reset_date").click(function(){

                action = 'data';
                start_date = [];
                end_date = [];

                $.post("action_archive.php", {
                    action: action, 
                    gender: gender, 
                    roles: roles, 
                    grade: grade, 
                    section: section, 
                    department: department, 
                    manufacturer: manufacturer,
                    address: address,
                    status: status,
                    start_date:start_date,
                    end_date:end_date
                },function(data, status){
                    $("#result").html(data);
                    var rowCount = $("#myTable tr").length - 1;
                    document.getElementById("row_count").innerHTML = rowCount;
                    $("#textChange").text("FILTERED VACCINE INFORMATION");
                });
            });

            $(".clear_filter").click(function(){

                action = 'data';
                start_date = [];
                end_date = [];
                gender = [];
                roles = [];
                grade = [];
                section = [];
                department = [];
                address = [];
                manufacturer = [];
                status = [];

                $.post("action_archive.php", {
                    action: action, 
                    gender: gender, 
                    roles: roles, 
                    grade: grade, 
                    section: section, 
                    department: department, 
                    manufacturer: manufacturer,
                    address: address,
                    status: status,
                    start_date:start_date,
                    end_date:end_date
                },function(data, status){
                    $("#result").html(data);
                    var rowCount = $("#myTable tr").length - 1;
                    document.getElementById("row_count").innerHTML = rowCount;
                    $("#textChange").text("VACCINE INFORMATION");
                });
            });

            
            function get_filter_text(text_id){
                var filterData = [];
                $("#"+text_id+':checked').each(function(){
                    filterData.push($(this).val());
                });
                return filterData;
            }

            function get_date(text_id){
                var filterDate = [];
                $("#"+text_id).each(function(){
                    filterDate.push($(this).val());
                });
                return filterDate;
            }

        });
    </script>

    <script type="application/javascript">

        function clearDate(){
            inputstart = document.getElementById("start");
            inputend = document.getElementById("end");

            inputstart.value = null;
            inputend.value = null;
        }

        function uncheckAll() {
          document.querySelectorAll('input[type="checkbox"]')
            .forEach(el => el.checked = false);

            inputstart = document.getElementById("start");
            inputend = document.getElementById("end");

            inputstart.value = null;
            inputend.value = null;
        }

        function tableSearch(){
            let input, filter, table, tr, td, txtValue;


            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            console.log(tr);

            for(let i = 0; i < tr.length; i ++) {
                td = tr[i].getElementsByTagName("td")[0];
                if(td){
                    txtValue = td.textContent || td.innerText;
                    if(txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    }
                    else{
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script type="text/javascript">
        $(function() {
            $('input[name="birthday"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format('YYYY'),10)
            })
        });
    </script>

    <script>
        $(document).ready(function(){
            // Select all the rows in the table
            // and get the count of the selected elements
            var rowCount = $("#myTable tr").length - 1;
            document.getElementById("row_count").innerHTML = rowCount;
          });
    </script>
    <script>
        // Get the button:
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
        if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>

</body>
</html>