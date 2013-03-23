<?php
session_start();
include('function.login.php');
include('player_stats.php');
if(isset($_GET['item_type']))
$item_type = $_GET['item_type'];
else
$item_type = 'everything';
if($item_type!='everything' && $item_type!='weapon' && $item_type!='armor' && $item_type!='pants' && $item_type!='helm' && $item_type!='gloves' && $item_type!='boots' && $item_type!='wings' && $item_type!='shield' && $item_type!='pend_ring' && $item_type!='pet' && $item_type!='jewel' && $item_type!='orb_scroll' && $item_type!='other')
exit('wrong_parameter');
if(isset($_GET['req_class']))
$req_class = $_GET['req_class'];
else
$req_class = 'all';
if($req_class!='all' && $req_class!='knight' && $req_class!='wizard' && $req_class!='elf' && $req_class!='summoner' && $req_class!='gladiator' && $req_class!='lord' && $req_class!='fighter')
exit('wrong_parameter');
if(isset($_GET['order_by']))
$order_by = $_GET['order_by'];
else
$order_by = 'id_time';
if($order_by!='id_time' && $order_by!='item_name' && $order_by!='item_excellent' && $order_by!='price')
exit('wrong_parameter');
$query = "SELECT * FROM market"; //actual result
$sql = "SELECT COUNT(*) FROM market"; //counting rows for pagination
if($item_type!='everything')
{
 switch ($item_type)
 {
  case 'weapon':
  $query_add = " WHERE (item_type='1' OR item_type='2')";
  break;
  case 'armor':
  $query_add = " WHERE item_type='3'";
  break;
  case 'pants':
  $query_add = " WHERE item_type='4'";
  break;
  case 'helm':
  $query_add = " WHERE item_type='5'";
  break;
  case 'gloves':
  $query_add = " WHERE item_type='6'";
  break;
  case 'boots':
  $query_add = " WHERE item_type='7'";
  break;
  case 'wings':
  $query_add = " WHERE item_type='8'";
  break;
  case 'shield':
  $query_add = " WHERE item_type='9'";
  break;
  case 'pend_ring':
  $query_add = " WHERE (item_type='A' OR item_type='B')";
  break;
  case 'pet':
  $query_add = " WHERE item_type='C'";
  break;
  case 'jewel':
  $query_add = " WHERE (item_type='D' OR item_type='E')";
  break;
  case 'orb_scroll':
  $query_add = " WHERE item_type='G'";
  break;
  case 'other':
  $query_add = " WHERE (item_type='F' OR item_type='H' OR item_type='I' OR item_type='J' OR item_type='K' OR item_type='L')";
  break;
 }
 $query = $query.$query_add;
 $sql = $sql.$query_add;
}
if($req_class!='all')
{
 switch ($req_class)
 {
  case 'knight':
  $query_add_class = "req_class='1' OR req_class='21' OR req_class='10' OR req_class='11' OR req_class='15'";
  break;
  case 'wizard':
  $query_add_class = "req_class='2' OR req_class='22' OR req_class='10' OR req_class='12' OR req_class='13' OR req_class='14' OR req_class='16'";
  break;
  case 'elf':
  $query_add_class = "req_class='3' OR req_class='23' OR req_class='11' OR req_class='12'";
  break;
  case 'summoner':
  $query_add_class = "req_class='4' OR req_class='24' OR req_class='13' OR req_class='16'";
  break;
  case 'gladiator':
  $query_add_class = "req_class='5' OR req_class='14' OR req_class='15' OR req_class='16'";
  break;
  case 'lord':
  $query_add_class = "req_class='6'";
  break;
  case 'fighter':
  $query_add_class = "req_class='7'";
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
if($order_by!='id_time')
$query = $query." ORDER BY $order_by";
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
<table class="main_table" cellspacing="0">
<tr><td id="main_table_td2">
<table cellspacing="1" class="npc32_table">
<tr><td id="pstore_title">
<div id="pstore_title_ins">Mercado livre</div>
</td></tr>
<tr><td>
<table class="market_table" cellspacing="0">
<tr class="market_head"><td class="m_id">id</td><td class="m_type">type</td><td class="m_name">name</td><td class="m_owner">owner</td><td class="m_exc">exc</td><td class="m_price">Valor</td></tr>
<?php
if(mysql_num_rows($result)>0)
{
while($row = mysql_fetch_assoc($result))
{
 echo "<tr><td>".$row['id']."</td><td>".$row['item_type']."</td><td><a href='#' onmouseout='nd()' class='market_item' id='".$row['id']."' name='".$row['item_code']."'>".$row['item_name']."</a></td><td>".$row['owner_id']."</td><td>".$row['item_excellent']."</td><td>".$row['price']."</td></tr>";
}
echo '</table>';
}
else
echo '</table><br/>no items';
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
$link = "&item_type=".$item_type."&req_class=".$req_class."&order_by=".$order_by;
// range of num links to show
$range = 2;
echo '<table class="pagination_ins"><tr>';
//beginning
if ($currentpage > 3)
   echo "<td><a href='market.php?page=1".$link."'>1</a></td>";
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
 echo "<td><a href='market.php?page=$x".$link."'>$x</a></td>";
}
   } 
}
//ending
if (($totalpages-$currentpage)>3)
echo "<td class='page_b'>...</td>";
if (($totalpages-$currentpage)>2)
   echo "<td><a href='market.php?page=$totalpages".$link."'>$totalpages</a></td>";
