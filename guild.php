<?php
session_start();
include('function.login.php');
if($_SESSION['char_id']=='0')
{
 header("Location: character.php");
 exit();
}
$user_id = $_SESSION['user_id'];
$char_id = $_SESSION['char_id'];
$char_name = $_SESSION['char_name'];
$query = "SELECT guild FROM characters WHERE id='$char_id'";
$result1 = mysql_query($query,$conn);
$row = mysql_fetch_assoc($result1);
$guild = $row['guild'];
if($guild>0)
{
 $query = "SELECT name, founder FROM guilds WHERE id='$guild'";
 $result5 = mysql_query($query,$conn);
 $count = mysql_num_rows($result5);
 if($count<1)
 exit('no guild');
 $row = mysql_fetch_assoc($result5);
 $guild_name = $row['name'];
 $guild_founder = $row['founder'];
}
if(isset($_GET['action']))
{
/////////////////////ACCEPT//////////////////////////////////
 if($_GET['action'] == 'accept')
 {
  if($_POST['invite'] == 'accept')
  {
   $guild_tmp = abs($guild);
   $query = "UPDATE characters set guild='$guild_tmp' WHERE id='$char_id'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
   $_SESSION['guild'] = $guild_tmp;
  }
  else if($_POST['invite'] == 'decline')
  {
   $query = "UPDATE characters set guild=0 WHERE id='$char_id'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
  }
 header("Location: guild.php");
 exit();
 }
/////////////////////ACCEPT END//////////////////////////////////
/////////////////////QUIT//////////////////////////////////
 else if($_GET['action'] == 'quit')
 {
  if($_POST['quit'] == 'quit')
  {
   if($guild_founder == $char_name)
   exit('founder'); //can't quit if founder, should disband
   $query = "UPDATE characters set guild=0 WHERE id='$char_id'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
   $_SESSION['guild'] = 0;
  }
 header("Location: guild.php");
 exit();
 }
/////////////////////QUIT END//////////////////////////////////
/////////////////////DELETE//////////////////////////////////
 else if($_GET['action'] == 'delete')
 {
   if($guild_founder!=$char_name)
   exit('not founder');
 $delete_char = mysql_real_escape_string($_GET['char']);
$query = "SELECT name, guild FROM characters WHERE id='$delete_char'";
$result = mysql_query($query,$conn);
$row = mysql_fetch_assoc($result);
$check_name = $row['name'];
$check_guild = abs($row['guild']); //guild or guild invite...
if($check_name == $char_name)
exit('founder'); //can't self-delete, should disband
if($check_guild < 1) //not in a guild...
 {
  header("Location: guild.php?error=noguild");
  exit();
 }
if($check_guild != $guild)
 {
  header("Location: guild.php?error=other");
  exit();
 }
   $query = "UPDATE characters set guild=0 WHERE id='$delete_char'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
 header("Location: guild.php");
 exit();
 }
/////////////////////DELETE END//////////////////////////////////
/////////////////////DISBAND//////////////////////////////////
 else if($_GET['action'] == 'disband')
 {
  if($_POST['quit'] == 'quit')
  {
   if($guild_founder!=$char_name)
   exit('not founder');
   $query = "UPDATE characters set guild=0 WHERE guild='$guild'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
   $query = "DELETE FROM guilds WHERE id='$guild'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
   $_SESSION['guild'] = 0;
  }
 header("Location: guild.php");
 exit();
 }
/////////////////////DISBAND END//////////////////////////////////
/////////////////////INVITE//////////////////////////////////
 else if($_GET['action'] == 'invite')
 {
 if($char_name != $guild_founder)
 exit('not founder');
  $invite_name = mysql_real_escape_string($_POST['invite_name']);
  if(strlen($invite_name)<1)
  {
   header("Location: guild.php");
   exit();
  }
  $query = "SELECT guild FROM characters WHERE name='$invite_name'";
  $result = mysql_query($query,$conn);
  if(mysql_num_rows($result)<1)
  {
   header("Location: guild.php?error=name");
   exit();
  }
$row = mysql_fetch_assoc($result);
$invited_guild = $row['guild'];
if($invited_guild<0 || $invited_guild>0)
  {
   header("Location: guild.php?error=other");
   exit();
  }
$negative_guild = -1 * $guild;
$sql = "SELECT COUNT(*) FROM characters WHERE guild='$guild' OR guild='$negative_guild'";
$result = mysql_query($sql, $conn);
$r = mysql_fetch_row($result);
$numrows = $r[0];
 if($r[0]>19)
  {
   header("Location: guild.php?error=full");
   exit();
  }
   $query = "UPDATE characters set guild='$negative_guild' WHERE name='$invite_name'";
   if(!mysql_query($query, $conn))
   exit('mysql_error');
 header("Location: guild.php");
 exit();
 }
/////////////////////INVITE END//////////////////////////////////
/////////////////////CREATE//////////////////////////////////
 else if($_GET['action'] == 'create')
 {
 if($guild > 0) //don't allow to create a guild if you are a member already...
 {
  header("Location: guild.php?error=member");
  exit();
 }
 $guild_name = mysql_real_escape_string($_POST['guild_name']);
 if(!ctype_alnum($guild_name) || strlen($guild_name)<3 || strlen($guild_name)>12)
 {
  header("Location: guild.php?error=chars");
  exit();
 }
////////////////check if name is free/////////////////////////
 $query = "SELECT * FROM guilds WHERE name='$guild_name'";
 $result = mysql_query($query,$conn);
 if(mysql_num_rows($result)>0)
 {
  header("Location: guild.php?error=taken");
  exit();
 }
////////////////level check/////////////////////////
$query = "SELECT level FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$row = mysql_fetch_assoc($result);
$player_level = $row['level'];
 if($player_level < 10)
 {
  header("Location: guild.php?error=level");
  exit();
 }
////////////////money check/////////////////////////
$query = "SELECT zen FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$row = mysql_fetch_assoc($result);
$player_money = $row['zen'];
 if($player_money < 1000)
 {
  header("Location: guild.php?error=money");
  exit();
 }
 else
 {
 $query = "UPDATE users SET zen=zen-1000 WHERE id='$user_id'";
 if(!mysql_query($query, $conn))
 exit('mysql_error');
 }
 $new_time = time();
 $query = "INSERT INTO guilds (name, founder, time) VALUES ('$guild_name', '$char_name', '$new_time')";
 if(!mysql_query($query, $conn))
 exit('mysql_error');
 $query = "SELECT id FROM guilds WHERE name='$guild_name'";
 $result = mysql_query($query,$conn);
 $row = mysql_fetch_assoc($result);
 $guild_id = $row['id'];
 $query = "UPDATE characters set guild='$guild_id' WHERE id='$char_id'";
 if(!mysql_query($query, $conn))
 exit('mysql_error');
 $_SESSION['guild'] = $guild_id;
 header("Location: guild.php");
 exit();
 }
/////////////////////CREATE END//////////////////////////////////
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="market.css" rel="stylesheet" type="text/css"/>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
</head>
<body>
<div id="overDiv" style="text-align:center; position:absolute; visibility:hidden; z-index:1000; opacity:0.82; filter:alpha(opacity=82);"></div>
<table class = "parent_table" cellspacing="0">
<tr>
<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<table class="main_table" cellspacing="0">
<tr><td id="main_table_td2">
<table cellspacing="1" class="npc32_table">
<tr><td id="pstore_title">
<div id="pstore_title_ins">
Guild Status
</div>
</td></tr>
<tr><td id="guild_main">
<table cellspacing="0" id="guild_ins"><tr><td>
<div class="guild_header">Royal Captain Lorence</div>
<img src="images/guild.gif" alt="" />
</td><td id="guild_separator"></td><td>
<?php
echo '<div class="guild_header">Gerenciamento da guild</div><div class="guild_data"><br/>';
if($guild < 0) //invited...
{
$guild_tmp = abs($guild);
$query = "SELECT name, founder FROM guilds WHERE id='$guild_tmp'";
$result1 = mysql_query($query,$conn);
$count = mysql_num_rows($result1);
if($count<1)
exit('no guild');
$row = mysql_fetch_assoc($result1);
$guild_name = $row['name'];
$guild_founder = $row['founder'];
echo '<b>'.$guild_founder.'</b><br/>Convidou para entrar na Guild <br/><b>'.$guild_name.'</b> .<br/><br/>';
echo <<<EOT
<form method="post" name="cookie" action="guild.php?action=accept">
<input type="radio" name="invite" value="accept" checked="checked">Aceitar</input>
<input type="radio" name="invite" value="decline" />Recusar</input>
<br/><br/>
<input type="submit" name="submit" value="Submit" />
</form>
</div>
EOT;
}
else if($guild > 0) //a guild member
{
 if($char_name == $guild_founder) //special case: disband guild if founder
 {
echo <<<EOT
<form method="post" name="cookie" action="guild.php?action=disband">
Disband guild <input type="checkbox" name="quit" value="quit" />
<br/><br/>
<input type="submit" name="submit" value="Submit" />
</form>
<br/>
<form method="post" name="cookie1" action="guild.php?action=invite">
Invite to guild:<br/>
EOT;
if(isset($_GET['invite']))
 echo '<input type="text" name="invite_name" id="invite_name" maxlength="12" size="26" value="'.$_GET['invite'].'" />';
else
 echo '<input type="text" name="invite_name" id="invite_name" maxlength="12" size="26" />';
echo <<<EOT
<br/>
<br/>
<input type="submit" name="submit" value="Submit" />
</form>
EOT;
if(isset($_GET['error']))
{
 if($_GET['error'] == 'name')
 echo '<br/><b>no such character</b>';
 else if($_GET['error'] == 'full')
 echo '<br/><b>guild limit is reached</b>';
 else if($_GET['error'] == 'other')
 echo '<br/><b>character is in other guild</b>';
 else if($_GET['error'] == 'noguild')
 echo '<br/><b>character is not in a guild</b>';
}
echo '</div>';
 }
 else
 {
echo <<<EOT
<form method="post" name="cookie" action="guild.php?action=quit">
Quit guild <input type="checkbox" name="quit" value="quit" />
<br/><br/>
<input type="submit" name="submit" value="Submit" />
</form>
</div>
EOT;
 }
}
else //no guild and no request
{
echo <<<EOT
Criar guild:
<form method="post" name="cookie" action="guild.php?action=create">
<input type="text" name="guild_name" id="guild_name" maxlength="12" size="26" /><br/>
[12 letras max, sem espacos]
<br/>
[Somente alfanumericos]
<br/>
<br/>
<input type="submit" name="submit" value="Submit" />
</form>
EOT;
if(isset($_GET['error']))
{
 if($_GET['error'] == 'taken')
 echo '<br/><b>this name is taken</b>';
 else if($_GET['error'] == 'chars')
 echo '<br/><b>incorrect guild name</b>';
 else if($_GET['error'] == 'member')
 echo '<br/><b>a guild member already</b>';
 else if($_GET['error'] == 'money')
 echo '<br/><b>not enough money</b>';
 else if($_GET['error'] == 'level')
 echo '<br/><b>no required level</b>';
}
echo '</div>';
}
?>
</td></tr></table>
</td></tr>
<tr><td>
<div id="guild_desc_back"><div id="guild_desc">
Por ser um membro de uma guilda pode receber mais XP se voce lutar ao lado de outros membros da guilda em um local. <br/> ou pode criar seu proprio cla depois de atingir o nível 10 (custos de 1000 ouro). Para se juntar a uma guilda existente, voce deve receber um convite de um dos fundadores da aliança.
</div></div>
</td></tr>
</table>
</td><td id="main_table_td3">
<br/>
<div class="mcheck">
<br/>
<div class="mcheck_head">
<?php
if($guild>0)
 echo $guild_name;
else
 echo 'Guild';
echo '</div><table class="mcheck_ins" cellspacing="0"><tr><td>';
if($guild>0)
{
$negative_guild = -1 * $guild;
$query = "SELECT id, name, level, guild FROM characters WHERE guild='$guild' OR guild='$negative_guild' ORDER BY level DESC";
$result = mysql_query($query,$conn);
echo '<table id="guild_list" cellspacing="0">';
while($row = mysql_fetch_assoc($result))
{
 if($row['name'] == $guild_founder)
 echo '<tr><td><b># '.$row['name'].'</b></td><td><b>'.$row['level'].'</b></td><td><img src="images/star.gif" width="15px" height="15px" title="guild founder" alt=""/></td></tr>';
 else if($row['guild'] < 0) //invited members
 {
  echo '<tr><td><a class="gray"># '.$row['name'].'</a></td><td><a class="gray">???</a></td><td>';
  if($char_name == $guild_founder)
  echo '<a href="guild.php?action=delete&char='.$row['id'].'"><img src="images/del.gif" width="15px" height="14px" title="delete" alt=""/></a>'; //show only if guild founder
  echo '</td></tr>';
 }
 else
 {
  echo '<tr><td># '.$row['name'].'</td><td>'.$row['level'].'</td><td>';
  if($char_name == $guild_founder)
  echo '<a href="guild.php?action=delete&char='.$row['id'].'"><img src="images/del.gif" width="15px" height="14px" title="delete" alt=""/></a>'; //show only if guild founder
  echo '</td></tr>';
 }
}
echo '</table>';
mysql_free_result($result);
}
else
echo 'no guild<br/>';
?>
<br/>
</td></tr>
</table>
</div>
</td></tr></table>
</div>
</td></tr></table>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>