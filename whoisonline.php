<?php
session_start();
$login_not_required = 1;
include('function.login.php');
//server stats
$sql = "SELECT COUNT(*) FROM users";
$result_tmp = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result_tmp);
$total_users = $r[0];
$sql = "SELECT COUNT(*) FROM characters";
$result_tmp = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result_tmp);
$total_characters = $r[0];
$sql = "SELECT COUNT(*) FROM guilds";
$result_tmp = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result_tmp);
$total_guilds = $r[0];
$query = "SELECT * FROM online ORDER BY location DESC"; //actual result
$sql = "SELECT COUNT(*) FROM online"; //counting rows for pagination
/////////////////////////pagination//////////////////////////
$result = mysql_query($sql, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result);
$numrows = $r[0];
$rowsperpage = 20;
$totalpages = ceil($numrows / $rowsperpage);
if (isset($_GET['page']) && is_numeric($_GET['page']))
$currentpage = (int) $_GET['page'];
else
$currentpage = 1;
if ($currentpage > $totalpages)
$currentpage = $totalpages;
if ($currentpage < 1)
$currentpage = 1;
$offset = ($currentpage - 1) * $rowsperpage;
/////////////////////////pagination//////////////////////////
$query = $query." LIMIT $offset, $rowsperpage";
$result = mysql_query($query,$conn);
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
<?php
echo 'Quem esta online (last 5 min)';
?>
</div>
</td></tr>
<tr><td>
<table class="market_table" cellspacing="0">
<tr class="market_head"><td class="m_id">id</td><td class="m_name">Nome</td><td class="m_location">Localizacao</td></tr>
<?php
if(mysql_num_rows($result)>0)
{
$pos = 1;
while($row = mysql_fetch_assoc($result))
{
 if($row['location'] != 'global')
 {
  $spot_tmp = $row['location'];
  $tmp = substr($row['location'],4);
  if($tmp <11)
  $map_tmp = 'lorencia';
  else if($tmp >10 && $tmp <21)
  $map_tmp = 'noria';
  else if($tmp >20 && $tmp <31)
  $map_tmp = 'elbeland';
  else if($tmp >30 && $tmp <41)
  $map_tmp = 'dungeon';
  else if($tmp >40 && $tmp <51)
  $map_tmp = 'devias';
  else
  $map_tmp = '#';
  $location_tmp = 'battle.php?map='.$map_tmp.'&spot='.$spot_tmp;
  echo "<tr><td>".($offset+$pos)."</td><td>".$row['char_name']."</td><td><a href='".$location_tmp."'>".$spot_tmp."</a></td></tr>";
 }
 else
 echo "<tr><td>".($offset+$pos)."</td><td>".$row['char_name']."</td><td>".$row['location']."</td></tr>";
 $pos++;
}
echo '</table>';
}
else
echo '</table><br/>no characters';
mysql_free_result($result);
?>
</td></tr>
<tr><td id="npc32_separator"></td></tr>
<tr><td class="pagination">
<div class="pagination_main">
<?php
if($totalpages > 1)//show pagination only if more than one page...
{
/******  build the pagination links ******/

// range of num links to show
$range = 2;
echo '<table class="pagination_ins"><tr>';
//beginning
if ($currentpage > 3)
   echo "<td><a href='whoisonline.php?page=1'>1</a></td>";
if ($currentpage > 4)
   echo "<td class='page_b'>...</td>";
// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++)
{
   if (($x > 0) && ($x <= $totalpages))
    {
 if ($x == $currentpage)
{
 echo "<td class='page_a'>$x</td>";
}
 else
{
 echo "<td><a href='whoisonline.php?page=$x'>$x</a></td>";
}
   } 
}
//ending
if (($totalpages-$currentpage)>3)
echo "<td class='page_b'>...</td>";
if (($totalpages-$currentpage)>2)
   echo "<td><a href='whoisonline.php?page=$totalpages'>$totalpages</a></td>";
echo '</tr></table>';
/****** end build pagination links ******/
}
?>
</div>
</td></tr>
</table>
</td><td id="main_table_td3">
<br/>
<div class="mcheck">
<br/>
<div class="mcheck_head">Status do servidor</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td>
<?php
echo 'Accounts: '.$total_users.'<br/>';
echo 'Characters: '.$total_characters.'<br/>';
echo 'Guilds: '.$total_guilds.'<br/>';
?>
<br/>
</td></tr>
</table>
</div>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
$('.market_table tr:even').addClass('even');
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>