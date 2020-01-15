<?php
require "../view/database.php";
require "../model/User.php";
require "../model/Xiaomi.php";
require "../model/vivoy53.php";

if (isset($_POST["id"])) {
	$id = $_POST["id"];
	$sql = "DELETE from phukien where id = " . $id;
	$db->query($sql);
}


if (isset($_POST['logout'])) {
	require"index.php";
}

$user = null;
if (isset($_POST["username"]) && isset($_POST["password"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	$sql = "SELECT * from user where username='$username' and password='$password'";
	$user = $db->query($sql)->fetch_object("User");
} else {
}
$sql = "SELECT * FROM `phukien`";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);


$phukiens = array();
for ($i = 0; $i < count($result); $i++) {
	$phukien = $result[$i];
	if ($phukien['type'] == 'bao da op lung') {
		array_push($phukiens, new vivoy53(
			$phukien['id'],
			$phukien['name'],
			$phukien['price'],
			$phukien['image'],
			$phukien['quantity']
		));
	}

	if ($phukien['type'] == 'cuc sac du phong') {
		array_push($phukiens, new Xiaomi(
			$phukien['id'],
			$phukien['name'],
			$phukien['price'],
			$phukien['image'],
			$phukien['quantity']
		));
	}
	if ($phukien['type'] == 'op lung') {
		array_push($phukiens, new vivoy53(
			$phukien['id'],
			$phukien['name'],
			$phukien['price'],
			$phukien['image'],
			$phukien['quantity']
		));
	}

	if ($phukien['type'] == 'phone') {
		array_push($phukiens, new Xiaomi($phukien['id'], $phukien['name'], $phukien['price'], $phukien['image'], $phukien['quantity']));
	}
	if ($phukien['type'] == 'gay chup anh') {
		array_push($phukiens, new Xiaomi(
			$phukien['id'],
			$phukien['name'],
			$phukien['price'],
			$phukien['image'],
			$phukien['quantity']
		));
	}
}

// Delete
if (isset($_POST["id"])) {
	$id = $_POST["id"];
	$sql = "DELETE from `phukien` where id= " . $id;
	$db->query($sql);
}


?>

<!DOCTYPE html>
<html>

<head>
	<title>WebPhukien</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="page-footer font-small special-color-dark pt-4" style="color: white; margin-top: 0px; margin-bottom: 0px;">
		<footer style="background-color: black;">
			
	<img style="width: 20px;height:20px; "src="../images/accessories/email.png"> <i style="color: #33FF61;">email:hothion468@gmail.com</i>
	&nbsp;&nbsp;&nbsp;
	<img style="width: 20px;height: 20px;"src="../images/accessories/hot.jpg"> <i style="color: red;">Hotline:</i> <b>0395191247</b>
	&nbsp;&nbsp;&nbsp;
	<img style="width: 20px;height: 20px;"src="../images/accessories/ad.png"> <i style="color: #33FF61;">101B Le Huu Trac,Son Tra,Da Nang</i> 
		
		<div style="margin-left: 1100px;">
	<?php
		if ($user == null) {
		?>
		<form action="index.php" method="post">
			<button onclick="logout()"style="background: black;border: none;"><i class="fa fa-lock"></i></button>
		</div>
		<form method="post">
		<input style="border-radius: 5px;height: 25px;margin-left: 800px;" type="text" placeholder="Search.." name="search">
		<button type="submit"style="border-radius: 2px;"><i class="fa fa-search"></i></button>
		</form>


		
		<?php
	}
		?>
	</div>

	

	<br>
	<br>
	<br>
	<div id="menu">
		<ul>
			<li><a class="nav-link" href="index.php"><b>Trang chủ</b></a></li>
			<li><a class="nav-link" href="pk.php"><b>Phụ kiện</b></a></li>
			<li><a class="nav-link" href="lienhe.php"><b>Liên hệ</b></a></li>
			<li>
				<form action="add.php" method="post">
					<button style="border-radius: 5px;" type="submit" onClick="edit()">Add</button>
				</form>
			</li>
		</ul>
	</div>


	<script type="text/javascript">
		var image = ["../images/accessories/3.jpg", "../images/accessories/5.gif", "../images/accessories/6.png"];
		var position = 0;
		setInterval(function() {
			position = position + 1;
			document.getElementById("myImage").src = image[position];
			if (position == 2) {
				position = 0;
			}
		}, 3000);
	</script>
	<div>
		<img id="myImage" src="../images/accessories/3.jpg" style="width: 95%;margin-left: 25px;">
	</div>
	<img src="../images/accessories/2.jpg" style="width: 80%;margin-left: 120px;margin-top: 20px;border-radius: 10px;">


	<form action="" method="post">
		<div class="container-pk">
			<?php
			for ($i = 0; $i < count($phukiens); $i++) {
			?>

				<div class="item-pk">
					<img class="item-pk-icon" src=<?php echo $phukiens[$i]->getImagePath(); ?>>
					<p class="item-pk-name"><?php echo $phukiens[$i]->name ?></p>
					<p class="item-pk-type"><?php echo $phukiens[$i]->getType() ?></p>
					<p class="item-pk-price"><?php echo $phukiens[$i]->getDisplayPrice() ?></p>
					<p class="item-pk-old-price"><?php echo $phukiens[$i]->getDisplayOldPrice() ?></p>
					<p>
						<form action="editF.php" method="post">
							<button name="edit-id" value="<?php echo $phukiens[$i]->id; ?>" onclick="onEditClicked()">Edit</button>
						</form>
						<form action=""method="post">
							<button name='id' value="<?php echo $phukiens[$i]->id; ?>">Delete</button>
						</form>
					</p>
				</div>
			<?php
			}
			?>

		</div>
	</form>
	
	<script src="index.js"></script>
	<hr style="color: white; margin-top: 0px; margin-bottom: 0px;">
	<footer class="page-footer font-small special-color-dark pt-4" style="background-color: black;">
		<div class="container">

			<ul class="list-unstyled list-inline text-center">
				<li class="list-inline-item">
					<a class="btn-floating btn-fb mx-1" style="color:royalblue;">
						<i class="fab fa-facebook-f"> </i>
					</a>
				</li>
				<li class="list-inline-item">
					<a class="btn-floating btn-tw mx-1" style="color:skyblue;">
						<i class="fab fa-twitter"> </i>
					</a>
				</li>
				<li class="list-inline-item">
					<a class="btn-floating btn-gplus mx-1">
						<i class="fab fa-google-plus-g" style="color:tomato;"> </i>
					</a>
				</li>
				<li class="list-inline-item">
					<a class="btn-floating btn-li mx-1">
						<i class="fab fa-linkedin-in" style="color:navy;"> </i>
					</a>
				</li>
				<li class="list-inline-item">
					<a class="btn-floating btn-dribbble mx-1">
						<i class="fab fa-dribbble" style="color:mediumvioletred;"> </i>
					</a>
				</li>
			</ul>
		</div>
		<div class="footer-copyright text-center py-3">On Ho 2020
			<br>
			<a href="home.php">Wecome accessories Shop</a>
		</div>
	</footer>

	<script src="index.js"></script>
</body>

</html>