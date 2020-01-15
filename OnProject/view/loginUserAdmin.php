<?php
require "../view/database.php";
require "../model/User.php";
session_start();
// $user = null;
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT * from user where username='$username' and password='$password'";
	$user = $db->query($sql)->fetch_object("User");

	if ($user && $user->canBuyPhuKien()) {
		$_SESSION['user'] = new User($user->id, null, $user->fullName, null, null, null);
		header("location: indexUser.php");
	}
	if ($user && $user->canManagePhuKien()) {
		$_SESSION['admin'] = new User($user->id, null, $user->fullName, null, null, null);
		header("location: indexAdmin.php");
	} else if ($username == "" || $password == "") {
		echo "<script> alert(' Please enter full information!'); </script>";
	} else {
		echo "<script> alert(' Username or Password wrong!'); </script>";
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title></title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<form id="login-form" class="login" method="post">
		<div class="container">
		<div class="main">
		<h2>Login Form </h2>
		<label>User Name:</label>

		<input type="text" placeholder="Enter Username"name="username" id="username"/>
		<label>Password :</label>

		<input type="password"  placeholder="Enter Password"name="password" id="password"/>
		<button type="submit">Login</button>
		<input type="checkbox" checked="checked" name="remember"> Remember me
		</div>
		</div>
	</form>

	
</body>

</html>