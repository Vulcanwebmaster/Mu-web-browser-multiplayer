<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
function empty_in_inventory($id, $item_size)
{
if($id > 69 && $id <82)
 $array_to_clear = array($id); //empty one of equipment slots
else
{
switch($item_size)
{
 case '11':
 $array_to_clear = array($id);
 break;
 case '12':
 $array_to_clear = array($id, $id+8);
 break;
 case '13':
 $array_to_clear = array($id, $id+8, $id+16);
 break;
 case '14':
 $array_to_clear = array($id, $id+8, $id+16, $id+24);
 break;
 case '22':
 $array_to_clear = array($id, $id+1, $id+8, $id+9);
 break;
 case '23':
 $array_to_clear = array($id, $id+1, $id+8, $id+9, $id+16, $id+17);
 break;
 case '24':
 $array_to_clear = array($id, $id+1, $id+8, $id+9, $id+16, $id+17, $id+24, $id+25);
 break;
 case '42':
 $array_to_clear = array($id, $id+1, $id+2, $id+3, $id+8, $id+9, $id+10, $id+11);
 break;
 case '53':
 $array_to_clear = array($id, $id_+1, $id+2, $id+3, $id+4, $id+8, $id+9, $id+10, $id+11, $id+12, $id+16, $id+17, $id+18, $id+19, $id+20);
 break;
 case '32':
 $array_to_clear = array($id, $id+1, $id+2, $id+8, $id+9, $id+10);
 break;
 case '33':
 $array_to_clear = array($id, $id+1, $id+2, $id+8, $id+9, $id+10, $id+16, $id+17, $id+18);
 break;
}
}
return $array_to_clear;
}
if(!isset($_GET['id1']) || !isset($_GET['id2']))
exit('error');
if(!is_numeric($_GET['id1']) || !is_numeric($_GET['id2']))
exit('error');
$id_source = intval($_GET['id1']);
$id_target = intval($_GET['id2']);
if($id_source > 69 || $id_target > 69)
exit('error');
/////////////////////////loading arrays////////////////////////////////////
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
/////////////////////////loading arrays end///////////////////////////////
if(!isset($current_inventory[$id_source]))
exit('error');
if($current_inventory[$id_source]=='0' || $current_inventory[$id_target]=='0' || $current_inventory[$id_source]=='1')
exit('error');
if($current_inventory[$id_target]=='1')
{
 //must find the real item
 $id_target_new = 'blank';

 for($i=0; $i<$id_target; $i++)
 {
  $tmp_item_code = $current_inventory[$i];
  if($tmp_item_code!='0' && $tmp_item_code!='1')
  {
  $tmp_item_size =  intval(substr($tmp_item_code,2,2));
  if($tmp_item_size!='11')
   {
   $tmp_array = empty_in_inventory($i, $tmp_item_size);
   $key = array_search($id_target, $tmp_array);
   if($key!== false)
   $id_target_new = $i;
   }
  }
 }
if($id_target_new === 'blank')
exit('error');
else
$id_target = $id_target_new;
}
 $item_code_target = $current_inventory[$id_target];
 $item_type_target = substr($item_code_target,0,1);
if($item_type_target!='1' && $item_type_target!='2' && $item_type_target!='3' && $item_type_target!='4' && $item_type_target!='5' && $item_type_target!='6' && $item_type_target!='7' && $item_type_target!='8' && $item_type_target!='9')
exit('error');
 $item_level_target = substr($item_code_target,12,2);
 $item_luck_target = substr($item_code_target,15,1);
 $item_option_target = intval(substr($item_code_target,32,1));
 $item_harmony_target = substr($item_code_target,37,2);
 $item_code_source = $current_inventory[$id_source];
 $item_type_source = substr($item_code_source,0,1);
