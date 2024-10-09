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
    <script src="textvalid.js"></script>
    <title>Update Packages</title>
</head>
<body>
<div class="content">
    <div class="container-fluid">
    <a href="packages.php" title="Return To The Package"><span class="material-symbols-outlined">arrow_back</span></a>
        <h3>Update Package</h3>
   
      

        <form method="post">
            <div class="row">
                <div class="col-md-6">
                <label for="pn" class="control-label">Packages Name:</label>
                <input type="text"  class="form-control" id="pn" name="packname" value="<?php echo $_GET['pname']?>">
                </div>
                <div class="col-md-6">
                <label for="pc" class="control-label">Pakcage Category:</label>
                <select name="packcategory" id="pc" class="form-select" >
                    <option value="island" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'island') ? 'selected' : ''; ?>>Island</option>
                    <option value="temple" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'temple') ? 'selected' : ''; ?>>Temple</option>
                    <option value="mountain"<?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'mountain') ? 'selected' : ''; ?>>Mountain</option>
                    <option value="beach" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'beach') ? 'selected' : ''; ?>>Beach</option>
                    <option value="desert" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'desert') ? 'selected' : ''; ?>>Desert</option>
                    <option value="forest" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'forest') ? 'selected' : ''; ?>>Forest</option>
                    <option value="city" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'city') ? 'selected' : ''; ?>>City</option>
                    <option value="cultural" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'cultural') ? 'selected' : ''; ?>>Cultural</option>
                    <option value="historical" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'historical') ? 'selected' : ''; ?>>Historical</option>
                    <option value="wildlife" <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'wildlife') ? 'selected' : ''; ?>>Wildlife</option>
                    <option value="adventure"  <?php echo (isset($_GET['pcate']) && $_GET['pcate'] == 'adventure') ? 'selected' : ''; ?>>Adventure</option>
                </select>
                
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">
                <label for="pl" class="control-label">Packages Location:</label>
                <input type="text"  class="form-control" id="pl" name="packlocation"  value="<?php echo $_GET['ploc']?>">
                </div>
            
            
                <div class="col-md-6">
                <label for="pp" class="control-label">Packages Price:</label>
                <input type="number"  class="form-control" id="pp" min="1" step="1"name="packprice" placeholder="(currency ₹)"  value="<?php echo $_GET['pprice']?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <label for="pd" class="control-label">Packages Details:</label>
                <textarea name="packdetail" id="pd" class="form-control"  ><?php echo $_GET['pdetail']?></textarea>
                </div>
               
            </div>
            <!-- <div class="row">
                <div class="col-md-6">
                <label for="pi" class="control-label">Image:</label> <br>
                <input type="file"  class="form-file" id="pi" name="packiamge">
                </div>
            </div> -->
            <button type="submit" value="submit" name="submit" id="btninsert"class="btn btn-primary">UPDATE</button>
            <button type="reset" value="reset" name="reset"class="btn btn-secondary ">RESET</button>
        </form>
        </div>
    </div>
</body>
</html>
<?php 
        
    if(isset($_POST['submit'])){
        $pn=$_POST['packname'];
        $pc=$_POST['packcategory'];
        $pl=$_POST['packlocation'];
        $pp=$_POST['packprice'];
        $pd=$_POST['packdetail'];
        $iq="update packages set package_name='$pn',package_cate='$pc',package_loc='$pl',package_price='$pp',package_detail='$pd' where pid=".$_GET['id'];
        $up=mysqli_query($cn,$iq);
        if(!$up){
            echo '<script> alert("Upadte successfull")</script>';
            exit;
        }
        else{
            echo '<script> alert("Update successfull")</script>';
            exit;
        }
    }
?>