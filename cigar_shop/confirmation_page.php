<?php
/**
 * comfirmation_page.php
 *
 * Project 2
 *
 * @category   Project 2
 * @package    p2
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.11.30
 */

if(isset($_SESSION['orders_id']))
{
    $orderId_confirmation = $_SESSION['orders_id'];
    echo "<h1>Thank you for you purchase. Your order number is: $orderId_confirmation</h1>";

}
?>
<br><br><br><br>

