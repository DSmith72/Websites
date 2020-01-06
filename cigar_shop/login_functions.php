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


# Script 12.2 - login_functions.inc.php
	 // This page defines two functions used by the login/logout process.

	 /* This function determines an absolute
URL and redirects the user there.
	 	* The function takes one argument: the
page to be redirected to.
	 	* The argument defaults to index.php.
	 */
	 function redirect_user ($page = 'index.php') {

	 	 // Start defining the URL...
	 	 // URL is http:// plus the host name plus the current directory:
	 	 $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

	 	 // Remove any trailing slashes:
	 	 $url = rtrim($url, '/\\');

	 	 // Add the page:
	 	 $url .= '/' . $page;

	 	 // Redirect the user:
	 	 header("Location: $url");
	 	 exit(); // Quit the script.

	 } // End of redirect_user( ) function.


	 /* This function validates the form data
(the email address and password).
	 	* If both are present, the database is
queried.
	 	* The function requires a database
connection.
	 	* The function returns an array of
information, including:
	 	* - a TRUE/FALSE variable indicating
success
	 	* - an array of either errors or the
database result
	 */
$user = "dtsmith2106"; //Enter the user name
$password = "txk7n5dt"; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "dtsmith2106"; //Enter the database
$table = "midterm_animals"; //Enter the table name

$connection= mysqli_connect ($host, $user, $password);

if (!$connection)
{
    die ('Could not connect:'.mysqli_error($connection) );
}

mysqli_select_db($connection,$dbase);
$email = $_POST['email'];
$pass = $_POST['pass'];
	 function check_login($connection, $email = '',
                            $pass = '') {

	 	 $errors = array( ); // Initialize error array.
         // Validate the email address:
         	 	 if (empty($email)) {
             	 	 	 $errors[] = 'You forgot to enter your email address.';
	 	 }
         	 	 else {
             	 	 	 $e = mysqli_real_escape_string($connection, trim($email));
	 	 }

	 	 // Validate the password:
	 	 if (empty($pass)) {
             	 	 	 $errors[] = 'You forgot to enter your password.';
	 	 } else {
             	 	 	 $p = mysqli_real_escape_string($connection, trim($pass));
	 	 }

	 	 if (empty($errors)) { // If everything's OK.

	 	 	 // Retrieve the user_id and first_name for that email/password combination:
	 	 	 $q = "SELECT customer_id, f_name FROM customers WHERE email='$e' AND pass=SHA1('$p')";
	 	 	 $r = @mysqli_query ($connection, $q);

// Run the query.

	 	 	 // Check the result:
	 	 	 if (mysqli_num_rows($r) == 1) {

	 	 	 	 // Fetch the record:
	 	 	 	 $row = mysqli_fetch_array ($r, MYSQLI_ASSOC);

	 	 	 	 // Return true and the record:
	 	 	 	 return array(true, $row);

	 	 	 } else { // Not a match!
	 	 	 	 $errors[] = 'The email address
             and password entered do not match those on file.';
	 	 	 }

	 	 } // End of empty($errors) IF.
         var_dump($r);
	 	 // Return false and the errors:
	 	 return array(false, $errors);

	 } // End of check_login( ) function