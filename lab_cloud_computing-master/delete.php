<?php
require "config/connection.php";

$id = $_GET["stdID"];


$sql = "DELETE FROM students WHERE stdID='" . $id ."' ";

if (mysqli_query($conn, $sql)) {
    header("location:index.php"); 
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
?>