<?php
session_start();
$pagename="login"; //Create and populate a variable called $pagename
echo "<link rel='stylesheet' type='text/css' href='mystylesheet.css'>"; //Call in stylesheet
echo "<title>".$pagename."</title>"; //display name of the page as window title
echo "<body>";
include ("headfile.html"); //include header layout file
echo "<h4>".$pagename."</h4>"; //display name of the page on the web page
echo "<table id='baskettable'>
      <form action='login_process.php' method='post'>
      <tr>
      <td colspan='2'>Email:            
      <input type='text' name='email'></td>
    </tr>
    <tr>
      <td colspan='2' style='padding-right: 4ch'>Password:
      <input type='password' name='password'></td>
    </tr>
    <tr>
      <td colspan='2'><input type='submit' value='Login' id='submitbtn'>
      <input type='reset' value='Clear Form' id='submitbtn'></td>
    </tr>
      </form>
      </table>"; 
echo "</body>";
?>