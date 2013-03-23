<?php
session_start();
include('function.login.php');
include('player_stats.php');
$navigation='shop';
if(!isset($_GET['id']))
exit('Undefined shop.');
else
$shop_id = $_GET['id'];
if(!file_exists('shop/'.$shop_id.'.xml'))
exit('Wrong shop id.');
//loading shop into json array
$xml = simplexml_load_file('shop/'.$shop_id.'.xml');
$i=0;
foreach($xml->children() as $child)
 {
  $shop_inventory[$i]= "$child";
  $i++;
 }
$shop_inventory = json_encode($shop_inventory);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.shop.js"></script>
</head>
<body>
<div id="overDiv" style="text-align:center; position:absolute; visibility:hidden; z-index:1000; opacity:0.82; filter:alpha(opacity=82);"></div>
<table class = "parent_table" cellspacing="0">
	<tr>
		<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
	</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<table class="main_table" cellspacing="0"><tr><td id="main_table_td1">
<table class="shop" cellspacing="1">
	<tr><td colspan="8" id="shop_name"></td></tr>
	<tr><td id="1000"></td><td id="1001"></td><td id="1002"></td><td id="1003"></td><td id="1004"></td><td id="1005"></td><td id="1006"></td><td id="1007"></td></tr>
	<tr><td id="1008"></td><td id="1009"></td><td id="1010"></td><td id="1011"></td><td id="1012"></td><td id="1013"></td><td id="1014"></td><td id="1015"></td></tr>
	<tr><td id="1016"></td><td id="1017"></td><td id="1018"></td><td id="1019"></td><td id="1020"></td><td id="1021"></td><td id="1022"></td><td id="1023"></td></tr>
	<tr><td id="1024"></td><td id="1025"></td><td id="1026"></td><td id="1027"></td><td id="1028"></td><td id="1029"></td><td id="1030"></td><td id="1031"></td></tr>
	<tr><td id="1032"></td><td id="1033"></td><td id="1034"></td><td id="1035"></td><td id="1036"></td><td id="1037"></td><td id="1038"></td><td id="1039"></td></tr>
	<tr><td id="1040"></td><td id="1041"></td><td id="1042"></td><td id="1043"></td><td id="1044"></td><td id="1045"></td><td id="1046"></td><td id="1047"></td></tr>
	<tr><td id="1048"></td><td id="1049"></td><td id="1050"></td><td id="1051"></td><td id="1052"></td><td id="1053"></td><td id="1054"></td><td id="1055"></td></tr>
	<tr><td id="1056"></td><td id="1057"></td><td id="1058"></td><td id="1059"></td><td id="1060"></td><td id="1061"></td><td id="1062"></td><td id="1063"></td></tr>
	<tr><td id="1064"></td><td id="1065"></td><td id="1066"></td><td id="1067"></td><td id="1068"></td><td id="1069"></td><td id="1070"></td><td id="1071"></td></tr>
	<tr><td id="1072"></td><td id="1073"></td><td id="1074"></td><td id="1075"></td><td id="1076"></td><td id="1077"></td><td id="1078"></td><td id="1079"></td></tr>
	<tr><td id="1080"></td><td id="1081"></td><td id="1082"></td><td id="1083"></td><td id="1084"></td><td id="1085"></td><td id="1086"></td><td id="1087"></td></tr>
	<tr><td id="1088"></td><td id="1089"></td><td id="1090"></td><td id="1091"></td><td id="1092"></td><td id="1093"></td><td id="1094"></td><td id="1095"></td></tr>
	<tr><td id="1096"></td><td id="1097"></td><td id="1098"></td><td id="1099"></td><td id="1100"></td><td id="1101"></td><td id="1102"></td><td id="1103"></td></tr>
	<tr><td id="1104"></td><td id="1105"></td><td id="1106"></td><td id="1107"></td><td id="1108"></td><td id="1109"></td><td id="1110"></td><td id="1111"></td></tr>
	<tr><td id="1112"></td><td id="1113"></td><td id="1114"></td><td id="1115"></td><td id="1116"></td><td id="1117"></td><td id="1118"></td><td id="1119"></td></tr>
</table>
</td><td id="main_table_td2">
<table cellspacing="1" class="middle_table">
<tr><td id="shop_seller"></td></tr>
<tr><td id="middle_table_picture"></td></tr>
<tr><td id="js_output">Clique nos itens para comprar ou vender.</td></tr>
</table>
</td><td id="main_table_td3">
<table class="inventory0" cellspacing="0"><tr><td id="spec">
<table class="inventory1" cellspacing="0">
	<tr>
		<td><div class="transpdiv slot64"></div><div class="slot slot64 pet" id="70"></div></td>
		<td></td>
		<td><div class="transpdiv slot64"></div><div class="slot slot64 helm" id="71"></div></td>
		<td colspan="2"><div class="transpdiv slot98"></div><div class="slot slot98 wings" id="72"></div></td>
	</tr>
	<tr>
		<td><div class="transpdiv slot128"></div><div class="slot slot128 hand1" id="73"></div></td>
		<td class="td32"><div class="transpdiv slot32"></div><div class="slot slot32 necklace" id="74"></div></td>
		<td><div class="transpdiv slot128"></div><div class="slot slot128 armor" id="75"></div></td>
		<td></td>
		<td><div class="transpdiv slot128"></div><div class="slot slot128 hand2" id="76"></td>
	</tr>
	<tr>
		<td><div class="transpdiv slot64"></div><div class="slot slot64 gloves" id="77"></div></td>
		<td><div class="transpdiv slot32"></div><div class="slot slot32 ring1" id="78"></div></td>
		<td><div class="transpdiv slot64"></div><div class="slot slot64 pants" id="79"></div></td>
		<td><div class="transpdiv slot32"></div><div class="slot slot32 ring2" id="80"></div></td>
		<td><div class="transpdiv slot64"></div><div class="slot slot64 boots" id="81"></div></td>
	</tr>
