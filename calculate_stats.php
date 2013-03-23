<?php
//////////////////////////initialize//////////////////////////////
switch($player_class)
{
 case 1:
 case 21:
 $player_damage_max = floor($player_strength/4);
 $player_damage_min = floor($player_strength/6);
 $player_damage_rate = floor($player_level*5+($player_agility*3)/2+$player_strength/4);
 $player_defense = floor($player_agility/3);
 $player_defense_rate = floor($player_agility/3);
 $player_hp = 35+$player_level*2+$player_stamina*3;
 $player_mp = floor(10+$player_level*0.5+$player_energy);
 $player_wiz_damage_max = 0;
 $player_wiz_damage_min = 0;
 break;
 case 2:
 case 22:
 $player_damage_max = floor($player_strength/8);
 $player_damage_min = floor($player_strength/12);
 $player_damage_rate = floor($player_level*5+($player_agility*3)/2+$player_strength/4);
 $player_defense = floor($player_agility/4);
 $player_defense_rate = floor($player_agility/3);
 $player_hp = 30+$player_level+$player_stamina*2;
 $player_mp = $player_level*2+$player_energy*2;
 $player_wiz_damage_max = floor($player_energy/4);
 $player_wiz_damage_min = floor($player_energy/9);
 break;
 case 3:
 case 23:
 $player_damage_max = floor($player_strength/8 + $player_agility/4);
 $player_damage_min = floor($player_strength/14 + $player_agility/7);
 $player_damage_rate = floor($player_level*5+($player_agility*3)/2+$player_strength/4);
 $player_defense = floor($player_agility/10);
 $player_defense_rate = floor($player_agility/4);
 $player_hp = 40+$player_level+$player_stamina*2;
 $player_mp = floor(6+$player_level*1.5+$player_energy*1.5);
 $player_wiz_damage_max = 0;
 $player_wiz_damage_min = 0;
 break;
 case 4:
 case 24:
 $player_damage_max = floor($player_strength/8);
 $player_damage_min = floor($player_strength/12);
 $player_damage_rate = floor($player_level*5+($player_agility*3)/2+$player_strength/4);
 $player_defense = floor($player_agility/3);
 $player_defense_rate = floor($player_agility/4);
 $player_hp = 33+$player_level+$player_stamina*2;
 $player_mp = floor(4+$player_level*1.5+$player_energy*1.5);
 $player_wiz_damage_max = floor($player_energy/4);
 $player_wiz_damage_min = floor($player_energy/9);
 break;
}
////////////////////////potions////////////////////////////
if(isset($calculate_potions))
{
$current_inventory_tmp = json_decode($current_inventory);
$battle_hp_potions_elite = 0;
$battle_hp_potions_large = 0;
$battle_hp_potions_medium = 0;
$battle_hp_potions_small = 0;
$battle_hp_potions_apple = 0;
$battle_mp_potions_elite = 0;
$battle_mp_potions_large = 0;
$battle_mp_potions_medium = 0;
$battle_mp_potions_small = 0;
$battle_antidotes = 0;
for($i=0; $i<count($current_inventory_tmp); $i++)
{
 if($current_inventory_tmp[$i]!='0' && $current_inventory_tmp[$i]!='1')
 {
  $item_type = substr($current_inventory_tmp[$i],0,1);
  $item_sub_type = substr($current_inventory_tmp[$i],5,1);
  if($item_type == 'F')
  {
   switch($item_sub_type)
   {
    case '5':
    $battle_hp_potions_elite+=1;
    break;
    case '4':
    $battle_hp_potions_large+=1;
    break;
    case '3':
    $battle_hp_potions_medium+=1;
    break;
    case '2':
    $battle_hp_potions_small+=1;
    break;
    case '1':
    $battle_hp_potions_apple+=1;
    break;
    case '9':
    $battle_mp_potions_elite+=1;
    break;
    case '8':
    $battle_mp_potions_large+=1;
    break;
    case '7':
    $battle_mp_potions_medium+=1;
    break;
    case '6':
    $battle_mp_potions_small+=1;
    break;
    case 'A':
    $battle_antidotes+=1;
    break;
   }
  }
 }
}
}
////////////////////////potions end////////////////////////////
//////////////////////////other stats/////////////////////////
$hand1_damage_min = 0;
$hand1_damage_max = 0;
$hand2_damage_min = 0;
$hand2_damage_max = 0;
$shield_defense_rate = 0;
$equipment_defense = 0;
$equipment_luck = 0;
$hand1_staff_option = 0;
$hand2_staff_option = 0;
$hand1_staff_rise = 0;
$hand2_staff_rise = 0;
$staff_rise_final = 0;
$curse_spell_increment = 0;
$equipment_hp_regeneration = 0;
//excellent options
$equipment_damage_level_20 = 0;
$equipment_damage_2p = 0;
$equipment_defense_rate_10p = 0;
$equipment_damage_decrease_4p = 0;
$equipment_increase_hp_4p = 0;
$equipment_increase_mp_4p = 0;
$equipment_excellent = 0;
$equipment_reflect = 0;
//harmony options
$equipment_h_min_dmg = 0;
$equipment_h_max_dmg = 0;
$equipment_h_defense_inc = 0;
$equipment_h_inc_hp = 0;
$equipment_h_def_rate_inc = 0;
$equipment_h_dmg_dec = 0;
$equipment_h_critical_inc = 0;
$equipment_h_skill_inc = 0;
$pet_damage = 0;
$wings_damage = 0;
$wiz_ring_damage = 0;
$arrows = -10;
$equipment_hp_bonus = 0;
$equipment_damage_absorb = 0;
$equipment_skills = array();
//////////////////////////////slot-by-slot///////////////////////////////////////
$current_equipment_tmp = json_decode($current_equipment);
for($i=0; $i<70; $i++)
 {
  $tmp_array_70[$i]=0;
 }