echo '</tr></table>';
/****** end build pagination links ******/
}
?>
</div>
</td></tr>
</table>
</td><td id="main_table_td3">
<br/>
<form action="market.php" method="get">
<div class="mcheck">
<br/>
<div class="mcheck_head">Tipo do item</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td><input type="radio" name="item_type" value="weapon">weapon</input></td><td><input type="radio" name="item_type" value="shield">shield</input></td></tr>
<tr><td><input type="radio" name="item_type" value="armor">armor</input></td><td><input type="radio" name="item_type" value="pend_ring">ring & pend</input></td></tr>
<tr><td><input type="radio" name="item_type" value="pants">pants</input></td><td><input type="radio" name="item_type" value="pet">pet</input></td></tr>
<tr><td><input type="radio" name="item_type" value="helm">helm</input></td><td><input type="radio" name="item_type" value="jewel">jewel</input></td></tr>
<tr><td><input type="radio" name="item_type" value="gloves">gloves</input></td><td><input type="radio" name="item_type" value="orb_scroll">orb & scroll</input></td></tr>
<tr><td><input type="radio" name="item_type" value="boots">boots</input></td><td><input type="radio" name="item_type" value="other">other items</input></td></tr>
<tr><td><input type="radio" name="item_type" value="wings">wings</input></td><td><input type="radio" name="item_type" value="everything" checked="checked">everything</input></td></tr>
</table>
</div>
<br/>
<div class="mcheck">
<br/>
<div class="mcheck_head">Classes</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td><input type="radio" name="req_class" value="knight">Dark Knight</input></td><td><input type="radio" name="req_class" value="gladiator">Magic Gladiator</input></td></tr>
<tr><td><input type="radio" name="req_class" value="wizard">Dark Wizard</input></td><td><input type="radio" name="req_class" value="lord">Dark Lord</input></td></tr>
<tr><td><input type="radio" name="req_class" value="elf">Fairy Elf</input></td><td><input type="radio" name="req_class" value="fighter">Rage Fighter</input></td></tr>
<tr><td><input type="radio" name="req_class" value="summoner">Summoner</input></td><td><input type="radio" name="req_class" value="all" checked="checked">all classes</input></td></tr>
</table>
</div>
<br/>
<div class="mcheck">
<br/>
<div class="mcheck_head">Organizar por</div>
<table class="mcheck_ins" cellspacing="0">
<tr><td><input type="radio" name="order_by" value="item_name">Nome</input></td><td><input type="radio" name="order_by" value="item_excellent">excellent</input></td></tr>
<tr><td><input type="radio" name="order_by" value="price">valor</input></td><td><input type="radio" name="order_by" value="id_time" checked="checked">default (id)</input></td></tr>
</table>
</div>
<br/>
<input type="submit" value="Submit"class="mcheck_submit"></input>
</form>
<table class="zen_table1">
<tr><td>Ouro:</td><td id="zen_value">0</td></tr>
</table>
</td></tr></table>
</div>
</td></tr></table>
<script type="text/javascript">
function market_confirmed(r, item_id) {
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
 if(xmlhttp.responseText.slice(0,1)!='!')
 {
if(xmlhttp.responseText=="no_space")
jAlert('Not enough space in inventory', 'Message');
else if(xmlhttp.responseText=='no_money')
jAlert('Not enough money for this item', 'Message');
else if(xmlhttp.responseText=="your_item")
jAlert('Cannot buy your own item', 'Message');
else
jAlert('Id error', 'Message');
}
else
{
  jAlert('Item id #' + item_id + ' is bought', 'Message');
  var player_zen_new = Number(xmlhttp.responseText.slice(1));
  document.getElementById('zen_value').innerHTML = player_zen_new;
  document.getElementById(item_id).parentNode.innerHTML = 'sold';
}
    }
  }
xmlhttp.open("GET","function.market.php?id=" + item_id + "&rand=" + Math.random(),true);
xmlhttp.send();
 }

}
var item_type = '<?php echo $item_type;?>';
var req_class = '<?php echo $req_class;?>';
var order_by = '<?php echo $order_by;?>';
if(item_type!='everything');
$('input[value=' + item_type + ']').attr('checked', true);
if(req_class!='all');
$('input[value=' + req_class + ']').attr('checked', true);
if(order_by!='id_time');
$('input[value=' + order_by + ']').attr('checked', true);
var player_class = <?php echo $player_class;?>;
var player_level = <?php echo $player_level;?>;;
var player_strength = <?php echo $player_strength;?>;
var player_agility = <?php echo $player_agility;?>;
var player_stamina = <?php echo $player_stamina;?>;
var player_energy = <?php echo $player_energy;?>;
var player_zen = '<?php echo $player_zen;?>';
document.getElementById('zen_value').innerHTML = player_zen;
$('.market_table tr:even').addClass('even');
$('.market_item').mouseover(function() {
  var desc = load_items(this.name, 5, player_level, player_class, player_strength, player_agility, player_energy);
  desc = desc.replace(/&quot;/g,'"');
  overlib(desc,ADAPTIVE_WIDTH, 180,320,2);
});
$('.market_item').click(function(){
 nd();
 item_id = this.id;
 jConfirm('Comprar esse item id #' + this.id + '?', 'Confirm Buying', function(r) {market_confirmed(r, item_id);});
});
</script>
</body>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
</html>