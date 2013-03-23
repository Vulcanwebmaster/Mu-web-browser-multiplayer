<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['id']))
exit('error');
if(!is_numeric($_GET['id']))
exit('error');
$id = intval($_GET['id']);
if($id > 63)
exit('error');
function empty_in_inventory($id, $item_size)
{
switch($item_size)
{
 case '11':
 $array_to_clear = array($id);
 break;

 case '12':
 $array_to_clear = array($id, $id+8);
 break;
}
return $array_to_clear;
}
//loading inventory, equipment, player stats
include('function.common.php');
include('player_stats.php');
$current_inventory = json_decode($current_inventory);
if(!isset($current_inventory[$id]))
exit('error');
if($current_inventory[$id]=='0' || $current_inventory[$id]=='1')
exit('error');
$item_code = $current_inventory[$id];
parse_item_code($item_code);
if($item_type != 'F' && $item_type != 'G')
exit('error');
/////////////////////////checking requirements////////////////////////////
if($item_type == 'G')
{
//requirement1
if(substr($item_requirement1,0,1)!='0')
{
$requirement_1_value = intval(substr($item_requirement1,1,3));
switch(substr($item_requirement1,0,1))
{
case '1':
if($requirement_1_value > $player_strength)
exit('no_requirement');
break;
case '2':
if($requirement_1_value > $player_agility)
exit('no_requirement');
break;
case '3':
if($requirement_1_value > $player_energy)
exit('no_requirement');
break;
case '4':
if($requirement_1_value > $player_level)
exit('no_requirement');
break;
case '5':
if($requirement_1_value > $player_stamina)
exit('no_requirement');
break;
}
}
//required class
if($requirement_class!=0)
{
 switch($requirement_class)
 {
  case 1:
  if($player_class!='1' && $player_class!='21')
  exit('no_requirement');
  break;
  case 2:
  if($player_class!='2' && $player_class!='22')
  exit('no_requirement');
  break;
  case 3:
  if($player_class!='3' && $player_class!='23')
  exit('no_requirement');
  break;
  case 4:
  if($player_class!='4' && $player_class!='24')
  exit('no_requirement');
  break;
  case 5:
  if($player_class!='5')
  exit('no_requirement');
  break;
  case 6:
  if($player_class!='6')
  exit('no_requirement');
  break;
  case 7:
  if($player_class!='7')
  exit('no_requirement');
  break;
  case 10:
  if($player_class!='1' && $player_class!='2' && $player_class!='21' && $player_class!='22')
  exit('no_requirement');
  break;
  case 11:
  if($player_class!='1' && $player_class!='3' && $player_class!='21' && $player_class!='23')
  exit('no_requirement');
  break;
  case 12:
  if($player_class!='2' && $player_class!='3' && $player_class!='22' && $player_class!='23')
  exit('no_requirement');
  break;
  case 13:
  if($player_class!='2' && $player_class!='4' && $player_class!='22' && $player_class!='24')
  exit('no_requirement');
  break;
  case 14:
  if($player_class!='2' && $player_class!='5' && $player_class!='22')
  exit('no_requirement');
  break;
  case 15:
  if($player_class!='1' && $player_class!='5' && $player_class!='21')
  exit('no_requirement');
  break;
  case 16:
  if($player_class!='2' && $player_class!='4' && $player_class!='5' && $player_class!='22' && $player_class!='24')
  exit('no_requirement');
  break;
  case 21:
  if($player_class!='21')
  exit('no_requirement');
  break;
  case 22:
  if($player_class!='22')
  exit('no_requirement');
  break;
  case 23:
  if($player_class!='23')
  exit('no_requirement');
  break;
  case 24:
  if($player_class!='24')
  exit('no_requirement');
  break;
  default:
  exit('no_requirement');
 }
}
}
/////////////////////////checking requirements end////////////////////////////
/////////////////////////using item//////////////////////////////
$success = 0;
if($item_type == 'F')
{
include('calculate_stats.php'); //required to determine max hp and mp
$item_code = $current_inventory[$id];
parse_item_code($item_code); //restoring item code - it was modified in calculate stats
if($item_sub_type == '1' || $item_sub_type == '2' || $item_sub_type == '3' || $item_sub_type == '4' || $item_sub_type == '5')
{
 $potion_value = floor($player_hp_final*$item_effect/100); // how much HP to restore
 $player_hp_cur+=$potion_value;
 if($player_hp_cur>$player_hp_final)
 $player_hp_cur = $player_hp_final;
 $success = $player_hp_cur;
}
else if($item_sub_type == '6' || $item_sub_type == '7' || $item_sub_type == '8' || $item_sub_type == '9')
{
 $potion_value = floor($player_mp_final*$item_effect/100); // how much MP to restore
 $player_mp_cur+=$potion_value;
 if($player_mp_cur>$player_mp_final)
 $player_mp_cur = $player_mp_final;
 $success = $player_mp_cur;
}
else if($item_sub_type == 'A')
{
 // there should be script for using antidote
}
}
else if($item_type == 'G')
{
$current_skills = json_decode($current_skills);
if(!in_array($item_durability_max, $current_skills))
 {
  array_push($current_skills, $item_durability_max);
  $success = $item_durability_max; //add new skill number to array of skills
 }
}
/////////////////////////using item end//////////////////////////////
$array_to_clear = empty_in_inventory($id, $item_size);
for($i=0; $i<count($array_to_clear); $i++)
 {
   $e = $array_to_clear[$i];
   $current_inventory[$e] = 0;
 }
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $current_skills = json_encode($current_skills);
 if($item_type == 'F')
 $query = "UPDATE characters SET inventory='$current_inventory', hp_cur='$player_hp_cur', mp_cur='$player_mp_cur' WHERE id='$char_id'";
 else
 $query = "UPDATE characters SET inventory='$current_inventory', skills='$current_skills' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
array_unshift($array_to_clear, $success);
echo json_encode($array_to_clear);
?>