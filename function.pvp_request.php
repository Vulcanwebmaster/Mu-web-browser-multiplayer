<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_SESSION['player_stats']['spot']))
exit('error');
if(!isset($_GET['char']))
exit('error');
include("database.php");
global $conn;
$spot = $_SESSION['player_stats']['spot'];
$char = mysql_real_escape_string($_GET['char']);
$new_time = time();
$my_id = $_SESSION['char_id'];
$my_char = $_SESSION['char_name'];
//don't allow multiple requests
 $sql = "SELECT COUNT(*) FROM online WHERE pvp='$my_id'";
 $result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
 $r = mysql_fetch_row($result1);
 $numrows = $r[0];
 if($numrows > 0)
 exit('failed');
//don't allow requests if my character is currently challenged
 $sql = "SELECT pvp FROM online WHERE char_name='$my_char'";
 $result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
 $row = mysql_fetch_assoc($result1);
 $pvp = $row['pvp'];
 if($pvp > 0)
 exit('failed');
//don't allow request if that char was challenged already or not in the same spot
$sql = "SELECT pvp FROM online WHERE location='$spot' AND char_name='$char'";
$result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$row = mysql_fetch_assoc($result1);
$pvp = $row['pvp'];
$numrows = mysql_num_rows($result1);
if($numrows < 1 || $pvp > 0)
exit('failed');
 $query = "UPDATE online SET pvp='$my_id', pvp_time='$new_time' WHERE char_name = '$char'";
 if(!mysql_query($query, $conn))
 exit('online_error');
echo $char;
?>