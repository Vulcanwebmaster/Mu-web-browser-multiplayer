<?php
if(!isset($targets))
exit('error');
$s = 0;
$main_target = substr($target, 5);
 while($s<count($_SESSION['enemies']) && $targets>1)
 {
  if(!isset($_SESSION['enemies'][$s]['exp']) && $main_target!=$s)
  {
$rand_damage_tmp = mt_rand($damage_skill_min, $damage_skill_max);
$excellent_hit_tmp = 0;
$critical_hit_tmp = 0;
//critical & excellent damage
if($equipment_excellent!=0){
 $tmp = mt_rand(1, 100);
 if($tmp<=$equipment_excellent)
 {
  $rand_damage_tmp = $damage_skill_max + $equipment_h_critical_inc + floor(($damage_skill_max + $equipment_h_critical_inc)*0.2);
  $excellent_hit_tmp = 1;
 }
}
if($equipment_luck!=0 && $excellent_hit_tmp < 1){
 $tmp = mt_rand(1, 100);
 if($tmp<=$equipment_luck)
 {
  $rand_damage_tmp = $damage_skill_max + $equipment_h_critical_inc;
  $critical_hit_tmp = 1;
 }
}
//////////////////////different effects part 2/////////////////////////
  if($_SESSION['player_stats']['effect'] == '53') //greater damage
  $rand_damage_tmp = $rand_damage_tmp + floor(3+$player_energy/7);
  if($_SESSION['player_stats']['effect'] == '74') //berserker part 1
  $rand_damage_tmp = $rand_damage_tmp + floor(30+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '75') //weakness
  $rand_damage_tmp = $rand_damage_tmp - floor(20+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '48' && $damage_wiz_max_total>0) //wizardry enhance ???
  $rand_damage_tmp = $rand_damage_tmp + floor($rand_damage_tmp*floor(20+$player_energy/100)/100);
//////////////////////different effects part 2 end/////////////////////
  $rand_damage_tmp += $equipment_h_skill_inc;
  $enemy_defense = $_SESSION['enemies'][$s]['defense'];
  $enemy_defense_rate = $_SESSION['enemies'][$s]['defense_rate'];
  if($_SESSION['enemies'][$s]['effect'] == '52') //greater defense
  $enemy_defense = $enemy_defense + floor(2+$player_energy/8);
  if($_SESSION['enemies'][$s]['effect'] == '74') //berserker part 2
  $enemy_defense = $enemy_defense - floor(10+$player_energy/20);
  if($_SESSION['enemies'][$s]['effect'] == '77') //innovation
  $enemy_defense = $enemy_defense - floor(20+$player_energy/20);
  if($enemy_defense<1)
  $enemy_defense = 0;
  $rand_damage_tmp = $rand_damage_tmp - $enemy_defense; //substracting defense
  $damage_bonus = floor($rand_damage_tmp*$damage_bonus/100);
  $rand_damage_tmp = $rand_damage_tmp + $damage_bonus;
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '8') //defense skill
  $rand_damage_tmp = ceil($rand_damage_tmp/2);
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '71') //was sleeping - wake up
  {
   $_SESSION['enemies'][substr($target, 5)]['effect'] = 0;
   $_SESSION['enemies'][substr($target, 5)]['effect_duration'] = 0;
  }
  if($rand_damage_tmp<1)
  $rand_damage_tmp = 1; // minimum = 1
 //calculating chance to miss
  $chance_to_miss = floor($enemy_defense_rate/$damage_rate_total*50);
  if($chance_to_miss<5)
  $chance_to_miss = 5; //minimum = 5
  if($chance_to_miss>95)
  $chance_to_miss = 95; //maximum = 95
  $tmp = mt_rand(1, 100);
  if($tmp<=$chance_to_miss)
  $rand_damage_tmp = 'miss';
  $action_result = 'miss';
if(is_numeric($rand_damage_tmp))
{
  $_SESSION['enemies'][$s]['hp_cur'] -=$rand_damage_tmp;
 if($excellent_hit_tmp!=0)
  $action_result = 'dmg '.$rand_damage_tmp.' [exc]';
 else if($critical_hit_tmp!=0)
  $action_result = 'dmg '.$rand_damage_tmp.' [crt]';
 else
  $action_result = 'dmg '.$rand_damage_tmp;
}
  $_SESSION['player_stats']['battle_report'] = $_SESSION['player_stats']['battle_report'].'add trg: enemy'.$s.': '.$action_result.'<br/>';
  $targets -=1;
  }
  $s++;
 }
?>