<?php
if(!isset($_SESSION['user_id']))
{
 header("Location: ucp.php?action=login");
 exit();
}
else if($_SESSION['char_id']=='0')
{
 header("Location: character.php");
 exit();
}
//deleting battle data
if(isset($_SESSION['player_stats']) || isset($_SESSION['enemies']))
{
 unset($_SESSION['player_stats']);
 unset($_SESSION['enemies']);
}
$user_id = $_SESSION['user_id'];
include("database.php");
global $conn;
$query = "SELECT zen FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$player_zen = intval($dbarray[0]);
$char_id = $_SESSION['char_id'];
$query = "SELECT name, class, level, strength, agility, stamina, energy, points, fruits, skills, experience, hp_cur, mp_cur, inventory, equipment, monsters FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$player_name = $dbarray[0];
$player_class = $dbarray[1];
$player_level = $dbarray[2];
$player_strength = $dbarray[3];
$player_agility = $dbarray[4];
$player_stamina = $dbarray[5];
$player_energy = $dbarray[6];
$player_points = $dbarray[7];
$player_fruits = $dbarray[8];
$current_skills = $dbarray[9];
$player_experience = $dbarray[10];
$player_hp_cur = $dbarray[11];
$player_mp_cur = $dbarray[12];
$current_inventory = $dbarray[13];
$current_equipment = $dbarray[14];
$player_monsters = $dbarray[15];
?>