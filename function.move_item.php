<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
function check_if_empty($current_inventory, $id, $item_size)
{
$result = '';
if($id > 69 && $id <82)
{
 if(!isset($current_inventory[$id]) || $current_inventory[$id]!='0')
   return 'no_space';
   else
   return array($id);
}
else
{
 switch ($item_size)
 {
 case "11":
$tmp = array($id);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space')
   return 'no_space';
   else
   return $tmp;
 break;
 case "12":
$tmp = array($id, $id+8);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space')
   return 'no_space';
   else
   return $tmp;
 break;
 case "13":
$tmp = array($id, $id+8, $id+16);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space')
   return 'no_space';
   else
   return $tmp;
 break;
 case "14":
$tmp = array($id, $id+8, $id+16, $id+24);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space')
   return 'no_space';
   else
   return $tmp;
 break;
 case "22":
$tmp = array($id, $id+1, $id+8, $id+9);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147'
|| $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195'
|| $id =='203' || $id =='211' || $id =='257' || $id =='265' || $id =='273'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "23":
$tmp = array($id, $id+1, $id+8, $id+9, $id+16, $id+17);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147'
|| $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195'
|| $id =='203' || $id =='211' || $id =='257' || $id =='265' || $id =='273'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "24":
$tmp = array($id, $id+1, $id+8, $id+9, $id+16, $id+17, $id+24, $id+25);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147'
|| $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195'
|| $id =='203' || $id =='211' || $id =='257' || $id =='265' || $id =='273'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "42":
array($id, $id+1, $id+2, $id+3,$id+8, $id+9, $id+10, $id+11);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='6' || $id =='14' || $id =='22' || $id =='30' || $id =='38' || $id =='46' || $id =='54'
|| $id =='5' || $id =='13' || $id =='21' || $id =='29' || $id =='37' || $id =='45' || $id =='53'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147' || $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195' || $id =='203' || $id =='211'
|| $id =='106' || $id =='114' || $id =='122' || $id =='130' || $id =='138' || $id =='146' || $id =='154' || $id =='162' || $id =='170' || $id =='178' || $id =='186' || $id =='194' || $id =='202' || $id =='210'
|| $id =='105' || $id =='113' || $id =='121' || $id =='129' || $id =='137' || $id =='145' || $id =='153' || $id =='161' || $id =='169' || $id =='177' || $id =='185' || $id =='193' || $id =='201' || $id =='209'

|| $id =='257' || $id =='265' || $id =='273' || $id =='281'
|| $id =='256' || $id =='264' || $id =='272' || $id =='280'
|| $id =='255' || $id =='263' || $id =='271' || $id =='279'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "53":
$tmp = array($id, $id+1, $id+2, $id+3,$id+4, $id+8, $id+9, $id+10, $id+11, $id+12, $id+16, $id+17, $id+18, $id+19, $id+20);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='6' || $id =='14' || $id =='22' || $id =='30' || $id =='38' || $id =='46' || $id =='54'
|| $id =='5' || $id =='13' || $id =='21' || $id =='29' || $id =='37' || $id =='45' || $id =='53'
|| $id =='4' || $id =='12' || $id =='20' || $id =='28' || $id =='36' || $id =='44' || $id =='52'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147' || $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195' || $id =='203' || $id =='211'
|| $id =='106' || $id =='114' || $id =='122' || $id =='130' || $id =='138' || $id =='146' || $id =='154' || $id =='162' || $id =='170' || $id =='178' || $id =='186' || $id =='194' || $id =='202' || $id =='210'
|| $id =='105' || $id =='113' || $id =='121' || $id =='129' || $id =='137' || $id =='145' || $id =='153' || $id =='161' || $id =='169' || $id =='177' || $id =='185' || $id =='193' || $id =='201' || $id =='209'
|| $id =='104' || $id =='112' || $id =='120' || $id =='128' || $id =='136' || $id =='144' || $id =='152' || $id =='160' || $id =='168' || $id =='176' || $id =='184' || $id =='192' || $id =='200' || $id =='208'

|| $id =='257' || $id =='265' || $id =='273' || $id =='281'
|| $id =='256' || $id =='264' || $id =='272' || $id =='280'
|| $id =='255' || $id =='263' || $id =='271' || $id =='279'
|| $id =='254' || $id =='262' || $id =='270' || $id =='278'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "32":
$tmp = array($id, $id+1, $id+2, $id+8, $id+9, $id+10);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
   if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='6' || $id =='14' || $id =='22' || $id =='30' || $id =='38' || $id =='46' || $id =='54'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147' || $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195' || $id =='203' || $id =='211'
|| $id =='106' || $id =='114' || $id =='122' || $id =='130' || $id =='138' || $id =='146' || $id =='154' || $id =='162' || $id =='170' || $id =='178' || $id =='186' || $id =='194' || $id =='202' || $id =='210'

|| $id =='257' || $id =='265' || $id =='273' || $id =='281'
|| $id =='256' || $id =='264' || $id =='272' || $id =='280'
)
   return 'no_space';
   else
   return $tmp;
 break;
 case "33":
$tmp = array($id, $id+1, $id+2, $id+8, $id+9, $id+10, $id+16, $id+17, $id+18);
foreach ($tmp as $value)
{
    if(!isset($current_inventory[$value]) || $current_inventory[$value]!='0')
    $result = 'no_space';
}
if($result === 'no_space'
|| $id =='7' || $id =='15' || $id =='23' || $id =='31' || $id =='39' || $id =='47' || $id =='55'
|| $id =='6' || $id =='14' || $id =='22' || $id =='30' || $id =='38' || $id =='46' || $id =='54'
|| $id =='107' || $id =='115' || $id =='123' || $id =='131' || $id =='139' || $id =='147' || $id =='155' || $id =='163' || $id =='171' || $id =='179' || $id =='187' || $id =='195' || $id =='203' || $id =='211'
|| $id =='106' || $id =='114' || $id =='122' || $id =='130' || $id =='138' || $id =='146' || $id =='154' || $id =='162' || $id =='170' || $id =='178' || $id =='186' || $id =='194' || $id =='202' || $id =='210'
|| $id =='257' || $id =='265' || $id =='273' || $id =='281'
|| $id =='256' || $id =='264' || $id =='272' || $id =='280'
)
   return 'no_space';
   else
   return $tmp;
 break;
 }
}
}
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
if(isset($_GET['npc32_kind']))
$npc32_kind = $_GET['npc32_kind'];
include('function.common.php');
/////////////////////////loading arrays////////////////////////////////////
//loading inventory, equipment, player stats
include('player_stats.php');
$current_inventory = json_decode($current_inventory);
$current_equipment = json_decode($current_equipment);
 for($i=0; $i<70; $i++)
 {
  $tmp_array_70[$i]=0;
 }
