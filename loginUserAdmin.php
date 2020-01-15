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
	
<style type="text/css">
.h2{
/*background: #FEFFED;*/
padding: 30px 35px;
margin: -10px -50px;
text-align:center;

border-radius: 10px 10px 0 0;
}

div.container{
background: url("background.jpeg");
width: 900px;
height: 450px;
margin:50px auto;
left: 50px;
font-family: 'Raleway', sans-serif;
/*background-color: pink;*/
border-radius: 5px;
}
div.main{
	
width: 300px;
padding: 10px 50px 50px;
border: 2px solid gray;
border-radius: 10px;
font-family: raleway;
float:left;
margin-top:50px;
background-color: #f0f5f5;
}
input[type=text],input[type=password]{
width: 100%;
height: 40px;
padding: 5px;
margin-bottom: 25px;
margin-top: 5px;
border: 2px solid #ccc;//mau den nhat khung user va password
color: #4f4f4f;
font-size: 16px;
border-radius: 5px;
}
label{
color: #464646;//mau chu user va password
text-shadow: 0 1px 0 #fff;
font-size: 14px;
font-weight: bold;
}
center{
font-size:32px;
}

.back{
text-decoration: none;
border: 1px solid rgb(0, 143, 255);
background-color: rgb(0, 214, 255);
padding: 3px 20px;
border-radius: 2px;
color: black;
}
input[type=button]{
font-size: 16px;
border: 1px solid pink;
color: #4E4D4B;//mau chu login
font-weight: bold;
cursor: pointer;
width: 100%;
border-radius: 5px;
padding: 10px 0;
}
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}
img.avatar {
  width: 40%;
  border-radius: 50%;
}
.display{
	display: grid;
}
	</style>
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