</table>
</td></tr>
<tr><td>
<table class="inventory" cellspacing="1">
	<tr><td id="0"></td><td id="1"></td><td id="2"></td><td id="3"></td><td id="4"></td><td id="5"></td><td id="6"></td><td id="7"></td></tr>
	<tr><td id="8"></td><td id="9"></td><td id="10"></td><td id="11"></td><td id="12"></td><td id="13"></td><td id="14"></td><td id="15"></td></tr>
	<tr><td id="16"></td><td id="17"></td><td id="18"></td><td id="19"></td><td id="20"></td><td id="21"></td><td id="22"></td><td id="23"></td></tr>
	<tr><td id="24"></td><td id="25"></td><td id="26"></td><td id="27"></td><td id="28"></td><td id="29"></td><td id="30"></td><td id="31"></td></tr>
	<tr><td id="32"></td><td id="33"></td><td id="34"></td><td id="35"></td><td id="36"></td><td id="37"></td><td id="38"></td><td id="39"></td></tr>
	<tr><td id="40"></td><td id="41"></td><td id="42"></td><td id="43"></td><td id="44"></td><td id="45"></td><td id="46"></td><td id="47"></td></tr>
	<tr><td id="48"></td><td id="49"></td><td id="50"></td><td id="51"></td><td id="52"></td><td id="53"></td><td id="54"></td><td id="55"></td></tr>
	<tr><td id="56"></td><td id="57"></td><td id="58"></td><td id="59"></td><td id="60"></td><td id="61"></td><td id="62"></td><td id="63"></td></tr>
</table>
</td></tr>
<tr><td>
<table class="zen_table">
<tr><td >Ouro:</td><td id="zen_value">0</td></tr>
</table>
</td></tr>
</table>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
var player_class = <?php echo $player_class;?>;
var player_level = <?php echo $player_level;?>;;
var player_strength = <?php echo $player_strength;?>;
var player_agility = <?php echo $player_agility;?>;
var player_stamina = <?php echo $player_stamina;?>;
var player_energy = <?php echo $player_energy;?>;
var player_zen = <?php echo $player_zen;?>;
document.getElementById('zen_value').innerHTML = player_zen;
//passing php inventory array into javascript
var js_current_inventory = <?php echo $current_inventory; ?>;
var js_shop_inventory = <?php echo $shop_inventory ?>;
for(i=0; i<64; i++)
{
 if(js_current_inventory[i]!='0')
 {
  document.getElementById(i).className='occupied';
  if(js_current_inventory[i]!=1)
    document.getElementById(i).innerHTML = load_items(js_current_inventory[i], 2, player_level, player_class, player_strength, player_agility, player_energy);
 }
}
$('.slot').addClass('equip_cell');
//loading equipment
var js_current_equipment = <?php echo $current_equipment; ?>;
var js_array_70 = new Array();
 for(i=0; i<70; i++)
 {
  js_array_70[i]=0;
 }
js_current_equipment = js_array_70.concat(js_current_equipment);

for(i=70; i<82; i++)
{
 if(js_current_equipment[i]!='0')
 {
  $('#'+i).addClass('occupied');
$( document.getElementById(i).parentNode.childNodes[0] ).addClass('occupied');
  document.getElementById(i).innerHTML = load_items(js_current_equipment[i], 2, player_level, player_class, player_strength, player_agility, player_energy);
 }
}
if(js_current_equipment[70]!='0')
{
  var item_code = js_current_equipment[70];
  var item_size = Number(item_code.slice(2,4));
if(item_size == 11)
set_margin = 16;
else
set_margin = 0;
$('#70>img').css({
margin: set_margin
});
}
if(js_current_equipment[73]!='0')
{
  var item_code = js_current_equipment[73];
  var item_size = Number(item_code.slice(2,4));
if(item_size == 11 || item_size == 12 || item_size == 13 || item_size == 14)
set_margin = 16;
else
set_margin = 0;
$('#73>img').css({
marginLeft: set_margin
});
}
if(js_current_equipment[75]!='0')
{
  var item_code = js_current_equipment[75];
  var item_size = Number(item_code.slice(2,4));
if(item_size == 32 || item_size == 33)
set_margin = -16;
else
set_margin = 0;
$('#75>img').css({
marginLeft: set_margin
});
}
if(js_current_equipment[76]!='0')
{
  var item_code = js_current_equipment[76];
  var item_size = Number(item_code.slice(2,4));
if(item_size == 11 || item_size == 12 || item_size == 13 || item_size == 14)
set_margin = 16;
else
set_margin = 0;
$('#76>img').css({
marginLeft: set_margin
});
}
for(i=1000; i<1120; i++)
{
if(js_shop_inventory[i-1000]!=0)
  {
  document.getElementById(i).className='occupied';
  if(js_shop_inventory[i-1000]!=1)
    document.getElementById(i).innerHTML = load_items(js_shop_inventory[i-1000], 1, player_level, player_class, player_strength, player_agility, player_energy);
  }
}
 document.getElementById('middle_table_picture').innerHTML = '<img src="shop/' + js_shop_inventory[120] + '.gif"/>';
 document.getElementById('shop_name').innerHTML = js_shop_inventory[121];
 document.getElementById('shop_seller').innerHTML = js_shop_inventory[122];
$('.sell_shop').click(function(){buy_item(this);});
$('.sell_inv').click(function(){sell_item(this);});
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>