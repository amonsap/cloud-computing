<?php
    require "config/connection.php";
    
    if(isset($_GET['stdID'])){
        $id = $_GET['stdID'];
        $sql = "SELECT * FROM students WHERE stdID = '$id' ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($res);
    }

    if(isset($_POST['btn-update'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $deptID = $_POST['deptID'];
        $stdID = $_POST['stdID'];
        $update = "UPDATE students SET fname='$fname', lname='$lname',deptID='$deptID' WHERE stdID = '$stdID' ";
        $up = mysqli_query($conn, $update);
        if(!isset($sql)){
            die ("Error $sql" .mysqli_connect_error());
        }else{
            
            header("location: index.php");
            
        }
    }
?>
<script>
function update(){
    var x;
    if(confirm("Do you want to edit the information?") == true){
        x= "update";
 }
}
</script>
<?php include "templates/header.php";?>
<div class="header" style="color: #46322B"><b >Edit student</b></div>


<form method="POST" >
            <input type="hidden" name="stdID" id="stdID" value="<?php echo $row["stdID"];?>"><br>
        <label  for="firstname" style="color: #46322B" >First Name:</label>
            <input class="form-control" type="text" name="fname" id="fname" value="<?php echo $row['fname'];?>"><br>
        <label  for="lastname" style="color: #46322B" >Last Name:</label>
            <input class="form-control" type="text" name="lname" id="lname" value="<?php echo $row['lname'];?>"><br>
        <label  for="deptID" style="color: #46322B" >Departments:</label>        
            <select class="form-control" name="deptID" id="departmentID_item">
    <?php
    
    $res2 = mysqli_query($conn, "SELECT * FROM department");
    while($row2 = mysqli_fetch_array($res2)) {
        echo "<option value='".$row2['deptID']."'>".$row2['deptName']."</option>";
    } ?>

    </select>
    <br>

    <div class="form-row align-items-center">
        <div class="col-auto">
            <a href="index.php" class="linkText" >Back to HOME</a>
        </div>
        <div class="locationText" >
             <!-- Button trigger modal -->
             <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update" onClick="update()">Update</button>
                Submit
            </button>
        </div>
    </div>
</form>

<?php
 $fname = $_POST['firstname'];
 $lname = $_POST['lastname'];
 $stdID = $_POST['studentID'];
 $deptID = $_POST['deptID'];
?>
</div>
<?php include "templates/footer.php";?>
