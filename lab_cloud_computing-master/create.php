<?php
    require "config/connection.php";

    $res1 = mysqli_query($conn, "SELECT * FROM department");

    if (isset($_POST['btn-submit'])) {    
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $stdID = $_POST['studentID'];
        $deptID = $_POST['deptID'];

        $sql= "INSERT INTO students (stdID, fname, lname, deptID) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssss', $stdID, $fname, $lname, $deptID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        
        if(!isset($sql)){
            die ("Error $sql" .mysqli_connect_error());
        }else{
            header("location: index.php");  
        }
    }
?>

<?php include "templates/header.php";?>

<div class="header" style="color: #46322B"><b >Add a student</b></div>

<form method="post">
    <label class="titleText"  for="studentID" style="color: #46322B" >Student ID:</label>
        <input class="form-control" type="text" placeholder="603xxxxxx-x" name="studentID" id="studentID"   required>
    <label class="titleText" for="firstname" style="color: #46322B" >First Name:</label>
        <input class="form-control" type="text" placeholder="Firstname" name="firstname" id="firstname"required>
    <label class="titleText" for="lastname" style="color: #46322B" >Last Name:</label>
        <input class="form-control" type="text" placeholder="Lastname"name="lastname" id="lastname"required>
    <label class="titleText" for="deptID" style="color: #46322B" >Departments:</label>
        <select class="form-control" name="deptID" id="departmentID_item">
            <?php 
            
            while($row = mysqli_fetch_array($res1)) {
                echo "<option value='".$row['deptID']."'>".$row['deptName']."</option>";
            } 
                mysqli_close($conn);?>

        </select>
   
     <br>

    <div class="form-row align-items-center">
        <div class="col-auto">
            <a href="index.php" class="linkText" >Back to HOME</a>
        </div>
        <div class="locationText" >
             <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Submit
            </button>
        </div>
    </div>

   
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="color: black">Save data student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="styleText"> Do you want to save the information ? </p>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="btn-submit" id="btn-submit" > Save  </button>
            </div>
        </div>
    </div>
    </div>
   

</form>


</div>
<?php include "templates/footer.php";?>


