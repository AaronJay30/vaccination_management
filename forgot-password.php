<?php

    use PHPMailer\PHPMailer\PHPMailer;

    @include 'include\config.php';
    session_start();

    if(isset($_POST['action'])){
        function sendmail(){
            
            $email = $_POST['email'];
            $name = "Oceans of Knowledge High school"; 
            $code = $_POST['code'];
            $to = $email; 
            $subject = "Reset Password";
            $body = "<font size='3'> Hello! 
            <br><br> Forgot your password?
            <br>We received a request to reset the password for your account.
            <br>Here's the code <b>".$code."</b>
            <br>Take care and stay safe!
            <br><br> Regards,
            <br><br><b>-Oceans of Knowledge High School</b> - <i>'A Great Place For Education.'</i>
            </font>";
            $from = "oceansofknowledge3100@gmail.com"; 
            $password = "vogctnfckzicnwhi";  

            //vogctnfckzicnwhi
            //comsci3100lecture
    
            // Ignore from here
    
            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";
            $mail = new PHPMailer();
    
            // To Here
    
            //SMTP Settings
            $mail->isSMTP();
            // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
            $mail->Host = "smtp.gmail.com"; // smtp address of your email
            $mail->SMTPAuth = true;
            $mail->Username = $from;
            $mail->Password = $password;
            $mail->Port = 587;  // port
            $mail->SMTPSecure = "tls";  // tls or ssl
            $mail->smtpConnect([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
                ]
            ]);
    
            //Email Settings
            $mail->isHTML(true);
            $mail->setFrom($from, $name);
            $mail->addAddress($to); // enter email address whom you want to send
            $mail->Subject = ("$subject");
            $mail->Body = $body;
            if ($mail->send()) {
                echo "email sent";
            } else {
                echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
            }
        
        }
    }

    sendmail();


?>