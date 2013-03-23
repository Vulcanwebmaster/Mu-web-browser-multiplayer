<?php
session_start();
if(!isset($_GET['action']))
exit('error');
include("database.php");
global $conn;
/////////////////////////LOGIN////////////////////////
if($_GET['action'] == 'login')
{
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$time = time();
$password = md5($password);
$query = "SELECT id, username, password FROM users WHERE username = '$username' AND password = '$password'";
$result = mysql_query($query, $conn);
$dbarray = mysql_fetch_array($result);
$user_id = $dbarray[0];
 if(mysql_num_rows($result))
 {
  $_SESSION['username'] = $username;
  $_SESSION['user_id'] = $user_id;
/////////////////info about currently active character////////////////////
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
//////////////////////////active character end//////////////////////////////
$lastvisit = time();
$query = "UPDATE users SET lastvisit='$lastvisit' WHERE id='$user_id'";
$result = mysql_query($query, $conn);
  if(isset($_POST['setcookie']))
  {
   setcookie("mu_username", $username, $time + 604800); // one week
   setcookie("mu_password", $password, $time + 604800);
  }
  header('Location: ucp.php?action=login_success'); 
 }
 else
{
 header('Location: ucp.php?action=login_error');
}
}
/////////////////////////REGISTER////////////////////////
if($_GET['action'] == 'register')
{
if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['password2']) || !isset($_POST['email']))
{
 header('Location: ucp.php?action=register_error');
 exit();
}
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$time = time();
$username = mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);
$password2 = mysql_real_escape_string($_POST['password2']);
$email = mysql_real_escape_string($_POST['email']);
if(!ctype_alnum($username) || $password!=$password2 || strlen($username)<3 || strlen($username)>12 || strlen($password)<3 || strlen($password)>20 || strlen($email)<3 || strlen($email)>50)
{
echo '1';
 //header('Location: ucp.php?action=register_error');
 //exit(); 
}
$password = md5($password);
//Check to see if username exists 
$query = "SELECT username FROM users WHERE username = '$username'";
$result = mysql_query($query, $conn);
if(mysql_num_rows($result)>0)
{
 header('Location: ucp.php?action=register_taken');
 exit();
}
$regtime = time();
$ip = $_SERVER['REMOTE_ADDR'];
$cell32 = '[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]';
$cell120 = '[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]';
$query = "INSERT INTO users (ip, regtime, username, password, email, lastvisit, active_char, zen, pstore_open, pstore_open_time, pstore, npc32_kind, npc32, vault) VALUES ('$ip', '$regtime', '$username', '$password', '$email', '$regtime', 'av1', 500, 0, 0, '$cell32', 0, '$cell32', '$cell120')";
if(mysql_query($query, $conn)) 
{
 header('Location: ucp.php?action=register_success');
 exit(); 
} 
else
{
echo '3';
 //header('Location: ucp.php?action=register_error');
 //exit();
}
}
?>