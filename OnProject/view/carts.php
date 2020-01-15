<?php
require "../view/database.php";
require "../model/Cart.php";



$sql1 = "SELECT * from cart";
$result1 = $db->query($sql1)->fetch_all() ;

if(isset($_POST["dele"])){
        $id = $_POST["dele"];
        $sql1 = "DELETE from cart where cart_id= ".$id;
        $db->query($sql1);
        }

        if (isset($_POST['id'], $_POST['quantity']) && is_numeric($_POST['id']) && is_numeric($_POST['quantity'])) {
    // Đặt biến Post đăng để chúng ta dễ dàng xác định chúng, đồng thời đảm bảo rằng chúng là số nguyên
        $product_id = (int)$_POST['id'];
        $quantity = (int)$_POST['quantity'];
    // Prepare the SQL statement, we basically are checking if the product exists in our databaser
        $sql= "SELECT * FROM phukien WHERE id = ?')";
   
        $product =$db->query($sql);
    // Check if the product exists (array is not empty)
        if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: indexUser.php');
    exit;
}
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}

/*//add to cart
session_start();
$id= isset($_GET['id']);
if (isset($_SESSION['cart'])) {
    $carts = array();
    $carts = json_decode($_SESSION['cart'], true);
	for($i = 0; $i < count($result1); $i++) {
	if ($result1[$i]['cart_id'] == $id) {
	$carts = $result1[$i];
	 array_push($carts,new Cart($result1[$i]['cart_id'],$result1[$i]['name'],$result1[$i]['price'],$result1[$i]['quantity']));
	}
}
}
function sum($result1)
{
    $sum = 0;
    for ($i = 0; $i < count($result1); $i++) {
        $sum += (($result1[$i]['price']) * ($result1[$i]['quantity']));
    }
    return $sum;
}*/
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div id="cart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: white;">
    <form action="index.php" method="">
    <button style=" font-style: italic; color:lime;font-size: 14px; border: none; ">Quay lại trang chủ</button>
    </form>
	<form action="" method="post">
	<p style="color: black; font-weight: bold;text-align:center; font-size: 20px; margin-top: 50px;">MY SHOPPING CART</p>  
	    <div class="line">


    <h1>Shopping Cart</h1>
    <form action="indexUser.php" method="post">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Total</td>
                </tr>
            </thead>
          
                <?php
                for ($i = 0; $i < count($cart); $i++) {?>
                <tr>
                    <td>
                        <img width="100" src=<?php echo "../images/accessories/" . $cart[$i]['image'] ?>>
                    </td>
                    <td>
                        <p><?php echo $cart[$i]['name'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $cart[$i]['price'] ?></p>
                    </td>
                    <td>
                        <p><?php echo $cart[$i]['quantity'] ?></p>
                    </td>
                    <td>
                     <p><?php echo (($cart[$i]['quantity'])*($cart[$i]['price'])) ?></p>
                 </td>
                </tr>
               <<?php 
               }
                ?>
            
        </table>
    </form>
</body>
</html>	