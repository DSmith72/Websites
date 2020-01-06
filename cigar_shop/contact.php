<?php
/**
 * contact.php
 *
 * Project 1
 *
 * @category   Project
 * @package    Project 1
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.09.05
 */
?>

<div class = "contact">
    <h2>Contact Page</h2>

    <form action = "customer_contact_add.php" method = "POST">
        <label for="firstName">First Name</label>
        <input type="text" name="firstName" id="firstName">
        <br><br>
        <label for="lastName">Last Name</label>
        <input type="text" name="lastName" id="lastName">
        <br><br>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
        <br><br>
        <label for = "message">Message</label>
        <input type = "text" name = "message" id = "message">
        <br><br>
        <input type = "submit" value="Send">
    </form>
    <br>
</div>
