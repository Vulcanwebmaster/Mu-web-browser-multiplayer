<?php
session_start();
$login_not_required = 1;
include('function.login.php');
if(isset($_GET['req_class']))
$req_class = $_GET['req_class'];
else
$req_class = 'all';
if($req_class!='all' && $req_class!='knight' && $req_class!='wizard' && $req_class!='elf' && $req_class!='summoner' && $req_class!='gladiator' && $req_class!='lord' && $req_class!='fighter')
exit('wrong_parameter');
if(isset($_GET['order_by']))
$order_by = $_GET['order_by'];
else
$order_by = 'experience';
if($order_by!='experience' && $order_by!='monsters')
exit('wrong_parameter');
$query = "SELECT * FROM characters"; //actual result
$sql = "SELECT COUNT(*) FROM characters"; //counting rows for pagination
if($req_class!='all')
{
 switch ($req_class)
 {
  case 'knight':
  $query_add_class = "class='1' OR class='21' OR class='10' OR class='11' OR class='15'";
  break;
  case 'wizard':
  $query_add_class = "class='2' OR class='22' OR class='10' OR class='12' OR class='13' OR class='14' OR class='16'";
  break;
  case 'elf':
  $query_add_class = "class='3' OR class='23' OR class='11' OR class='12'";
  break;
  case 'summoner':
  $query_add_class = "class='4' OR class='24' OR class='13' OR class='16'";
  break;
  case 'gladiator':
  $query_add_class = "class='5' OR class='14' OR class='15' OR class='16'";
  break;
  case 'lord':
  $query_add_class = "class='6'";
  break;
  case 'fighter':
  $query_add_class = "class='7'";
  break;
 }
if(isset($query_add))
{
 $query = $query." AND (".$query_add_class.")";
 $sql = $sql." AND (".$query_add_class.")";
}
else
{
 $query = $query." WHERE ".$query_add_class;
 $sql = $sql." WHERE ".$query_add_class;
}
}
//if($order_by!='experience')
$query = $query." ORDER BY $order_by DESC";
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
<div id="cinfo">
<div id="cinfo_title"></div>
<div id="cinfo_main">
<table id="cinfo_main_table" cellspacing="0"><tr><td><div id="cinfo_avatar"></div></td><td id="cinfo_info"></td></tr></table>
</div>
<button type="button" id="close_button">Fechar</button>
</div>
<div id="fade_bg">&nbsp;</div>
<table class="main_table" cellspacing="0">
<tr><td id="main_table_td2">
<table cellspacing="1" class="npc32_table">
<tr><td id="pstore_title">
<div id="pstore_title_ins">
<?php
if($req_class=='all')
$title = 'Ranking (global)';
else
$title = 'Ranking ('.$req_class.')';

if($order_by=='experience')
$title = $title.' '.'(experience)';
else
$title = $title.' '.'('.$order_by.')';
echo $title;
?>
</div>
</td></tr>
<tr><td>
<table class="market_table" cellspacing="0">
<tr class="market_head"><td class="m_id">Rank</td><td class="m_name">Nome</td><td class="m_experience">Experiencia</td><td class="m_monsters">Monstros</td></tr>
<?php
if(mysql_num_rows($result)>0)
{
$pos = 1;
while($row = mysql_fetch_assoc($result))
{
 echo "<tr><td>".($offset+$pos)."</td><td><a href='#' id='".$row['name']."' rel='".$row['class']."' class='call_cinfo'>".$row['name']."</a></td><td>".$row['experience']."</td><td>".$row['monsters']."</td></tr>";
 $pos++;
}
echo '</table>';
}
else
echo '</table><br/>Sem personagens';

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
//adding parameters
$link = "&req_class=".$req_class."&order_by=".$order_by;
// range of num links to show
$range = 2;
echo '<table class="pagination_ins"><tr>';
//beginning
if ($currentpage > 3)
   echo "<td><a href='ranking.php?page=1".$link."'>1</a></td>";
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
 echo "<td><a href='ranking.php?page=$x".$link."'>$x</a></td>";
}
   } 
}
//ending
if (($totalpages-$currentpage)>3)
echo "<td class='page_b'>...</td>";
if (($totalpages-$currentpage)>2)
   echo "<td><a href='ranking.php?page=$totalpages".$link."'>$totalpages</a></td>";
echo '</tr></table>';
/****** end build pagination links ******/
}
?>
</div>
</td></tr>
</table>
</td><td id="main_table_td3">
<br/>
<form action="ranking.php" method="get">
<div class="mcheck">
<br/>
<div class="mcheck_head">Classe</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td><input type="radio" name="req_class" value="knight">Dark Knight</input></td><td><input type="radio" name="req_class" value="gladiator">Magic Gladiator</input></td></tr>
<tr><td><input type="radio" name="req_class" value="wizard">Dark Wizard</input></td><td><input type="radio" name="req_class" value="lord">Dark Lord</input></td></tr>
<tr><td><input type="radio" name="req_class" value="elf">Fairy Elf</input></td><td><input type="radio" name="req_class" value="fighter">Rage Fighter</input></td></tr>
<tr><td><input type="radio" name="req_class" value="summoner">Summoner</input></td><td><input type="radio" name="req_class" value="all" checked="checked">Mostrar todas</input></td></tr>
</table>
</div>
<br/>
<div class="mcheck">
<br/>
<div class="mcheck_head">Organizar por</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td><input type="radio" name="order_by" value="monsters">Monstros</input></td><td><input type="radio" name="order_by" value="experience" checked="checked">Default (exp)</input></td></tr>
</table>
</div>
<br/>
<input type="submit" value="Submit"class="mcheck_submit"></input>
</form>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
class1 = new Image(100,100);
class1.src="images/1.gif";
class2 = new Image(100,100);
class2.src="images/2.gif";
class3 = new Image(100,100);
class3.src="images/3.gif";
class4 = new Image(100,100);
class4.src="images/4.gif";
var req_class = '<?php echo $req_class;?>';
var order_by = '<?php echo $order_by;?>';
if(req_class!='all');
$('input[value=' + req_class + ']').attr('checked', true);
if(order_by!='id_time');
$('input[value=' + order_by + ']').attr('checked', true);
$('.market_table tr:even').addClass('even');
$(".call_cinfo").click(function(){
$("#cinfo_title").html(this.id);
var class_tmp = $(this).attr("rel");
if(class_tmp > 20)
class_tmp -=20;
var new_image = eval('class' + class_tmp + '.src');
$('#cinfo_avatar').html('<img src='+new_image+' />');
  $.post("function.cinfo.php?char=" + this.id, function(data) {
   $('#cinfo_info').html(data);
  });
$("#cinfo").animate({bottom: '300px' }, 200);
$('#fade_bg').css('visibility', 'visible');
return false;
});
$("#fade_bg, #close_button").click(function(){
	$('#fade_bg').css('visibility', 'hidden');
	$("#cinfo").animate({bottom: '-200px' }, 200);
	return false;
});
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>