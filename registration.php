<?php
session_start();
include("connection.php");
// $db_host = 'localhost';
// $db_username = 'root';
// $db_password = '';
// $db_name = 'tour';
// $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
if ($cn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $terms_accepted = isset($_POST['terms']) ? $_POST['terms'] : '';
    if (
        empty($name) || empty($email) || empty($password) ||
        empty($confirm_password) || empty($phone) || empty($address)
    ) {
        $error = "Please fill in all fields";
    }
    else if (strlen($phone) != 10) {
        $error = "phone number's length should be 10";
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address";
    } elseif ($password != $confirm_password) {
        $error = "Passwords do not match";
    } elseif ($terms_accepted != 'on') {
        $error = "You must accept the terms and conditions";
    } else {
        if (validatePassword($password)) {
            echo 'Password is valid!';
        } else {
            echo 'Password is not valid!';
            if(!empty($phone)){
                $checkduppho="select * from registration where phone='$phone'";
                $execute=mysqli_query($cn,$checkduppho);
                $numpho=mysqli_num_rows($execute);
                if($numpho>0){
                    $error="phone number already exists";
                }
            } 
            $query = "INSERT INTO registration (name, email, phone, password, address) VALUES ('$name', '$email', '$phone','$password','$address')";

            

            $result = $cn->query($query);

            if ($result) {
                $success = "Registration successful! You can now login.";
                $_SESSION['username'] = $name;
                setcookie('username', $name, time() + (86400 * 30), "/"); // 86400 = 1 day
                header("location:login.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
    }
}
function validatePassword($password)
{
    if (strlen($password) < 8 || strlen($password) > 16) {
        return false;
    }
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    if (!preg_match('/[!#$%^&*]/', $password)) {
        return false;
    }
    return true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register - Tour Packages</title>
    <link rel="stylesheet" href="registration.css">
</head>

<body>
    <a href="home.php" style="text-decoration:none; color:#00bfff; padding:3px">Back to Homepage!</a>

    <div class="container">
        <h1>Register</h1>
        <?php if (isset($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } elseif (isset($success)) { ?>
            <div class="success"><?php echo $success; ?></div>
        <?php } ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br><br>
            <div class="password-input">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

            </div>
            <div class="password-input">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password">
            </div>
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone"><br><br>
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea><br><br>
            <input type="checkbox" id="terms" name="terms">
            <label for="terms">I accept the Terms&Conditions</label><br><br>
            <!-- <p>if you want to store your cookies</p> -->
            <input type="submit" name="submit" value="Register">
        </form>
    </div>

</body>

</html>