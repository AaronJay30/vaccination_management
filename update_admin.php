<?php 
    @include 'include\config.php'; 

    session_start();

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
</head>


<body style="background-color: #cbebf6;">
    
    <div class="container mt-5 pb-2" style="background: #fff;">
        <h1 class="text-center pt-3 pb-3" style="color: #024059; font-weight: 900; " id="textChange">UPDATE INFORMATION</h1>
        <hr>

        <?php 
            $userid = $_GET['uid'];

            $sql = "SELECT * FROM user_login WHERE user_login_id = $userid";

            $result = mysqli_query($conn, $sql);
            
            if($result){
                while($row = mysqli_fetch_assoc($result)){
                    $name = $row['name'];
                    $address = $row['address'];
                    $gender = $row['gender'];
                    $contact = $row['contact'];
                    $birthday = $row['birthday'];
                    $roles = $row['roles'];
                    $grade = $row['grade'];
                    $section = $row['section'];
                    $department = $row['department'];
                }
            }
        ?>
        <form method="Post">
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label font-weight-bold">Name</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="name" value="<?php echo htmlspecialchars($name); ?>" name="name">
                </div>
                
                <label for="address" class="col-sm-2 col-form-label font-weight-bold">Address</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="address" value="<?php echo htmlspecialchars($address); ?>" name="address">
                </div>
                
                <label for="gender" class="col-sm-2 col-form-label font-weight-bold">Gender</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="gender" value="<?php echo htmlspecialchars($gender); ?>" name="gender">
                </div>
                
                <label for="contact" class="col-sm-2 col-form-label font-weight-bold">Contact</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="contact" value="<?php echo htmlspecialchars($contact); ?>" name="contact">
                </div>
                
                <label for="birthday" class="col-sm-2 col-form-label font-weight-bold">Birthday</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="birthday" value="<?php echo htmlspecialchars($birthday) ?>" name="birthday">
                </div>
                
                <label for="role" class="col-sm-2 col-form-label pb-3 font-weight-bold">Role</label>
                <div class="col-sm-10">
                    <select class="form-select role-select" aria-label="Default select example" name="roles" id="roles">
                        <option value="Student" <?php if($roles == "Student") echo 'selected';  ?> >Student</option>
                        <option value="Faculty" <?php if($roles == "Faculty") echo 'selected';  ?> >Faculty</option>
                    </select>

                </div>
                
                <label for="grade" class="col-sm-2 col-form-label pb-3 font-weight-bold">Grade Level</label> 
                <div class="col-sm-2 mr-5"> 
                    <input type="number" min="7" max="12" class="form-control" id="gradeID" value="<?php echo htmlspecialchars($grade) ?>" name="grade"> 
                </div> 
                        
                <label for="section" class="col-sm-1 col-form-label pb-3 font-weight-bold">Section</label> 
                <div class="col-sm-2"> 
                    <input type="number" min="1" max="2" class="form-control" id="sectionID" value="<?php echo htmlspecialchars($section) ?>" name="section"> 
                </div>

            </div>
            <div class="form-group row" style="margin-top: -1.5%";>
                <label for="departmentID" class="col-sm-2 col-form-label font-weight-bold">Department</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="departmentID" value="<?php echo htmlspecialchars($department) ?>" name="department">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary btn-sm col-12 mb-2" name="submit">Update</button>
        </form>
            <a href="admin.php"><button class="btn btn-secondary btn-sm col-12 mb-3">Cancel</button></a>
    </div>

    <script> 
        $(document).ready(function(){
            var roles = $('#roles :selected').text()

            if (roles == "Student"){
                document.getElementById("departmentID").disabled = true;
                document.getElementById("sectionID").disabled = false;
                document.getElementById("departmentID").value = null;
                document.getElementById("gradeID").disabled = false;
            } else{
                document.getElementById("sectionID").disabled = true;
                document.getElementById("sectionID").value = null;
                document.getElementById("gradeID").disabled = true;
                document.getElementById("gradeID").value = null;
                document.getElementById("departmentID").disabled = false;
            }

            

            $('#roles').change(function(){
                var roles = $('#roles :selected').text()

                if (roles == "Student"){
                    document.getElementById("departmentID").disabled = true;
                    document.getElementById("departmentID").value = null;
                    document.getElementById("sectionID").disabled = false;
                    document.getElementById("gradeID").disabled = false;
                } else{
                    document.getElementById("sectionID").disabled = true;
                    document.getElementById("sectionID").value = null;
                    document.getElementById("gradeID").disabled = true;
                    document.getElementById("gradeID").value = null;
                    document.getElementById("departmentID").disabled = false;
                }

            });
        });


    </script>


    <?php 

        if(isset($_POST['submit'])){

            if($roles == "Faculty"){
                $sql = "INSERT INTO user_login_history (user_id, name, address, birthday, gender, contact, roles, grade, section, department) VALUES($userid, '$name', '$address', '$birthday', '$gender', '$contact', '$roles', NULL, NULL, '$department')";
                $result = mysqli_query($conn, $sql);
            } else if($roles == "Student") {
                $sql = "INSERT INTO user_login_history (user_id, name, address, birthday, gender, contact, roles, grade, section, department) VALUES($userid, '$name', '$address', '$birthday', '$gender', '$contact', '$roles', $grade, $section, NULL)";
                $result = mysqli_query($conn, $sql);
            }
            
           

            $name = $_POST['name'];
            $address = $_POST['address'];
            $gender = $_POST['gender'];
            $contact = $_POST['contact'];
            $birthday = $_POST['birthday'];
            $roles = $_POST['roles'];
            
            if($roles == "Faculty"){
                $grade = NULL;
                $section = NULL;
                $department = $_POST['department'];
            } else if($roles == "Student") {
                $grade = $_POST['grade'];
                $section = $_POST['section'];
                $department = NULL;
            }

            
            if($roles == "Faculty"){
                $sql = "UPDATE user_login SET name = '$name', address = '$address', gender = '$gender' , contact = '$contact', birthday = '$birthday', roles = '$roles', grade = NULL, section = NULL, department = '$department' WHERE user_login_id = '$userid'";
                $result = mysqli_query($conn, $sql);
            } else if($roles == "Student") {
                $sql = "UPDATE user_login SET name = '$name', address = '$address', gender = '$gender' , contact = '$contact', birthday = '$birthday', roles = '$roles', grade = '$grade', section = '$section', department = NULL WHERE user_login_id = '$userid'";
                $result = mysqli_query($conn, $sql);
            }
            
                                
            if ($result) {
                echo '<script> window.location.href="admin.php?status=success&action=update"; </script>';
            } else {
                echo '<script> window.location.href="admin.php?status=error&action=update"; </script>';
            }
        }
    ?>
    


</body>
</html>