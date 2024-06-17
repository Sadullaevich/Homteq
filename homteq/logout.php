<?php
session_start();
$pagename="homteq"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
include ("detectlogin.php");
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
// Check if the user is logged in
if (isset($_SESSION['userid'])) {
    // Display thank you message
    echo "<p class='updateInfo'>Thank you, " . $_SESSION['userfn'] . ' ' . $_SESSION['usersn'] ."</p>";

    // Unset and destroy the session
    session_unset();
    session_destroy();

    // Display a logout confirmation message
    echo '<p class="updateInfo">You are now logged out. <a href="login.php">Click here to log in again.</a></p>';
}
echo "</body>";
?>