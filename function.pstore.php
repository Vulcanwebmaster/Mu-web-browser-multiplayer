<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['action']) && !isset($_GET['id']))
exit('error');
$user_id = $_SESSION['user_id'];
$char_id = $_SESSION['char_id'];
include("database.php");
global $conn;
//////////////////////moving items///////////////////////////
if(isset($_GET['id']))
{
function check_space_in_inventory($current_inventory, $item_size, $where)
{
 switch ($item_size)
 {
 case "11":
$i = 0;
$result = '';
$success = 'no_space';
while ($success === 'no_space' && $i<63+$where)
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
while ($success === 'no_space' && $i<55+$where)
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
while ($success === 'no_space' && $i<47+$where)
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
while ($success === 'no_space' && $i<39+$where)
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
while ($success === 'no_space' && $i<54+$where)
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
while ($success === 'no_space' && $i<46+$where)
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
while ($success === 'no_space' && $i<38+$where)
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
while ($success === 'no_space' && $i<52+$where)
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
while ($success === 'no_space' && $i<43+$where)
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
while ($success === 'no_space' && $i<53+$where)
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
while ($success === 'no_space' && $i<45+$where)
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
function array_to_occupy($check, $item_size)
{
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
return $array_to_occupy;
}
if(!is_numeric($_GET['id']))
exit('error');
$id_clicked = intval($_GET['id']);
if($id_clicked < 84)
{
 if(!isset($_GET['price']))
 exit('error');
 if(!is_numeric($_GET['price']))
 exit('error');
 $price = intval($_GET['price']);
 if($price>99999999 || $price<1)
 exit('error');
}
//////////////////loading arrays//////////////////////////////
//loading inventory & equipment
$query = "SELECT inventory, equipment FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_inventory = $dbarray[0];
$current_equipment = $dbarray[1];
$current_inventory = json_decode($current_inventory);
$current_equipment = json_decode($current_equipment);
 for($i=0; $i<70; $i++)
 {
  $tmp_array_70[$i]=0;
 }
 $current_equipment = array_merge($tmp_array_70, $current_equipment);
$query = "SELECT pstore FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
if(!mysql_num_rows($result))
exit('mysql_error');
$dbarray = mysql_fetch_array($result);
$current_store = $dbarray[0];
$current_store = json_decode($current_store);
 for($i=0; $i<250; $i++)
 {
  $tmp_array_250[$i]=0;
 }
$current_store = array_merge($tmp_array_250, $current_store);
//////////////////loading arrays end//////////////////////////////
if($id_clicked>249)
{
if(!isset($current_store[$id_clicked]))
exit('error');
if($current_store[$id_clicked]=='0' || $current_store[$id_clicked]=='1')
exit('error');
$item = $current_store[$id_clicked];
}
else if($id_clicked<84 && $id_clicked>69)
{
if(!isset($current_equipment[$id_clicked]))
exit('error');
if($current_equipment[$id_clicked]=='0' || $current_equipment[$id_clicked]=='1')
exit('error');
$item = $current_equipment[$id_clicked];
}
else
{
if(!isset($current_inventory[$id_clicked]))
exit('error');
if($current_inventory[$id_clicked]=='0' || $current_inventory[$id_clicked]=='1')
exit('error');
$item = $current_inventory[$id_clicked];
}
include('function.common.php');
parse_item_code($item);
if($id_clicked>249)
$check = check_space_in_inventory($current_inventory, $item_size, 0);
else
$check = check_space_in_inventory(array_slice($current_store, 250), $item_size, -32);
if($check === 'no_space')
exit('no_space');
$array_to_occupy = array_to_occupy($check, $item_size);
if($id_clicked>249)
{
 for($i=0; $i<count($array_to_occupy); $i++)
 {
  $e = $array_to_occupy[$i];
  $current_inventory[$e] = 1;
  $f = $id_clicked + $array_to_occupy[$i] - $array_to_occupy[0];
  $current_store[$f] = 0;
 }
 $current_inventory[$array_to_occupy[0]] = $item;
}
else
{
 for($i=0; $i<count($array_to_occupy); $i++)
 {
  $array_to_occupy[$i] = $array_to_occupy[$i] + 250;
  $e = $array_to_occupy[$i];
  $current_store[$e] = 1;
 }
$current_store[$array_to_occupy[0]] = $item;
$current_store[$array_to_occupy[0]+32] = $price;

 if($id_clicked<84 && $id_clicked>69)
 {
  $current_equipment[$id_clicked] = 0;
 }
 else
 {
   for($i=0; $i<count($array_to_occupy); $i++)
  {
   $f = $id_clicked + $array_to_occupy[$i] - $array_to_occupy[0];
   $current_inventory[$f] = 0;
  }
 }
}
 //saving updated inventory
 $current_equipment = array_slice($current_equipment, 70);
 //saving updated inventory & equipment
 $current_inventory = json_encode($current_inventory);
 $current_equipment = json_encode($current_equipment);
 $query = "UPDATE characters SET inventory='$current_inventory', equipment='$current_equipment' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
$current_store = array_slice($current_store, 250);
$current_store = json_encode($current_store);
$query = "UPDATE users SET pstore='$current_store' WHERE id='$user_id'";
if(!mysql_query($query,$conn))
exit('mysql_error');
echo json_encode($array_to_occupy);
}
//////////////////////moving items///////////////////////////
//////////////////////open/close///////////////////////////
else if(isset($_GET['action']))
{
if($_GET['action']!='open' && $_GET['action']!='close')
exit('error');
$query = "SELECT zen, pstore_open FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
if(!mysql_num_rows($result))
exit('mysql_error');
$dbarray = mysql_fetch_array($result);
$player_money = $dbarray[0];
$pstore_open = $dbarray[1];
//////////////////////open_store///////////////////////////
if($_GET['action'] == 'open')
{
if($pstore_open!=0)
exit('already_opened');
if($player_money<1000)
exit('no_money');
//loading store into json array
$query = "SELECT pstore FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
if(!mysql_num_rows($result))
exit('mysql_error');
$dbarray = mysql_fetch_array($result);
$current_store = $dbarray[0];
$current_store = json_decode($current_store);
$count_items = 0;
$current_store_tmp = array_slice($current_store, 0, 32);
for($i=0; $i<count($current_store_tmp); $i++)
{
  if($current_store_tmp[$i]!='0' && $current_store_tmp[$i]!='1')
  $count_items +=1;
}
if($count_items<1)
exit('no_items');
//just in case...
 $query = "DELETE FROM market WHERE owner_id='$user_id'";
 if(!mysql_query($query, $conn))
 exit('market_error');
include('function.common.php');
for($i=0; $i<count($current_store_tmp); $i++)
{
 if($current_store_tmp[$i]!='0' && $current_store_tmp[$i]!='1')
 {
  $item_code = $current_store_tmp[$i];
  parse_item_code($item_code);
  $item_price = $current_store[$i+32];
  $current_time = time();
  $query = "INSERT INTO market (item_code, owner_id, pstore_id, start_time, item_type, item_excellent, req_class, item_name, price) VALUES ( '$item_code', '$user_id', '$i', '$current_time', '$item_type', '$item_excellent', '$requirement_class', '$item_name', '$item_price')";
  if(!mysql_query($query, $conn))
  exit('market_error');
 }
}
$tmp_time = time();
$query = "UPDATE users SET pstore_open=1, pstore_open_time='$tmp_time', zen=zen-1000 WHERE id='$user_id'";
if(mysql_query($query, $conn)) 
{
 echo 'ok'; 
}
 else
{
 echo 'error';
}
}
//////////////////////open_store///////////////////////////
//////////////////////close_store///////////////////////////
if($_GET['action'] == 'close')
{
if($pstore_open==='0')
exit('already_closed');
$query = "UPDATE users SET pstore_open=0, pstore_open_time=0 WHERE id='$user_id'";
mysql_query($query, $conn);
$query = "DELETE FROM market WHERE owner_id='$user_id'";
if(mysql_query($query, $conn)) 
{
 echo 'ok'; 
}
 else
{
 echo 'error';
}
}
//////////////////////close_store///////////////////////////
}
//////////////////////open/close///////////////////////////
else
exit('no_action_id');
?>