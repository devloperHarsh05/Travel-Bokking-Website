
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <title>Packages</title>
</head>
<body>
<div class="content">
    <div class="container">
    <h2>Packages Management</h2>
    
    <h4>View Packges</h4>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>PACKAGE_NAME</th>
                <th>PACKAGE_CATEGORY</th>
                <th>PACKAGE_LOCATION</th>
                <th>PACKAGE_PRICE</th>
                <th>PACKAGE_DETAILS</th>
                <th colspan="2">OPRATIONS</th>
                <th><a href="createpackage.php" title="Add package"><span class="material-symbols-outlined">add_circle</span></a></th>
            </tr>
        
    <?php
    
    $query="select * from packages";
    $exe=mysqli_query($cn,$query);
    // while($row=mysqli_fetch_array($exe)){
    //     echo "<tr><td>".$row["0"]."</td><td>"
    //     .$row["1"]."</td><td> "
    //     .$row["2"]."</td><td>"
    //     .$row["3"]."</td><td>"
    //     .$row["4"]."</td><td>"
    //     .$row["5"]."</td><td>
    //     <a href='updatepackage.php?id=$row[pid]&pname=$row[package_name]&pcate=$row[package_cate]&ploc=$row[package_loc]&pprice=$row[package_price]&pdetail=$row[package_detail]'>Edit</a></td><td>"
    //     ."<a href='deletepackage.php?id=$row[pid]'>Delete</a></td></tr></table>";
    // }
    while ($row = mysqli_fetch_assoc($exe)) {
        echo "<tr>
            <td>" . $row["pid"] . "</td>
            <td>" . $row["package_name"]. "</td>
            <td>" . $row["package_cate"]. "</td>
            <td>" . $row["package_loc"] . "</td>
            <td>" . $row["package_price"] . "</td>
            <td>" . $row["package_detail"] . "</td>
            <td><a title='Edit Package' href='updatepackage.php?id=$row[pid]&pname=$row[package_name]&pcate=$row[package_cate]&ploc=$row[package_loc]&pprice=$row[package_price]&pdetail=$row[package_detail]'><span class='material-symbols-outlined'>edit_square</span></a></td>
            <td><a href='#' title='Remove Package'onclick='confirmdelete(\"deletepackage.php?id=".$row["pid"] ."\")' ><span class='material-symbols-outlined'>delete</span></a></td>
        </tr>";
    }
    ?>
    </table>
    </div>
    </div>
    <script>
        function confirmdelete(url){
            if(confirm("Are you sure you want to delete the record?if you delete the package then package's booking will also be deleted")){
                window.location.href=url;
            }
        }
    </script>

</body>
</html> 