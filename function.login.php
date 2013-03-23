<?php
if((isset($_SESSION['enemies']) || isset($_SESSION['player_stats'])) && !isset($in_battle))
{
 unset($_SESSION['enemies']);
 unset($_SESSION['player_stats']);
}
include("database.php");
global $conn;
if(!isset($_SESSION['user_id']))
{
if(isset($_COOKIE['mu_username']) && isset($_COOKIE['mu_password'])) //if there is a cookie, try auto login
{
 $mu_username = mysql_real_escape_string($_COOKIE['mu_username']);
 $mu_password = mysql_real_escape_string($_COOKIE['mu_password']);
$query = "SELECT id, username, password FROM users WHERE username = '$mu_username' AND password = '$mu_password'";
$result = mysql_query($query, $conn);
$dbarray = mysql_fetch_array($result);
$user_id = $dbarray[0];
if(mysql_num_rows($result))
{
 $_SESSION['username'] = $mu_username;
 $_SESSION['user_id'] = $user_id;
/////////////////info about currently active character////////////////
$query = "SELECT active_char FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$active_char= $dbarray[0];
$query = "SELECT * FROM characters WHERE owner='$user_id'";
$result = mysql_query($query,$conn);
$count_chars = mysql_num_rows($result);
if($count_chars>0 && $active_char == 'av1')
{
$row = mysql_fetch_assoc($result);
$_SESSION['char_id'] = $row['id'];
$_SESSION['char_name'] = $row['name'];
$_SESSION['guild'] = $row['guild'];
}
else if($count_chars>1 && $active_char == 'av2')
{
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$_SESSION['char_id'] = $row['id'];
$_SESSION['char_name'] = $row['name'];
$_SESSION['guild'] = $row['guild'];
}
else if($count_chars>2 && $active_char == 'av3')
{
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$_SESSION['char_id'] = $row['id'];
$_SESSION['char_name'] = $row['name'];
$_SESSION['guild'] = $row['guild'];
}
else
$_SESSION['char_id'] = 0;
//////////////////////////active character end///////////////////////////
$lastvisit = time();
$query = "UPDATE users SET lastvisit='$lastvisit' WHERE id='$user_id'";
$result = mysql_query($query, $conn);
setcookie("mu_username", $mu_username, time() + 604800); // one week
setcookie("mu_password", $mu_password, time() + 604800);
}
else // password doesn't match
header('Location: ucp.php?action=login_error');
} // end of if cookie is found...
else
{
 if(!isset($login_not_required))
 {
  header("Location: ucp.php?action=login");
  exit();
 }
}
} // end of if username session is not set...
?>