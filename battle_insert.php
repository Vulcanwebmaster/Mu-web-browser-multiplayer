<?php
session_start();
if(!isset($_GET['map']))
exit('error');
if(!file_exists('maps/'.$_GET['map'].'.xml'))
exit('Wrong map id.');
if(!isset($_GET['spot']))
exit('error');
include("database.php");
global $conn;
$spot = mysql_real_escape_string($_GET['spot']);
if(isset($_SESSION['player_stats']['spot']))
{
 if($_SESSION['player_stats']['spot'] != $spot)
 {
  unset($_SESSION['enemies']);
  unset($_SESSION['player_stats']);
 }
}
if(!isset($_SESSION['player_stats']))
{
//spot quota = 10
$char = $_SESSION['char_name'];
$query = "SELECT COUNT(*) FROM online WHERE location='$spot'";
$result1 = mysql_query($query, $conn) or trigger_error("SQL", E_USER_ERROR);
$r = mysql_fetch_row($result1);
$numrows = $r[0];
if($numrows > 9)
{
 echo '<script type="text/javascript">window.top.location.href = "ucp.php?action=spotfull";</script>';
 exit();
}
$set_player_stats = 1;
$calculate_potions = 1;
include('function.common.php');
include('player_stats.php');
include('calculate_stats.php');
//deleting old exp rates, if exist...
$char = $_SESSION['char_name'];
$query1 = "UPDATE online SET exp=0 WHERE char_name = '$char'";
if(!mysql_query($query1, $conn))
exit('online_error');
}
///////////////////////generating enemies/////////////////////////
if(!isset($_SESSION['enemies']))
{
$xml = simplexml_load_file('maps/'.$_GET['map'].'.xml');
//monster data
$monster_data = array();
foreach($xml as $value)
{
  if($value->getName() == 'monster')
  {
   $monster_tmp = (string)$value['name'];
   $monster_data[$monster_tmp] = array();
   foreach($value as $key)
   $monster_data[$monster_tmp][$key->getName()] = (string)$key;
  }
}
//encounters > info on each monster from monster data
$encounters = array();
foreach($xml as $value)
{
  if($value->getName() == 'spot' && $value['id'] == $spot)
  {
   foreach($value as $key)
   array_push($encounters, (string)$key);
  }
}
if(count($encounters)<1)
exit('Wring spot id');
$tmp = mt_rand(1,5);
$_SESSION['enemies'] = array();
for($i=0;$i<$tmp; $i++)
{
 $rand_enemy = mt_rand(0,count($encounters)-1);
 $_SESSION['enemies'][$i]['name'] = $encounters[$rand_enemy];
 $_SESSION['enemies'][$i]['level'] = $monster_data[$encounters[$rand_enemy]]['level'];
 $_SESSION['enemies'][$i]['hp'] = $monster_data[$encounters[$rand_enemy]]['hp'];
 $_SESSION['enemies'][$i]['hp_cur'] = $monster_data[$encounters[$rand_enemy]]['hp'];
 $_SESSION['enemies'][$i]['damage'] = $monster_data[$encounters[$rand_enemy]]['damage'];
 $_SESSION['enemies'][$i]['defense'] = $monster_data[$encounters[$rand_enemy]]['defense'];
 $_SESSION['enemies'][$i]['damage_rate'] = $monster_data[$encounters[$rand_enemy]]['damage_rate'];
 $_SESSION['enemies'][$i]['defense_rate'] = $monster_data[$encounters[$rand_enemy]]['defense_rate'];
 $_SESSION['enemies'][$i]['effect'] = 0;
 $_SESSION['enemies'][$i]['effect_duration'] = 0;
 $_SESSION['enemies'][$i]['item'] = 'no item';
}
$_SESSION['player_stats']['spot'] = $spot;
}
$monster_hp_array = array();
$monster_hp_array_cur = array();
for($i=0;$i<count($_SESSION['enemies']); $i++)
{
array_push($monster_hp_array,$_SESSION['enemies'][$i]['hp']);
array_push($monster_hp_array_cur,$_SESSION['enemies'][$i]['hp_cur']);
}
///////////////////////end generating enemies/////////////////////////
switch($_SESSION['player_stats']['player_class'])
{
 case 1:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/1.gif"/>';
$player_title = 'Dark Knight';
 break;
 case 2:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/2.gif"/>';
$player_title = 'Dark Wizard';
 break;
 case 3:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/3.gif"/>';
$player_title = 'Fairy Elf';
 break;
 case 4:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/4.gif"/>';
$player_title = 'Summoner';
 break;
 case 21:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/1.gif"/>';
$player_title = 'Blade Knight';
 break;
 case 22:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/2.gif"/>';
$player_title = 'Soul Master';
 break;
 case 23:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/3.gif"/>';
$player_title = 'Muse Elf';
 break;
 case 24:
$player_avatar = '<img class="battle_avatar" width="100px" height="100px" src="images/4.gif"/>';
$player_title = 'Bloody Summoner';
 break;
}
$player_hp_final = $_SESSION['player_stats']['player_hp_final'];
if($_SESSION['player_stats']['effect'] == '23')
{
 $hp_raise = 0; //greater fortitude
 $hp_raise = floor($_SESSION['player_stats']['player_hp_final']*floor(12 + $_SESSION['player_stats']['player_energy']/20)/100);
 $player_hp_final += $hp_raise;
}
if($_SESSION['player_stats']['player_hp_cur']>$player_hp_final)
$_SESSION['player_stats']['player_hp_cur'] = $player_hp_final; //fixing hp if greater fortitude ended...
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="battle.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.stats.js"></script>
<script type="text/javascript" src="functions.skills.js"></script>
</head>
<body style="background: #c6c6c6;">
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.80; filter:alpha(opacity=80);"></div>
<div class="target" id="player">
<table cellspacing="1" id="player_battle"><tr><td><?php echo $player_avatar;?></td><td>
<table cellscpaing="1" id="player_battle_ins"><tr><td id="battle_name"><?php echo substr($_SESSION['char_name'], 0, 9); ?></td></tr>
<tr><td id="battle_action">
<div id="player_action">
<?php
if(isset($_GET['action']))
{
 $player_skills_tmp = json_decode($_SESSION['player_stats']['player_skills']);
 if($_GET['action']=='potion_hp' || $_GET['action']=='potion_mp' || $_GET['action']=='antidote')
 {
  echo '<img height="28px" width="20px" src="skills/'.$_GET['action'].'.gif"/>';
  $cur_action = $_GET['action'];
 }
 else if($_GET['action']=='attack' || !in_array(substr($_GET['action'],5),$player_skills_tmp))
 {
  echo '<img height="28px" width="20px" src="skills/attack.gif"/>';
  $cur_action = 'attack';
 }
 else
 {
  echo '<img height="28px" width="20px" src="skills/'.$_GET['action'].'.gif"/>';
  $cur_action = $_GET['action'];
 }
}
else
{
echo '<img height="28px" width="20px" src="skills/attack.gif"/>';
$cur_action = 'attack';
}
?>
</div>
<div id="player_action_desc"><b>action</b><br/><?php echo $cur_action; ?></div>
</td>
</tr>
<tr><td id="battle_effects">
<?php
if($_SESSION['player_stats']['effect_duration']>0)
echo '<img height="28px" width="20px" src="skills/skill'.$_SESSION['player_stats']['effect'].'.gif"/>'.'&nbsp;'.$_SESSION['player_stats']['effect_duration'].' turns';
?>
</td></tr></table>
</td></tr></table></div>
<div id="battle_report">
<div id="battle_report_title"><b>Relatorio de batalha</b></div>
<div id="js_output">
<?php
if(isset($_SESSION['player_stats']['battle_report']))
echo $_SESSION['player_stats']['battle_report'];
else
echo 'ready';
?>
</div></div>
<?php
echo '<div id="turns"><b>TURNO</b><br/>'.$_SESSION['player_stats']['turns'].'</div>';
if(isset($_GET['note']))
 echo '<div id="note"><img width="58px" height="50px" src="images/level.gif"/></div>';
