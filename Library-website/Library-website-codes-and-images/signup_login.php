<?php
include('connection.php');
if (isset($_POST['login'])) {
    // Login processing
    $email = $_POST['eml'];
    $password = $_POST['pswrd'];

    // SQL query to check if the email exists in the database
    $sql = "SELECT signupID, password FROM hj_signup WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User exists, check password
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Successful login
            // Set session variables (replace with your actual session handling)
            session_start();
            $_SESSION['signupID'] = $row['signupID'];
            // Redirect to the user's dashboard or other protected area
            header("Location: Library.php");
            exit();
        } else {
            // Incorrect password
            $error_message = "Incorrect password.";
        }
    } else {
        // User not found
        $error_message = "User not found.";
    }
} elseif (isset($_POST['signup'])) {
    // Signup processing
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // SQL query to insert new user
    $sql = "INSERT INTO hj_signup (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        // Signup successful
        header("Location: Library.php"); // Redirect to Library page after successful signup
        exit();
    } else {
        // Signup failed
        $error_message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Display the signup/login form with any error messages
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up/Login</title>
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<style>
	body{
	margin: 0;
	padding: 0;
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	font-family: 'Jost', sans-serif;
	background:url("grand_books_library.jpg") no-repeat center/ cover;
}
.main{
	width: 350px;
	height: 500px;
	background: red;
	overflow: hidden;
	background: url("huge_books_library.jpg") no-repeat center/ cover;
	border-radius: 10px;
	box-shadow: 5px 20px 50px #000000;
}
#chk{
	display: none;
}
.signup{
	position: relative;
	width:100%;
	height: 100%;
}
label{
	color: #fff;
	font-size: 2.3em;
	justify-content: center;
	display: flex;
	margin: 60px;
	font-weight: bold;
	cursor: pointer;
	transition: .5s ease-in-out;
}
input{
	width: 60%;
	height: 20px;
	background: #e0dede;
	justify-content: center;
	display: flex;
	margin: 20px auto;
	padding: 10px;
	border: none;
	outline: none;
	border-radius: 5px;
}
button{
	width: 60%;
	height: 40px;
	margin: 10px auto;
	justify-content: center;
	display: block;
	color: #fff;
	background: #7e0707;
	font-size: 1em;
	font-weight: bold;
	margin-top: 20px;
	outline: none;
	border: none;
	border-radius: 5px;
	transition: .2s ease-in;
	cursor: pointer;
}
button:hover{
	background: #a35d5d;
}
.login{
	height: 460px;
	background: #fff;
	border-radius: 60% / 10%;
	transform: translateY(-180px);
	transition: .8s ease-in-out;
}
.login label{
	color: #623838;
	transform: scale(.6);
}

#chk:checked ~ .login{
	transform: translateY(-500px);
}
#chk:checked ~ .login label{
	transform: scale(1);	
}
#chk:checked ~ .signup label{
	transform: scale(.6);
}

</style>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
			
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<label for="chk" aria-hidden="true">Sign up</label>
					<input type="text" name="username" placeholder="User name" required="">
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button type="submit" name="signup">Sign up</button>
				</form>
			</div>

            <div class="login">
				<form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="eml" placeholder="Email" required="">
					<input type="password" name="pswrd" placeholder="Password" required="">
					<button type="submit" name="login">Login</button>
					<?php if (isset($error_message)) : ?>
        <p style="color: red; magrin: 0 auto"><?php echo $error_message; ?></p>
    <?php endif; ?>
				</form>
			</div>
	</div>
</body>
</html>
<?php
$conn->close();
?>