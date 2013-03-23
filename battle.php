<?php
session_start();
$in_battle = 1;
include('function.login.php');
if($_SESSION['char_id']=='0')
{
 header("Location: character.php");
 exit();
}
if(!isset($_GET['map']) || !isset($_GET['spot']))
exit('error');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="battle.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
<script type="text/javascript" src="functions.stats.js"></script>
<script type="text/javascript" src="functions.skills.js"></script>
<script type="text/javascript">
var stop_update =0;
var first_load = 0;
var char_name = "<?php echo $_SESSION['char_name']; ?>";
var timer = window.setTimeout(function(){stop_updating()},120000); //2 min of inactivity...
function stop_updating () {
  stop_update = 1;
  $('#players_list').html('...Player inativo...');
}
function update_timer() {
 if(first_load < 1)
 {
  first_load = 1;
  load_players();
 }
 if(stop_update == 1) //iframe clicked after inactivity, need to revive
 {
  stop_update =0;
  load_players();
 }
 window.clearTimeout(timer);
 timer = window.setTimeout(function(){stop_updating()},120000); //2 min of inactivity...
}
function load_players () {
 if(stop_update<1) //update only if player is actually clicking
 {
  $.post("function.online.php?listonline=true",function(data) {
  var exp_rate = data.substring(data.indexOf(":::") +3);
  data = data.substring(0,data.indexOf(":::"));
    $('#players_list').html(data);
    $('#spot_exp').html('Exp rate: ' + exp_rate + '%');
$(".call_cinfo_battle").click(function(){
var class_tmp = $(this).attr("rel");
if(class_tmp > 20)
class_tmp -=20;
$('#cinfo_avatar').html('<img src="images/'+class_tmp+'.gif" />');
$("#cinfo_title").html(this.id);
var tmp_id = this.id;
$("#fight_button").click(function(){
  $.post("function.pvp_request.php?char=" + tmp_id, function(data) {
   if(data == 'failed')
    $('#cinfo_info').html('[Invite PvP falhou]');
   else
    {
     $('#fade_bg').css('visibility', 'hidden');
     $("#cinfo").animate({bottom: '-200px' }, 200);

     $('#pvp_infobox').css('visibility', 'visible');
     $('#pvp_infobox_content').html(data);
    }
  });
});
$("#cinfo").animate({bottom: '300px' }, 200);
$('#fade_bg').css('visibility', 'visible');
return false;
});
  });
  setTimeout(function(){load_players()},7000);
 }
}
</script>
</head>
<body>
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.80; filter:alpha(opacity=80);"></div>
<table class = "parent_table" cellspacing="0">
<tr>
<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<div id="cinfo">
<div id="cinfo_title"></div>
<div id="cinfo_main">
<table id="cinfo_main_table" cellspacing="0"><tr><td><div id="cinfo_avatar"></div></td><td id="cinfo_info">
</td></tr></table>
</div>
<button type="button" id="close_button">Fechar</button>
</div>
<div id="fade_bg">&nbsp;</div>
<table class="main_table" cellspacing="2">
<tr><td class="map_td1">
<iframe name="iframe_battle" id="iframe_battle" src="battle_insert.php?map=<?php echo $_GET['map'];?>&spot=<?php echo $_GET['spot'];?>" frameborder="0" scrolling="no" marginheight"0px" marginwidth="0px">
<p>Your browser does not support iframes.</p>
</iframe>
</td><td class="map_td2">
<div id="spot_name"><?php echo ucfirst($_GET['map']) .' / '.$_GET['spot'];?></div>
<div id="spot_exp">Exp rate: <?php
if(isset($_SESSION['player_stats']['player_exp_percent']))
echo $_SESSION['player_stats']['player_exp_percent'].'%';
else
echo '100%';
?></div>
<div id="players_list"></div>
<script type="text/javascript">
$("#fade_bg, #close_button").click(function(){
$('#fade_bg').css('visibility', 'hidden');
$("#cinfo").animate({bottom: '-200px' }, 200);
return false;
});
</script>
</td></tr></table>
</div>
</td></tr></table>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</body>
</html>