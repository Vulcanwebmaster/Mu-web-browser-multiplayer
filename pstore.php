<?php
session_start();
include('function.login.php');
include('player_stats.php');
$query = "SELECT pstore_open, pstore FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$pstore_open = $dbarray[0];
$current_store = $dbarray[1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="pstore.css" rel="stylesheet" type="text/css"/>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.pstore.js"></script>
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
<div id="pstore_back"></div>
<div id="pstore_legend">Sua loja pessoal permite vender seus itens no mercado Livre. Os itens serao listados no mercado livre apos clicar no botão "Abrir".<br/>A abertura da loja custa 1,000 Ouro.</div>
<table cellspacing="1" class="npc32_table">
<tr><td id="title"><div id="title_ins">Minha loja</div></td></tr>
<tr><td id="npc32_separator"></td></tr>
<tr><td id="js_output">Clique nos itens para adicionar ou remover.</td></tr>
</table>
<div id="pstore_picture"><img src="images/lmarket.gif" width="250px" height="206px" /></div>
<table cellspacing="2" id="npc32_inventory">
<tr><td><div class="pstore_info"></div></td></tr>
<tr><td>
<table cellspacing="1" class="npc32_inventory">
<tr><td id="250"></td><td id="251"></td><td id="252"></td><td id="253"></td><td id="254"></td><td id="255"></td><td id="256"></td><td id="257"></td></tr>
<tr><td id="258"></td><td id="259"></td><td id="260"></td><td id="261"></td><td id="262"></td><td id="263"></td><td id="264"></td><td id="265"></td></tr>
<tr><td id="266"></td><td id="267"></td><td id="268"></td><td id="269"></td><td id="270"></td><td id="271"></td><td id="272"></td><td id="273"></td></tr>
<tr><td id="274"></td><td id="275"></td><td id="276"></td><td id="277"></td><td id="278"></td><td id="279"></td><td id="280"></td><td id="281"></td></tr>
</table>
</td></tr>
<tr><td><div class="pstore_buttons"><button type="button" id="open_button">Abrir</button>&nbsp;<button type="button" id="close_button">Fechar</button></div></td></tr>
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
<tr><td>Ouro:</td><td id="zen_value">0</td></tr>
</table>
</td></tr>
</table>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
var store_open = '<?php echo $pstore_open;?>';
if(store_open == 'error')
store_open = '0';
var player_class = <?php echo $player_class;?>;
var player_level = <?php echo $player_level;?>;;
var player_strength = <?php echo $player_strength;?>;
var player_agility = <?php echo $player_agility;?>;
var player_stamina = <?php echo $player_stamina;?>;
var player_energy = <?php echo $player_energy;?>;
var player_zen = <?php echo $player_zen;?>;
document.getElementById('zen_value').innerHTML = player_zen;
var js_current_inventory = <?php echo $current_inventory; ?>;
for(i=0; i<64; i++)
{
  $('#'+i).addClass('inv_cell');
 if(js_current_inventory[i]!='0')
 {
  $('#'+i).addClass('occupied');
  if(js_current_inventory[i]!='1')
  document.getElementById(i).innerHTML = load_items(js_current_inventory[i], 4, player_level, player_class, player_strength, player_agility, player_energy);
 }
}
$('.slot').addClass('equip_cell');
//loading equipment
var js_current_equipment = <?php echo $current_equipment; ?>;
var js_array_70 = new Array();;
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
  document.getElementById(i).innerHTML = load_items(js_current_equipment[i], 4, player_level, player_class, player_strength, player_agility, player_energy);
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
var js_current_store = <?php echo $current_store; ?>;
var js_array_250 = new Array();
 for(i=0; i<250; i++)
 {
  js_array_250[i]=0;
 }
js_current_store = js_array_250.concat(js_current_store);

for(i=250; i<282; i++)
{
if(js_current_store[i]=='0')
 {
  $('#'+i).addClass('inv_cell');
 }
 else
  {
  $('#'+i).addClass('occupied');
  $('#'+i).addClass('inv_cell');
  if(js_current_store[i]!=1)
    document.getElementById(i).innerHTML = load_items(js_current_store[i], 3, player_level, player_class, player_strength, player_agility, player_energy, js_current_store[i+32]);
  }
}
$('.store_to_inv').click(function(){store_to_inv(this, store_open);});
$('.inv_to_store').click(function(){inv_to_store(this, store_open);});
var count_items = 0;
 current_store_tmp = js_current_store.slice(250,282);
 for(i=0; i<current_store_tmp.length; i++)
 {
  if(current_store_tmp[i]!='0' && current_store_tmp[i]!='1')
  count_items +=1;
 }
if(store_open!='1')
 $('.pstore_info').text('Minha loja esta fechada (' + count_items + ')');
else
 $('.pstore_info').text('Minha loja esta aberta (' + count_items + ')');
$('#open_button').click(function(){
if(store_open!='1')
{
 if(count_items>0)
 {
  open_pstore();
 }
 else
 {
  jAlert('Adicione itens antes de abrir sua loja', 'Personal Store');
 }
}
else
 jAlert('A sua Loja ja esta aberta', 'Personal Store');

});
$('#close_button').click(function(){
if(store_open!='1')
 jAlert('A sua Loja ja esta fechada', 'Personal Store');
else
{
 close_pstore();
}
});
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>