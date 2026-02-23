<?php include('connection.php');?>

<?php

if(isset($_GET['readingID'])){
$read_ing_id=$_GET['readingID'];	


$qu_ery="DELETE FROM hj_reading where readingID='$read_ing_id'";

$res_ult=mysqli_query($conn,$qu_ery);

if(!$res_ult){
die("Query failed".mysqli_error($conn));	
}

else{
    header('Location: library_admin.php?delete_msg=You have deleted the record.');
}

}
$conn->$close();
?>