<?php

    $userid = $_SESSION['id'];

    $sql = "SELECT * FROM user_login WHERE user_login_id = $userid ";

    $result = mysqli_query($conn,$sql);

    if($result){
        while($row = mysqli_fetch_assoc($result)){
            $name = $row['name'];
            $roles = $row['roles'];
            $grade = $row['grade'];
            $section = $row['section'];
            $department = $row['department'];
            $profile = $row['profile'];
        }
    }

    $sqlVaccine = "SELECT * FROM user_vaccine WHERE userid = $userid";
    $resultVaccine = mysqli_query($conn,$sqlVaccine);
    
    if($resultVaccine){
        while($rowVaccine = mysqli_fetch_assoc($resultVaccine)){
            $firstDoseid = $rowVaccine['firstDoseid'];
            $secondDoseid = $rowVaccine['secondDoseid'];
            $boosterDoseid = $rowVaccine['boosterDoseid'];
        }
    }

    $sqlFirst = "SELECT * FROM first_dose WHERE userid = $userid";
    $resultFirst = mysqli_query($conn,$sqlFirst);
    if($resultFirst){
        while($rowFirst = mysqli_fetch_assoc($resultFirst)){
            $manufacturer = $rowFirst['manufacturer'];
        }
    }

?>

<div class="sidebar">
        <div class="logo-details">
            <img src="image\OKlogo.png" alt="" style="width: 25%; margin-right:10px;" class="icon">
            <div class="logo_name">OCEANS OF KNOWLEDGE</div>
                <i class='bx bx-menu' id="btn" ></i>
            </div>

            <hr style="margin-top:10px ;background:#fff;">
            
            <ul class="nav-list">

                <li>
                    <a href="student.php">
                    <i class='bx bx-grid-alt'></i>
                    <span class="links_name">Dashboard</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </li>

                <?php
                    if( ($firstDoseid != NULL && $manufacturer != "Jansen" && $secondDoseid == NULL && $boosterDoseid == NULL) || ($firstDoseid == NULL && $secondDoseid == NULL && $boosterDoseid == NULL) || ($firstDoseid != NULL && $secondDoseid != NULL && $boosterDoseid == NULL)){
                ?>
                
                    <li>
                    <a href="student_vaccine-form.php">
                        <i class='bx bx-edit' ></i>
                        
                        <span class="links_name">Vaccine Form</span>
                    </a>
                    <span class="tooltip">Vaccine Form</span>
                    </li>

                <?php
                    }
                ?>

                <li>
                <a href="student_setting.php">
                    <i class='bx bx-cog' ></i>
                    <span class="links_name">Account Setting</span>
                </a>
                <span class="tooltip">Account Setting</span>
                </li>

                <li class="profile">
                    <div class="profile-details">
                    <img src="image\avatar\<?php echo $profile ?>" alt="profileImg">
                    <div class="name_job">
                        <div class="name"><?php echo $name ?></div>
                        <div class="job"><?php
                            if($roles == "Student"){
                                echo "Grade ".$grade." - ".$section;
                            } else{
                                echo $department;
                            }
                        
                        ?>
                        </div>
                    </div>
                    </div>
                    <a href="admin_logout.php" style="background:#1d1b31;"><i class='bx bx-log-out bx-sm' id="log_out"></i></a>
                </li>

                </ul>
            </div>