$current_equipment = array_merge($tmp_array_70, $current_equipment);
if(($id_source>99 && $id_source<220) || ($id_target >99 && $id_target <220))
{
//loading vault into array
$query = "SELECT vault FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_vault = $dbarray[0];
$current_vault = json_decode($current_vault);
 for($i=0; $i<100; $i++)
 {
  $tmp_array_100[$i]=0;
 }
 $current_vault = array_merge($tmp_array_100, $current_vault);
}
if(($id_source>249 && $id_source<282) || ($id_target >249 && $id_target <282))
{
//loading npc32 into array
if(!isset($npc32_kind))
exit('error');
$query = "SELECT npc32 FROM users WHERE id='$user_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$current_npc32 = $dbarray[0];
$current_npc32 = json_decode($current_npc32);
 for($i=0; $i<250; $i++)
 {
  $tmp_array_250[$i]=0;
 }
 $current_npc32 = array_merge($tmp_array_250, $current_npc32);
}
/////////////////////////loading arrays end///////////////////////////////
if($id_source>249 && $id_source<282)
{
if(!isset($current_npc32[$id_source]))
exit('error');
if($current_npc32[$id_source]=='0' || $current_npc32[$id_source]=='1')
exit('error');
}
if($id_source>99 && $id_source<220)
{
if(!isset($current_vault[$id_source]))
exit('error');
if($current_vault[$id_source]=='0' || $current_vault[$id_source]=='1')
exit('error');
}
if($id_source>69 && $id_source<82)
{
if(!isset($current_equipment[$id_source]))
exit('error');
if($current_equipment[$id_source]=='0' || $current_equipment[$id_source]=='1')
exit('error');
}
if($id_source<70)
{
if(!isset($current_inventory[$id_source]))
exit('error');
if($current_inventory[$id_source]=='0' || $current_inventory[$id_source]=='1')
exit('error');
}
//all checks are done, begin moving
if($id_source<70)
 $item_code = $current_inventory[$id_source];
