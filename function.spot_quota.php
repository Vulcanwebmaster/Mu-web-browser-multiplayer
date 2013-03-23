<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['spot']))
exit('error');
include("database.php");
global $conn;
$location = mysql_real_escape_string($_GET['spot']);
$sql = "SELECT COUNT(*) FROM online WHERE location='$location'";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];
echo $numrows;
?>