<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['stat']))
exit('error');
$stat = $_GET['stat'];
if($stat!='strength' && $stat!='agility' && $stat!='stamina' && $stat!='energy')
exit('error');
include("database.php");
global $conn;
$char_id = $_SESSION['char_id'];
$query = "SELECT points FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$points = $dbarray[0];
if($points<1)
exit('error');
if($stat == 'strength')
$query = "UPDATE characters SET points=points-1, strength=strength+1 WHERE id='$char_id'";
else if($stat == 'agility')
$query = "UPDATE characters SET points=points-1, agility=agility+1 WHERE id='$char_id'";
else if($stat == 'stamina')
$query = "UPDATE characters SET points=points-1, stamina=stamina+1 WHERE id='$char_id'";
else if($stat == 'energy')
$query = "UPDATE characters SET points=points-1, energy=energy+1 WHERE id='$char_id'";
if(!mysql_query($query, $conn))
exit('mysql_error');
echo 'ok';
?>