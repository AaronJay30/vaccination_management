<?php

    @include 'include\config.php';
    session_start();

    if(isset($_POST['submitOne'])){
        $file = $_FILES['file']; 

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize < 50000000) {
                    
                    $fileNameNew = uniqid('BI', true). "." .$fileActualExt;
                    $fileDestination = 'image/vaccine_card/'.$fileNameNew;
                    
                    $userid = $_SESSION['id'];
                    $vaccineCardNumber = $_POST['vaccineCardNumber'];
                    $philhealthNumber = $_POST['philhealthNumber'];
                    $category = $_POST["category"];
                    $status = $_POST['status'];
                    $healthFacility = $_POST['healthFacility'];
                    $healthFacilityContact = $_POST['healthFacilityContact'];


                    // First Dose
                    $manufacturer = $_POST['manufacturer'];
                    $vaccineDate = $_POST['vaccineDate'];
                    $lot = $_POST['lot'];
                    $batch = $_POST['batch'];
                    $vaccinator = $_POST['vaccinator'];
                    

                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0) {
                        $sql = "UPDATE first_dose SET date = '$vaccineDate', manufacturer = '$manufacturer',batchNumber = '$batch', lotNumber = '$lot', vaccinatorName = '$vaccinator' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    } else {
                        $sqlVaccine = "INSERT INTO first_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDate', '$manufacturer', '$batch', '$lot', '$vaccinator')";
                        mysqli_query($conn, $sqlVaccine);
                    }


                    $sql = "SELECT * FROM second_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($result) > 0) {

                        $sql = "UPDATE user_vaccine SET secondDoseid = NULL WHERE userid = $userid";
                        mysqli_query($conn, $sql);

                        $sql = "UPDATE user_vaccine_history SET secondDoseid = NULL WHERE userid = $userid";
                        mysqli_query($conn, $sql);


                        $sql = "DELETE FROM second_dose WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    }
                    

                    

                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $firstDoseid = $row['first_dose_id'];

                    $sql = "UPDATE user_vaccine SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = $firstDoseid, facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);

                    $sql = "UPDATE user_vaccine_history SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = $firstDoseid, facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    header('Location:student.php?success=Success');
                    

                } 
                else {
                    header('Location:student_vaccine-form.php?error=Your file is too big!');
                }
            } 
            else {
                header('Location:student_vaccine-form.php?error=There was an error while uploading your file!');
            }
        } 
        else {
            header('Location:student_vaccine-form.php?error=You cannot upload files of this type!');
        }
    } else  if(isset($_POST['submitHalf'])){
        $file = $_FILES['file']; 

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize < 50000000) {
                    
                    $fileNameNew = uniqid('BI', true). "." .$fileActualExt;
                    $fileDestination = 'image/vaccine_card/'.$fileNameNew;
                    
                    $userid = $_SESSION['id'];
                    $vaccineCardNumber = $_POST['vaccineCardNumber'];
                    $philhealthNumber = $_POST['philhealthNumber'];
                    $category = $_POST["category"];
                    $status = $_POST['status'];
                    $healthFacility = $_POST['healthFacility'];
                    $healthFacilityContact = $_POST['healthFacilityContact'];


                    // First Dose
                    $manufacturer = $_POST['manufacturer'];
                    $vaccineDate = $_POST['vaccineDate'];
                    $lot = $_POST['lot'];
                    $batch = $_POST['batch'];
                    $vaccinator = $_POST['vaccinator'];
                    

                    $sqlCheck = "SELECT * FROM first_dose WHERE userid = $userid";
                    $resultCheck = mysqli_query($conn, $sqlCheck);

                    if(mysqli_num_rows($resultCheck) > 0) {
                        $sql = "UPDATE first_dose SET date = '$vaccineDate', manufacturer = '$manufacturer',batchNumber = '$batch', lotNumber = '$lot', vaccinatorName = '$vaccinator' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    }else {
                        $sqlVaccine = "INSERT INTO first_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDate', '$manufacturer', '$batch', '$lot', '$vaccinator')";
                        mysqli_query($conn, $sqlVaccine);
                    }

                    $sqlCheck = "SELECT * FROM second_dose WHERE userid = $userid";
                    $resultCheck = mysqli_query($conn, $sqlCheck);

                    if(mysqli_num_rows($resultCheck) > 0) {
                        $sql = "UPDATE user_vaccine SET secondDoseid = NULL WHERE userid = $userid";
                        mysqli_query($conn, $sql);

                        $sql = "UPDATE user_vaccine_history SET secondDoseid = NULL WHERE userid = $userid";
                        mysqli_query($conn, $sql);

                        $sql = "DELETE FROM second_dose WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    }



                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $resultLast = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($resultLast);
                    $firstDoseid = $row['first_dose_id'];
                    

                    $sql = "UPDATE user_vaccine SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);

                    $sql = "UPDATE user_vaccine_history SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);

                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    header('Location:student.php?success=Success');
                    

                } 
                else {
                    header('Location:student_vaccine-form.php?error=Your file is too big!');
                }
            } 
            else {
                header('Location:student_vaccine-form.php?error=There was an error while uploading your file!');
            }
        } 
        else {
            header('Location:student_vaccine-form.php?error=You cannot upload files of this type!');
        }
    } else  if(isset($_POST['submitFull'])){
        $file = $_FILES['file']; 

        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExt, $allowed)) {

            if ($fileError === 0) {

                if ($fileSize < 50000000) {
                    
                    $fileNameNew = uniqid('BI', true). "." .$fileActualExt;
                    $fileDestination = 'image/vaccine_card/'.$fileNameNew;
                    
                    $userid = $_SESSION['id'];
                    $vaccineCardNumber = $_POST['vaccineCardNumber'];
                    $philhealthNumber = $_POST['philhealthNumber'];
                    $category = $_POST["category"];
                    $status = $_POST['status'];
                    $healthFacility = $_POST['healthFacility'];
                    $healthFacilityContact = $_POST['healthFacilityContact'];


                    // First Dose
                    $manufacturerFirst = $_POST['manufacturerFirst'];
                    $vaccineDateFirst = $_POST['vaccineDateFirst'];
                    $lotFirst = $_POST['lotFirst'];
                    $batchFirst = $_POST['batchFirst'];
                    $vaccinatorFirst = $_POST['vaccinatorFirst'];

                    // Second Dose
                    $manufacturerSecond = $_POST['manufacturerSecond'];
                    $vaccineDateSecond = $_POST['vaccineDateSecond'];
                    $lotSecond = $_POST['lotSecond'];
                    $batchSecond = $_POST['batchSecond'];
                    $vaccinatorSecond = $_POST['vaccinatorSecond'];
                    

                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $resultCheckFirst = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultCheckFirst) > 0){
                        $sql = "UPDATE first_dose SET date = '$vaccineDateFirst', manufacturer = '$manufacturerFirst',batchNumber = '$batchFirst', lotNumber = '$lotFirst', vaccinatorName = '$vaccinatorFirst' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    } else {
                        $sqlVaccine = "INSERT INTO first_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDateFirst', '$manufacturerFirst', '$batchFirst', '$lotFirst', '$vaccinatorFirst')";
                        mysqli_query($conn, $sqlVaccine);
                    }

                    $sql = "SELECT * FROM second_dose WHERE userid = $userid";
                    $resultCheckSecond = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultCheckSecond) > 0){
                        $sql = "UPDATE second_dose SET date = '$vaccineDateSecond', manufacturer = '$manufacturerSecond',batchNumber = '$batchSecond', lotNumber = '$lotSecond', vaccinatorName = '$vaccinatorSecond' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    } else {
                        $sqlVaccine = "INSERT INTO second_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDateSecond', '$manufacturerSecond', '$batchSecond', '$lotSecond', '$vaccinatorSecond')";
                        mysqli_query($conn, $sqlVaccine);
                    }
                    

                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $firstDoseid = $row['first_dose_id'];

                    $sql = "SELECT * FROM second_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $secondDoseid = $row['second_dose_id'];

                    $sql = "UPDATE user_vaccine SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', secondDoseid =  '$secondDoseid' , facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);

                    $sql = "UPDATE user_vaccine_history SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', secondDoseid =  '$secondDoseid' , facilityName = '$healthFacility', facilityContact = '$healthFacilityContact', vaccineCard = '$fileNameNew' WHERE userid = $userid";
                    mysqli_query($conn, $sql);
                    
                    move_uploaded_file($fileTmpName, $fileDestination);
                    
                    header('Location:student.php?success=Success');
                    

                } 
                else {
                    header('Location:student_vaccine-form.php?error=Your file is too big!');
                }
            } 
            else {
                header('Location:student_vaccine-form.php?error=There was an error while uploading your file!');
            }
        } 
        else {
            header('Location:student_vaccine-form.php?error=You cannot upload files of this type!');
        }
    } else  if(isset($_POST['submitFullwithBooster'])){
        $fileVaccine = $_FILES['fileFirst']; 

        $fileNameVaccine = $fileVaccine['name'];
        $fileTmpNameVaccine = $fileVaccine['tmp_name'];
        $fileSizeVaccine = $fileVaccine['size'];
        $fileErrorVaccine = $fileVaccine['error'];

        $fileExtVaccine = explode(".", $fileNameVaccine);
        $fileActualExtVaccine = strtolower(end($fileExtVaccine));

        $fileBooster = $_FILES['fileBooster']; 

        $fileNameBooster = $fileBooster['name'];
        $fileTmpNameBooster = $fileBooster['tmp_name'];
        $fileSizeBooster = $fileBooster['size'];
        $fileErrorBooster = $fileBooster['error'];

        $fileExtBooster = explode(".", $fileNameBooster);
        $fileActualExtBooster = strtolower(end($fileExtBooster));

        $allowed = array("jpg", "jpeg", "png");

        if (in_array($fileActualExtVaccine, $allowed) && in_array($fileActualExtBooster, $allowed) ) {

            if ($fileErrorVaccine === 0 && $fileErrorBooster === 0 ) {

                if ($fileSizeVaccine < 50000000 && $fileSizeBooster < 50000000 ) {
                    
                    $fileNameNewVaccine = uniqid('BI', true). "." .$fileActualExtVaccine;
                    $fileNameNewBooster = uniqid('BI', true). "." .$fileActualExtBooster;

                    $fileDestinationVaccine = 'image/vaccine_card/'.$fileNameNewVaccine;
                    $fileDestinationBooster = 'image/booster_card/'.$fileNameNewBooster;
                    
                    $userid = $_SESSION['id'];
                    $vaccineCardNumber = $_POST['vaccineCardNumber'];
                    $philhealthNumber = $_POST['philhealthNumber'];
                    $category = $_POST["category"];
                    $status = $_POST['status'];


                    $healthFacilityFirst = $_POST['healthFacilityFirst'];
                    $healthFacilityContactFirst = $_POST['healthFacilityContactFirst'];


                    // First Dose
                    $manufacturerFirst = $_POST['manufacturerFirst'];
                    $vaccineDateFirst = $_POST['vaccineDateFirst'];
                    $lotFirst = $_POST['lotFirst'];
                    $batchFirst = $_POST['batchFirst'];
                    $vaccinatorFirst = $_POST['vaccinatorFirst'];

                    // Second Dose
                    $manufacturerSecond = $_POST['manufacturerSecond'];
                    $vaccineDateSecond = $_POST['vaccineDateSecond'];
                    $lotSecond = $_POST['lotSecond'];
                    $batchSecond = $_POST['batchSecond'];
                    $vaccinatorSecond = $_POST['vaccinatorSecond'];

                    // Booster Dose
                    $manufacturerBooster = $_POST['manufacturerBooster'];
                    $vaccineDateBooster = $_POST['vaccineDateBooster'];
                    $lotBooster = $_POST['lotBooster'];
                    $batchBooster = $_POST['batchBooster'];
                    $vaccinatorBooster = $_POST['vaccinatorBooster'];
                    

                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    
                    if(mysqli_num_rows($result) > 0){
                        $sqlVaccine = "UPDATE first_dose SET date = '$vaccineDateFirst', manufacturer = '$manufacturerFirst',batchNumber = '$batchFirst', lotNumber = '$lotFirst', vaccinatorName = '$vaccinatorFirst' WHERE userid = $userid";
                        mysqli_query($conn, $sqlVaccine);
                    } else{
                        $sqlVaccine = "INSERT INTO first_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDateFirst', '$manufacturerFirst', '$batchFirst', '$lotFirst', '$vaccinatorFirst')";
                        mysqli_query($conn, $sqlVaccine);
                    }

                    $sql = "SELECT * FROM second_dose WHERE userid = $userid";
                    $resultCheckSecond = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultCheckSecond) > 0){
                        $sql = "UPDATE second_dose SET date = '$vaccineDateSecond', manufacturer = '$manufacturerSecond',batchNumber = '$batchSecond', lotNumber = '$lotSecond', vaccinatorName = '$vaccinatorSecond' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    } else {
                        $sqlVaccine = "INSERT INTO second_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDateSecond', '$manufacturerSecond', '$batchSecond', '$lotSecond', '$vaccinatorSecond')";
                        mysqli_query($conn, $sqlVaccine);
                    }

                    $sql = "SELECT * FROM booster_dose WHERE userid = $userid";
                    $resultCheckSecond = mysqli_query($conn, $sql);

                    if(mysqli_num_rows($resultCheckSecond) > 0){
                        $sql = "UPDATE booster_dose SET date = '$vaccineDateBooster', manufacturer = '$manufacturerBooster',batchNumber = '$batchBooster', lotNumber = '$lotBooster', vaccinatorName = '$vaccinatorBooster' WHERE userid = $userid";
                        mysqli_query($conn, $sql);
                    } else {
                        $sqlVaccine = "INSERT INTO booster_dose (`userid`, `date`, `manufacturer`, `batchNumber`, `lotNumber`, `vaccinatorName`) VALUES ('$userid', '$vaccineDateBooster', '$manufacturerBooster', '$batchBooster', '$lotBooster', '$vaccinatorBooster')";
                        mysqli_query($conn, $sqlVaccine);
                    }

                   

                    // Getting the dose id
                    $sql = "SELECT * FROM first_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $firstDoseid = $row['first_dose_id'];

                    $sql = "SELECT * FROM second_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $secondDoseid = $row['second_dose_id'];

                    $sql = "SELECT * FROM booster_dose WHERE userid = $userid";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);

                    $boosterDoseid = $row['booster_dose_id'];


                    // Updating the user
                    $sql = "UPDATE user_vaccine SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', secondDoseid =  '$secondDoseid' , boosterDoseid =  '$boosterDoseid' , facilityName = '$healthFacilityFirst', facilityContact = '$healthFacilityContactFirst', vaccineCard = '$fileNameNewVaccine', boosterCard = '$fileNameNewBooster' WHERE userid = $userid";
                    mysqli_query($conn, $sql);

                    $sql = "UPDATE user_vaccine_history SET philhealth = '$philhealthNumber', category = '$category', vaccineCardNumber = '$vaccineCardNumber', firstDoseid = '$firstDoseid', secondDoseid =  '$secondDoseid' , boosterDoseid =  '$boosterDoseid' , facilityName = '$healthFacilityFirst', facilityContact = '$healthFacilityContactFirst',vaccineCard = '$fileNameNewVaccine', boosterCard = '$fileNameNewBooster' WHERE userid = $userid";
                    mysqli_query($conn, $sql);


                    move_uploaded_file($fileTmpNameVaccine, $fileDestinationVaccine);
                    move_uploaded_file($fileTmpNameBooster, $fileDestinationBooster);
                    
                    header('Location:student.php?success=Success');
                    

                } 
                else {
                    header('Location:student_vaccine-form.php?error=Your file is too big!');
                }
            } 
            else {
                header('Location:student_vaccine-form.php?error=There was an error while uploading your file!');
            }
        } 
        else {
            header('Location:student_vaccine-form.php?error=You cannot upload files of this type!');
        }
    }


?> 