<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
function check_space_in_inventory($current_inventory, $item_size)
{
 switch ($item_size)
 {
 case "11":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<63)
{
$tmp = array($i);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space')
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "12":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<55)
{
$tmp = array($i, $i+8);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space')
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "13":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<47)
{
$tmp = array($i, $i+8, $i+16);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space')
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "14":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<39)
{
$tmp = array($i, $i+8, $i+16, $i+24);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space')
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "22":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<54)
{
$tmp = array($i, $i+1, $i+8, $i+9);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39 || $i==47)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "23":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<46)
{
$tmp = array($i, $i+1, $i+8, $i+9, $i+16, $i+17);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "24":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<38)
{
$tmp = array($i, $i+1, $i+8, $i+9, $i+16, $i+17, $i+24, $i+25);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "42":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<52)
{
$tmp = array($i, $i+1, $i+2, $i+3, $i+8, $i+9, $i+10, $i+11);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39 || $i==47 || $i==6 || $i==14 || $i==22 || $i==30 || $i==38 || $i==46 || $i==5 || $i==13 || $i==21 || $i==29 || $i==37 || $i==45)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "53":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<43)
{
$tmp = array($i, $i+1, $i+2, $i+3, $i+4, $i+8, $i+9, $i+10, $i+11, $i+12, $i+16, $i+17, $i+18, $i+19, $i+20);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39 || $i==6 || $i==14 || $i==22 || $i==30 || $i==38 || $i==5 || $i==13 || $i==21 || $i==29 || $i==37 || $i==4 || $i==12 || $i==20 || $i==28 || $i==36)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "32":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<53)
{
$tmp = array($i, $i+1, $i+2, $i+8, $i+9, $i+10);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39 || $i==47 || $i==6 || $i==14 || $i==22 || $i==30 || $i==38 || $i==46)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 case "33":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<45)
{
$tmp = array($i, $i+1, $i+2, $i+8, $i+9, $i+10, $i+16, $i+17, $i+18);
foreach ($tmp as $value)
{
    if($current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space' || $i==7 || $i==15 || $i==23 || $i==31 || $i==39 || $i==47 || $i==6 || $i==14 || $i==22 || $i==30 || $i==38 || $i==46)
{
$result = '';
$i++;
}
else
$success = $i;
}
  return $success;
 break;
 }
}
if(!isset($_GET['id']))
exit('error');

if(!isset($_GET['shop']))
exit('error');
else
$shop_id = $_GET['shop'];
if(!file_exists('shop/'.$shop_id.'.xml'))
exit('Wrong shop id.');
if(!is_numeric($_GET['id']))
exit('error');
$id_clicked = intval($_GET['id']);
if($id_clicked > 119)
exit('error1');
include('function.common.php');
//loading shop into array
$xml = simplexml_load_file('shop/'.$shop_id.'.xml');
$i=0;
foreach($xml->children() as $child)
 {
  $shop_inventory[$i]= "$child";
  $i++;
 }
//loading inventory
$user_id = $_SESSION['user_id'];
$char_id = $_SESSION['char_id'];
include("database.php");
global $conn;
$query = "SELECT inventory FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_inventory = $dbarray[0];
$current_inventory = json_decode($current_inventory);
//loading zen
$query = "SELECT zen FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$player_zen = intval($dbarray[0]);
if($shop_inventory[$id_clicked] == '0' || $shop_inventory[$id_clicked] == '1')
{
 exit('error0');
}
 //calculate item price
 $item_to_buy = $shop_inventory[$id_clicked];
parse_item_code($item_to_buy);
 if($item_type=='C' || $item_type=='D' || $item_type=='E')
 $bonus_price = 500;
 else
 $bonus_price = 5;
 $buying_price = $bonus_price + $item_effect*(1 + $item_level + $item_luck + $item_option + ceil($item_excellent/100)*10 + $item_harmony + $item_guardian) + $item_durability_cur;
if($player_zen < $buying_price)
exit('no_money');
$check = check_space_in_inventory($current_inventory, $item_size);
if($check === 'no_space')
exit('no_space');
switch($item_size)
{
 case '11':
 $array_to_occupy = array($check);
 break;
 case '12':
 $array_to_occupy = array($check, $check+8);
 break;
 case '13':
 $array_to_occupy = array($check, $check+8, $check+16);
 break;
 case '14':
 $array_to_occupy = array($check, $check+8, $check+16, $check+24);
 break;
 case '22':
 $array_to_occupy = array($check, $check+1, $check+8, $check+9);
 break;
 case '23':
 $array_to_occupy = array($check, $check+1, $check+8, $check+9, $check+16, $check+17);
 break;
 case '24':
 $array_to_occupy = array($check, $check+1, $check+8, $check+9, $check+16, $check+17, $check+24, $check+25);
 break;
 case '42':
 $array_to_occupy = array($check, $check+1, $check+2, $check+3, $check+8, $check+9, $check+10, $check+11);
 break;
 case '53':
 $array_to_occupy = array($check, $check+1, $check+2, $check+3, $check+4, $check+8, $check+9, $check+10, $check+11, $check+12, $check+16, $check+17, $check+18, $check+19, $check+20);
 break;
 case '32':
 $array_to_occupy = array($check, $check+1, $check+2, $check+8, $check+9, $check+10);
 break;
 case '33':
 $array_to_occupy = array($check, $check+1, $check+2, $check+8, $check+9, $check+10, $check+16, $check+17, $check+18);
 break;
}
for($i=0; $i<count($array_to_occupy); $i++)
{
 $e = $array_to_occupy[$i];
 $current_inventory[$e] = 1;
}
$current_inventory[$array_to_occupy[0]] = $item_to_buy;
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $query = "UPDATE characters SET inventory='$current_inventory' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
//saving updated money
$query = "UPDATE users SET zen=zen-'$buying_price' WHERE id='$user_id'";
if(!mysql_query($query, $conn))
exit('mysql_error');
echo json_encode($array_to_occupy);
?>