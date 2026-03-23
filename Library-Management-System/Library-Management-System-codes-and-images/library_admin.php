<!DOCTYPE html>
<?php include('header.php');?>
<?php include('connection.php');?>
<div class="box1">
<h2>ALL READERS</h2>
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">ADD READER</button>
</div>
<table class="table table-hover table-borderd table-striped">
<thead>
<tr>
<th style="width:140">READING-ID</th>
<th style="width:140">BOOK NAME</th>
<th style="width:140">USERNAME</th>
<th style="width:140">UPDATE</th>
<th style="width:140">DELETE</th>

</tr>
</thead>

<tbody>
<?php
$query="SELECT*FROM hj_reading;";
$result=mysqli_query($conn,$query);

if(!$result){
die("query".mysqli_error($conn));
}

else{
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $row['readingID']?></td>
<td><?php echo $row['bookName']?></td>
<td><?php echo $row['usernameR']?></td>
<td><a href="update.php?readingID=<?php echo $row['readingID']?>" class="btn btn-success">Update</a></td>
<td><a href="delete.php?readingID=<?php echo $row['readingID']?>" class="btn btn-danger">Delete</a></td>

</tr>
<?php
}
}
mysqli_close($conn);
?>
</tbody>
</table>

<?php
if(isset($_GET['insert_msg'])){
echo "<h6>".$_GET['insert_msg']."</h6>";
}
?>

<?php
if(isset($_GET['update_msg'])){
echo "<h6>".$_GET['update_msg']."</h6>";
}
?>

<?php
if(isset($_GET['delete_msg'])){
echo "<h6>".$_GET['delete_msg']."</h6>";
}
?>
<!-- Modal -->
<form action="insert.php" method="post">
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ADD READER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="modal-body">
		<div class="form-group">
		<label for="bookName">book name</label>
		<input type="text" name="bookName" class="form-control">
		</div>
		
		<div class="form-group">
		<label for="usernameR">username</label>
		<input type="text" name="usernameR" class="form-control">
		</div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		
        <input type="submit" class="btn btn-success" name="add_reader" value="ADD">
      </div>
    </div>
  </div>
</div>
</form>
<?php include('footer.php');?>