<?php
/**
* login.php
*
* project 2
*
* @category   Project 2
* @package    Project 2
* @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
* @version    2019.10.21
* @Link      https://cislinux.hfcc.edu/~dtsmith2106/cis222/p2
*/



	 // Include the header:4


	 // Print any error messages, if they exist:
	 if (isset($errors) && !empty($errors))
	 {
	 	 echo '<h1>Error!</h1>
	 	 <p class="error">The following error(s) occurred:<br />';
	 	 foreach ($errors as $msg) {
	 	     echo " - $msg<br />\n";
         }
	 	 echo '</p><p>Please try again</p>';
	 }

?>

    <h2>Login</h2>
    <form method="post">
    	 <p>Email Address: <input type="text" name="email" size="20" maxlength="60" ></p>
 	 	 <p>Password: <input type="password" name="pass" size="20" maxlength="20" ></p>
         <p><input type="submit" name="submit_button" value="Login" /></p>
     </form>
<?php

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

if(isset($_POST['submit_button']))
{
    //session_start();
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $n = hash1( $pass, $j = 200, $s = "th3_secret_SalT" );
    $qry = "SELECT customer_id FROM customer WHERE email = '$email' AND  pass = '$n' LIMIT 1";
    $result = mysqli_query($connection, $qry);
    $row = mysqli_fetch_array($result);

    $_SESSION['customer_id']  = $row['customer_id'];
    $row = mysqli_affected_rows($connection);
    if($row == 1)
    {
        header("Location: index.php");
        exit();
    }
    else{
        echo "No such login information";
    }

}
?>

    <br> <br>
    <h1>Or</h1>
    <br> <br>


    <h2>Create account</h2>
    <form method="POST">
        <p>First name: <input type = "text" name = "first_name" size="20" maxlength="60" ></p>
        <p>Last name: <input type = "text" name = "last_name" size="20" maxlength="60" ></p>
        <p>Email address: <input type = "text" name = "email" size="20" maxlength="60" ></p>
        <p>Password: <input type = "password" name = "password"size="20" maxlength="20"  ></p>
        <p>Phone Number: <input type = "text" name="phone" size="20" maxlength="20"></p>
        <p><input type="submit" name="submit_button2" value="Create account" /></p>
    </form>

<?php
if(isset($_POST['submit_button2']))
{
    if(empty($_POST['first_name']))
    {
        echo "Please enter your first name";
    }
    else
    {
        $_POST['first_name'];
    }
    if(empty($_POST['last_name']))
    {
        echo "Please enter your last name";
    }
    else
    {
        $_POST['last_name'];
    }
    if(empty($_POST['email']))
    {
        echo "Please enter your email";
    }
    else
    {
        $_POST['email'];
    }
    if(empty($_POST['password']))
    {
        echo "Please enter a password";
    }
    else
    {
        $_POST['password'];
    }
    if(empty($_POST['phone']))
    {
        echo "Please enter a phone number";
    }
    else
    {
        $_POST['phone'];
    }

    if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['phone']))
    {
        $fname = $_POST['first_name'];
        $lname = $_POST['last_name'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $phone = $_POST['phone'];
        $n = hash1( $pass, $j = 200, $s = "th3_secret_SalT" );
        $qry = "INSERT INTO customer(customer_id, f_name, l_name, email, pass, phone, notes) 
                VALUES(NULL, '$fname', '$lname', '$email', '$n', '$phone', NULL) ";
        $result = mysqli_query($connection, $qry);

}

}