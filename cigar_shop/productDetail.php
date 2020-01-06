<?php
/**
 * productDetail.php
 *
 * project 2
 *
 * @category   Project 2
 * @package    Project 2
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.10.27
 * @Link      https://cislinux.hfcc.edu/~dtsmith2106/cis222/p2
 */

$host="localhost";
$username="dtsmith2106";
$password="txk7n5dt";
$database="dtsmith2106";
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$database;charset=$charset";
$opt =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

$pdo = new PDO($dsn, $username, $password, $opt);


$_SESSION['details'] = $_GET['detail'];
$details = $_SESSION['details'];
$result=$pdo->query("SELECT * FROM product WHERE item_num = $details");
$row = $result->fetch();
echo "<table>";
echo "<tr>";
echo "<th>Item number</th>" . "\t" . "<th>Description</th>" . "<th>Price</th>" . "<th>Cigar Image</th>" ;
echo "</tr>";
echo "<tr>";
echo "<td>" . $row['item_num'] . "</td>";
echo "<td>" . $row['item_description'] . "</td>";
echo "<td>" ."$" . $row['item_price'] . "</td>";
echo "<td><img src=" . ($row['image']) . " alt=\"picture\">" ."</td>";
echo "</tr>";
echo "</table>";
echo "<form method = 'POST'>";
echo "<p><input type = 'submit' name = 'Subbutton' value='Add To Cart'>" . "</p>";
echo "</form>";

if(isset($_POST['Subbutton']))
{
    $stmt=$pdo->query("SELECT * FROM product          
                                 WHERE item_num = $details");
    $row['item_qty'] = 1;
    $pid = $row['product_id'];
    $item_num = $row['item_num'];
    $item_description = $row['item_description'];
    $item_price = $row['item_price'];
    $item_qty = $row['item_qty'];
    if(isset($_SESSION['customer_id']))
    {
        $customerId =$_SESSION['customer_id'];

        $stmt=$pdo->query("INSERT INTO cart( cart_id, customer_id, product_id, description, qty, price, date_added)
                                    VALUES (NULL, $customerId, $pid, '$item_description', $item_qty, $item_price, NOW())");
    }
    else
    {
        echo "Please sign in to add item to cart";
    }


}