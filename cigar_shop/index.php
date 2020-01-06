<?php
/**
* index.php
*
* Project 1
*
* @category   Project
* @package    Project 1
* @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
* @version    2019.09.27
 * @Link      https://cislinux.hfcc.edu/~dtsmith2106/cis222/p2
*/
/**
 * Project Part 1 Grade
 * 1. Index Site        40 / 40
 * 2. Database Content  40 / 40 No product table or inserts in sql file.
 * 3. Contact Page      20 / 20
 * 4. Catalog Page      40 / 40
 * 5. Appearance        10 / 10
 * 6. Extra Credit      0 / 20
 * 
 * Total:               150 / 150
 */
function hash1( $pass, $j = 200, $s = "th3_secret_SalT" )
{
    $n = crypt( $pass, $s );

    for( $i = 0; $i < $j; ++$i )
    {
        $n = crypt( $n.$pass, $s );
    }

    return $n;
}
include('head.php');
include('header.php');

if(isset($_GET['page']) && $_GET['page'] == 'contact')
{
    include('contact.php');
}
else if(isset($_GET['page']) && $_GET['page'] == 'login')
{

    include('login.php');
}
else if(isset($_GET['page']) && $_GET['page'] == 'logout')
{

    include('logout.php');
    session_destroy();
}
else if(isset($_GET['page']) && $_GET['page'] == 'catalog')
{
    include('catalog.php');

}
else if(isset($_GET['page']) && $_GET['page'] == 'view_cart')
{
    include('view_cart.php');

}
else if(isset($_GET['page']) && $_GET['page'] == 'check_out')
{
    include('checkout_page.php');

}
else if(isset($_GET['page']) && $_GET['page'] == 'confirm')
{
    include('confirmation_page.php');

}
else if(isset($_GET['detail']))
{
    include('productDetail.php');
}

else{
   include('home.php');
}

include('footer.php');
?>