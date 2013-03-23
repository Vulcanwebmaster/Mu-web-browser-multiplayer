<?php
session_start();
include('function.login.php');
$user_id = $_SESSION['user_id'];
include("database.php");
global $conn;
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$row = mysql_fetch_assoc($result);
$email = $row['email'];
$password = $row['password'];
$old_pass='';
if(isset($_GET['action']))
{
 if($_GET['action'] == 'submit')
{
 $old_pass = mysql_real_escape_string($_POST['old_pass']);
 if(strlen($old_pass)<1)
 $error='type in old password';
 else
 {
 $new_email = mysql_real_escape_string($_POST['email']);

 $new_pass = mysql_real_escape_string($_POST['new_pass']);
 $new_pass1 = mysql_real_escape_string($_POST['new_pass1']);
 if($new_pass!=$new_pass1)
 $error='retype new password';
 else if(md5($old_pass)!=$password)
 $error='incorrect old password';
 }
}
if(!isset($error)) //update only if no errors were found...
{
 if((strlen($new_email)>0) && (strlen($new_pass)<1)) //update email only...
 {
  if($new_email == $email)
  $error='email is the same';
  else
  {
  $query = "UPDATE users set email='$new_email' WHERE id='$user_id'";
  if(mysql_query($query, $conn)) 
  $success = 'email updated'; 
  else
  exit('mysql_error');
  $email = $new_email;
  }
 }
 else if((strlen($new_email)<1) && (strlen($new_pass)>0)) //update password only...
 {
  $new_pass = md5($new_pass);
  $query = "UPDATE users set password='$new_pass' WHERE id='$user_id'";
  if(mysql_query($query, $conn)) 
  $success = 'password updated'; 
  else
  exit('mysql_error');
 }
 else if((strlen($new_email)>0) && (strlen($new_pass)>0)) //update email and password...
 {
  $new_pass = md5($new_pass);
  $query = "UPDATE users set email='$new_email', password='$new_pass' WHERE id='$user_id'";
  if(mysql_query($query, $conn))
  {
  if($new_email != $email)
  $success = 'email and password updated';
  else
  $success = 'password updated';
  }
  else
  exit('mysql_error');
  $email = $new_email;
 }
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="mypage.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
</head>
<body>
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.82; filter:alpha(opacity=82);"></div>

<table class = "parent_table" cellspacing="0">
<tr>
<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<table class="main_table" cellspacing="0">
<tr><td id="my_page_td1">
<div class="header">Geral</div>
<div class="my_page_data">
<?php
if(isset($_SESSION['char_name']))
echo "Personagem ativo: ".$_SESSION['char_name']."<br/>";
else
echo "Personagem ativo: none<br/>";
?>
</div>
</td><td id="my_page_td2"><div class="header">Settings</div>
<div class="my_page_data">
<form method="post" name="cookie" action="mypage.php?action=submit">
Trocar email:<br/><input type="text" name="email" id="email" maxlength="50" size="30" value="<?php echo $email; ?>" />
<br/>
Trocar password:<br/><input type="password" name="new_pass" id="new_pass" maxlength="30" size="30" />
<br/>
Nova senha (Repetir):<br/><input type="password" name="new_pass1" id="new_pass1" maxlength="30" size="30" />
<br/>
Senha antiga:<br/><input type="password" name="old_pass" id="old_pass" maxlength="30" size="30" />
<br/>
<input type="submit" name="submit" value="Submit" />&nbsp;<input type="reset" name="reset" value="Reset" />
<br/>
</form>
<?php if(isset($error)) echo "<div id='mypage_error'>".$error.'</div>'; ?>
<?php if(isset($success)) echo "<div id='mypage_success'>".$success.'</div>'; ?>
</div>
</td><td id="my_page_td3"><div class="header">Reservado</div>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>