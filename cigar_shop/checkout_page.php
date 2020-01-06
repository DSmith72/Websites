<?php
/**
 * checkout_page.php
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
define("TAXES", .06);
$taxes = TAXES;
$opt =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

$pdo = new PDO($dsn, $username, $password, $opt);

$rownum=0;
?>
<div class = "checkout_address">
    <h2>Checkout Page</h2>
</div>
<?php
if(isset($_SESSION['customer_id']))
{
    $customerId = $_SESSION['customer_id'];

    //Get price * quantity and display along with item descriptions
    $stmt = $pdo->query("SELECT description, price, qty,(price * qty) AS price_qty  FROM cart WHERE customer_id =$customerId");

    echo "<table>";
    echo "<tr>";
    echo "<th>Description</th>" . "<th>Quantity</th>" . "<th>Price</th>";
    echo "</tr>";
    while ($row = $stmt->fetch()) {
        echo '<tr>';
        echo "<td>" . ($row['description']) . "</td>";
        echo "<td>" . $row['qty'] . "</td>";
        //echo "<td>" . ("$" . $row ['price']) . "</td>";
        echo "<td>" . "$"  . number_format(($row['price_qty']),2) . "</td>";
        echo "</form>";
        echo "</tr>";
        $rownum++;
        $qty_price = $row['price_qty'];
        $qty = $row['qty'];
    }

    //Get the total of all price and quantity amd display
    $stmt = $pdo->query("SELECT  SUM((`price` * `qty`)) AS `total_price`  FROM cart WHERE customer_id =$customerId");
    $row = $stmt->fetch();
    echo "<tr>";
    echo "<td>". "</td>";
    echo "<td>". "</td>";
    echo "<td>" . "Sub total: ". "$"  . number_format(($row['total_price']),2) . "</td>";
    echo "<tr>";
    $total_price = $row['total_price'];

    //Get taxes and display
    if(isset($row['total_price']))
    {
        $stmt = $pdo->query("SELECT  ($total_price * $taxes) AS `tax`  FROM cart WHERE customer_id =$customerId");
    }

    $row = $stmt->fetch();
    echo "<tr>";
    echo "<td>". "</td>";
    echo "<td>". "</td>";
    echo "<td>" . "Taxes: ". "$"  . number_format(($row['tax']),2) . "</td>";
    echo "<tr>";
    $tax = $row['tax'];

    //Get final price and display
    if(isset($tax))
    {
        $stmt = $pdo->query("SELECT  ($total_price + $tax) AS `final_total`  FROM cart WHERE customer_id =$customerId");
    }

    $row = $stmt->fetch();
    echo "<tr>";
    echo "<td>". "</td>";
    echo "<td>". "</td>";
    echo "<td>" . "Total: ". "$"  . number_format(($row['final_total']),2) . "</td>";
    echo "<tr>";
    $final_price = $row['final_total'];
  echo "</table>";


}

?>
<div class = "home_address">
    <form  method = "POST">
        <br><br>
        <h4>Mailing Address</h4>
        <label for="address">Address</label>
        <input type="text" name="address" id="address">
        <br><br>
        <label for = "street">Street</label>
        <input type = "text" name = "street" id = "street">
        <br><br>
        <label for = "city">City</label>
        <input type = "text" name = "city" id = "city">
        <br><br>
        <label for = "state">State</label>
        <input type = "text" name = "state" id = "state">
        <br><br>
        <label for = "zip">Zip code</label>
        <input type = "text" name = "zip" id = "zip">
        <br><br>
        <label for = "apt">Apt #</label>
        <input type = "text" name = "apt" id = "apt">
        <br><br>
        <br><br>
        <h4>Shipping address if different from mailing address</h4>
        <label for="shipping_address">Address</label>
        <input type="text" name="shipping_address" id="shipping_address">
        <br><br>
        <label for = "shipping_street">Street</label>
        <input type = "text" name = "shipping_street" id = "shipping_street">
        <br><br>
        <label for = "shipping_city">City</label>
        <input type = "text" name = "shipping_city" id = "shipping_city">
        <br><br>
        <label for = "shipping_state">State</label>
        <input type = "text" name = "shipping_state" id = "shipping_state">
        <br><br>
        <label for = "shipping_zip">Zip code</label>
        <input type = "text" name = "shipping_zip" id = "shipping_zip">
        <br><br>
        <label for = "shipping_apt">Apt #</label>
        <input type = "text" name = "shipping_apt" id = "shipping_apt">
        <br><br>
        <h3>Method Of Payment</h3>
        <label for = "payment">Card Type</label>
        <select name = "card_type">
            <option  value=" "></option>
            <option  value="Visa">Visa</option>
            <option  value="Mastercard">Mastercard</option>
        </select>
        <p><label  for = "card_number">Card Number</label>
        <input type = "text" name = "card_number" value = "1234 4567 7890 1234"></p>
        <p><label for = "exp_date">Expiration Date</label>
            <input type="exp_date" name="exp_date"></p>
        <p><label for = "csv-num">CSV number</label>
            <input type="csv_num" name="csv_num"></p>
        <p><input type = "submit" name = "purchase" value="Purchase"></p>
    </form>
    <br>
</div>
<?php
if(isset($_POST['purchase']))
{
    //Inserting orders into orders table
    $stmt = $pdo->query("INSERT INTO orders(orders_id, customer_id, total_price, date_added)
                                   VALUES (NULL, $customerId, $final_price, NOW())");
    //$stmt = $pdo->query("SELECT orders_id FROM orders WHERE customer_id =$customerId");
    $row = $stmt->fetch();
    $orders_id = $pdo->lastInsertId();
    $_SESSION['orders_id'] = $orders_id;
    $qry = "SELECT * FROM cart WHERE customer_id =$customerId";
    $stmt = $pdo->query($qry);

    //Inserting into order_items table
   while($row = $stmt->fetch())
   {

       $pid = $row['product_id'];
       $qty_cart = $row['qty'];
       $qty_price = $row['price'];
       $qry2 = "INSERT INTO order_items(order_item_id, orders_id, product_id, quantity, price)
                                           VALUES(NULL, $orders_id, $pid, $qty_cart, $qty_price)";
       $temp_result = $pdo->query( $qry2 );
   }

}
if(isset($_POST['purchase']))
{
    //Checking that all fields are filled out
    if(empty($_POST['address']))
    {
        echo "Please enter your address number";
    }
    else
    {
        $_POST['address'];
    }
    if(empty($_POST['street']))
    {
        echo "Please enter your street name";
    }
    else
    {
        $_POST['street'];
    }
    if(empty($_POST['city']))
    {
        echo "Please enter your city";
    }
    else
    {
        $_POST['city'];
    }
    if(empty($_POST['state']))
    {
        echo "Please enter your state";
    }
    else
    {
        $_POST['state'];
    }
    if(empty($_POST['zip']))
    {
        echo "Please enter your zip code";
    }
    else
    {
        $_POST['zip'];
    }

    //adding to varibles if evey field is filled out
    if(!empty($_POST['address']) && !empty($_POST['street']) && !empty($_POST['city']) && !empty($_POST['state']) && !empty($_POST['zip'])) {
        $address = $_POST['address'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $apt = $_POST['apt'];

        //inserting mailing address into address table if no apartment number was added
        if(empty($apt))
        {
            $stmt = $pdo->query("INSERT INTO address(address_id, customer_id, address_num, street, city, state, zip, apt_num, notes) 
                            VALUES(NULL, $customerId, $address, '$street', '$city', '$state', $zip, NULL, 'Mailing Address')");
            var_dump($stmt);
        }
        //inserting mailing address into address table if a apartment number WAS added
        else
        {
            $stmt = $pdo->query("INSERT INTO address(address_id, customer_id, address_num, street, city, state, zip, apt_num, notes) 
                            VALUES(NULL, $customerId, $address, '$street', '$city', '$state', $zip, $apt, 'Mailing Address')");
        }

    }

    //checking to see if there is a shipping address
    if(!empty($_POST['shipping_address']) && !empty($_POST['shipping_street']) && !empty($_POST['shipping_city']) && !empty($_POST['shipping_state']) && !empty($_POST['shipping_zip'])) {
        $shipping_address = $_POST['shipping_address'];
        $shipping_street = $_POST['shipping_street'];
        $shipping_city = $_POST['shipping_city'];
        $shipping_state = $_POST['shipping_state'];
        $shipping_zip = $_POST['shipping_zip'];
        $shipping_apt = $_POST['shipping_apt'];

        //inserting shipping address into address table if no apartment number was added
        if(empty($shipping_apt))
        {
            $stmt = $pdo->query("INSERT INTO address(address_id, customer_id, address_num, street, city, state, zip, apt_num, notes) 
                            VALUES(NULL, $customerId, $shipping_address, '$shipping_street', '$shipping_city', '$shipping_state', $shipping_zip, NULL, 'Shipping Address')");
        }

        //inserting shipping address into address table if a apartment number was added
        else
        {
            $stmt = $pdo->query("INSERT INTO address(address_id, customer_id, address_num, street, city, state, zip, apt_num, notes) 
                            VALUES(NULL, $customerId, $shipping_address, '$shipping_street', '$shipping_city', '$shipping_state', $shipping_zip, $shipping_apt, 'Shipping Address')");
        }

    }
    echo '<script>window.location="index.php?page=confirm"</script>';

    //deleteing from cart table when items were purchased
    $stmt = $pdo->query("DELETE FROM cart WHERE customer_id = $customerId");


}
