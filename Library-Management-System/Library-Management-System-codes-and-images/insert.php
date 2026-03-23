<?php
include('connection.php');
if(isset($_POST['add_reader'])){
$bookName=$_POST['bookName'];
$usernameR=$_POST['usernameR'];
if(($bookName=='' && $usernameR=='') || (empty($bookName) && empty($usernameR))){
	header('Location: library_admin.php?insert_msg=You need to fill the book name and the username!');
}

else{
$que_ry="INSERT INTO hj_reading(bookName, usernameR) VALUES('$bookName', '$usernameR');";
$result2=mysqli_query($conn,$que_ry) or die(mysqli_error($conn));
header('Location: library_admin.php');
}
}
$conn->close();
?>