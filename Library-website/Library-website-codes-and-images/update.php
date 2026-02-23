<?php include('header.php'); ?>
<?php include('connection.php'); ?>

<?php
if(isset($_GET['readingID'])){
$reading_ID=$_GET['readingID'];
$query="SELECT*FROM hj_reading WHERE 'readingID'='$reading_ID';";
$result=mysqli_query($conn,$query);

if(!$result){
die("query".mysqli_error($conn));
}

else{
$ro_w=mysqli_fetch_assoc($result);
}
}

?>


<?php
if(isset($_POST['update_reader'])){
	if(isset($_GET['readingID_new'])){
	  $readingidnew=$_GET['readingID_new'];
	}
$book_name=$_POST['bookName'];
$user_nameR=$_POST['usernameR'];
$quer_y="UPDATE hj_reading SET bookName='$book_name', usernameR='$user_nameR' WHERE readingID='$readingidnew';";
$re_sult=mysqli_query($conn,$quer_y);
if(!$re_sult){
die("query Failed".mysqli_error($conn));
}

else{
header('Location: library_admin.php?update_msg=You have successfully updated the data.');
}
}
?>


<form action="update.php?readingID_new=<?php echo $reading_ID;?>" method="post">
		
		<div class="form-group">
		<label for="bookName">book name</label>
		<input type="text" name="bookName" class="form-control" value="<?php echo $ro_w['bookName']?>">
		</div>
		
		<div class="form-group">
		<label for="usernameR">username</label>
		<input type="text" name="usernameR" class="form-control" value="<?php echo $ro_w['usernameR']?>">
		</div>
		        <br><input type="submit" class="btn btn-success" name="update_reader" value="UPDATE">

</form>


<?php include('footer.php'); ?>