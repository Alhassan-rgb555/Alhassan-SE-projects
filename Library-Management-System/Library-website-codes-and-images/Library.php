<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title> Alhassan library </title>
<div class="header">
<h1> Welcome to Alhassan library! </h1>
<div class="button-container">
<form><a href="signup_login.php" class="button red-button">signout</a></form>
</div>
</div>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<style type="text/css">
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 2px solid #201042;
  text-align: left;
  padding: 4px;
}

tr:nth-child(even) {
  background-color: #753bb9;
  }
</style>
</head>
<body>
<br><div class="main">
<table class="table">
<tr>
<th style="width: 100px; height: 80px"> book image </th>
<th style="width: 100px; height: 80px"> book name </th>
<th style="width: 100px; height: 80px"> book author </th>
<th style="width: 100px; height: 80px"> book source for reading </th>
</tr>

<!--1-->
<tr>
<td> <img src="The_ Island_Of_Doctor_Moreau.jpg" width="100" height="120"> </td>
<td> The Island Of Dr Moreau </td>
<td> H. G. Wells </td>
<td> <a href="https://www.gutenberg.org/ebooks/159"> Project Gutenberg </a> </td>
</tr>
<!--2-->
<tr>
<td> <img src="The_Complete_Works_of_William_Shakespeare.jpg" width="100" height="120" </td>
<td> The Complete Works of William Shakespeare </td>
<td> William Shakespeare </td>
<td> <a href="https://www.gutenberg.org/ebooks/100"> Project Gutenberg </a> </td>
</tr>
<!--3-->
<tr>
<td> <img src="The.jpg" width="100" height="120"> </td>
<td> The Oxford English Dictionary </td>
<td> J. A. Simpson </td>
<td> <a href="https://archive.org/details/oxfordenglishdic0000unse_a3t6/mode/2up"> Internet Archeive </a> </td>
</tr>
<!--4-->
<tr>
<td> <img src="Robinson_Crusoe.jpg" width="100" height="120"> </td>
<td> Robinson Crusoe </td>
<td> Daniel Defoe </td>
<td> <a href="https://archive.org/details/cu31924011498676/mode/2up"> Internet Archeive </a> </td>
</tr>
<!--5-->
<tr>
<td> <img src="The_shadow_on_the_spark.jpg" width="100" height="120"> </td>
<td> The shadow on the spark </td>
<td> Edward S. Sears </td>
<td> <a href="https://www.gutenberg.org/ebooks/75049"> Project Gutenberg </a> </td>
</tr>
<!--6-->
<tr>
<td> <img src="adventure.jpg" width="100" height="120"> </td>
<td> When East met West </td>
<td> W. C. Tuttle </td>
<td> <a href="https://www.gutenberg.org/ebooks/74958"> Project Gutenberg </a> </td>
</tr>
<!--7-->
<tr>
<td> <img src="Inside the inventors's.jpg" width="100" height="120"> </td>
<td> Inside the investor's brain : the power of mind over money </td>
<td> Peterson, Richard L. </td>
<td> <a href="https://archive.org/details/insideinvestorsb0000pete/page/n5/mode/2up"> Internet Archieve </a> </td>
</tr>
<!--8-->
<tr>
<td> <img src="The game of life.jpg" width="100" height="120"> </td>
<td> The game of life and how to play it </td>
<td> Florence Scovel Shinn </td>
<td> <a href="https://www.gutenberg.org/ebooks/74878"> Project Gutenberg </a> </td>
</tr>
</table>
</div>
<style>
.inread{
text-align: center;
background-color: #1c595a;
color: #fff;
padding: 10px;
letter-spacing: 2px;
font-weight: 250;
justify-content: center;
margin: 10px auto;
padding: 5px;
border: none;
outline: none;
border-radius: 10px;
}

body{
margin: 0;
padding: 0;
justify-content: center;
align-items: center;
min-height: 100vh;
font-family: 'Jost', sans-serif;
background:url("pexels-photo-1907785.jpeg");
}

.main{
width: 500px;
height: 1150px;
background: #753bb9;
overflow: hidden;
border-radius: 10px;
box-shadow: 5px 20px 50px #000000;
margin: 0 auto;
}

.header{
text-align: center;
background-color: #1c1381;
color: #fff;
padding: 20px;
letter-spacing: 2px;
font-weight: 500;
}

.button-container{
display: flex;
justify-content: flex-end; /*Align buttons to right*/
}
.button{
margin-left: 20px; /*Add spacing between buttons*/
padding: 10px 20px;
border: none;
border-radius: 5px;
cursor: pointer;
}

.red-button{
background-color: #ff0000;
display: inline-block;
padding: 10px 20px;
color: white;
text-decoration: none;
border: none;
border-radius: 5px;
cursor: pointer;
font-family: calibri;	
}

a{
display: inline-block;
padding: 10px 20px;
background-color: #5a6c78;
color: white;
text-decoration: none;
border: none;
border-radius: 5px;
cursor: pointer;
font-family: calibri;	
}

.button:hover{
box-shadow: 0px 0px 15px #4CAF50;
}

#lantern{
background-color: #ce3d0b;
color: #fff;
padding: 10px;
letter-spacing: 2px;
font-weight: 250;
}
</style>
<div class="inread">
<form method="post">
<label>Enter the book name you want as shown in the table above and your username to save the reading</label><br><br>
<input type="text" name="bknme" maxlength="30" placeholder="book name"><br><br>
<input type="text" name="usrnme" maxlength="30" placeholder="username"><br><br>
<input type="submit" value="submit"><br>
</form> 
</div>
</body>
</html>

<?php
include('connection.php');

$qu_ery="INSERT INTO hj_reading(bookName, usernameR) VALUES('".$_POST['bknme']."', '".$_POST['usrnme']."');";

$sql=mysqli_query($conn,$qu_ery) or die(mysqli_error($conn));
$conn->close;
?>

<?php
include('connection.php');
session_start();
if(isset($_SEESSION['signupID'])){
$_SESSION=array();
session_destroy();
header("Location: signup_login.php");
exit();
$query="DELETE FROM hj_signup WHERE signupID='';";
}

else{
header("Location: Library.php");
exit();
}
$conn->close();
?>