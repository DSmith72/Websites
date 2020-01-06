<?php
/**
 * view_cart.php
 *
 * Project 2
 *
 * @category   Project 2
 * @package    p2
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.11.10
 */

$host="localhost";
$username="dtsmith2106";
$password="txk7n5dt";
$database="dtsmith2106";
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$database;charset=$charset";
?>
<div id = "cart">
    <h1>Cart Items</h1>
</div>
<?php

$opt =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

$pdo = new PDO($dsn, $username, $password, $opt);

$rownum=0;
if(isset($_SESSION['customer_id'])) {
    $customerId = $_SESSION['customer_id'];
    $stmt = $pdo->query("SELECT * FROM cart WHERE customer_id = $customerId");

    echo "<table>";
    echo "<tr>";
    echo "<th>Product number</th>" . "\t" . "<th>Description</th>" . "<th>Price</th>" . "<th>Quantity</th>" . "<th></th>";
    echo "</tr>";
    while ($row = $stmt->fetch()) {
        echo '<tr>';
        echo "<td>" . ($row['product_id']) . "</td>";
        echo "<td>" . ($row['description']) . "</td>";
        echo "<td>" . ("$" . $row ['price']) . "</td>";
        echo "<form method = 'POST'>";?>
        <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
        <td><p><input type = 'number' name = 'qty' min='0' max='100' value="<?php echo $row['qty']; ?>"><input type = 'submit' name = 'update-qty' value='Update Quantity'></p></td><?php
        echo "<td>" . "<p><input type = 'submit' name = 'delete' value='Delete Item'>" . "</p>" . "</td>";
        echo "</form>";
        echo "</tr>";
        $rownum++;
    }
    echo "</table>";
    if(isset($_POST['cart_id']))
    {
        $cartId = $_POST['cart_id'];
    }

}
else
{
    "Please sign in";
}
if(isset($_POST['delete']))
{
    $stmt = $pdo->query("DELETE FROM cart WHERE cart_id = $cartId");
    header("Location: index.php?page=view_cart");
}
if(isset($_POST['update-qty']))
{
    $newQty = $_POST['qty'];
    $stmt = $pdo->query("UPDATE cart SET qty = $newQty WHERE cart_id = $cartId");
    header("Location: index.php?page=view_cart");
}
?>
<br><br>
<button onclick="window.location.href = 'index.php?page=check_out';">Check Out</button>
<br><br>
