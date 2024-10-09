<?php
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'tourms';
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
function changePassword($oldPassword, $newPassword) {
 if ($oldPassword === $newPassword) {
 echo "You have entered your last password";
 }
}
if (isset($_POST['forgot'])) {
 $username = $_POST['username'];
 $new_password = $_POST['newpass'];
 $query = "UPDATE registration SET password = '$new_password' WHERE name ='$username'";
 require 'src/Exception.php';
 require 'src/PHPMailer.php';
 require 'src/SMTP.php';
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
 $query = "SELECT * FROM registration WHERE name = '$username'";
 $result = $conn->query($query);
 $row = mysqli_fetch_assoc($result);
 $email = $row['email'];
 $phone = $row['phone'];

 $mail->isSMTP(); 
 $mail->Host = 'smtp.gmail.com'; 
 $mail->SMTPAuth = true; 
 $mail->Username = 'tourd2004@gmail.com'; 
 $mail->Password = 'osej kxhi hfra gbqq';
 $mail->SMTPSecure = 'tls' ; 
 $mail->Port = 587;
 $mail->setFrom('tourd2004@gmail.com', 'patel dhruv');
 $mail->addAddress($email, $username);
 $mail->addReplyTo('tourd2004@gmail.com', 'dhruv');

 $mail->isHTML(true);
 $mail->Subject = 'new password';
 $mail->Body = 'your new password is :'.$new_password;
 $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
 if( $mail->send()){
 echo 'Message has been sent';
 }
} catch (Exception $e) {
 echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

?>
<html>
<head>
 <title>Tour Packages Login</title>
 <style>
  body {
            font-family: Arial, sans-serif;
            color:#00bfff;
        }
        .container {
            width: 300px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        .btn {
            background-color: #00bfff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #00bfff;
        }
        
        .label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color:#00bfff;
        }
        .btn:hover {
            background-color: #3e8e41;
        } 
 </style>
</head>
<body>
 <div class="container">
 <h2>Forgot Password</h2>
 <?php if (isset($error)) { ?>
 <p style="color: red;"><?php echo $error; ?></p>
 <?php } ?>
 <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 <label for="username">Username:</label>
 <input type="text" id="username" name="username" class="form-control"required><br><br>
 <label for="password">New Password:</label><br>
 <input type="password" id="password" name="newpass" class="form-control" required><br><br>
 <input type="submit" name="forgot" value="Reset Password"class="btn">
 </form>
 </div>
</body>
</html>