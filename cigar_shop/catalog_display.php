<?php
/**
 * catalog_display.php
 *
 * Project 2
 *
 * @category   Project 2
 * @package    p2
 * @author     David Smith <dtsmith2106@hawkmail.hfcc.edu>
 * @version    2019.09.29
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

$rownum=0;
$stmt=$pdo->query("SELECT * FROM product order by item_num");
echo "<table>";
echo "<tr>";
echo "<th>Item number</th>" . "\t" . "<th>Name</th>" . "<th>Price</th>" . "<th>Cigar Image</th>";
echo "</tr>";
while ($row = $stmt->fetch())
{
    echo '<tr>';
    echo "<td>".'<a href = "index.php?detail=' . $row['item_num'] . '" >' . ($row['item_num']) ."</a>" . "</td>";
    echo "<td>" . ($row['item_name']) . "</td>";
    echo "<td>" . ("$" .$row ['item_price']) ."</td>";
    echo "<td><img src=" . ($row['image']) . " alt=\"picture\"></td>";
    echo "</tr>";
    $rownum++;
}
echo "</table>";

?>
</body>
</html>