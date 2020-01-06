<?php
/**
 * logout.php
 *
 * Project 2
 *
 * @category   Project 2
 * @package    p2
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.11.10
 */

# Script 18.9 - logout.php
	 // This is the logout page for the site.
	 //require('includes/config.inc.php');
	 $page_title = 'Logout';
	 //include('includes/header.html');

	 // If no first_name session variable exists, redirect the user:
	 if (!isset($_SESSION['customer_id'])) {

	 	 $url = BASE_URL . 'index.php'; //Define the URL .
         ob_end_clean(); // Delete the buffer.
	 	 header("Location: index.php");
	 	 exit(); // Quit the script.

	 } else { // Log out the user.

	 	 $_SESSION = array(); // Destroy the variables .
	 	 session_destroy(); // Destroy the session itself .
    	 	 setcookie(session_name(), '',
        time() - 3600); // Destroy the cookie.
         header("Location: index.php");
	 }

	 // Print a customized message:
	 echo '<h3>You are now logged out.</h3>';



