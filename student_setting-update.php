<?php 

    @include 'include\config.php';
    session_start();


    if(isset($_POST['accountBtn'])){
         

        if($_FILES['file']['name'] != ""){
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
                        $fileDestination = 'image/avatar/'.$fileNameNew;
                        
                        $userid = $_SESSION['id'];
                        $name = $_POST['name'];
                        $gender = $_POST['gender'];
                        $birthday = $_POST['birthday'];
                        $address = $_POST['address'];
                        $email = $_POST['email'];
                        $contact = $_POST['contact'];

                        $sql = "UPDATE user_login SET name = '$name', gender='$gender', birthday = '$birthday', address='$address', email='$email', contact='$contact', profile='$fileNameNew' WHERE user_login_id = $userid";
                        mysqli_query($conn, $sql);

                        $sql = "UPDATE user_login_history SET name = '$name', gender='$gender', birthday = '$birthday', address='$address', contact='$contact' WHERE user_id = $userid";
                        mysqli_query($conn, $sql);

                        move_uploaded_file($fileTmpName, $fileDestination);
                        
                        header('Location:student.php?success=Update Successfully');
                        

                    } 
                    else {
                        header('Location:student_setting.php?error=Your file is too big!');
                    }
                } 
                else {
                    header('Location:student_setting.php?error=There was an error while uploading your file!');
                }
            } 
            else {
                header('Location:student_setting.php?error=You cannot upload files of this type!');
            }
        } else{
            $userid = $_SESSION['id'];
            $name = $_POST['name'];
            $gender = $_POST['gender'];
            $birthday = $_POST['birthday'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];

            $sql = "UPDATE user_login SET name = '$name', gender='$gender', birthday = '$birthday', address='$address', email='$email', contact='$contact' WHERE user_login_id = $userid";
            mysqli_query($conn, $sql);

            $sql = "UPDATE user_login_history SET name = '$name', gender='$gender', birthday = '$birthday', address='$address', contact='$contact' WHERE user_id = $userid";
            mysqli_query($conn, $sql);
            
            header('Location:student.php?success=Update Successfully');
        }
    } 
    
    if(isset($_POST['passwordBtn'])){

        $userid = $_SESSION['id']; 

        $sql = "SELECT * FROM user_login WHERE user_login_id = $userid ";
        $result = mysqli_query($conn,$sql);

        if($result){
            while ($row = mysqli_fetch_assoc($result)){
                $oldpass = $row['password'];
            }
        }

        $password = $_POST['oldpass'];
        $newpassword = $_POST['newpass'];
        $conpassword = $_POST['conpass'];

        if($oldpass == md5($password)){
            if($newpassword == $conpassword){
                if(strlen($newpassword) >= 8){
                    $enpass = md5($newpassword);

                    $sql = "UPDATE user_login SET password = '$enpass' WHERE user_login_id = $userid";
                    mysqli_query($conn, $sql);

                    header('Location:student.php?success=Password change successfully');

                } else{
                    header('Location:student_setting.php?error=Password should atleast contain 8 character');
                }

            } else{
                header('Location:student_setting.php?error=Password did not match!');
            }

        } else{
            header('Location:student_setting.php?error=Incorrect password');
        }
    }