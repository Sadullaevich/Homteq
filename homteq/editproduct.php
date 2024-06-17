<?php
$pagename="edit product"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if (isset($_POST['update_prodid']))
{
$pridtobeupdated = $_POST['update_prodid'];
$newprice=$_POST['new_price'];
$newqutoadd=$_POST['new_quantity'];
$curquSQL="select prodQuantity from Product where prodId=".$pridtobeupdated;
$execurquSQL=mysqli_query($conn, $curquSQL) or die (mysqli_error($conn));
$arrayqu=mysqli_fetch_array($execurquSQL);
$newstock = $arrayqu['prodQuantity'] + $newqutoadd;
if (!empty($newprice))
{
$updateSQL = "UPDATE Product
SET prodPrice = ".$newprice.", prodQuantity = ".$newstock."
WHERE prodId = ".$pridtobeupdated;
$exeupdateSQL=mysqli_query($conn, $updateSQL) or die (mysqli_error($conn));
}
else
{
$updateSQL = "UPDATE Product
SET prodQuantity = ".$newstock."
WHERE prodId = ".$pridtobeupdated;
$exeupdateSQL=mysqli_query($conn, $updateSQL) or die (mysqli_error($conn));
}
echo "<p> <b>Product No ".$pridtobeupdated." has been updated </b>";
}


$SQL="SELECT prodId, prodName, prodPicNameSmall, prodDescripShort, prodQuantity, prodPrice FROM Product";
$exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));
echo "<table style='border: 0px'>";
while ($arrayp=mysqli_fetch_array($exeSQL))
{
echo "<tr>";
echo "<td style='border: 0px'>";
//display the small image whose name is contained in the array
echo "<img src=images/".$arrayp['prodPicNameSmall']." height=200 width=200>";
echo "</td>";
echo "<td style='border: 0px'>";
echo "<p><h5>".$arrayp['prodName']."</h5></p>";
echo "<p class='updateInfo'>".$arrayp['prodDescripShort']."</p>";
echo "<form action=editproduct.php method=post>";
echo "<p class='updateInfo'>Current Price: <b>&pound".$arrayp['prodPrice']."</b>";
echo " | | Enter New Price: <input type=text name=new_price size=8></p>";
echo "<p class='updateInfo'>Current Stock Level: <b>".$arrayp['prodQuantity']."</b>";
echo " | | Add number of items: <select name=new_quantity>";
for ($i=0; $i<=100 ; $i++)
{
echo "<option value=".$i.">".$i."</option>";
}
echo "</select></p>";
echo "<p class='updateInfo'><input type=submit value='Update' id='submitbtn'></p>";
echo "<input type=hidden name=update_prodid value=".$arrayp['prodId'].">";
echo "</form>";
echo "</td>";
echo "</tr>";
}
echo "</table>";


echo "</body>";
?>