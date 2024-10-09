<?php
include("connection.php");
include("header.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-5.0.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="jquery.js"></script>
    <script src="textvalid.js"></script>
    <title>Update Packages</title>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <a href="manageuser.php" title="Return To The Package"><span
                    class="material-symbols-outlined">arrow_back</span></a>
            <h3>Update User</h3>



            <form method="post">
                <div class="row">
                    <div class="col-md-6">
                        <label for="n" class="control-label">Name:</label>
                        <input type="text" class="form-control" id="n" name="name" value="<?php echo $_GET['name'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="ee" class="control-label">Email:</label>
                        <input type="email" class="form-control" id="ee" name="email"
                            value="<?php echo $_GET['email'] ?>">
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="ph" class="control-label">Phone:</label>
                        <input type="text" class="form-control" id="ph" name="phone" value="<?php echo $_GET['pho'] ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="add" class="control-label">Address:</label>
                        <textarea name="address" id="add" class="form-control"><?php echo $_GET['add'] ?></textarea>

                    </div>

                    <!-- <div class="row">
                <div class="col-md-6">
                <label for="pi" class="control-label">Image:</label> <br>
                <input type="file"  class="form-file" id="pi" name="packiamge">
                </div>
            </div> -->
                    <!-- <button type="submit" value="submit" name="submit" id="btninsert"
                        class="btn btn-primary">UPDATE</button>
                    <button type="reset" value="reset" name="reset" class="btn btn-secondary ">RESET</button> -->
                    <div class="row mt-3">
                <div class="col-md-1">
                    <button type="submit" value="submit" name="submit" id="btninsert" class="btn btn-primary">UPDATE</button>
                </div>
                <div class="col-md-1">
                    <button type="reset" value="reset" name="reset" class="btn btn-secondary ms-3">RESET</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>
<?php

if (isset($_POST['submit'])) {
    $nm = $_POST['name'];
    $em = $_POST['email'];
    $ph = $_POST['phone'];
    $ad = $_POST['address'];
    ;
    $iq = "update registration set name='$nm',email='$em',phone='$ph',address='$ad' where rid=" . $_GET['id'];
    $up = mysqli_query($cn, $iq);
    if (!$up) {
        echo '<script> alert("Upadte unsuccessfull")</script>';
        exit;
    } else {
        echo '<script> alert("Update successfull")</script>';
        exit;
    }
}
?>