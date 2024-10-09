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

    <title>Users</title>
</head>

<body>
    <div class="content">
        <div class="container">
            <h2>Users Management</h2>
            <h4>View Users</h4>
            <form method="post">
                <div class="row">
                    <div class="col-md-6  d-flex justify-content-end">
                        <label for="ser" class="label-control me-0">Search:</label>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex">
                        <input type="text" id="ser" class="form-control" name="search"
                            placeholder="Search By Name or Phone no">
                            <button type="submit" value="find" name="find"><span class="material-symbols-outlined">search</span></button>
                            </div>
                        </div>
                </div>
            </form>


            <table class="table table-bordered table-striped">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE NO</th>
                    <th>ADDRESS</th>
                    <th colspan="2">OPRATIONS</th>
                </tr>
                <?php
                if (isset($_POST["find"])) {
                    $findr = $_POST['search'] ?? '';
                    $query = "select * from registration where name='$findr' or phone='$findr'";
                    $exe = mysqli_query($cn, $query);
                    if (!$exe || mysqli_num_rows($exe) == 0) {
                        echo "<tr><td colspan='7'>No results found for '$findr'</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($exe)) {
                            echo "<tr>
                                <td>" . $row["rid"] . "</td>
                                <td>" . $row["name"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phone"] . "</td>
                                <td>" . $row["address"] . "</td>
                                <td><a title='Edit Package' href='updateusers.php?id=$row[rid]&name=$row[name]&email=$row[email]&pho=$row[phone]&add=$row[address]'><span class='material-symbols-outlined'>edit_square</span></a></td>
                                <td><a href='#' title='Remove Package' onclick='confirmdelete(\"deleteusers.php?id=" . $row["rid"] . "\")'><span class='material-symbols-outlined'>delete</span></a></td>
                            </tr>";
                        }
                    }
                } else if(!isset($_POST["find"])) {
                    // Display all records if no search term is provided
                    $query = "select * from registration";
                    $exe = mysqli_query($cn, $query);
                    while ($row = mysqli_fetch_assoc($exe)) {
                        echo "<tr>
                            <td>" . $row["rid"] . "</td>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>" . $row["phone"] . "</td>
                            <td>" . $row["address"] . "</td>
                            <td><a title='Edit Package' href='updateusers.php?id=$row[rid]&name=$row[name]&email=$row[email]&pho=$row[phone]&add=$row[address]'><span class='material-symbols-outlined'>edit_square</span></a></td>
                            <td><a href='#' title='Remove Package' onclick='confirmdelete(\"deleteusers.php?id=" . $row["rid"] . "\")'><span class='material-symbols-outlined'>delete</span></a></td>
                        </tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <script>
        function confirmdelete(url) {
            if (confirm("If you delete user data then that user's booking data will also be delete.You sure want delete the record?")) {
                window.location.href = url;
            }
        }
    </script>

</body>

</html>
