<?php
require "config/connection.php";
require "templates/header.php"; 

$res = mysqli_query($conn, 'SELECT * FROM students, department WHERE students.deptID = department.deptID');

if(isset($_GET['searchid']) ){
    $stdID = $_GET['searchid'];
    $sql = "SELECT * FROM students,department 
    WHERE students.deptID = department.deptID AND stdID LIKE '%$stdID%' ";
    $res = mysqli_query($conn, $sql);
}

?>

<script>
    function confirmDelete(ID) { 
        var ans = confirm("Do you want to delete " + ID + " the information ?");
    if (ans==true){
        document.location = "delete.php?stdID=" + ID;
    }
}
</script>


<div class="header" style="color: #46322B"><b >Edit Profile</b></div>

<form method="GET">
    <div class="form-row align-items-center">
        <div class="col-auto">
            <input  class="form-control" type="text" placeholder="Input Student ID" id="serachid" name="searchid">
        </div>
        <div class="col-auto" >
            <button class="btn btn-primary" type="Search" ><strong>Search</strong></button>
        </div>
    </div>
</form>

<br>
<table class="table table-sm">
    <thead class="thead-dark">
        <tr>
            <th scope="col" class="titleText">StudentID</th>
            <th scope="col" class="titleText">First Name</th>
            <th scope="col" class="titleText">Last Name</th>
            <th scope="col" class="titleText">Department</th>
            <th scope="col" class="titleText">Edit</th>
            <th scope="col" class="titleText">Delete</th>
        </tr>
    </thead>

    <tbody>
        
        <?php 
        while($row = mysqli_fetch_assoc($res)) {?>
        <tr>
            <td class="styleText"><?php echo $row['stdID']; ?> </td>
            <td class="styleText"><?php echo $row['fname']; ?> </td>
            <td class="styleText"><?php echo $row['lname']; ?> </td>
            <td class="styleText"><?php echo $row['deptName']; ?> </td>
            <td class="styleText"><?php echo "<a href='edit-detail.php?stdID=" . $row['stdID']. "'> Edit </a>" ;?></td>
            <td class="styleText">
            <a href='#' onclick='confirmDelete("<?php echo $row['stdID']; ?>")'> Delete </a></td>
        </tr>
        <?php } 
        mysqli_close($conn);?>
    </tbody>
</table>
<a href="index.php" class="linkText" >Back to HOME</a>
</div>
<?php require "templates/footer.php"; ?>