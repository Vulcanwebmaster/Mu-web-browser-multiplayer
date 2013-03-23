<?php
session_start();
include('function.login.php');
if($_SESSION['char_id']=='0')
{
 header("Location: character.php");
 exit();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="map.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
<script src="jquery.alerts.js" type="text/javascript"></script>
<script type="text/javascript" src="overlib.js"></script>
<script type="text/javascript" src="functions.overlib.js"></script>
<script type="text/javascript" src="functions.common.js"></script>
</head>
<body>
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.80; filter:alpha(opacity=80);"></div>
<table class = "parent_table" cellspacing="0">
<tr>
<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<table class="main_table" cellspacing="2">
<tr><td class="map_td1">
<div class="map_container"><img src="maps/main.jpg" width="572px" height="572px" id="current_map"></img>
<div class="map_point" id="lorencia" onmouseout="nd()"></div>
<div class="map_point" id="noria" onmouseout="nd()"></div>
<div class="map_point" id="elbeland" onmouseout="nd()"></div>
<div class="map_point" id="dungeon" onmouseout="nd()"></div>
<div class="map_point" id="devias" onmouseout="nd()"></div>
<div id="map_return"><a href="#">Voltar ao Continente</a></div>
</div>
</td><td class="map_td2">
<div id="map_name">Continente de Mu</div>
<br>
<br><b>
<center><div style="padding-bottom:0px; border-bottom:0px dashed #3BC;">Est&aacute; come&ccedil;ando agora?</div><br>
<div style="padding-bottom:0px; border-bottom:0px dashed #3BC;">1-Compre uma arma <a href="shop.php?id=lorencia2">Clique aqui</a></link></div>
<div style="padding-bottom:0px; border-bottom:0px dashed #3BC;">2-Para iniciar experimente<br>"Lorencia - Spot 1"</div></center>
</div><b>
<div id="map_spot_div">
<div id="map_spot_pic"><img src="maps/map_spot.jpg" /></div>
<div id="enter_spot"><div id="enter_spot_button">Entrar</div></div>
</div>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
lorencia_img = new Image(572,572);
lorencia_img.src="maps/lorencia.jpg";
noria_img = new Image(572,572);
noria_img.src="maps/noria.jpg";
elbeland_img = new Image(572,572);
elbeland_img.src="maps/elbeland.jpg";
dungeon_img = new Image(572,572);
dungeon_img.src="maps/dungeon.jpg";
devias_img = new Image(572,572);
devias_img.src="maps/devias.jpg";
new_left = 0;
new_top = 0;
var new_url = '';
$('#enter_spot_button').click(function(){
  window.location = new_url;
});
function spot_quota (check_spot) {
  $.post("function.spot_quota.php?spot=" + check_spot,function(data) {
   $('#map_spot_chars').html(data + '/10');
  });
}
//loading new map spots, npc
function load_map_elements(map_name){
 var new_array = new Array();
$('#map_return').css({
visibility: 'visible'
});
var cap_name = map_name.charAt(0).toUpperCase() + map_name.slice(1);
$('#map_name').text(cap_name);
if (window.ActiveXObject)
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
else
  xmlhttp=new XMLHttpRequest();
var new_path = 'maps/' + map_name + '.xml';
xmlhttp.open("GET", new_path + "?rand=" + Math.random(),false);
xmlhttp.send();
xmlDoc=xmlhttp.responseXML;
$(xmlDoc).find('spot').each(function(){
var spot_id = $(this).attr('id');
var spot_x = $(this).attr('x')+'px';
var spot_y = $(this).attr('y')+'px';
//loading encounters
tmp_array = [];
$(this).find('encounter').each(function(){
tmp_array.push($(this).text());
});
//loading encounters end;
new_array[spot_id] = tmp_array;
$('.map_container').append('<div class="map_spot" id="'+ spot_id +'" onmouseout="nd()"></div>');
$('#'+spot_id).css({
left: spot_x,
top: spot_y
});
});
$('.map_spot').mouseover(function() {
  var spot_name = this.id.slice(0,4) + ' ' + this.id.slice(4);
  overlib(spot_name, ABOVE, OFFSETX, -60, ADAPTIVE_WIDTH, 100,320,2);
});
$('.map_spot').click(function() {
 var spot_name = this.id.slice(0,4) + ' ' + this.id.slice(4);
 $('#map_name').text(cap_name + ' / ' + spot_name);
 $('#map_spot_pic>img').attr('src', 'maps/'+this.id+'.jpg');
if (!$('#map_spot_enc').length)
{
 $('#enter_spot').before('<div id="map_spot_chars">...</div><div id="map_spot_enc">Possivelmente vai encontrar</div><div id="map_spot_enc_legend"></div>');
}
else
$('.enc_monster').remove();
 var enc_data = new Array();
 var enc_data = new_array[this.id];
 for(i=0; i<enc_data.length; i++)
 {
  $('#map_spot_enc_legend').append('<img src="monsters/'+enc_data[i]+'.gif" id="'+enc_data[i]+'" class="enc_monster" width="64px" height="64px" onmouseout="nd()"/>');
 }
$('.enc_monster').mouseover(function() {
//monster name > capitalize and remove underscores
        newVal = '';
        monster_name = this.id.split('_');
        for(var c=0; c < monster_name.length; c++) {
                newVal += monster_name[c].substring(0,1).toUpperCase() +
monster_name[c].substring(1, monster_name[c].length) + ' ';
        }
        monster_name = newVal;
  overlib(monster_name, ABOVE, OFFSETX, -60, ADAPTIVE_WIDTH, 100,320,2);
});
spot_quota(this.id);
new_url = 'battle.php?map=' + map_name + '&spot=' + this.id;
$('#map_spot_div').css({visibility: 'visible'});
});
$(xmlDoc).find('npc').each(function(){
var npc_id = $(this).attr('id');
var npc_type = $(this).attr('type');
var npc_url = $(this).text();
new_array[npc_id] = npc_url;
var npc_x = $(this).attr('x')+'px';
var npc_y = $(this).attr('y')+'px';
$('.map_container').append('<div class="map_npc" id="'+ npc_id +'" onmouseout="nd()">'+ npc_type +'</div>');
$('#'+npc_id).css({
left: npc_x,
top: npc_y
});
});
$('.map_npc').mouseover(function() {
  overlib('seller: '+this.id, ABOVE, OFFSETX, -60, ADAPTIVE_WIDTH, 100,320,2);
});
$('.map_npc').click(function() {
  var npc_cap_name = this.id;
  npc_cap_name = npc_cap_name.charAt(0).toUpperCase() + npc_cap_name.slice(1);
  var cap_name = map_name.charAt(0).toUpperCase() + map_name.slice(1);
 $('#map_name').text(cap_name + ' / ' + npc_cap_name);
 $('#map_spot_pic>img').attr('src', 'maps/'+this.id+'.jpg');
if ($('#map_spot_enc').length)
{
 $('#map_spot_chars').remove();
 $('#map_spot_enc').remove();
 $('#map_spot_enc_legend').remove();
}
new_url = new_array[this.id];//loading url location of npc to visit
$('#map_spot_div').css({visibility: 'visible'});
});
}
//loading new map
function load_new_map(id, map_name, new_left, new_top){
if(id == map_name)
{
var new_name = eval(map_name + '_img.src');
$('.map_container').append('<img class="new_map" src='+new_name+' />');
$('.new_map').css({
left: new_left,
top: new_top,
width: '26px',
height: '26px',
opacity: '0.20'
});
$('.new_map').animate({
left: '0px',
top: '0px',
height: '572px',
width: '572px',
opacity: '1'
},800, function(){
load_map_elements(map_name);
});
}
$('.new_map').click(function() {
 $('#map_spot_div').css({visibility: 'hidden'});
 var cap_name = map_name.charAt(0).toUpperCase() + map_name.slice(1);
 $('#map_name').text(cap_name);
});
}
map_zoomed = 0;
$('.map_point').mouseover(function() {
  if(map_zoomed!='1')
{
  var cap_name = this.id;
  cap_name = cap_name.charAt(0).toUpperCase() + cap_name.slice(1);
  overlib(cap_name, ABOVE, OFFSETX, -60, ADAPTIVE_WIDTH, 120,320,2);
}
});
$('.map_point').click(function() {
nd();
map_zoomed = 0;
new_left = $(this).position().left;
new_top = $(this).position().top;
var map_name = this.id;
  $('.map_point').fadeOut(300, function(){
load_new_map(this.id, map_name, new_left, new_top);
});
});
//returning to the main map
$('#map_return>a').click(function() {
$('#map_return').css({visibility: 'hidden'});
$('.map_spot').remove();
$('.map_npc').remove();
$('#map_spot_div').css({visibility: 'hidden'});
$('.new_map').animate({
left: new_left,
top: new_top,
height: '26px',
width: '26px',
opacity: '0.20'
},800, function(){
    map_zoomed = 0;
    $('.new_map').remove();
    $('#map_name').text('The Continent of Mu');
    $('.map_point').fadeTo(300, 0.52);
});
});
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>