$current_equipment_tmp = array_merge($tmp_array_70, $current_equipment_tmp);
//pet
 if($current_equipment_tmp[70]!='0')
{
  $item_code = $current_equipment_tmp[70];
  parse_item_code ($item_code);

  if($item_sub_type=='1')
 {
  $equipment_damage_absorb += 0.2;
  $equipment_hp_bonus +=50;
 }
  if($item_sub_type=='2')
  $pet_damage = 0.3;

  if($item_sub_type=='4')
 {
  $pet_damage = 0.1;
  $equipment_damage_absorb += 0.15;
 }
  if($item_sub_type=='6')
  $equipment_damage_absorb += 0.1;
  if($item_sub_type=='7')
  $pet_damage = 0.1;
  if($item_sub_type=='8')
 {
  $equipment_damage_absorb += 0.3;
  $equipment_hp_bonus +=50;
 }
  if($item_sub_type=='9')
  $pet_damage = 0.4;

 if($item_skill!='0' && !in_array($item_skill, $equipment_skills))
 array_push($equipment_skills, $item_skill);
}
//helm
 if($current_equipment_tmp[71]!='0')
{
  $item_code = $current_equipment_tmp[71];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_defense += ($item_effect + $item_option*4);
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//wings
 if($current_equipment_tmp[72]!='0')
{
  $item_code = $current_equipment_tmp[72];
  parse_item_code($item_code);
  $equipment_defense += ($item_effect + $item_option*4 + $item_level*3);
  $equipment_luck += $item_luck;
 //first or second level wings?
 if($item_sub_type=='1')
 {
  $wings_damage = (12 + $item_level*2)/100;
  $equipment_damage_absorb += (12 + $item_level*2)/100;
 }
 else
 {
  $wings_damage = (25 + $item_level*2)/100;
  $equipment_damage_absorb += (25 + $item_level*2)/100;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//hand1
 if($current_equipment_tmp[73]!='0')
{
  $item_code = $current_equipment_tmp[73];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 4:
  $equipment_damage_level_20 += ($player_level/20);
  break;
  case 2:
  $equipment_damage_2p +=0.02;
  break;
  case 1:
  $equipment_excellent +=10;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_min_dmg += $item_harmony_value*3;
     break;
     case 2:
     $equipment_h_max_dmg += $item_harmony_value*5;
     break;
     case 5:
     $equipment_h_critical_inc += $item_harmony_value*6;
     break;
     case 6:
     $equipment_h_skill_inc += $item_harmony_value*5;
     break;
   }
 }
  $hand1_damage_min = floor($item_effect*5/6) + $item_option*4;
  $hand1_damage_max = $item_effect + $item_option*4;
if(($item_type=='1' && $item_sub_type=='3') || ($item_type=='2' && $item_sub_type=='3')) //staff & stick
 {
  $hand1_staff_option = $item_option*4;
  $hand1_staff_rise = floor($item_effect*5/6);
 }
if($item_type=='1' && $item_sub_type=='5') //summoner books
$curse_spell_increment = $item_effect;
if(($item_type=='2' && $item_sub_type=='8') || ($item_type=='2' && $item_sub_type=='9')) //don't allow dmg if there are no arrows
{
 $arrows = 0; //right hand will fix this if there are arrows
}
 if($item_skill!='0' && !in_array($item_skill, $equipment_skills))
 array_push($equipment_skills, $item_skill);
}
//necklace
 if($current_equipment_tmp[74]!='0')
{
  $item_code = $current_equipment_tmp[74];
  parse_item_code($item_code);
 $equipment_hp_regeneration += $item_option;
 switch($item_excellent)
 {
  case 4:
  $equipment_damage_level_20 += ($player_level/20);
  break;
  case 2:
  $equipment_damage_2p +=0.02;
  break;
  case 1:
  $equipment_excellent +=10;
  break;
 }
}
//armor
 if($current_equipment_tmp[75]!='0')
{
  $item_code = $current_equipment_tmp[75];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_defense += ($item_effect + $item_option*4);
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//hand2
 if($current_equipment_tmp[76]!='0')
{
  $item_code = $current_equipment_tmp[76];
  parse_item_code($item_code);
  $item_effect2 = $item_effect + $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_luck += $item_luck;
if($item_type!='9')
{
if(($item_type=='1' && $item_sub_type=='3') || ($item_type=='2' && $item_sub_type=='3')) //staff & stick
{
  $hand2_staff_option = $item_option*4;
  $hand2_staff_rise = floor($item_effect2*5/6);
}
if($item_type=='1' && $item_sub_type=='5') //summoner books
{
 if($curse_spell_increment<$item_effect2)
 $curse_spell_increment = $item_effect2;
}
if(($item_type=='1' && $item_sub_type=='6') || ($item_type=='1' && $item_sub_type=='7')) //arrows & bolts
{
 if(substr($current_equipment_tmp[73],5,1) == '8' || substr($current_equipment_tmp[73],5,1) == '9') //bow or crossbow is equipped?
 $arrows = $item_durability_cur;
}
 switch($item_excellent)
 {
  case 4:
  $equipment_damage_level_20 += ($player_level/20);
  break;
  case 2:
  $equipment_damage_2p +=0.02;
  break;
  case 1:
  $equipment_excellent +=10;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_min_dmg += $item_harmony_value*3;
     break;
     case 2:
     $equipment_h_max_dmg += $item_harmony_value*5;
     break;
     case 5:
     $equipment_h_critical_inc += $item_harmony_value*6;
     break;
     case 6:
     $equipment_h_skill_inc += $item_harmony_value*5;
     break;
   }
 }
     $hand2_damage_min = floor($item_effect2*5/6) + $item_option*4;
     $hand2_damage_max = $item_effect2 + $item_option*4;
}
else
{
  $equipment_defense += $item_effect + $item_level;
  $shield_defense_rate = $item_effect*3 + $item_level*3 + ceil($item_excellent/100)*30 + $item_option*5;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
 if($item_skill!='0' && !in_array($item_skill, $equipment_skills))
 array_push($equipment_skills, $item_skill);
}
//gloves
 if($current_equipment_tmp[77]!='0')
{
  $item_code = $current_equipment_tmp[77];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_defense += ($item_effect + $item_option*4);
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//ring 1
 if($current_equipment_tmp[78]!='0')
{
  $item_code = $current_equipment_tmp[78];
  parse_item_code($item_code);
  if($item_sub_type=='7')
  $equipment_increase_mp_4p +=$item_option/100;
  else
  $equipment_hp_regeneration += $item_option;
  if($item_sub_type=='9')
  $wiz_ring_damage = 0.1;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
 }
}
//pants
 if($current_equipment_tmp[79]!='0')
{
  $item_code = $current_equipment_tmp[79];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_defense += ($item_effect + $item_option*4);
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//ring 2
 if($current_equipment_tmp[80]!='0')
{
  $item_code = $current_equipment_tmp[80];
  parse_item_code($item_code);
  if($item_sub_type=='7')
  $equipment_increase_mp_4p +=$item_option/100;
  else
  $equipment_hp_regeneration += $item_option;
  if($item_sub_type=='9')
  $wiz_ring_damage = 0.1;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
 }
}
//boots
 if($current_equipment_tmp[81]!='0')
{
  $item_code = $current_equipment_tmp[81];
  parse_item_code($item_code);
  $item_effect += $item_level*3 + ceil($item_excellent/100)*30;
  $equipment_defense += ($item_effect + $item_option*4);
  $equipment_luck += $item_luck;
 switch($item_excellent)
 {
  case 1:
  $equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  $equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  $equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  $equipment_increase_mp_4p +=0.04;
  break;
  case 6:
  $equipment_reflect +=5;
  break;
 }
 if($item_harmony!='00')
 {
  $item_harmony_type = intval(substr($item_harmony,0,1));
  $item_harmony_value = intval(substr($item_harmony,1,1));
    switch($item_harmony_type)
    {
     case 1:
     $equipment_h_defense_inc += $item_harmony_value*5;
     break;
     case 2:
     $equipment_h_inc_hp += $item_harmony_value*6;
     break;
     case 5:
     $equipment_h_def_rate_inc += $item_harmony_value*2;
     break;
     case 6:
     $equipment_h_dmg_dec += $item_harmony_value/100;
     break;
   }
 }
}
//////////////////////////////slot-by-slot end//////////////////////////////////////
//////////////////////////////final stats//////////////////////////////////////
if($hand1_damage_min>=$hand2_damage_min)
{
 $hand2_damage_min = 0;
 $hand2_damage_max = 0;
}
else
{
 $hand1_damage_min = 0;
 $hand1_damage_max = 0;
}
$damage_min_total = floor($player_damage_min + $hand1_damage_min + $hand2_damage_min + $equipment_damage_level_20 + $equipment_h_min_dmg);
$damage_max_total = floor($player_damage_max + $hand1_damage_max + $hand2_damage_max + $equipment_damage_level_20 + $equipment_h_max_dmg);
if($damage_min_total>$damage_max_total)
$damage_min_total = $damage_max_total;
$damage_bonus = floor(($pet_damage + $wings_damage + $equipment_damage_2p + $wiz_ring_damage)*100); //percents
$player_hp_final = floor(($player_hp + $equipment_hp_bonus + $equipment_h_inc_hp)*(1 + $equipment_increase_hp_4p));
if($player_hp_cur>$player_hp_final)
$player_hp_cur=$player_hp_final;
$player_mp_final = floor($player_mp*(1 + $equipment_increase_mp_4p));
if($player_mp_cur>$player_mp_final)
$player_mp_cur=$player_mp_final;
$damage_absorb_value = $equipment_damage_absorb*100; //percents
$damage_absorb_value2 = ($equipment_damage_decrease_4p + $equipment_h_dmg_dec)*100; //percents
$defense_total = $player_defense + $equipment_defense + $equipment_h_defense_inc;
$defense_rate_total = floor(($player_defense_rate + $shield_defense_rate + $equipment_h_def_rate_inc)*(1 + $equipment_defense_rate_10p));
$damage_wiz_min_total = floor($player_wiz_damage_min + $hand1_staff_option + $hand2_staff_option + $equipment_damage_level_20 + $equipment_h_min_dmg);
$damage_wiz_max_total = floor($player_wiz_damage_max + $hand1_staff_option + $hand2_staff_option + $equipment_damage_level_20 + $equipment_h_max_dmg);
if($damage_wiz_min_total>$damage_wiz_max_total)
$damage_wiz_min_total = $damage_wiz_max_total;
if($hand1_staff_rise>$hand2_staff_rise)
$staff_rise_final = $hand1_staff_rise;
else
$staff_rise_final = $hand2_staff_rise;
//////////////////////////////final stats end//////////////////////////////////////
//////////////////////////////loading all stats into php session//////////////////////////////////////
if(isset($set_player_stats)){
$_SESSION['player_stats']['player_class'] = $player_class;
$_SESSION['player_stats']['player_level'] = $player_level;
$_SESSION['player_stats']['player_exp_cur'] = $player_experience;
$_SESSION['player_stats']['player_exp_tmp'] = 0;
$_SESSION['player_stats']['player_exp_percent'] = 100;
$_SESSION['player_stats']['player_monsters'] = $player_monsters;
$_SESSION['player_stats']['player_strength'] = $player_strength; //required for overlib in the battle
$_SESSION['player_stats']['player_agility'] = $player_agility; //required for overlib in the battle
$_SESSION['player_stats']['player_energy'] = $player_energy; //required to calculate skill damage
$_SESSION['player_stats']['equipment_luck'] = $equipment_luck*5; //percents of luck
$_SESSION['player_stats']['equipment_excellent'] = $equipment_excellent; //percents of excellent rate
$_SESSION['player_stats']['equipment_reflect'] = $equipment_reflect; //percents of damage reflect
$_SESSION['player_stats']['equipment_hp_regeneration'] = $equipment_hp_regeneration;
$_SESSION['player_stats']['equipment_h_critical_inc'] = $equipment_h_critical_inc;
$_SESSION['player_stats']['equipment_h_skill_inc'] = $equipment_h_skill_inc;
$_SESSION['player_stats']['player_hp_cur'] = $player_hp_cur;
$_SESSION['player_stats']['player_hp_final'] = $player_hp_final;
$_SESSION['player_stats']['player_mp_cur'] = $player_mp_cur;
$_SESSION['player_stats']['player_mp_final'] = $player_mp_final;
$_SESSION['player_stats']['damage_min_total'] = $damage_min_total;
$_SESSION['player_stats']['damage_max_total'] = $damage_max_total;
$_SESSION['player_stats']['damage_bonus'] = $damage_bonus;
$_SESSION['player_stats']['damage_rate_total'] = $player_damage_rate;
$_SESSION['player_stats']['damage_absorb_value'] = $damage_absorb_value;
$_SESSION['player_stats']['damage_absorb_value2'] = $damage_absorb_value2;
$_SESSION['player_stats']['defense_total'] = $defense_total;
$_SESSION['player_stats']['defense_rate_total'] = $defense_rate_total;
$_SESSION['player_stats']['damage_wiz_min_total'] = $damage_wiz_min_total;
$_SESSION['player_stats']['damage_wiz_max_total'] = $damage_wiz_max_total;
$_SESSION['player_stats']['staff_rise_final'] = $staff_rise_final;
$_SESSION['player_stats']['curse_spell_increment'] = $curse_spell_increment;
$_SESSION['player_stats']['battle_hp_potions_elite'] = $battle_hp_potions_elite;
$_SESSION['player_stats']['battle_hp_potions_large'] = $battle_hp_potions_large;
$_SESSION['player_stats']['battle_hp_potions_medium'] = $battle_hp_potions_medium;
$_SESSION['player_stats']['battle_hp_potions_small'] = $battle_hp_potions_small;
$_SESSION['player_stats']['battle_hp_potions_apple'] = $battle_hp_potions_apple;
$_SESSION['player_stats']['battle_mp_potions_elite'] = $battle_mp_potions_elite;
$_SESSION['player_stats']['battle_mp_potions_large'] = $battle_mp_potions_large;
$_SESSION['player_stats']['battle_mp_potions_medium'] = $battle_mp_potions_medium;
$_SESSION['player_stats']['battle_mp_potions_small'] = $battle_mp_potions_small;
$_SESSION['player_stats']['battle_antidotes'] = $battle_antidotes;
$_SESSION['player_stats']['potions_update'] = json_encode(array());
$_SESSION['player_stats']['arrows'] = $arrows;
$_SESSION['player_stats']['zen'] = 0;
$_SESSION['player_stats']['effect'] = 0;
$_SESSION['player_stats']['effect_duration'] = 0;
$current_skills = json_decode($current_skills);
$player_skills = array_merge($equipment_skills,$current_skills);
$_SESSION['player_stats']['player_skills'] = json_encode($player_skills);
$_SESSION['player_stats']['turns'] = 1;
}
//////////////////////////////loading all stats into php session end//////////////////////////////////
?>