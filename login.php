<?php
include("connection.php");
session_start(); // Start the session
// $db_host = 'localhost';
// $db_username = 'root';
// $db_password = '';
// $db_name = 'tour';
// $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $storeCookie = isset($_POST['storeCookie']) ? $_POST['storeCookie'] : 'no';
    
    $query = "SELECT * FROM registration WHERE (email='$username' OR name='$username') AND password='$password'";
    $query2 = "SELECT * FROM admin WHERE aname='$username' AND password='$password'";
    $result = mysqli_query($cn, $query);
    $result2=mysqli_query($cn, $query2);
    if (mysqli_num_rows($result) > 0) {

        $_SESSION['username'] = $username;
        $_SESSION['loggedin']=true;
        header('Location: home-1.php');
        exit();
    }
    elseif (mysqli_num_rows($result2)>0){
        $_SESSION['usernameadmin'] = $username;
        $_SESSION['loggedin']=true;
        header('Location: admin.php');
        exit();
    }
    else {
        echo "<script>alert('invalid username or password');window.location.href='login.php'</script>";
    }
}
$passwordLastChanged = strtotime('2024-09-01');
function checkPasswordExpiration($passwordLastChanged)
{
    $timeSinceLastChange = time() - $passwordLastChanged;
    if ($timeSinceLastChange > 90 * 24 * 60 * 60) {
        return true;
    }
    return false;
}
if (isset($_POST['check'])) {
    $passwordLastChanged = strtotime('2024-08-01');
    if (checkPasswordExpiration($passwordLastChanged)) {
        echo "<p>Password is expired</p>";
    } else {
        echo "<h1 class='blurred'>Password is still valid!</h1>
 <style>
 .blurred {
 filter: blur(5px);
 animation: blur-clear 2s forwards;
 }
 @keyframes blur-clear {
 0% {
 filter: blur(5px);
 }
 100% {
 filter: blur(0);
 }
 }
 </style>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelista Tours</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background-color: whitesmoke;
            color: #fff;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 400px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #00bfff;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color:#00bfff;
        }

        .input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            outline: none;
        }

        .button {
            background-color: #00bfff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .button:hover {
            background-color: #0099cc;
        }

        .or {
            text-align: center;
            margin-bottom: 20px;
        }

        .social-login {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .social-button {
            background-color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .social-button:hover {
            background-color: #e0e0e0;
        }

        .social-icon {
            font-size: 20px;
            color: #00bfff;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer a {
            color: #00bfff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

      
    </style>
</head>

<body>
<a href="home-1.php" style="text-decoration:none; color:#00bfff; padding:3px">Back to Homepage!</a>
    <div class="container">
        
        <div class="card">
            <h2 class="title">Welcome</h2>
            <form action="#" method="post">
                <div class="form-group">
                    <label for="email" class="label">Email Id</label>
                    <input type="text" id="email" class="input" name="username" placeholder="username or email" required>
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="form-group">
                    <label for="password" class="label">Password</label>
                    <input type="password" id="password" class="input" name="password" placeholder="********" required>
                    <i class="fas fa-lock"></i>
                </div>
                <input type="submit" class="button" name=submit>LOGIN
                <div class="or">OR</div>

                <div class="footer">
                    
                    <a href="forgot.php">Forgot your password?</a><br> 
                    <br> <br><br>
                    <a href="registration.php">Create An a Account!</a> <br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>