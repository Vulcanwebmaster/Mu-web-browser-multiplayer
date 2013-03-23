<?php
session_start();
include('player_stats.php');
if(!isset($_GET['id']))
exit('Undefined');
else
$id = $_GET['id'];
$xml = simplexml_load_file('items/'.$id.'/index.xml');
$i=0;
foreach($xml->children() as $child)
 {
  $item_list[$i]= "$child";
  $i++;
 }
$item_list = json_encode($item_list);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<link href="common.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
</head>
<body>
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.82; filter:alpha(opacity=82);"></div>
<table><tr><td>Item Data:</td>
<td><a href="view_items.php?id=1">[ 1 ]</a></td>
<td><a href="view_items.php?id=2">[ 2 ]</a></td>
<td><a href="view_items.php?id=3">[ 3 ]</a></td>
<td><a href="view_items.php?id=4">[ 4 ]</a></td>
<td><a href="view_items.php?id=5">[ 5 ]</a></td>
<td><a href="view_items.php?id=6">[ 6 ]</a></td>
<td><a href="view_items.php?id=7">[ 7 ]</a></td>
<td><a href="view_items.php?id=8">[ 8 ]</a></td>
<td><a href="view_items.php?id=9">[ 9 ]</a></td>
<td><a href="view_items.php?id=A">[ A ]</a></td>
<td><a href="view_items.php?id=B">[ B ]</a></td>
<td><a href="view_items.php?id=C">[ C ]</a></td>
<td><a href="view_items.php?id=D">[ D ]</a></td>
<td><a href="view_items.php?id=E">[ E ]</a></td>
<td><a href="view_items.php?id=F">[ F ]</a></td>
<td><a href="view_items.php?id=G">[ G ]</a></td>
<td><a href="view_items.php?id=I">[ I ]</a></td>
<td><a href="view_items.php?id=J">[ J ]</a></td>
<td><a href="view_items.php?id=K">[ K ]</a></td>
<td><a href="index.php">[ Voltar ]</a></td>
</tr></table>
<script type="text/javascript">
var player_class = <?php echo $player_class;?>;
var player_level = <?php echo $player_level;?>;;
var player_strength = <?php echo $player_strength;?>;
var player_agility = <?php echo $player_agility;?>;
var player_stamina = <?php echo $player_stamina;?>;
var player_energy = <?php echo $player_energy;?>;
var player_zen = <?php echo $player_zen;?>;
var js_item_list = <?php echo $item_list; ?>;
document.write('<table style="margin-left:40px;"><tr>');
for(i=0; i<js_item_list.length; i++)
{
var num=i/8;
var x = parseFloat(num) - parseInt(num);
if(x == 0)
document.write('</tr><tr>');
document.write('<td style="vertical-align:top; width:120px; height:100px; padding: 4px; background: #c6c6c6;" id = "' + i + '"></td>');
document.getElementById(i).innerHTML = i + '&nbsp;' + load_items(js_item_list[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
}
document.write('</tr></table>');
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>