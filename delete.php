<?php
include("connection.php");

$id = $_GET['id'];
$query = "DELETE FROM `missingpersondetails` WHERE case_id='$id'"; //delete query

$data = mysqli_query($conn,$query);

if($data){
    echo "<script>alert('Record Deleted Successfully')</script>";
    ?>
    <meta http-equiv = "refresh" content = "0; url = http://localhost/missingperson/display.php" />
    <?php
}
else{
    echo "<script>alert('Error in deleting record')</script>";
}

?>