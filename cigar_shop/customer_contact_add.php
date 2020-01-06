<?php
/**
 * customer_contact_add.php
 *
 * Project 1
 *
 * @category   Project 1
 * @package    p1
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.09.28
 */

$user = "dtsmith2106"; //Enter the user name
$password = "txk7n5dt"; //Enter the password
$host = "localhost"; //Enter the host
$dbase = "dtsmith2106"; //Enter the database
$table = "contact_page"; //Enter the table name
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$dbase;charset=$charset";
$opt =
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

$pdo = new PDO($dsn, $user, $password, $opt);


$firstName= $_POST['firstName'];
$lastName= $_POST['lastName'];
$email= $_POST['email'];
$message= $_POST['message'];

if (!$dsn)
{
    die ('Could not connect:'.mysqli_error($dsn) );
}
$stmt = $pdo->query("INSERT INTO $table (contact_id, f_name, l_name, email, message)
VALUES (NULL , '$firstName', '$lastName', '$email', '$message')");


if(!$stmt)
{
    echo "Add failed";
}
else
{
    echo 'You have been added.';
}

?>