if($item_type_source!='D')
exit('error');
$item_sub_type_source = substr($item_code_source,5,1);
$item_degrade = 0;//recording decrease of option/level/etc.
$new_item_code = 0;
// item degrade = 0 - combination success
// item degrade = 1 - combination failure item drops in level/option
// item degrade = 2 - combination failure item stays the same, jewel disappears
/////////////////////////transformation begin///////////////////////////////
/////////////jewel of bless/////////////
if($item_sub_type_source == '1')
{
if($item_level_target<6)
 {
  $item_level_target +=1;
  $item_level_target = str_pad($item_level_target, 2, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($item_code_target, $item_level_target, 12, 2);
 }
else
 $item_degrade = 2;
}
/////////////jewel of soul////////////////
else if($item_sub_type_source == '2')
{
if($item_luck_target =='1')
 {
  $tmp = mt_rand(0,3);//75% of success for items with luck
  if($tmp!= 1)
  {
  $item_level_target +=1;
  if($item_level_target>9)
  $item_level_target = 9;
  $item_level_target = str_pad($item_level_target, 2, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($item_code_target, $item_level_target, 12, 2);
  }
  else
  {
  if($item_level_target>0 && $item_level_target<7)
  $item_level_target -=1;
  else if($item_level_target>6)
  $item_level_target = 0;
  $item_level_target = str_pad($item_level_target, 2, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($item_code_target, $item_level_target, 12, 2);
  $item_degrade = 1;
  }
 }
else
 {
  $tmp = mt_rand(0,1);//50% of success for items without luck
  if($tmp== 1)
  {
  $item_level_target +=1;
  if($item_level_target>9)
  $item_level_target = 9;
  $item_level_target = str_pad($item_level_target, 2, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($item_code_target, $item_level_target, 12, 2);
  }
  else
  {
  if($item_level_target>0 && $item_level_target<7)
  $item_level_target -=1;
  else if($item_level_target>6)
  $item_level_target = 0;
  $item_level_target = str_pad($item_level_target, 2, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($item_code_target, $item_level_target, 12, 2);
  $item_degrade = 1;
  }
 }
}
/////////////jewel of life////////////////
else if($item_sub_type_source == '3')
{
  $tmp = mt_rand(0,1);//50% of success
  if($tmp== 1)
  {
  $item_option_target +=1;
  if($item_option_target>4)
  $item_option_target = 4;
  $new_item_code = substr_replace($item_code_target, $item_option_target, 32, 1);
  }
  else
  {
  if($item_option_target>0)
  $item_option_target -=1;
  $new_item_code = substr_replace($item_code_target, $item_option_target, 32, 1);
  $item_degrade = 1;
  }
}
/////////////jewel of harmony////////////////
else if($item_sub_type_source == '4')
{
if($item_harmony_target=='00')
 {
  $tmp = mt_rand(0,1);//50% of success
  if($tmp== 1)
  {
  $harmony_rand_option = mt_rand(1,6);//choosing harmony option...
  $harmony_option_value = 1;
  if($item_level_target > 6)
  $harmony_option_value = 2;
  if($item_level_target > 8)
  $harmony_option_value = 3;
  if($item_level_target > 10)
  $harmony_option_value = 4;
  if($item_level_target > 12)
  $harmony_option_value = 5;
  $harmony_rand_option = $harmony_rand_option.''.$harmony_option_value;
  $new_item_code = substr_replace($item_code_target, $harmony_rand_option, 37, 2);
  }
  else
   $item_degrade = 2;
 }
else
 $item_degrade = 2;
}
/////////////lower refining stone////////////////
else if($item_sub_type_source == '5')
{
if($item_harmony_target!='00')
 {
  $item_harmony_target_type = intval(substr($item_harmony_target,0,1));
  $item_harmony_target_value = intval(substr($item_harmony_target,1,1));

  $tmp = mt_rand(0,3);//25% of success
  if($tmp== 1)
  {
   $item_harmony_target_value +=1;
   if($item_harmony_target_value>5)
   $item_harmony_target_value = 5;//limit
   $harmony_rand_option = $item_harmony_target_type.''.$item_harmony_target_value;
   $new_item_code = substr_replace($item_code_target, $harmony_rand_option, 37, 2);
  }
 else
  {
   if($item_harmony_target_value>1)
   $item_harmony_target_value -=1;
   $harmony_rand_option = $item_harmony_target_type.''.$item_harmony_target_value;
   $new_item_code = substr_replace($item_code_target, $harmony_rand_option, 37, 2);
   $item_degrade = 1;
  }
 }
else
 $item_degrade = 2;
}
/////////////higher refining stone////////////////
else if($item_sub_type_source == '6')
{
if($item_harmony_target!='00')
 {
  $item_harmony_target_type = intval(substr($item_harmony_target,0,1));
  $item_harmony_target_value = intval(substr($item_harmony_target,1,1));

  $tmp = mt_rand(0,1);//50% of success
  if($tmp== 1)
  {
   $item_harmony_target_value +=1;
   if($item_harmony_target_value>5)
   $item_harmony_target_value = 5;//limit
   $harmony_rand_option = $item_harmony_target_type.''.$item_harmony_target_value;
   $new_item_code = substr_replace($item_code_target, $harmony_rand_option, 37, 2);
  }
 else
  {
   if($item_harmony_target_value>1)
   $item_harmony_target_value -=1;
   $harmony_rand_option = $item_harmony_target_type.''.$item_harmony_target_value;
   $new_item_code = substr_replace($item_code_target, $harmony_rand_option, 37, 2);
   $item_degrade = 1;
  }
 }
else
 $item_degrade = 2;
}
/////////////unknown jewel?////////////////
else
exit('error');
/////////////////////////transformation end///////////////////////////////
$current_inventory[$id_source] = 0;
$array_to_insert = array();
$array_to_insert[0] = $id_target;
$array_to_insert[1] = $new_item_code;
$array_to_insert[2] = $item_degrade;
$current_inventory[$id_source] = 0;
if($item_degrade!='2')
 $current_inventory[$id_target] = $new_item_code;
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $query = "UPDATE characters SET inventory='$current_inventory' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
echo json_encode($array_to_insert);
?>