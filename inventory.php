<?php
session_start();
include('function.login.php');
include('player_stats.php');
switch($player_class)
{
 case 1:
$player_avatar = '<img width="100px" height="100px" src="images/1.gif"/>';
$player_title = 'Dark Knight';
 break;
 case 2:
$player_avatar = '<img width="100px" height="100px" src="images/2.gif"/>';
$player_title = 'Dark Wizard';
 break;
 case 3:
$player_avatar = '<img width="100px" height="100px" src="images/3.gif"/>';
$player_title = 'Fairy Elf';
 break;
 case 4:
$player_avatar = '<img width="100px" height="100px" src="images/4.gif"/>';
$player_title = 'Summoner';
 break;
 case 21:
$player_avatar = '<img width="100px" height="100px" src="images/1.gif"/>';
$player_title = 'Blade Knight';
 break;
 case 22:
$player_avatar = '<img width="100px" height="100px" src="images/2.gif"/>';
$player_title = 'Soul Master';
 break;
 case 23:
$player_avatar = '<img width="100px" height="100px" src="images/3.gif"/>';
$player_title = 'Muse Elf';
 break;
 case 24:
$player_avatar = '<img width="100px" height="100px" src="images/4.gif"/>';
$player_title = 'Bloody Summoner';
 break;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="inventory.css" rel="stylesheet" type="text/css"/>
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script src="jquery.drag.drop.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.inventory.js"></script>
<script type="text/javascript" src="functions.stats.js"></script>
<script type="text/javascript" src="inventory.init.js"></script>
<script type="text/javascript" src="functions.skills.js"></script>
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
<table class="stats_table" cellspacing="1">
<tr><td id="stats1"><table id="stats1_1"><tr><td id="stats_avatar"><?php echo $player_avatar; ?></td><td>
<div id = "stats_title_ins">
<?php
echo '<br/>'.$player_name.'<br/>';
echo $player_title.'<br/>';
echo 'Nivel: '.$player_level;
?>
</div>
<div id="points_val"><?php echo 'Pontos: '.$player_points; ?></div>
</td></tr></table></td></tr>
<tr><td id="stats2"><table id="stats2_1"><tr><td colspan="3" id="stats2_0"></td></tr><tr><td id="stats2_2">EXP</td><td id="stats2_3"><div id="exp_bar"></div></td><td id="stats2_4">0</td></tr></table></td></tr>
<tr><td class="stats4"><table cellspacing="1" class="stats_row">
<tr><td class="stats_row1 stats_column1">Forca</td><td class="stats_row1"><div class="stats_row1_val" id="stats_strength"></div></td></tr>
<tr><td class="stats_column1">Dano</td><td id="stats_damage"></td></tr><tr>
<td class="stats_column1">Dano Rate</td><td id="stats_damage_rate"></td></tr>
</table></td></tr>
<tr><td class="stats3"></td></tr>
<tr><td class="stats4"><table cellspacing="1" class="stats_row">
<tr><td class="stats_row1 stats_column1">Agilidade</td><td class="stats_row1"><div class="stats_row1_val" id="stats_agility"></div></td></tr>
<tr><td class="stats_column1">Defesa</td><td id="stats_defense"></td></tr>
<tr><td class="stats_column1">Defesa Rate</td><td id="stats_defense_rate"></td></tr>
</table></td></tr>
<tr><td class="stats3"></td></tr>
<tr><td class="stats4"><table cellspacing="1" class="stats_row">
<tr><td class="stats_row1 stats_column1">Stamina</td><td class="stats_row1"><div class="stats_row1_val" id="stats_stamina"></div></td></tr>
<tr><td class="stats_column1">HP</td><td id="stats_hp"></td></tr>
<tr><td class="stats_column1">Dano Absorb</td><td id="stats_damage_absorb"></td></tr>
</table></td></tr>
<tr><td class="stats3"></td></tr>
<tr><td class="stats45"><table cellspacing="1" class="stats_row">
<tr><td class="stats_row1 stats_column1">Magia</td><td class="stats_row1"><div class="stats_row1_val" id="stats_energy"></div></td></tr>
<tr><td class="stats_column1">MP</td><td id="stats_mp"></td></tr>
<tr><td class="stats_column1" id="wiz_damage"></td><td id="stats_wiz_damage"></td></tr>
<tr><td class="stats_column1" id="staff_rise"></td><td id="stats_staff_rise"></td></tr>
</table></td></tr>
<tr><td></td></tr>
</table>
</td><td id="main_table_td2">
<table cellspacing="1" class="drop_table">
<tr><td>Inventario/Status</td></tr>
<tr><td class="drop_middle"></td></tr>
<tr><td id="js_output">Arrastar e solte os itens para equipar.</td></tr>
</table>
<table cellspacing="1" class="effects_table">
<tr><td id="skills_title">Skills (0)</td></tr>
<tr><td class="effects_middle" id="skills">
<table class="skills_table" cellspacing="0"><tr><td>
<div class="paging paging_left">
<a href="#" rel="prev"></a>
</div>
</td><td>
<div class="main_view">
<div class="window">
<div class="image_reel">
</div>
</div>
</div>
</td><td>
<div class="paging paging_right">
<a href="#" rel="next"></a>
</div>
</td></tr></table>
</td></tr>
<tr><td>Lista de skills disponiveis</td></tr>
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
var player_class = <?php echo $player_class;?>;
var player_level = <?php echo $player_level;?>;;
var player_points = <?php echo $player_points;?>;
var player_exp_cur = <?php echo $player_experience;?>;
var player_exp_next = (player_level+9)*player_level*player_level;
var prev_level = player_level-1;
var player_exp_prev = (prev_level+9)*prev_level*prev_level;
var player_strength = <?php echo $player_strength;?>;
var player_agility = <?php echo $player_agility;?>;
var player_stamina = <?php echo $player_stamina;?>;
var player_hp_cur = <?php echo $player_hp_cur;?>;
var player_energy = <?php echo $player_energy;?>;
var player_mp_cur = <?php echo $player_mp_cur;?>;
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
////////////////experience///////////////////////
document.getElementById('stats2_0').innerHTML = player_exp_cur + ' / ' + player_exp_next;
var exp_span = (player_exp_next - player_exp_prev)/2000;
var exp_span2 = player_exp_cur - player_exp_prev;
var exp_span3 = Math.floor(exp_span2/exp_span);
if(exp_span3==0)
{
 $('#exp_bar').css({backgroundPosition: '-200px 0px'});
 $('#stats2_4').html('0');
}
if(exp_span3>0 && exp_span3<200)
{
 $('#exp_bar').css({backgroundPosition: (200-exp_span3)*-1+'px 0px'});
 $('#stats2_4').html('0');
}
if(exp_span3>=200)
{
 exp_span3_2 = exp_span3%200;//quotient to set in the current exp bar
 $('#exp_bar').css({backgroundPosition: (200-exp_span3_2)*-1+'px 0px'});
 $('#stats2_4').html(Math.floor(exp_span3/200));
}
////////////////experience end///////////////////////
stats_init();
 $('#stats_strength').html(player_strength);
 $('#stats_agility').html(player_agility);
 $('#stats_stamina').html(player_stamina);
 $('#stats_energy').html(player_energy);
 $('#stats_damage_rate').html(player_damage_rate);
//////////////////////points/////////////////////////////
if(player_points>0)
{
add_button = new Image();
add_button1 = new Image();
add_button.src = 'images/add.gif';
add_button1.src = 'images/add1.gif';
$('#stats_strength').after('<img id="strength" class="add_stats" src="images/add.gif" onmouseout="nd()"/>');
$('#stats_agility').after('<img id="agility" class="add_stats" src="images/add.gif" onmouseout="nd()"/>');
$('#stats_stamina').after('<img id="stamina" class="add_stats" src="images/add.gif" onmouseout="nd()"/>');
$('#stats_energy').after('<img id="energy" class="add_stats" src="images/add.gif" onmouseout="nd()"/>');
$('.add_stats').mouseover(function() {
  overlib('add ' + this.id, ABOVE, OFFSETX, -60, ADAPTIVE_WIDTH, 100,320,2);
});
$('.add_stats').mousedown(function(){
nd();
 if(player_points>0)
 {
 add_points(this.id);
 this.src = add_button1.src;
 }
});
}
//////////////////////points end/////////////////////////////
update_stats ();
////////////////////////skills/////////////////////////
var current_skills = <?php echo $current_skills; ?>;
js_current_skills = equipment_skills.concat(current_skills);
$('#skills_title').text('Skills (' + js_current_skills.length + ')');
for(i=0; i<js_current_skills.length; i++)
{
test = get_skill_description(js_current_skills[i]);
test = "('" + test + "',ADAPTIVE_WIDTH, 160,320,2)";
test = 'onmouseover="overlib' + test + '" onmouseout="nd()" ';
insert="<div class='action_cont'><img height='28px' width='20px' class='action' id='skill"+js_current_skills[i]+"'" + test + "src='skills/skill" + js_current_skills[i] + ".gif'/></div>";
$('.image_reel').append(insert);
}
var first_image = 1;
var image_reelPosition = 0;
rotate = function(){
if($active.attr("rel") == 'next' && js_current_skills.length > 6 && (first_image + 5) < js_current_skills.length)
{
 if((first_image + 8) <= js_current_skills.length)
 {
   image_reelPosition +=96;
   first_image +=3;
 }
 else
 {
   image_reelPosition +=32;
   first_image +=1;
 }
}
else if($active.attr("rel") == 'prev' && first_image>1)
{
 if(first_image>3)
 {
   first_image -=3;
   image_reelPosition -=96;
 }
 else
 {
   first_image -=1;
   image_reelPosition -=32;
 }
}
    $(".image_reel").animate({
        left: -image_reelPosition
    }, 300 );
}
//Show the paging and activate its first link
var imageWidth = $(".window").width()/6;
var imageSum = $(".image_reel img").size() + 1;
var imageReelWidth = imageWidth * imageSum;
//Adjust the image reel to its new size
$(".image_reel").css({'width' : imageReelWidth});
//On Click
$(".paging a").click(function() {
    $active = $(this); //Activate the clicked paging
    rotate(); //Trigger rotation immediately
    return false; //Prevent browser jump to link anchor
});
////////////////////////skills/////////////////////////
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>