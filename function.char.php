<?php
session_start();
if(!isset($_GET['action']))
exit('error');
if(!isset($_SESSION['user_id']))
exit('error');
$user_id = $_SESSION['user_id'];
///////////////set active///////////////////////
if($_GET['action'] == 'set_active')
{
if(!isset($_GET['char']))
exit('error');
if($_GET['char']!='av1' && $_GET['char']!='av2' && $_GET['char']!='av3')
exit('error');
include("database.php");
global $conn;
$char = mysql_real_escape_string($_GET['char']);
$old_char = $_SESSION['char_name'];
$query = "DELETE FROM online WHERE char_name='$old_char'";
if(!mysql_query($query, $conn))
exit('mysql_error');
$query = "UPDATE users SET active_char='$char' WHERE id='$user_id'";
if(mysql_query($query, $conn))
{
 //updating active character in this session...
 $query = "SELECT * FROM characters WHERE owner='$user_id'";
 $result = mysql_query($query,$conn);
 $count_chars = mysql_num_rows($result);
 if($count_chars>0 && $char == 'av1')
 {
 $row = mysql_fetch_assoc($result);
 $_SESSION['char_id'] = $row['id'];
 $_SESSION['char_name'] = $row['name'];
 $_SESSION['guild'] = $row['guild'];
 }
 else if($count_chars>1 && $char == 'av2')
 {
 $row = mysql_fetch_assoc($result);
 $row = mysql_fetch_assoc($result);
 $_SESSION['char_id'] = $row['id'];
 $_SESSION['char_name'] = $row['name'];
 $_SESSION['guild'] = $row['guild'];
 }
 else if($count_chars>2 && $char == 'av3')
 {
 $row = mysql_fetch_assoc($result);
 $row = mysql_fetch_assoc($result);
 $row = mysql_fetch_assoc($result);
 $_SESSION['char_id'] = $row['id'];
 $_SESSION['char_name'] = $row['name'];
 $_SESSION['guild'] = $row['guild'];
 }
 else
 {
 $_SESSION['char_id'] = 0;
 }
 //active character end
 echo 'ok';
}
else
 exit('mysql_error');
}
///////////////set active end///////////////////////
///////////////delete///////////////////////
if($_GET['action'] == 'delete')
{
if(!isset($_GET['char']))
exit('error');
if($_GET['char']!='av1' && $_GET['char']!='av2' && $_GET['char']!='av3')
exit('error');
include("database.php");
global $conn;
$char = mysql_real_escape_string($_GET['char']);
$query = "SELECT active_char FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$active_char = $dbarray[0];
$query = "SELECT * FROM characters WHERE owner='$user_id'";
$result = mysql_query($query,$conn);
$count_chars = mysql_num_rows($result);
if($char == 'av1')
{
$row = mysql_fetch_assoc($result);
$ch_id = $row['id'];
}
else if($char == 'av2')
{
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$ch_id = $row['id'];
}
else if($char == 'av3')
{
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$row = mysql_fetch_assoc($result);
$ch_id = $row['id'];
}
if($active_char!='av1')
{
 $query = "UPDATE users SET active_char='av1' WHERE id='$user_id'";
 mysql_query($query, $conn);
}
$query = "DELETE FROM characters WHERE id='$ch_id'";
if(mysql_query($query, $conn))
{
 //updating active character in this session
 $query = "SELECT * FROM characters WHERE owner='$user_id'";
 $result = mysql_query($query,$conn);
 $count_chars = mysql_num_rows($result);
 if($count_chars>0)
 {
 $row = mysql_fetch_assoc($result);
 $_SESSION['char_id'] = $row['id'];
 $_SESSION['char_name'] = $row['name'];
 $_SESSION['guild'] = $row['guild'];
 }
 else
 {
 $_SESSION['char_id'] = 0;
 unset($_SESSION['char_name']);
 unset($_SESSION['guild']);
 }
 echo 'ok';
}
else
 echo 'error';
}
///////////////delete end///////////////////////
///////////////create///////////////////////
if($_GET['action'] == 'create')
{
if(!isset($_GET['char']))
exit('error');
if(!isset($_GET['cclass']))
exit('error');
if($_GET['cclass']!='1' && $_GET['cclass']!='2' && $_GET['cclass']!='3' && $_GET['cclass']!='4')
exit('error');
include("database.php");
global $conn;
$char = mysql_real_escape_string($_GET['char']);
$cclass = mysql_real_escape_string($_GET['cclass']);
if(!ctype_alnum($char) || strlen($char)<3 || strlen($char)>12)
exit('error');
$query = "SELECT * FROM characters WHERE name='$char'";
$result = mysql_query($query,$conn);
if(mysql_num_rows($result)>0)
exit('char_taken');
$query = "SELECT * FROM characters WHERE owner='$user_id'";
$result = mysql_query($query,$conn);
$count_chars = mysql_num_rows($result);
if($count_chars>2)
exit('error');
$cell12 = '[0,0,0,0,0,0,0,0,0,0,0,0]';
$cell64 = '[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]';
if($cclass == '1')
{
$query = "INSERT INTO characters (owner, name, class, level, strength, agility, stamina, energy, points, fruits, skills, experience, hp_cur, mp_cur, inventory, equipment, monsters, guild) VALUES ( '$user_id', '$char', '$cclass',1,28,20,25,10,0,0,'[]',0,110,20,'$cell64','$cell12',0, 0)";
}
else if($cclass == '2')
{
$query = "INSERT INTO characters (owner, name, class, level, strength, agility, stamina, energy, points, fruits, skills, experience, hp_cur, mp_cur,  inventory, equipment, monsters, guild) VALUES ( '$user_id', '$char', '$cclass',1,18,18,15,30,0,0,'[30]',0,60,60,'$cell64','$cell12',0, 0)";
}
else if($cclass == '3')
{
$query = "INSERT INTO characters (owner, name, class, level, strength, agility, stamina, energy, points, fruits, skills, experience, hp_cur, mp_cur,  inventory, equipment, monsters, guild) VALUES ( '$user_id', '$char', '$cclass',1,22,25,20,15,0,0,'[]',0,80,30,'$cell64','$cell12',0, 0)";
}
else if($cclass == '4')
{
$query = "INSERT INTO characters (owner, name, class, level, strength, agility, stamina, energy, points, fruits, skills, experience, hp_cur, mp_cur,  inventory, equipment, monsters, guild) VALUES ( '$user_id', '$char', '$cclass',1,21,21,18,23,0,0,'[]',0,70,40,'$cell64','$cell12',0, 0)";
}
if(mysql_query($query, $conn))
{
 if($count_chars<2)
 {//if it's the only character, automatically set it as active in this session...
 $query = "SELECT * FROM characters WHERE owner='$user_id'";
 $result = mysql_query($query,$conn);
 $row = mysql_fetch_assoc($result);
 $_SESSION['char_id'] = $row['id'];
 $_SESSION['char_name'] = $row['name'];
 $_SESSION['guild'] = $row['guild'];
 }
 echo 'ok';
}
else
 echo 'error';
}
///////////////delete end///////////////////////
?>