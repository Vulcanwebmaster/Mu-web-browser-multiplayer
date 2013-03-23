<?php
if(!isset($_GET['char']))
exit('error');
include("database.php");
global $conn;
$char_name = mysql_real_escape_string($_GET['char']);
$sql = "SELECT class, level, guild FROM characters WHERE name='$char_name'";
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$row = mysql_fetch_assoc($result);
switch($row['class'])
{
 case 1:
$player_title = 'Dark Knight';
 break;
 case 2:
$player_title = 'Dark Wizard';
 break;
 case 3:
$player_title = 'Fairy Elf';
 break;
 case 4:
$player_title = 'Summoner';
 break;
 case 21:
$player_title = 'Blade Knight';
 break;
 case 22:
$player_title = 'Soul Master';
 break;
 case 23:
$player_title = 'Muse Elf';
 break;
 case 24:
$player_title = 'Bloody Summoner';
 break;
}
$level = $row['level'];
$guild = $row['guild'];
if($guild > 0)
{
 $sql = "SELECT name FROM guilds WHERE id='$guild'";
 $result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
 $row = mysql_fetch_assoc($result1);
 $guild = $row['name'];
}
else
$guild = 'none';
echo 'Class: '.$player_title;
echo '<br/>';
echo 'Level: '.$level;
echo '<br/>';
echo 'Guild: '.$guild;
?>