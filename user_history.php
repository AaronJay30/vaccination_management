<?php 

    session_start();

    
    @include 'include\config.php'; 

    if(!isset($_SESSION['id'])){
        header('location:login_admin.php');
    }

    if(!isset($_GET['uid'])){
        header('location:admin.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php 
        $userid = $_GET["uid"];
        $sql = "SELECT * FROM user_login WHERE user_login_id = $userid";
        $result = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($result)){
            echo $row['name'].' - History';
        }
    ?>
    </title>

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
    <?php @include 'include\header.php'; ?>
                
                <h1 class="text-center mt-4" style="color: #024059; font-weight: 900;" id="textChange">USER HISTORY</h1>
                <hr>
                
                <div class="container_admin-table">
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
                            </tr>
                        </thead>
                        <tbody class="expand" id="result">
                            <?php

                                $id = $_GET['uid'];
                                $sql = "SELECT * FROM user_vaccine_history WHERE userid = $id";
                                $result = mysqli_query($conn, $sql);
                                
                                if($result){
                                    while($row = mysqli_fetch_assoc($result)){
                                        $id = $row["userid"];
                                        $userid = $row["userid"];

                                        $sql2 = "SELECT * FROM user_login_history WHERE user_id = $id";
                                        
                                        $result2 = mysqli_query($conn, $sql2);

                                        if($result2){
                                            while($row2 = mysqli_fetch_assoc($result2)){
                                                $name = $row2["name"];
                                                $gender = $row2["gender"];
                                                $birthday = $row2["birthday"];
                                                $address = $row2["address"];
                                                $contact = $row2["contact"];
                                                $role = $row2["roles"];
                                                $grade = $row2["grade"];
                                                $section = $row2["section"];
                                                $department = $row2["department"]; 
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
                                                                    <a href="imageClick.php?uid='.$userid.'" target="_blank">Click Here</a>
                                                                </td>
                                                            </tr>
                                                ';
                                            }
                                        }

                                    }

                                }

                            ?>
                    </tbody>
                    </table>
                </div> 
    
</body>
</html>