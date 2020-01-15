<?php
require "../view/database.php";
require "../model/Cart.php";

$sql1 = "SELECT * FROM `cart`";
$result1 = $db->query($sql1)->fetch_all(MYSQLI_ASSOC);

if(isset($_POST["dele"])){
        $id = $_POST["dele"];
        $sql1 = "DELETE from cart where cart_id= ".$id;
        $db->query($sql1);
        }
    $carts = array();
    for($i = 0; $i < count($result1); $i++) {
        $cart = $result1[$i];
        array_push($carts, new Cart($cart['cart_id'],$cart['name'],$cart['price'],$cart['quantity'],$cart['image']));
        }

  
function sum($result1)
{
    $sum = 0;
    for ($i = 0; $i < count($result1); $i++) {
        $sum += (($result1[$i]['price']) * ($result1[$i]['quantity']));
    }
    return $sum;
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title></title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <table style="margin-top: 50px;width: 97%;margin-left: 15px;" id="tbl" class="table table-striped">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Delete</th>
        </tr>

         <?php 
            for($i = 0; $i < count($result1); $i++){?>
                    <div class="item-pk">
                        <tr>
                        <th scope="row"><?php echo $result1[$i]['cart_id']?></th>
                        <td>
                        <img width="100" src=<?php echo $result1[$i]['image'] ?>>
                        </td>
                        <td><p><?php echo $result1[$i]['name']?></p></td>
                        <td><p><?php echo $result1[$i]['price']?></p></td>
                        
                        <td><p><?php echo $result1[$i]['quantity']?></p></td>
                        <td>
                        <p><?php echo (($result1[$i]['price']) * ($result1[$i]['quantity'])) ?></p>
                    </td>
                    <td>
                        <form action=""method="post">
                    <button name="dele"value="<?php echo $result1[$i]['cart_id'];?>">Delete</button>
                    </td>
                    </form>
                </tr>
                <?php
            }
            ?>
</table>
    </div>
    <div class="pay">
        <h1>CỘNG GIỎ HÀNG</h1>
        <p>Tạm tính: <?php echo sum($result1); ?></p>
        <p>Phí giao hàng: <?php echo (sum($result1) * 0.01); ?></p>
        <p>Tổng: <?php echo (sum($result1) + (sum($result1) * 0.01)); ?></p>
        <form action="Order.php" method="post">
            <button style="text-align: center;" name="order">Thanh toán</button>
        </form>
    </div>

    <a style="text-decoration: none" href="index.php">Home</a>
    <a style="text-decoration: none" href="indexUser.php">UserHome</a>
</body>

</html>