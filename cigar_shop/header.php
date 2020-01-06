<?php
/**
 * header.php
 *
 * Project 1
 *
 * @category   Project 1
 * @package    p1
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.09.27
 */
session_start();


?>

<body>

<header>
    <div class="myDiv">
        <h1><a href="index.php">DTS Cigars</a></h1>
        <?php
        if(isset($_SESSION['customer_id']))
        {
            ?>
            <button onclick="window.location.href = 'index.php?page=logout';">Log Out</button>
        <?php   }

        else
        {?>
            <button onclick="window.location.href = 'index.php?page=login';">Log In</button>
       <?php
        }
        ?>
        <button onclick="window.location.href = 'index.php?page=view_cart';">Cart</button>
        <button onclick="window.location.href = 'index.php?page=check_out';">Check Out</button>
    </div>
    <div class = "myborder" id = "top-nav">
        <!--<img src = "header.jpg" alt = "Cigar Photo">-->

        <!--<img src = "header2.jpg" alt = "Cigar Photo">-->
        <p><a href="index.php?page=home">Home</a>
        <a href="index.php?page=contact">Contact</a>
        <a href="index.php?page=catalog">Catalog</a></div></p>
    </div>
</header>
   <!-- <nav class="nav-img">
        <div>
            <p><a href="home.php">Home</a></p>
            <p><a href="contact.php">Contact</a></p>
            <p><a href="index.php">Catalog</a></p>
        </div>
    </nav>-->



