<?php
session_start();
include('player_stats.php');
$dirhandler = opendir('skills');
$skills = array();
while ($file = readdir($dirhandler)) {
 if ($file != '.' && $file != '..' && substr($file, 0, 1) == 's')
 {
	$file = substr($file, 5);
        $file = substr($file, 0,-4);
	array_push($skills, $file);               
 }   
}
sort($skills);
closedir($dirhandler);
$skills = json_encode($skills);
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
<script type="text/javascript" src="functions.skills.js"></script>
</head>
<body>
<div id="overDiv" style="position:absolute; text-align:center; visibility:hidden; z-index:1000; opacity:0.82; filter:alpha(opacity=82);"></div>
<table><tr><td>Skill Data:</td>
<td><a href="index.php">[ Voltar ]</a></td>
</tr></table>
<script type="text/javascript">
var js_skill_list = <?php echo $skills; ?>;
document.write('<table style="margin-left:40px;"><tr>');
for(i=0; i<js_skill_list.length; i++)
{
var num=i/16;
var x = parseFloat(num) - parseInt(num);
test = get_skill_description(js_skill_list[i]);
test = "('" + test + "',ADAPTIVE_WIDTH, 160,320,2)";
test = 'onmouseover="overlib' + test + '" onmouseout="nd()" ';
insert="<img height='28px' width='20px' id='skill"+js_skill_list[i]+"'" + test + "src='skills/skill" + js_skill_list[i] + ".gif'/>";
if(x == 0)
document.write('</tr><tr>');
document.write('<td style="vertical-align:top; width:60px; height:60px; padding: 4px; background: #c6c6c6;" id = "' + i + '"></td>');
document.getElementById(i).innerHTML = js_skill_list[i] + '<br/>' + insert;
}
document.write('</tr></table>');
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>