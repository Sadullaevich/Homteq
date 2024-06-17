<?php

// Check if the user is logged in (i.e., if the session user ID is set)
if(isset($_SESSION['userid'])) {


    // Display the user's full name under the navigation bar
    echo "<p style='float: right '>";
    echo "<b><i>Welcome, " . $_SESSION['userfn'] . ' ' . $_SESSION['usersn'] .' / ' .$_SESSION['userut']."</i></b>";
    echo "</p>";
}
?>
