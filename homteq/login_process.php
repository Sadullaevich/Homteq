<?php
session_start();
include("db.php");
$pagename="login results"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
// Capture the inputs entered in the form using $_POST superglobal
$email = $_POST['email'];
$password = $_POST['password'];

// Display the content of the captured variables
// echo "Email: " . $email . "<br>";
// echo "Password: " . $password . "<br>";


// Check if either mandatory email or password fields in the form are empty
if (empty($email) or empty($password)) {
    // Display error message and provide a link to the login page
    echo "<p class='updateInfo'>Both email and password fields need to be filled in.<br><br> <a href='login.php'>Go back to login page</a></p>";
}else{
    $SQL = "SELECT userId, userType, userFName, userSName, userEmail, userPassword
                FROM Users
                WHERE userEmail='".$email."'";
                // Run SQL query for connected DB or exit and display error message
                $exeSQL = mysqli_query($conn, $SQL) or die(mysqli_error($conn));
                $arrayThisUser = mysqli_fetch_array($exeSQL);
                $nbOfRecs = mysqli_num_rows($exeSQL);
                // echo "<p class='updateInfo'>Number of users found: ".$nbOfRecs."</p>";

    if($nbOfRecs == 0)
    {
        echo"<p class='updateInfo'>Login Failure!</p>";
        echo"<p class='updateInfo'>Email Not Recognised!</p>";
        echo"<p class='updateInfo'>Go back to <a href='login.php'>Login</a> page</p>";
    }
    else{
        // echo "<p class='updateInfo'>User found</p>";
        if($arrayThisUser['userPassword']!= $password){
            echo"<p class='updateInfo'>Login Failure!</p>";
            echo"<p class='updateInfo'>Password Not Recognised!</p>";
            echo"<p class='updateInfo'>Go back to <a href='login.php'>Login</a> page</p>";
        }else{
            echo "<p class='updateInfo'>Login Success!</p>";
            $_SESSION['userid'] = $arrayThisUser['userId'];
            $_SESSION['userfn'] = $arrayThisUser['userFName'];
            $_SESSION['usersn'] = $arrayThisUser['userSName'];
            $_SESSION['userem'] = $arrayThisUser['userEmail'];
            $_SESSION['userut'] = $arrayThisUser['userType'];

            echo "<p class='updateInfo'>ID Number: ".$_SESSION['userid']."</p>";
            echo "<p class='updateInfo'>First Name: ".$_SESSION['userfn']."</p>";
            echo "<p class='updateInfo'>Surname: ".$_SESSION['usersn']."</p>";
            echo "<p class='updateInfo'>Email: ".$_SESSION['userem']."</p>";
            echo "<p class='updateInfo'>User Type: ".$_SESSION['userut']."</p>";
            echo "<p class='updateInfo'>Continue Shopping for <a href='index.php'>Home Tech</a></p>";
            echo "<p class='updateInfo'>View your  <a href='basket.php'>Smart Basket</a></p>";
        }
   
    }
}




echo "</body>";
?>