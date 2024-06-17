<?php
session_start();
include ("db.php");
$pagename="smart basket"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page

if(isset($_POST['remove_prodid'])) {
    $delprodid = $_POST['remove_prodid'];
    unset($_SESSION['basket'][$delprodid]);
    echo "<p class='updateInfo'><b>1 item removed from the basket</b></p>";
}


if(isset($_POST['h_prodid'])) {
    $newprodid = $_POST['h_prodid'];
    $reququantity = $_POST['prodQuantity'];
    $_SESSION['basket'][$newprodid] = $reququantity;
    echo "<p class='updateInfo'><b>1 item added</b></p>";
}
// } else {
//     echo "<p class='updateInfo'>Basket Unchanged</p>";
// }

$total = 0;

// Check if the session array $_SESSION['basket'] is set
if(isset($_SESSION['basket'])) {
    // Create HTML table with header
    echo "<table id='baskettable'>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Remove</th>
            </tr>";

    // Loop through the basket session array for each data item inside the session
    foreach($_SESSION['basket'] as $index => $value) {

        // Fetch details of selected product for which id matches $index from Product table using SQL query
        // Execute the query and create an array of records $arrayp
        // Assuming $arrayp contains product details like product name and price

        

                // Create a $SQL variable and populate it with a SQL statement that retrieves product details
                $SQL = "SELECT prodId, prodName, prodDescripLong, prodPrice, prodPicNameLarge, prodQuantity
                FROM Product
                WHERE prodId=".$index;
                // Run SQL query for connected DB or exit and display error message
                $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
        
                while ($arrayp = mysqli_fetch_array($exeSQL)) {
                    echo "<tr>";
                    echo "<td>" . $arrayp['prodName'] . "</td>";
                    echo "<td>£" . number_format($arrayp['prodPrice'], 2) . "</td>";
                    echo "<td>".$value."</td>";
                    // calculate subtotal
                    $subtotal = $arrayp['prodPrice'] * $value;
                    // display subtotal
                    echo "<td>£".$subtotal."</td>";
                    // Increase total by adding the subtotal to the current total
                    $total += $subtotal;                    
                    echo "<td>
                    <form action='basket.php' method='post'>
                    <input type='hidden' name='remove_prodid' value=".$index.">
                    <input type='submit' value='REMOVE' class = 'remove-button' id='submitbtn' >
                    </form>
                    </td>";  

                      
                    //   /* Hover effect */
                    //   input[type="submit"]:hover {
                    //     background-color: #45a049; /* Darker green */
                    //   }

                    
                    echo "</td>";
                    
    }}
    
    
    // Display total
    echo "<tr>
    <th colspan='4'>TOTAL</th>
    <th>£$total</th></tr>";
    // Close the HTML table
    echo "</table>";
} else {
    // Display empty basket message if the basket is empty
    echo "<p class='updateInfo'>Empty Basket</p>";
}

// Check if basket session is set and basket element counter is greater than 0
if (isset($_SESSION['basket']) and count($_SESSION['basket']) > 0) {
    // Display an anchor to clear the basket
    echo '<p class="updateInfo"><a href="clearbasket.php">Clear Basket</a></p>';

    // Check if the session user id is set
    if (isset($_SESSION['userid'])) {
        // Display a Checkout anchor to link to checkout.php
        echo '<p class="updateInfo"><a href="checkout.php">Checkout</a></p>';
    } else {
        // Display a Signup anchor for new customers to link to signup.php
        echo '<p class="updateInfo"><a href="signup.php">Signup</a></p>';
        // Display a Login anchor for returning customers to link to login.php
        echo '<p class="updateInfo"><a href="login.php">Login</a></p>';
    }
}
// echo "<p class='updateInfo'><a href='clearbasket.php'>Clear Basket</a></p>";

// echo "<p class='updateInfo'>New homteq customer: <a href='signup.php'>Sign Up</a></p>";

// echo "<p class='updateInfo'>You have an account: <a href='login.php'>Login</a></p>";

echo "</body>";
?>