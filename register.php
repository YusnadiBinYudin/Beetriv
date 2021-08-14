<?php
require_once('connection.php');
?>

<?php
//cara install phpmailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Beetriv - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<?php
if (isset($_POST['submit']))
{
    $username   = $_POST['username'];
    $password   = $_POST['password'];
    $email      = $_POST['email'];

    $mail= new PHPMailer(true);

    try {
        
        //Enable debug output
        $mail->SMTPDebug = 0;

        //Send using SMTP
        $mail->isSMTP();

        //Set the SMTP server 
        $mail->Host = 'smtp.gmail.com';

        //Enable SMTP authentication
        $mail->SMTPAuth = true;

        //SMTP username
        $mail->Username = 'haziqzulhazmi@gmail.com';

        //SMTP password
        $mail->Password = 'Haziq,804';

        //SMTP username
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        //SMTP PORT
        $mail->Port = 587;

        //Recipients
        $mail->setFrom('haziqzulhazmi@gmail.com','beetriv.com');

        //add recipient
        $mail->addAddress($email,$username);

        //Set email format to HTML
        $mail->isHTML(true);

        //converting text to html
        // $mail .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        //generating random 4 digit code
        $vcode=substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyzABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 4);

        $mail->Subject = 'Email Authentication Code';
        $mail->Body    = '<p>Verification code is: </p>' . $vcode;
        //<a href="http://localhost/Email%20Authentication/registration.php">Reset your password</a> 

        $mail->send();

        $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (Username, Email, Password) VALUES ('" . $username . "', '" . $password . "', '" . $email . "')";
        //mysql_query($conn, $sql);
        // $result = $stmtinsert->execute([$username,$password,$email,$vcode]);

        // if($result){
        //     echo 'Success';
        // }else{
        //     echo 'Error';
        // }

        header("Location: email-verification.php?email=" . $email);
        exit();
    }catch (Exception $e){
        echo "Message cannot send, Error Mail: {$mail->ErrorInfo}";
    

    
    }

   
    
}
?>

<form method= "post" action="emailverification.php" id="myForm">
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="firstname" name="username"
                                            placeholder="First Name" required/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="lastname" name="username"
                                            placeholder="Last Name" required/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email"
                                        placeholder="Email Address" required/>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleInputPassword" placeholder="Password" required/>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password"
                                            id="exampleRepeatPassword" placeholder="Repeat Password" required/>
                                    </div>
                                </div>
                                <input type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block" value="Register Account" required>
                                </a>
                                <hr>
                                <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    </form>
   

    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>