<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['id']))
exit('error');
if(!is_numeric($_GET['id']))
exit('error');
$id = intval($_GET['id']);
if(!isset($_SESSION['enemies'][$id]['item']))
exit('error');
$item_code = $_SESSION['enemies'][$id]['item'];
if($item_code == 'no item' || $item_code == 'taken')
exit('error');
$item_size = intval(substr($item_code,2,2));
$user_id = $_SESSION['user_id'];
$char_id = $_SESSION['char_id'];
include("database.php");
global $conn;
///////////////////////////defining functions/////////////////////
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
///////////////////////////defining functions end/////////////////
//////////////////loading arrays//////////////////////////////
//loading inventory
$query = "SELECT inventory FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_inventory = $dbarray[0];
$current_inventory = json_decode($current_inventory);
//////////////////loading arrays//////////////////////////////
$check = check_space_in_inventory($current_inventory, $item_size, 0);
if($check === 'no_space')
exit('no_space');
$array_to_occupy = array_to_occupy($check, $item_size);
 for($i=0; $i<count($array_to_occupy); $i++)
 {
  $e = $array_to_occupy[$i];
  $current_inventory[$e] = 1;
 }
 $current_inventory[$array_to_occupy[0]] = $item_code;
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $query = "UPDATE characters SET inventory='$current_inventory' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
$_SESSION['enemies'][$id]['item'] = 'taken';
echo 'ok';
?>