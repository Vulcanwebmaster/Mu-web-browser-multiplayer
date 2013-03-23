<?php
session_start();
include('function.login.php');
include('player_stats.php');
$query = "SELECT vault FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_vault = $dbarray['vault'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script src="jquery.drag.drop.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.inventory.js"></script>
<script type="text/javascript" src="inventory.init.js"></script>
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
<table class="vault" cellspacing="1">
	<tr><td colspan="8" id="vault_name">ARMAZEM</td></tr>
	<tr><td id="100"></td><td id="101"></td><td id="102"></td><td id="103"></td><td id="104"></td><td id="105"></td><td id="106"></td><td id="107"></td></tr>
	<tr><td id="108"></td><td id="109"></td><td id="110"></td><td id="111"></td><td id="112"></td><td id="113"></td><td id="114"></td><td id="115"></td></tr>
	<tr><td id="116"></td><td id="117"></td><td id="118"></td><td id="119"></td><td id="120"></td><td id="121"></td><td id="122"></td><td id="123"></td></tr>
	<tr><td id="124"></td><td id="125"></td><td id="126"></td><td id="127"></td><td id="128"></td><td id="129"></td><td id="130"></td><td id="131"></td></tr>
	<tr><td id="132"></td><td id="133"></td><td id="134"></td><td id="135"></td><td id="136"></td><td id="137"></td><td id="138"></td><td id="139"></td></tr>
	<tr><td id="140"></td><td id="141"></td><td id="142"></td><td id="143"></td><td id="144"></td><td id="145"></td><td id="146"></td><td id="147"></td></tr>
	<tr><td id="148"></td><td id="149"></td><td id="150"></td><td id="151"></td><td id="152"></td><td id="153"></td><td id="154"></td><td id="155"></td></tr>
	<tr><td id="156"></td><td id="157"></td><td id="158"></td><td id="159"></td><td id="160"></td><td id="161"></td><td id="162"></td><td id="163"></td></tr>
	<tr><td id="164"></td><td id="165"></td><td id="166"></td><td id="167"></td><td id="168"></td><td id="169"></td><td id="170"></td><td id="171"></td></tr>
	<tr><td id="172"></td><td id="173"></td><td id="174"></td><td id="175"></td><td id="176"></td><td id="177"></td><td id="178"></td><td id="179"></td></tr>
	<tr><td id="180"></td><td id="181"></td><td id="182"></td><td id="183"></td><td id="184"></td><td id="185"></td><td id="186"></td><td id="187"></td></tr>
	<tr><td id="188"></td><td id="189"></td><td id="190"></td><td id="191"></td><td id="192"></td><td id="193"></td><td id="194"></td><td id="195"></td></tr>
	<tr><td id="196"></td><td id="197"></td><td id="198"></td><td id="199"></td><td id="200"></td><td id="201"></td><td id="202"></td><td id="203"></td></tr>
	<tr><td id="204"></td><td id="205"></td><td id="206"></td><td id="207"></td><td id="208"></td><td id="209"></td><td id="210"></td><td id="211"></td></tr>
	<tr><td id="212"></td><td id="213"></td><td id="214"></td><td id="215"></td><td id="216"></td><td id="217"></td><td id="218"></td><td id="219"></td></tr>
</table>
</td><td id="main_table_td2">
<table cellspacing="1" class="middle_table">
<tr><td>Baz o Guarda do armazem</td></tr>
<tr><td id="middle_table_picture"><img src="images/vault.gif"/></td></tr>
<tr><td id="js_output">Arraste e solte os itens para mover.</td></tr>
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
<tr><td >Zen:</td><td id="zen_value">0</td></tr>
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
$('#zen_value').html(player_zen);
//passing php inventory array into javascript
var js_current_inventory = <?php echo $current_inventory; ?>;
var js_current_vault = <?php echo $current_vault ?>;
var js_array_100 = new Array();
 for(i=0; i<100; i++)
 {
  js_array_100[i]=0;
 }
js_current_vault = js_array_100.concat(js_current_vault);
for(i=0; i<64; i++)
{
  $('#'+i).addClass('inv_cell');
 if(js_current_inventory[i]!='0')
 {
  $('#'+i).addClass('occupied');
  if(js_current_inventory[i]!='1')
  document.getElementById(i).innerHTML = load_items(js_current_inventory[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
 }
}
jewel_drop_ini();
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
  document.getElementById(i).innerHTML = load_items(js_current_equipment[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
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
for(i=100; i<220; i++)
{
if(js_current_vault[i]=='0')
 {
  $('#'+i).addClass('inv_cell');
 }
 else
  {
  $('#'+i).addClass('occupied');
  $('#'+i).addClass('inv_cell');
  if(js_current_vault[i]!=1)
    document.getElementById(i).innerHTML = load_items(js_current_vault[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
  }
}
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>