else if($id_source>69 && $id_source<82)
 $item_code = $current_equipment[$id_source];
else if($id_source>99 && $id_source<220)
 $item_code = $current_vault[$id_source];
else if($id_source>249 && $id_source<282)
 $item_code = $current_npc32[$id_source];
parse_item_code($item_code);
/////////////////////////checking requirements////////////////////////////////////
if($id_target>69 && $id_target<82)
{
switch ($item_type)
{
case '1':
if($id_target!=73 && $id_target!=76)
exit('no_equip');
break;
case '2':
if($id_target!=73)
exit('no_equip');
//don't equip if one-handed already equipped... but make a check for bow + arrows
 if($current_equipment[76]!='0')
 {
  $equipped_right_hand = $current_equipment[76];
  $item_type1 = substr($equipped_right_hand,0,1);
  $item_sub_type1 = substr($equipped_right_hand,5,1);
  if(($item_sub_type == '8' && $item_type1 == '1' && $item_sub_type1 == '6') || ($item_sub_type == '9' && $item_type1 == '1' && $item_sub_type1 == '7'))
  {
   //bow + arrows or crossbow + bolts
  }
  else
  exit('no_equip');
 }
break;
case '3':
if($id_target!=75)
exit('no_equip');
break;
case '4':
if($id_target!=79)
exit('no_equip');
break;
case '5':
if($id_target!=71)
exit('no_equip');
break;
case '6':
if($id_target!=77)
exit('no_equip');
break;
case '7':
if($id_target!=81)
exit('no_equip');
break;
case '8':
if($id_target!=72)
exit('no_equip');
break;
case '9':
if($id_target!=76)
exit('no_equip');
break;
case 'A':
if($id_target!=74)
exit('no_equip');
break;
case 'B':
if($id_target!=78 && $id_target!=80)
exit('no_equip');
break;
case 'C':
if($id_target!=70)
exit('no_equip');
break;
default:
exit('no_equip');
}
//don't equip if two-handed already equipped...
if($id_target == 76)
 {
 if($current_equipment[73]!='0' && ($item_type == '1' || $item_type == '9'))
 {
  $equipped_left_hand = $current_equipment[73];
  $item_type2 = substr($equipped_left_hand,0,1);
  $item_sub_type2 = substr($equipped_left_hand,5,1);
  if($item_type2 == '1' || ($item_sub_type2 == '8' && $item_type == '1' && $item_sub_type == '6') || ($item_sub_type2 == '9' && $item_type == '1' && $item_sub_type == '7'))
  {
   //allow any if left is one handed or bows/arrows when left is two handed and = bow/crossbow
  }
  else
  exit('no_equip');
 }
}
$req_str_decrease = 0;
$req_agi_decrease = 0;
if(substr($item_harmony,0,1)=='3' && ($item_type == '1' || $item_type == '2'))
$req_str_decrease = intval(substr($item_harmony,1,1))*8;
if(substr($item_harmony,0,1)=='4' && ($item_type == '1' || $item_type == '2'))
$req_agi_decrease = intval(substr($item_harmony,1,1))*8;
//requirement1
if(substr($item_requirement1,0,1)!='0')
{
$requirement_1_value = (intval(substr($item_requirement1,1,3)) + $item_level*5 + ceil($item_excellent/100)*30);
switch(substr($item_requirement1,0,1))
{
case '1':
if(($requirement_1_value - $req_str_decrease) > $player_strength)
exit('no_requirement');
break;
case '2':
if(($requirement_1_value - $req_agi_decrease) > $player_agility)
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
//requirement2
if(substr($item_requirement2,0,1)!='0')
{
$requirement_2_value = (intval(substr($item_requirement2,1,3)) + $item_level*5 + ceil($item_excellent/100)*30);
switch(substr($item_requirement2,0,1))
{
case '1':
if(($requirement_2_value - $req_str_decrease) > $player_strength)
exit('no_requirement');
break;
case '2':
if(($requirement_2_value - $req_agi_decrease) > $player_agility)
exit('no_requirement');
break;
case '3':
if($requirement_2_value > $player_energy)
exit('no_requirement');
break;
case '4':
if($requirement_2_value > $player_level)
exit('no_requirement');
break;
case '5':
if($requirement_1_value > $player_stamina)
exit('no_requirement');
break;
}
}
//requirement 380 level items
if($item_requirement_add=='!')
{
if($player_level < 380)
exit('no_requirement');
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
/////////////////////////checking requirements end////////////////////////////////
/////////////////////////clearing cells////////////////////////////////////
$array_to_clear = empty_in_inventory($id_source, $item_size);
if($id_source<70)
{
 for($i=0; $i<count($array_to_clear); $i++)
 {
   $e = $array_to_clear[$i];
   $current_inventory[$e] = 0;
 }
}
if($id_source>69 && $id_source<82)
{
 $current_equipment[$array_to_clear[0]] = 0;
}
if($id_source>99 && $id_source<220)
{
 for($i=0; $i<count($array_to_clear); $i++)
 {
   $e = $array_to_clear[$i];
   $current_vault[$e] = 0;
 }
}
if($id_source>249 && $id_source<282)
{
 for($i=0; $i<count($array_to_clear); $i++)
 {
   $e = $array_to_clear[$i];
   $current_npc32[$e] = 0;
 }
}
/////////////////////////clearing cells end//////////////////////////////////
/////////////////////////filling cells///////////////////////////////////////
if($id_target<70)
 $cur_inv = $current_inventory;
else if($id_target>69 && $id_target<82)
 $cur_inv = $current_equipment;
else if($id_target>99 && $id_target<220)
 $cur_inv = $current_vault;
else if($id_target>249 && $id_target<282)
 $cur_inv = $current_npc32;
$array_to_insert = check_if_empty($cur_inv, $id_target, $item_size);
if($array_to_insert=='no_space')
exit('no_space');
else
{
   if($id_target<70)
   {
     for($i=0; $i<count($array_to_insert); $i++)
    {
      $e = $array_to_insert[$i];
      $current_inventory[$e] = 1;
    }
     $current_inventory[$array_to_insert[0]] = $item_code;
   }

   if($id_target>69 && $id_target<82)
   {
     $current_equipment[$array_to_insert[0]] = $item_code;
   }

   if($id_target>99 && $id_target<220)
   {
     for($i=0; $i<count($array_to_insert); $i++)
    {
      $e = $array_to_insert[$i];
      $current_vault[$e] = 1;
    }
     $current_vault[$array_to_insert[0]] = $item_code;
   }

   if($id_target>249 && $id_target<282)
   {
     for($i=0; $i<count($array_to_insert); $i++)
    {
      $e = $array_to_insert[$i];
      $current_npc32[$e] = 1;
    }
     $current_npc32[$array_to_insert[0]] = $item_code;
   }

}
/////////////////////////filling cells end//////////////////////////////////
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $query = "UPDATE characters SET inventory='$current_inventory' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');

if(($id_source>69 && $id_source<82) || ($id_target >69 && $id_target <82))
{
$current_equipment = array_slice($current_equipment, 70);
 //saving updated equipment
 $current_equipment = json_encode($current_equipment);
 $query = "UPDATE characters SET equipment='$current_equipment' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
}
if(($id_source>99 && $id_source<220) || ($id_target >99 && $id_target <220))
{
 $current_vault = array_slice($current_vault, 100);
 $current_vault = json_encode($current_vault);
 $query = "UPDATE users SET vault='$current_vault' WHERE id='$user_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
}
if(($id_source>249 && $id_source<282) || ($id_target >249 && $id_target <282))
{
/////////////////////////npc32_kind check//////////////////////////////////
//if there are no more items left, set npc32_kind to '0'
 $tmp = array();
 for($i=0; $i<count($current_npc32); $i++)
 {
   if($current_npc32[$i]!='0' && $current_npc32[$i]!='1')
   array_push($tmp, $current_npc32[$i]);
 }
 if(count($tmp)<1)
 $npc32_kind = '0';
/////////////////////////npc32_kind check//////////////////////////////////
$current_npc32 = array_slice($current_npc32, 250);
$current_npc32 = json_encode($current_npc32);
$query = "UPDATE users SET npc32_kind='$npc32_kind', npc32='$current_npc32' WHERE id='$user_id'";
if(!mysql_query($query,$conn))
exit('mysql_error');
}
echo json_encode($array_to_insert);
?>