else if($_SESSION['player_stats']['player_hp_cur']<1)
 echo '<div id="note"><img width="58px" height="50px" src="images/defeat.gif"/></div>';
?>
<div id="enemies">
<?php
if(isset($_SESSION['enemies']))
{
$alive = 0;
 for($i=0; $i<count($_SESSION['enemies']); $i++)
 {
if(isset($_SESSION['enemies'][$i]['exp']))
{
echo '<div class="enemy" id="enemy'.$i.'"><div class="defeated_ins">';
echo '<div class="defeated_name">Derrotou '.$_SESSION['enemies'][$i]['name'].'</div>';
echo '<div class="defeated_exp">EXP: '.$_SESSION['enemies'][$i]['exp'].'</div>';
echo '<div class="defeated_exp">Ouro: '.$_SESSION['enemies'][$i]['zen'].'</div><br/>';
$item_tmp = $_SESSION['enemies'][$i]['item'];
if($item_tmp == 'no item' || $item_tmp == 'taken')
echo '<div class="defeated_no_item">['.$item_tmp.']</div>';
else
{
 $item_name = substr($_SESSION['enemies'][$i]['item'],57);
 echo '<div class="defeated_item"><blink><b><a href="#" onmouseout="nd()" id="'.$i.'" class="defeated_item_ins" name="'.$_SESSION['enemies'][$i]['item'].'">['.$item_name.']</b><blink></a></div>';
}
echo '</div></div>';
}
else
{
$alive += 1;
echo '<div class="target enemy" id="enemy'.$i.'"><table cellspacing="0" class="enemy_ins"><tr><td class="enemy_avatar">';
echo '<img src="monsters/'.$_SESSION['enemies'][$i]['name'].'.gif" width="64px" height="64px"/>';
echo '</td><td class="enemy_legend"><div class="enemy_name">';
if($_SESSION['enemies'][$i]['effect_duration']>0)
echo '<div class="enemy_effect"><img height="28px" width="20px" src="skills/skill'.$_SESSION['enemies'][$i]['effect'].'.gif"/><div class="enemy_effect_desc">'.$_SESSION['enemies'][$i]['effect_duration'].'</div></div>';
echo $_SESSION['enemies'][$i]['name'].'<br/>hp: '.$_SESSION['enemies'][$i]['hp_cur'].'/'.$_SESSION['enemies'][$i]['hp'];
echo '</div><div class="enemy_health"></div></td></tr></table></div>';
}
 }
if($alive<1)
echo '<div id="enemy_buttons"><button type="button" id="save_cont">Salvar/Next</button>&nbsp;<button type="button" id="save_exit">Salvar/Sair</button></div>';
}
?>
</div>
<div id="newui">
<table id="newui_table" cellspacing="0"><tr><td class="potion">
<?php
$battle_hp_potions = $_SESSION['player_stats']['battle_hp_potions_elite']+$_SESSION['player_stats']['battle_hp_potions_large']+$_SESSION['player_stats']['battle_hp_potions_medium']+$_SESSION['player_stats']['battle_hp_potions_small']+$_SESSION['player_stats']['battle_hp_potions_apple'];
if($battle_hp_potions>0)
echo '<div id="potion_hp_desc">'.$battle_hp_potions.'</div><img  id="potion_hp" class="action" onmouseover="overlib(\'<br/>HP Potion<br/><br/>\', ADAPTIVE_WIDTH, 140,320,2, FRAME, parent, OFFSETX, 100)" onmouseout="nd()" src="skills/potion_hp.gif"/>';
?>
</td><td class="potion">
<?php
$battle_mp_potions = $_SESSION['player_stats']['battle_mp_potions_elite']+$_SESSION['player_stats']['battle_mp_potions_large']+$_SESSION['player_stats']['battle_mp_potions_medium']+$_SESSION['player_stats']['battle_mp_potions_small'];
if($battle_mp_potions>0)
echo '<div id="potion_mp_desc">'.$battle_mp_potions.'</div><img  id="potion_mp" class="action" onmouseover="overlib(\'<br/>MP Potion<br/><br/>\', ADAPTIVE_WIDTH, 140,320,2, FRAME, parent, OFFSETX, 100)" onmouseout="nd()" src="skills/potion_mp.gif"/>';
?>
</td><td class="potion">
<?php
if($_SESSION['player_stats']['battle_antidotes']>0)
echo '<div id="antidote_desc">'.$_SESSION['player_stats']['battle_antidotes'].'</div><img  id="antidote" class="action" onmouseover="overlib(\'<br/>Antidote<br/><br/>\', ADAPTIVE_WIDTH, 140,320,2)" onmouseout="nd()" src="skills/antidote.gif"/>';
?>
</td><td id="separator">
</td><td>
<div id="hp_gui_desc"></div>
<div id="hp_gui"></div>
</td><td>
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
</td><td>
<div id="mp_gui_desc"></div>
<div id="mp_gui"></div>
</td>
<td><div class="action_cont">
<img height='28px' width='20px' id="attack" class="action" onmouseover="overlib('<br/>Regular Attack<br/><br/>', ADAPTIVE_WIDTH, 140,320,2)" onmouseout="nd()" src="skills/attack.gif"/>
</div></td>
<td><div id="arrows_desc">
<?php
if($_SESSION['player_stats']['arrows']!=-10)
{
if($_SESSION['player_stats']['arrows']<0)
$_SESSION['player_stats']['arrows'] = 0;
echo 'arrows '.$_SESSION['player_stats']['arrows'];
}
?>
</div></td>
</tr></table>
<table class="exp_table" cellspacing="0"><tr><td><div id="exp_bars"></div></td>
<td><div id="exp_numb"></div></td></tr></table>
</div>
<script type="text/javascript">
if(top.location == self.location)
top.location.replace("map.php");
$(document).ready(function(){
 top.update_timer();
});
var click_block = 0;
var active_action = "<?php echo $cur_action; ?>";
var player_class = <?php echo $_SESSION['player_stats']['player_class'];?>;
var player_level = <?php echo $_SESSION['player_stats']['player_level'];?>;
var player_strength = <?php echo $_SESSION['player_stats']['player_strength'];?>;
var player_agility = <?php echo $_SESSION['player_stats']['player_agility'];?>;
var player_energy = <?php echo $_SESSION['player_stats']['player_energy'];?>;
var player_exp_cur = <?php echo $_SESSION['player_stats']['player_exp_cur'];?>;
var player_exp_next = (player_level+9)*player_level*player_level;
var prev_level = player_level-1;
var player_exp_prev = (prev_level+9)*prev_level*prev_level;
var player_hp_cur = <?php echo $_SESSION['player_stats']['player_hp_cur'];?>;
var player_hp_final = <?php echo $player_hp_final; ?>;
var player_mp_cur = <?php echo $_SESSION['player_stats']['player_mp_cur'];?>;
var player_mp_final = <?php echo $_SESSION['player_stats']['player_mp_final'];?>;
var battle_hp_potions = <?php echo $battle_hp_potions;?>;
var battle_mp_potions = <?php echo $battle_mp_potions;?>;
var battle_antidotes = <?php echo $_SESSION['player_stats']['battle_antidotes'];?>;
var monster_hp_array = <?php echo json_encode($monster_hp_array); ?>;
var monster_hp_array_cur = <?php echo json_encode($monster_hp_array_cur); ?>;
////////////////////////skills/////////////////////////
var js_current_skills = <?php echo $_SESSION['player_stats']['player_skills']; ?>;
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
////////////////////////skills end/////////////////////////
$('.target').append('<img class="pointer" src="images/active3.gif" width="10px" height="16px"/><img class="pointer1" src="images/active2.gif" width="10px" height="16px"/>');
$('.action').click(function(){
    active_action = this.id;
    $('#player_action').html('<img height="28px" width="20px" src="skills/'+active_action+'.gif"/>');
    $('#player_action_desc').html('<b>action</b><br/>'+active_action);
});
$('.target').hover(function(){
    $('.pointer').css({visibility: 'hidden'});
    $('.pointer1').css({visibility: 'hidden'});
    $(this).children('.pointer').css({visibility: 'visible'});
    $(this).children('.pointer1').css({visibility: 'visible'});
},
  function () { 
    $('.pointer').css({visibility: 'hidden'});
    $('.pointer1').css({visibility: 'hidden'});
  }
);
var map = "<?php echo $_GET['map']; ?>";
var spot = "<?php echo $_GET['spot']; ?>";
$('.target').click(function(){
if(click_block!=1)
{//prevent multiple clicks
active_target = this.id;
click_block = 1;
window.location = "battle_click.php?action=" + active_action + "&target=" + active_target + "&map=" + map + "&spot=" + spot + "&rand=" + Math.random();
}
});
$('#save_cont').click(function(){
 window.location = "battle_save.php?save=save&action=" + active_action + "&map=" + map + "&spot=" + spot + "&rand=" + Math.random();
});
$('#save_exit').click(function(){
 window.location = "battle_save.php?save=exit&action=" + active_action + "&map=" + map + "&spot=" + spot + "&rand=" + Math.random();
});
////////////////experience///////////////////////
var exp_span = (player_exp_next - player_exp_prev)/5400;
var exp_span2 = player_exp_cur - player_exp_prev;
var exp_span3 = Math.floor(exp_span2/exp_span);
if(exp_span3==0)
{
 $('#exp_bars').css({backgroundPosition: '-540px 0px'});
 $('#exp_numb').html('0');
}
if(exp_span3>0 && exp_span3<540)
{
 $('#exp_bars').css({backgroundPosition: (540-exp_span3)*-1+'px 0px'});
 $('#exp_numb').html('0');
}
if(exp_span3>=540)
{
 exp_span3_2 = exp_span3%540;//quotient to set in the current exp bar
 exp_span3_2 = exp_span3%540;//quotient to set in the current exp bar
 $('#exp_bars').css({backgroundPosition: (540-exp_span3_2)*-1+'px 0px'});
 $('#exp_numb').html(Math.floor(exp_span3/540));
}
////////////////experience end///////////////////////
///////////////adjusting player health bars///////////////////////
var hp_for_gui = 39-Math.floor(39*player_hp_cur/player_hp_final);
$('#hp_gui').css({
top: hp_for_gui,
backgroundPosition: '0px '+(hp_for_gui*-1) + 'px'
});
var mp_for_gui = 39-Math.floor(39*player_mp_cur/player_mp_final);
$('#mp_gui').css({
top: mp_for_gui,
backgroundPosition: '0px '+(mp_for_gui*-1) + 'px'
});
$('#hp_gui_desc').text(player_hp_cur + '/' + player_hp_final);
$('#mp_gui_desc').text(player_mp_cur + '/' + player_mp_final);
////////////////adjusting player health bars end///////////////////////
////////////////adjusting enemy health bars + item overlib///////////////////////
function adding_confirmed(r, item_id) {
 if(r)
 {
if (window.ActiveXObject)
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
else
  xmlhttp=new XMLHttpRequest();

 xmlhttp.onreadystatechange=function()
  {
if(xmlhttp.readyState==4 && xmlhttp.status>400)
{
 $('#js_output').text('Server error');
}
else if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 if(xmlhttp.responseText!='ok')
 {
if(xmlhttp.responseText=="no_space")
$('#js_output').text('Sem espaco no seu inventario');
else
$('#js_output').text('Inventario cheio');
}
else
{
$('#js_output').text('O item foi adicionado ao inventario');
$('#'+item_id).parent().html('[Pegou o item]');
}
    }
  }
xmlhttp.open("GET","function.pick_item.php?id=" + item_id + "&rand=" + Math.random(),true);
xmlhttp.send();
 }
}
for(i=0; i<monster_hp_array.length; i++)
{
 if(monster_hp_array[i]!=monster_hp_array_cur[i])
 {
  var enemy_hp_tmp = 164-Math.floor(164*monster_hp_array_cur[i]/monster_hp_array[i]);
  $('#enemy'+i+' .enemy_health').css({
  backgroundPosition: (enemy_hp_tmp*-1) + 'px '+ '0px'
  });
 }
}
$('.defeated_item_ins').mouseover(function() {
  var desc = load_items(this.name, 6, player_level, player_class, player_strength, player_agility, player_energy);
  desc = desc.replace(/&quot;/g,'"');
  overlib(desc,ADAPTIVE_WIDTH, 180,320,2);
});
$('.defeated_item_ins').click(function(){
 nd();
 item_id = this.id;
 jConfirm('Adicionar esse item ao seu inventario?', 'Confirm Adding', function(r) {adding_confirmed(r, item_id);});
});
////////////////adjusting enemy health bars + item overlib end///////////////////////
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>