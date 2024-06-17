<?php
session_start();
include("db.php"); // Include db.php file to connect to DB
$pagename = "make your home smart"; // Create and populate variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>";
echo "<title>" . $pagename . "</title>";
echo "<body>";
include("headfile.html");
include ("detectlogin.php");
echo "<h4>" . $pagename . "</h4>";
// Create a $SQL variable and populate it with a SQL statement that retrieves product details
$SQL = "SELECT prodId, prodName, prodDescripShort, prodPrice, prodPicNameSmall 
FROM Product";

// Run SQL query for connected DB or exit and display error message
$exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
echo "<table style='border: 0px'>";
// Create an array of records (2 dimensional variable) called $arrayp.
// Populate it with the records retrieved by the SQL query previously executed.
// Iterate through the array i.e while the end of the array has not been reached, run through it
while ($arrayp = mysqli_fetch_array($exeSQL)) {
    echo "<tr>";
    echo "<td style='border: 0px'>";
    // Display the small image whose name is contained in the array
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
    echo "<img src='./images/" . $arrayp['prodPicNameSmall'] . "' style='max-width: 200px; max-height:180px; object-fit: cover; width: 100%; height:100%'>";
    //close the anchor
    echo "</a>";
    echo "</td>";
    echo "<td style='border: 0px'>";
    //make the name into an anchor to prodbuy.php and pass the product id by URL as a parameter (the id from the array)
    echo "<a href=prodbuy.php?u_prod_id=".$arrayp['prodId'].">";
    echo "<h5>" . $arrayp['prodName'] . "</h5>"; // Display product name as contained in the array    
    echo "</a>";
    echo "<p class='updateInfo'>  " . $arrayp['prodDescripShort'] . "</p>"; // Display product description
    echo "<p class='updateInfo'><b>£" . number_format($arrayp['prodPrice'], 2) . "</b></p>"; // Display product price
    echo "</td>";
    echo "</tr>";
}
echo "</table>";
include("footfile.html");
echo "</body>";
?>

