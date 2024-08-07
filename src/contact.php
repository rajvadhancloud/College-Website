<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>College</title>
    <link href="output.css" rel="stylesheet" />
    <link href="input.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-primary">
    <header>
        <nav class="flex justify-around p-4 bg-blue-950 text-white text-2xl navbar">
            <div class="hover:text-blue-200">
                <a href="home.php">Home</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="courses.php"> Courses</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="about.php"> About</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="contact.php"> Contact US</a>
            </div>
            <div class="hover:text-blue-200">
                <a href="signin.php">Login</a>
            </div>
        </nav>
    </header>
    <main>
        <section>
            <h1 class="mt-10 pt-20 text-center text-8xl font-bold">Contact Us</h1>
        </section>
        <section class="parent">
            <div class="text-center bg-blue-950 container">
                <form action="contact.php" method="POST" class="grid grid-cols-1 form_class">
                    <Label class="text-4xl font-bold p-10 text-white">Email</Label>
                    <div class="text-center"><input type="email" name="email" class="email-input"></div>

                    <label class="text-4xl font-bold p-10 text-white">Message</label>
                    <div class="text-center"><input type="text" name="message" class="msg-input"></div>
                    <div class="button_class">
                        <button type="submit" name="submit" class="button_top send_button">Send</button>
                    </div>

                </form>
            </div>
        </section>
    </main>


</body>

</html>

<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mailfrom = $_POST["email"];
    $msg = $_POST["message"];
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rajvardhansingh605@gmail.com';                     //SMTP username
        $mail->Password   = 'pmevbogxugeueegf';                               //SMTP password
        $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($mailfrom);
        $mail->addAddress('rajvardhansingh605@gmail.com');     //Add a recipient


        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Mail from college website from '.$mailfrom;
        $mail->Body    = $msg;

        $mail->send();
        echo '<script>alert("Message has been sent")</script>';
    } catch (Exception $e) {
        echo '<script>alert("error occured")</script>';
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo '<script>alert("Please give some inputs")</script>';
}

?>