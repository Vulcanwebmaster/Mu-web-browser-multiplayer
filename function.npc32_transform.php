<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
$user_id = $_SESSION['user_id'];
include("database.php");
global $conn;
if(!isset($_GET['id']))
exit('error');
$npc32_id = $_GET['id'];
//loading npc32 into array
$query = "SELECT npc32_kind, npc32, zen FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$npc32_kind = $dbarray[0];
$current_npc32 = $dbarray[1];
$player_zen = intval($dbarray[2]);
  if($player_zen < 1000)
  exit('no_money');
$current_npc32 = json_decode($current_npc32);
$npc32_count = array();
for($i=0; $i<count($current_npc32); $i++)
{
  if($current_npc32[$i]!='0' && $current_npc32[$i]!='1')
  array_push($npc32_count, $current_npc32[$i]);
}
if(count($npc32_count)<1)
exit('error');
$return_item = array();
$return_item[0] = 0;
include('function.common.php');
////////////////////////////////////////////
if($npc32_id=='chaos_machine')
{
 $npc32_count_new = array();
 for($i=0; $i<count($npc32_count); $i++)
 {
  $type_sub_type = substr($npc32_count[$i],0,1).''.substr($npc32_count[$i],5,1);
  array_push($npc32_count_new, $type_sub_type);
 }
//E1 = jewel of creation
 if(count($npc32_count_new) == 2 && in_array('E2', $npc32_count_new) && in_array('E2', $npc32_count_new))
 {//four kinds of fruits
  $tmp = mt_rand(0,3);
  if($tmp==0)
  $return_item[0] = "J.11.A.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.strength_fruit";
  else if($tmp==1)
  $return_item[0] = "J.11.B.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.agility_fruit";
  else if($tmp==2)
  $return_item[0] = "J.11.C.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.stamina_fruit";
  else if($tmp==3)
  $return_item[0] = "J.11.D.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.energy_fruit";
 }
 else if(count($npc32_count_new) == 3 && in_array('I4', $npc32_count_new) && in_array('I5', $npc32_count_new) && in_array('E1', $npc32_count_new))
 $return_item[0] = "K.22.2.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.cloak_of_invisibility";
 else
 exit('error');
  $tmp = mt_rand(0,4);
  if($tmp==1)
  $return_item[0] = 0; //20% of fail
}
////////////////////////////////////////////
else if($npc32_id=='cblossom')
{
  if(count($npc32_count) > 1)
  exit('error');
 $item_code = $npc32_count[0];
 parse_item_code($item_code);
if($item_type=='I' && $item_sub_type =='1' && $item_durability_cur == $item_durability_max)
  $return_item[0] = "J.11.2.6040.00.0.0000.0000.00.0.0.00.00.0.006.030.000000.cherry_blossom_flower_petal";
else if($item_type=='I' && $item_sub_type =='2' && $item_durability_cur == $item_durability_max)
  $return_item[0] = "J.12.3.0700.00.0.0000.0000.00.0.0.00.00.0.008.030.000000.cherry_blossom_wine";
else if($item_type=='I' && $item_sub_type =='3' && $item_durability_cur == $item_durability_max)
  $return_item[0] = "J.11.4.0700.00.0.0000.0000.00.0.0.00.00.0.007.030.000000.cherry_blossom_rice_cake";
else
exit('error');
  $tmp = mt_rand(0,9);
  if($tmp == 1)
  $return_item[0] = 0; //10% of fail
}
////////////////////////////////////////////
else if($npc32_id=='lahap')
{
 if(count($npc32_count)==1)
 {
  $item_code = $npc32_count[0];
  $item_type = substr($item_code,0,1);
  $item_sub_type = substr($item_code,5,1);
 if($item_type=='E' && $item_sub_type =='4')
 {
  for($i=0; $i<10; $i++)
  {
   $return_item[$i] = "D.11.1.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.jewel_of_bless";
  }
 }
 else if($item_type=='E' && $item_sub_type =='5')
 {
  for($i=0; $i<10; $i++)
  {
   $return_item[$i] = "D.11.2.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.jewel_of_soul";
  }
 }
 else
  exit('error');
 }
  else if(count($npc32_count)==10)
 {
  $bless10 = 0;
  $soul10 = 0;
  for($i=0; $i<10; $i++)
  {
  if(substr($npc32_count[$i],0,1) == 'D' && substr($npc32_count[$i],5,1) == '1')
   $bless10 +=1;
  else if(substr($npc32_count[$i],0,1) == 'D' && substr($npc32_count[$i],5,1) == '2')
   $soul10 +=1;
  }
  if($bless10 == 10)
   $return_item[0] = "E.11.4.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.jewel_of_bless_x_10";
  else if($soul10 == 10)
   $return_item[0] = "E.11.5.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.jewel_of_soul_x_10";
  else
   exit('error');
 }
  else
  exit('error');
}
////////////////////////////////////////////
else if($npc32_id=='osbourne')
{
  if(count($npc32_count) > 1)
  exit('error');
 $item_code = $npc32_count[0];
 parse_item_code($item_code);
if(($item_type=='1' || $item_type=='2' || $item_type=='9') && $item_option!=0 && $item_excellent == 0 && $item_level>3)
 {
  $tmp = mt_rand(0,4);
  if($tmp == 1)
  $return_item[0] = "D.11.5.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.lower_refining_stone";
 }
else if(($item_type=='1' || $item_type=='2' || $item_type=='9') && $item_excellent!= 0)
 {
  $tmp = mt_rand(0,1);
  if($tmp == 1)
  $return_item[0] = "D.11.5.0000.00.0.0000.0000.00.0.0.00.00.0.000.000.000000.higher_refining_stone";
 }
else
exit('error');
}
////////////////////////////////////////////
else if($npc32_id=='jerridon')
{
  if(count($npc32_count) > 1)
  exit('error');
 $item_code = $npc32_count[0];
 parse_item_code($item_code);
if($item_harmony!=0)
 {
  $return_item[0] = substr_replace($item_code, '00', 37, 2);
 }
else
exit('error');
}
////////////////////////////////////////////
else
exit('error'); //unknown npc32
////////////////////////////////////////////
for($i=0; $i<count($current_npc32); $i++)
{
 $current_npc32[$i] = 0;
}
if($return_item[0] === 0)
{
 $npc32_kind = 0;
 $npc32_to_record = json_encode($current_npc32);
 $query = "UPDATE users SET npc32_kind='$npc32_kind', npc32='$npc32_to_record' WHERE id='$user_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
 exit('mix_fail');
}
else if(count($return_item) > 1)
{
 for($i=0; $i<count($return_item); $i++)
 {
  $current_npc32[$i] = $return_item[$i];
 }
}
else
{
 $item_size = intval(substr($return_item[0],2,2));
 $check = 0;
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
  $current_npc32[$e] = 1;
 }
 $current_npc32[0] = $return_item[0];
}
 $npc32_to_record = json_encode($current_npc32);
 $query = "UPDATE users SET npc32_kind='$npc32_kind', npc32='$npc32_to_record', zen=zen-1000 WHERE id='$user_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
 array_unshift($current_npc32, "success");
echo json_encode($current_npc32);
?>