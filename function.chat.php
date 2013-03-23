<?php
session_start();
if(!isset($_SESSION['char_name']))
exit('error no char');
include("database.php");
global $conn;
$new_time = time();
$poster = $_SESSION['char_name'];
 $dest = 'global';
 if(isset($_SESSION['player_stats']['spot']))
 $dest = $_SESSION['player_stats']['spot'];
//adding new chat message if required...
if(isset($_POST['text']))
{
 $input_text = $_POST['text'];
 $input_text = strip_tags($input_text);
 $input_text = mysql_real_escape_string($input_text);
 $input_text = substr($input_text, 0, 54);
 $query = "INSERT INTO chat (time, poster, text, dest) VALUES ( '$new_time', '$poster', '$input_text', '$dest' )";
 if(!mysql_query($query, $conn))
 exit('chat_error');
}
//how many rows in database?
if($dest === 'global')
$sql = "SELECT COUNT(*) FROM chat WHERE dest='global'"; //counting rows
else
$sql = "SELECT COUNT(*) FROM chat WHERE dest='global' OR dest='$dest'"; //counting rows
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];
//deleting old chat messages...
if($numrows>0)
{
 $old_time = $new_time - 3600; //1 hour
 $query = "DELETE FROM chat where time < $old_time";
 if(!mysql_query($query, $conn))
 exit('chat_error');
//get last 8 chat rows...
if($numrows>8)
$numrows -=8;
else
$numrows = 0;
if($dest === 'global')
$query = "SELECT * FROM chat WHERE dest='global' ORDER BY time LIMIT $numrows, 8";
else
$query = "SELECT * FROM chat WHERE dest='global' OR dest='$dest' ORDER BY time LIMIT $numrows, 8";
$result = mysql_query($query, $conn) or trigger_error("SQL", E_USER_ERROR);
 while($row = mysql_fetch_assoc($result))
 {
  $convert_time = date("H:i", $row['time']);
  $output = "[".$convert_time."]" . "[".$row['poster']."] " . $row['text'] . "<br/>";
  if($row['dest'] === 'global')
  echo "<a class='green'>".$output."</a>";
  else
  {//display spot posts only if in the same spot...
   if(isset($_SESSION['player_stats']['spot']))
   {
    if($_SESSION['player_stats']['spot'] === $row['dest'])
    echo $output;
   }
  }
 } //end of while
} //end of in numrows > 0
?>

