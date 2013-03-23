<?php
if(isset($_GET['listonline']))
session_start();
$new_time = time();
include("database.php");
global $conn;
//if logged in update or insert...
if(isset($_SESSION['char_name']))
{
$char = $_SESSION['char_name'];
$guild_online = $_SESSION['guild'];
$char_class = 0;
if(isset($_SESSION['player_stats']['player_class']))
$char_class = $_SESSION['player_stats']['player_class'];
$ip = $_SERVER['REMOTE_ADDR'];
$session_id = session_id();
$location = 'global';
if(isset($_SESSION['player_stats']['spot']))
$location = $_SESSION['player_stats']['spot'];
if(!isset($_GET['error']))
{
$sql = "SELECT id FROM online WHERE char_name != '$char' AND ip='$ip'"; //another user logged in with the same ip...
$result2 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$ip_logged = mysql_num_rows($result2);
if($ip_logged > 1000) // log out for cheating... !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!change that to 0 later!!!!!!!!!!!!!!!!!!!!!!!!1
{
 header('Location: ucp.php?action=logout&error=ip');
 exit();
}
}
$sql = "SELECT session_id FROM online WHERE char_name = '$char'"; //is this char already listed?
$result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$numrows = mysql_num_rows($result1);
$row = mysql_fetch_assoc($result1);
$session_id_stored = $row['session_id'];
if(isset($_SESSION['player_stats']['turns']))
$exp_tmp = ceil($_SESSION['player_stats']['player_exp_tmp'] / $_SESSION['player_stats']['turns']);
else
$exp_tmp = 0;
if($numrows>0 && $session_id_stored == $session_id)
{
 $query = "UPDATE online SET time='$new_time', location='$location', exp='$exp_tmp', guild='$guild_online', class='$char_class' WHERE char_name = '$char'";
 if(!mysql_query($query, $conn))
 exit('online_error');
}
else if($numrows>0) //online but different session...
{
 unset($_SESSION['enemies']);
 unset($_SESSION['player_stats']);
 $query = "UPDATE online SET ip='$ip', session_id='$session_id', time='$new_time', location='$location', exp='$exp_tmp', guild='$guild_online', class='$char_class' WHERE char_name = '$char'";
 if(!mysql_query($query, $conn))
 exit('online_error');
}
else
{
 $query = "INSERT INTO online (char_name, ip, session_id, location, time, exp, guild, class) VALUES ('$char', '$ip', '$session_id', '$location', '$new_time', '$exp_tmp', '$guild_online', '$char_class')";
 if(!mysql_query($query, $conn))
 exit('online_error');
}
} //end of if logged in
//deleting inactive characters and resetting inactive in battle
$old_time = $new_time - 300; //300 seconds = 5 min
$old_time_exp = $new_time - 180; //180 seconds = 3 min
$query = "DELETE FROM online where (time < $old_time) OR (time < $old_time_exp AND exp>0)";
if(!mysql_query($query, $conn))
exit('online_error');
//what data to show?
if(isset($_GET['listonline']) && isset($_SESSION['player_stats']['spot']))
{
 $location = $_SESSION['player_stats']['spot'];
 $query = "SELECT * FROM online WHERE location='$location'";
 $result = mysql_query($query, $conn) or trigger_error("SQL", E_USER_ERROR);
$max_chars = 0;
$exp_tmp = ceil($_SESSION['player_stats']['player_exp_tmp'] / $_SESSION['player_stats']['turns']);
$spot_exp = 0;
$exp_guild = 0;
$count_chars = mysql_num_rows($result);
 while(($row = mysql_fetch_assoc($result)) && ($max_chars<11))
 {
  if($_SESSION['guild']>0 && $_SESSION['guild'] == $row['guild'] && $count_chars>1) //same guild
  {
   echo "<div class='guild_member'> # ".$row['char_name']." [".$row['exp']."]</div>";
   if($row['char_name'] != $char) //not me
   $exp_guild += $row['exp'];
  }
  else
  {
   if($row['char_name'] != $char) //not me
   echo "# "."<a href='#' id='".$row['char_name']."' rel='".$row['class']."' class='call_cinfo_battle'>".$row['char_name']."</a> [".$row['exp']."]<br/>";
   else
   echo "# ".$row['char_name']." [".$row['exp']."]<br/>";
  }
  $max_chars +=1;
  $spot_exp += $row['exp'];
 }
if($spot_exp < 1)
$_SESSION['player_stats']['player_exp_percent'] = 100;
else
$_SESSION['player_stats']['player_exp_percent'] = floor(($exp_tmp + $exp_guild)*100/$spot_exp) + $exp_guild;
if($_SESSION['player_stats']['player_exp_percent'] < 10)
$_SESSION['player_stats']['player_exp_percent'] = 10;
if($_SESSION['player_stats']['player_exp_percent'] > 150)
$_SESSION['player_stats']['player_exp_percent'] = 150;
echo ':::'.$_SESSION['player_stats']['player_exp_percent'];
}
else if(isset($_GET['listonline']) && !isset($_SESSION['player_stats']['spot']))
 exit(':::100');
else
{
 //counting all characters...
 $sql = "SELECT COUNT(*) FROM online";
 $result1 = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
 $r = mysql_fetch_row($result1);
 $numrows = $r[0];
 echo 'ONLINE: '.$numrows;
}
?>