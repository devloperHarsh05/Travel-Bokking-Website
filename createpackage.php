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
    <script src="jquery.js"></script>
    <!-- <script src="validscript.js"></script> -->
     <script src="textvalid.js"></script>
    <title>Create Packages</title>
</head>
<body>
    <div class="content">
    <div class="container-fluid">
    <a href="packages.php" title="Return To The Package"><span class="material-symbols-outlined">arrow_back</span></a>

        <h3>Create Package</h3>

        <form method="post"  enctype="multipart/form-data" >
            <div class="row">
                <div class="col-md-6">
                <label for="pn" class="control-label">Packages Name:</label>
                <input type="text"  class="form-control" id="pn" name="packname">
                </div>
                <div class="col-md-6">
                <label for="pc" class="control-label">Pakcage Category:</label>
                <select name="packcategory" id="pc" class="form-select">
                    <option value=""></option>
                    <option value="island">Island</option>
                    <option value="island">Temple</option>
                    <option value="mountain">Mountain</option>
                    <option value="beach">Beach</option>
                    <option value="desert">Desert</option>
                    <option value="forest">Forest</option>
                    <option value="city">City</option>
                    <option value="cultural">Cultural</option>
                    <option value="historical">Historical</option>
                    <option value="wildlife">Wildlife</option>
                    <option value="adventure">Adventure</option>
                </select>
                
                </div>
<!--                
                <div class="col-md-6">
                <label for="pt" class="control-label">Packages Type:</label>
                <select name="packname" id="pt" class="form-select">
                    <option value="family">Family</option>
                    <option value="couple">Couple</option>
                    <option value="solo">Solo</option>
                    <option value="group">Group</option>
                </select>
                </div> -->
            
            <div class="row">
                <div class="col-md-6">
                <label for="pl" class="control-label">Packages Location:</label>
                <input type="text"  class="form-control" id="pl" name="packlocation">
                </div>
            
            
                <div class="col-md-6">
                <label for="pp" class="control-label">Packages Price:</label>
                <input type="number"  class="form-control" id="pp" min="1" step="1" name="packprice" placeholder="(currency ₹)">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <label for="pd" class="control-label">Packages Details:</label>
                <textarea name="packdetail" id="pd" class="form-control"></textarea>
                </div>
             
                <div class="col-md-6">
                <label for="pi" class="control-label">Image:</label> <br>
                <input type="file" name="fileimg[]" accpt=".jpg .jpeg" require multiple><br>
                </div>
            </div> 
            <button type="submit" value="submit" name="submit" id="btninsert"class="btn btn-primary ">CREATE</button>
            <button type="reset" value="reset" name="reset"class="btn btn-secondary ">RESET</button>
        </form>
    </div>
    </div>
</body>
</html>


<?php 
    if(isset($_POST['submit'])){

        $pn=$_POST['packname']?? '';;
    $pc=$_POST['packcategory']?? '';;
    $pl=$_POST['packlocation']?? '';;
    $pp=$_POST['packprice']?? '';;
    $pd=$_POST['packdetail']?? '';;
        // ...
        if(isset($_FILES['fileimg'])){ // Check if the file array is set
            $totalfiles= count ($_FILES['fileimg']['name']);
            $filearray = array();
    
            for($i=0;$i<$totalfiles;$i++){
                $imagename=$_FILES['fileimg']['name'][$i];
                $tmpname=$_FILES['fileimg']['tmp_name'][$i];
    
                $imageExtension = explode('.',$imagename);
                $imageExtension = strtolower(end($imageExtension));
    
                $newimageName = uniqid() . '.' .$imageExtension;
                move_uploaded_file($tmpname,'uploads/'. $newimageName);
                $filearray[] = $newimageName;
            }
            $filearray = json_encode($filearray);
        } else {
            $filearray = '[]'; // Set an empty array if no files are uploaded
        }
    
        $iq="insert into packages values('','$pn','$pc','$pl','$pp','$pd','$filearray')";
        $in=mysqli_query($cn,$iq);
        if(!$in){
            echo '<script> alert("Insert unssssuccessfull")</script>';
            exit;
        } else {
            echo '<script> alert("Insert successfull")</script>';
            exit;
        }
    }
?>