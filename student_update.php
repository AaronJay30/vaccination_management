<?php 
    @include 'include\config.php'; 

    session_start();

    if(!isset($_SESSION['id'])){
        header('location:student_login.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update</title>

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
        .container{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 60px;
            padding-top: 20px;
            height: 38vh;
            position: absolute;
            top: 25vh;
            left: 43vh;
        }
    </style>


</head>


<body style="background-color: #cbebf6;">
    <div class="container mt-5 pb-2 pl-5 pr-5" style="background: #fff;">
        <h1 class="text-center pt-3 pb-3" style="color: #024059; font-weight: 900; " id="textChange">UPDATE <?php if(isset($_GET['fdid'])) { echo "FIRST DOSE INFORMATION"; } else if (isset($_GET['sdid'])) { echo "SECOND DOSE INFORMATION";} else if(isset($_GET['bdid'])) {echo "BOOSTER DOSE INFORMATION";}  ?> </h1>
        <hr>

        <?php 
            if (isset($_GET['fdid'])) {
                $doseId = $_GET['fdid'];
                $sql = "SELECT * FROM first_dose WHERE first_dose_id = $doseId";
                $dose = "First";
            } else if (isset($_GET['sdid'])) {
                $doseId = $_GET['sdid'];
                $sql = "SELECT * FROM second_dose WHERE second_dose_id = $doseId";
                $dose = "Second";
            } else if (isset($_GET['bdid'])) {
                $doseId = $_GET['bdid'];
                $sql = "SELECT * FROM booster_dose WHERE booster_dose_id = $doseId";
                $dose = "Booster";
            }
            
            $result = mysqli_query($conn,$sql);

            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $date = $row['date'];
                    $manufacturer = $row['manufacturer'];
                    $batch = $row['batchNumber'];
                    $lot = $row['lotNumber'];
                    $vaccinator = $row['vaccinatorName'];
                }
            }
        ?>
        <form method="Post">
            <div class="form-group row">
                
                <div class="col-6">
                    <label for="manufacturer">Manufacturer</label>
                    <select class="form-control" name="manufacturer" id="manufacturer">
                        <option value="Astrazenica" <?php if($manufacturer == "Astrazenica") { echo "selected"; } ?> >Astrazenica</option>
                        <option value="Pfizer" <?php if($manufacturer == "Pfizer") { echo "selected"; } ?>>Pfizer</option>
                        <option value="Sinovac" <?php if($manufacturer == "Sinovac") { echo "selected"; } ?>>Sinovac</option>
                        <option value="Moderna" <?php if($manufacturer == "Moderna") { echo "selected"; } ?>>Moderna</option>
                        <?php if($dose == "First") 
                            { ?> <option value="Jansen" <?php if($manufacturer == "Jansen") { echo "selected"; } ?> >Jansen</option> <?php } ?>
                    </select>
                </div>

                <div class="col-6">
                    <label for="date">Date of Vaccination</label>
                    <input type="date" class="form-control" id="date" value='<?php echo $date; ?>' name="date" min="2020-01-01">
                </div>
                
                <div class="col-3">
                    <label for="batchNumber">Batch Number</label>
                    <input type="text" class="form-control" id="batchNumber" name="batchNumber" placeHolder="Enter your Batch Number" value='<?php echo $batch ; ?>'>
                </div>
                
                <div class="col-3">
                    <label for="lotNumber">Lot Number</label>
                    <input type="text" class="form-control" id="lotNumber" name="lotNumber" placeHolder="Enter your Lot Number" value='<?php echo $lot; ?>'>
                </div>
                
                <div class="col-6">
                    <label for="vaccinator">Vaccinator Name</label>
                    <input type="text" class="form-control" id="vaccinator" name="vaccinator" placeHolder="Enter your Vaccinator Name" value='<?php echo $vaccinator; ?>'>
                </div>
            </div>  

            <button type="submit" class="btn btn-primary btn-sm col-12 mb-3 " name="submit" style="margin-right: -20px;">Update</button>         
        </form>
            <a href="student.php"><button class="btn btn-secondary btn-sm col-12 mb-3">Cancel</button></a>
            
        <?php
            if(isset($_POST['submit'])){
                $date = $_POST['date'];
                $manufacturer = $_POST['manufacturer'];

                if($manufacturer == "Jansen"){
                    $sql = "SELECT secondDoseid FROM user_vaccine WHERE firstDoseid = $doseId";
                    $result = mysqli_query($conn, $sql);


                    while($row = mysqli_fetch_assoc($result)){
                        $secondId = $row['secondDoseid'];
                    }

                    $sql = "UPDATE user_vaccine_history SET secondDoseid = NULL WHERE firstDoseid = $doseId";
                    mysqli_query($conn,$sql);

                    $sql = "UPDATE user_vaccine SET secondDoseid = NULL WHERE firstDoseid = $doseId";
                    mysqli_query($conn,$sql);

                    $sql = "DELETE FROM second_dose WHERE second_dose_id = $secondId";
                    mysqli_query($conn,$sql);
                }


                $batch = $_POST['batchNumber'];
                $lot = $_POST['lotNumber'];
                $vaccinator = $_POST['vaccinator'];

                if($dose == "First"){
                    $sql = "UPDATE first_dose SET date = '$date', manufacturer = '$manufacturer', batchNumber = '$batch', lotNumber = '$lot', vaccinatorName = '$vaccinator' WHERE first_dose_id = $doseId";
                    $result = mysqli_query($conn, $sql);
                } else if($dose == "Second"){
                    $sql = "UPDATE second_dose SET date = '$date', manufacturer = '$manufacturer', batchNumber = '$batch', lotNumber = '$lot', vaccinatorName = '$vaccinator' WHERE second_dose_id = $doseId";
                    $result = mysqli_query($conn, $sql);
                } else if($dose == "Booster"){
                    $sql = "UPDATE booster_dose SET date = '$date', manufacturer = '$manufacturer', batchNumber = '$batch', lotNumber = '$lot', vaccinatorName = '$vaccinator' WHERE booster_dose_id = $doseId";
                    $result = mysqli_query($conn, $sql);
                }

                

                if($result){
                    echo '<script> window.location.href="student.php?success=Updated Successfully"; </script>';
                }
            }

        ?>

    </div>

    <script>
        date.max = new Date().toISOString().split("T")[0];
    </script>
</body>
</html>