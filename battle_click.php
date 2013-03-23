<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['action']) || !isset($_GET['target']) || !isset($_GET['map']) || !isset($_GET['spot']))
exit('error');
$action = $_GET['action'];
$target = $_GET['target'];
$map = $_GET['map'];
$spot = $_GET['spot'];
if($target!='enemy0' && $target!='enemy1' && $target!='enemy2' && $target!='enemy3' && $target!='enemy4' && $target!='player')
exit('error');
if($target!='player' && !isset($_SESSION['enemies'][substr($target, 5)]))
exit('error');
if($target!='player' && isset($_SESSION['enemies'][substr($target, 5)]['exp']))
exit('error'); //no attacking dead enemies
if($_SESSION['player_stats']['player_hp_cur']<1) //defeated
{
 echo '<script type="text/javascript">window.top.location.href = "ucp.php?action=defeat";</script>';
 //header('Location: ucp.php?action=defeat');
 exit();
}
/////////////////////////restoring data from session////////////////////////////
$player_level = $_SESSION['player_stats']['player_level'];
$player_experience = $_SESSION['player_stats']['player_exp_cur'];
$player_energy = $_SESSION['player_stats']['player_energy'];
$equipment_luck = $_SESSION['player_stats']['equipment_luck'];
$equipment_excellent = $_SESSION['player_stats']['equipment_excellent'];
$equipment_reflect = $_SESSION['player_stats']['equipment_reflect'];
$equipment_h_critical_inc = $_SESSION['player_stats']['equipment_h_critical_inc'];
$equipment_h_skill_inc = $_SESSION['player_stats']['equipment_h_skill_inc'];
$player_hp_cur = $_SESSION['player_stats']['player_hp_cur'];
$player_hp_final = $_SESSION['player_stats']['player_hp_final'];
if($_SESSION['player_stats']['effect'] == '23')
{
 $hp_raise = 0; //greater fortitude
 $hp_raise = floor($_SESSION['player_stats']['player_hp_final']*floor(12 + $_SESSION['player_stats']['player_energy']/20)/100);
 $player_hp_final += $hp_raise;
}
if($_SESSION['player_stats']['player_hp_cur']>$player_hp_final)
$_SESSION['player_stats']['player_hp_cur'] = $player_hp_final; //fixing hp if greater fortitude ended...
$player_mp_cur = $_SESSION['player_stats']['player_mp_cur'];
$player_mp_final = $_SESSION['player_stats']['player_mp_final'];
$damage_min_total = $_SESSION['player_stats']['damage_min_total'];
$damage_max_total = $_SESSION['player_stats']['damage_max_total'];
$damage_bonus = $_SESSION['player_stats']['damage_bonus'];
$damage_rate_total = $_SESSION['player_stats']['damage_rate_total'];
$damage_absorb_value = $_SESSION['player_stats']['damage_absorb_value'];
$damage_absorb_value2 = $_SESSION['player_stats']['damage_absorb_value2'];
$defense_total = $_SESSION['player_stats']['defense_total'];
$defense_rate_total = $_SESSION['player_stats']['defense_rate_total'];
$damage_wiz_min_total = $_SESSION['player_stats']['damage_wiz_min_total'];
$damage_wiz_max_total = $_SESSION['player_stats']['damage_wiz_max_total'];
$staff_rise_final = $_SESSION['player_stats']['staff_rise_final'];
$curse_spell_increment = $_SESSION['player_stats']['curse_spell_increment'];
$battle_hp_potions = $_SESSION['player_stats']['battle_hp_potions_elite']+$_SESSION['player_stats']['battle_hp_potions_large']+$_SESSION['player_stats']['battle_hp_potions_medium']+$_SESSION['player_stats']['battle_hp_potions_small']+$_SESSION['player_stats']['battle_hp_potions_apple'];
$battle_mp_potions = $_SESSION['player_stats']['battle_mp_potions_elite']+$_SESSION['player_stats']['battle_mp_potions_large']+$_SESSION['player_stats']['battle_mp_potions_medium']+$_SESSION['player_stats']['battle_mp_potions_small'];
$battle_antidotes = $_SESSION['player_stats']['battle_antidotes'];
$arrows = $_SESSION['player_stats']['arrows'];
$player_effect = $_SESSION['player_stats']['effect'];
$player_effect_duration = $_SESSION['player_stats']['effect_duration'];
$player_skills = $_SESSION['player_stats']['player_skills'];
/////////////////////////restoring data from session end////////////////////////////
$_SESSION['player_stats']['turns'] += 1;
$action_result = 'error';
$potions_update = json_decode($_SESSION['player_stats']['potions_update']);
/////////////////////////action = potion_hp////////////////////////////
if($action == 'potion_hp')
{
 if($battle_hp_potions>0)
 {
//what potion to use
$item_effect = 0;
if($_SESSION['player_stats']['battle_hp_potions_elite']>0){
 $_SESSION['player_stats']['battle_hp_potions_elite']-=1;
 $item_effect = 100;
 array_push($potions_update,'5');
}
else if($_SESSION['player_stats']['battle_hp_potions_large']>0){
 $_SESSION['player_stats']['battle_hp_potions_large']-=1;
 $item_effect = 40;
 array_push($potions_update,'4');
}
else if($_SESSION['player_stats']['battle_hp_potions_medium']>0){
 $_SESSION['player_stats']['battle_hp_potions_medium']-=1;
 $item_effect = 30;
 array_push($potions_update,'3');
}
else if($_SESSION['player_stats']['battle_hp_potions_small']>0){
 $_SESSION['player_stats']['battle_hp_potions_small']-=1;
 $item_effect = 20;
 array_push($potions_update,'2');
}
else if($_SESSION['player_stats']['battle_hp_potions_apple']>0){
 $_SESSION['player_stats']['battle_hp_potions_apple']-=1;
 $item_effect = 10;
 array_push($potions_update,'1');
}
if($target == 'player')
{
 $potion_value = floor($player_hp_final*$item_effect/100); // how much HP to restore
 $player_hp_cur+=$potion_value;
 if($player_hp_cur>$player_hp_final)
 $player_hp_cur = $player_hp_final;
 $_SESSION['player_stats']['player_hp_cur'] = $player_hp_cur;
}
else
{
 $enemy_hp = $_SESSION['enemies'][substr($target, 5)]['hp'];
 $enemy_hp_cur = $_SESSION['enemies'][substr($target, 5)]['hp_cur'];
 $potion_value = floor($enemy_hp*$item_effect/100); // how much HP to restore
 $enemy_hp_cur+=$potion_value;
 if($enemy_hp_cur>$enemy_hp)
 $enemy_hp_cur = $enemy_hp;
 $_SESSION['enemies'][substr($target, 5)]['hp_cur'] = $enemy_hp_cur;
}
 $_SESSION['player_stats']['potions_update'] = 1;
 $action_result = 'heal '.$potion_value;
 }
 else
 {
  $action_result = 'no hp potion';
 }
}
/////////////////////////action = potion_hp end////////////////////////////
/////////////////////////action = potion_mp////////////////////////////
else if($action == 'potion_mp')
{
 if($battle_mp_potions>0)
 {
//what potion to use
$item_effect = 0;
if($_SESSION['player_stats']['battle_mp_potions_elite']>0){
 $_SESSION['player_stats']['battle_mp_potions_elite']-=1;
 $item_effect = 100;
 array_push($potions_update,'9');
}
else if($_SESSION['player_stats']['battle_mp_potions_large']>0){
 $_SESSION['player_stats']['battle_mp_potions_large']-=1;
 $item_effect = 40;
 array_push($potions_update,'8');
}
else if($_SESSION['player_stats']['battle_mp_potions_medium']>0){
 $_SESSION['player_stats']['battle_mp_potions_medium']-=1;
 $item_effect = 30;
 array_push($potions_update,'7');
}
else if($_SESSION['player_stats']['battle_mp_potions_small']>0){
 $_SESSION['player_stats']['battle_mp_potions_small']-=1;
 $item_effect = 20;
 array_push($potions_update,'6');
}
if($target == 'player')
{
 $potion_value = floor($player_mp_final*$item_effect/100); // how much MP to restore
 $player_mp_cur+=$potion_value;
 if($player_mp_cur>$player_mp_final)
 $player_mp_cur = $player_mp_final;
 $_SESSION['player_stats']['player_mp_cur'] = $player_mp_cur;
}
else
{
 $potion_value = 'miss'; // can't restore enemy's mp
}
 $action_result = 'mana '.$potion_value;
 }
 else
 {
  $action_result = 'no mp potion';
 }
}
/////////////////////////action = potion_mp end///////////////////////////
/////////////////////////action = antidote////////////////////////////
else if($action == 'antidote')
{
 if($battle_antidotes>0)
 {
 //there should be code for actually using antidote

if($target == 'player')
{
 $_SESSION['player_stats']['effect_duration'] = 0;
 $_SESSION['player_stats']['effect'] = 0;
}
else
{
 $_SESSION['enemies'][substr($target, 5)]['effect'] = 0;
 $_SESSION['enemies'][substr($target, 5)]['effect_duration'] = 0;
}
 $_SESSION['player_stats']['battle_antidotes']-=1;
 array_push($potions_update,'A');
 $action_result = 'antidote';
 }
 else
 {
  $action_result = 'no antidotes';
 }
}
/////////////////////////action = antidote end////////////////////////////
/////////////////////////action = elf heal////////////////////////////
else if($action == 'skill51')
{
if($player_mp_cur>=20)
{
 $_SESSION['player_stats']['player_mp_cur']-=20;
 $hp_to_restore = 5 + floor($player_energy/5);
 $action_result = 'heal '.$hp_to_restore;
if($target == 'player')
{
 $player_hp_cur+=$hp_to_restore;
 if($player_hp_cur>$player_hp_final)
 $player_hp_cur = $player_hp_final;
 $_SESSION['player_stats']['player_hp_cur'] = $player_hp_cur;
}
else
{
 $enemy_hp = $_SESSION['enemies'][substr($target, 5)]['hp'];
 $enemy_hp_cur = $_SESSION['enemies'][substr($target, 5)]['hp_cur'];
 $enemy_hp_cur+=$hp_to_restore;
 if($enemy_hp_cur>$enemy_hp)
 $enemy_hp_cur = $enemy_hp;
 $_SESSION['enemies'][substr($target, 5)]['hp_cur'] = $enemy_hp_cur;
}
 }
 else
 {
  $action_result = 'no mp';
 }
}
/////////////////////////action = elf heal end////////////////////////////
/////////////////////////action = attack/skill////////////////////////////
else
{
 if($action!='attack')
 {
  $player_skills = json_decode($player_skills); //checking if the character knows this skill
  if(!in_array(substr($action,5),$player_skills))
  exit('wrong skill id');
 }
$targets = 1;
$mp_used = 0;
$damage_skill_max = 0;
$damage_skill_min = 0;
$effect = 0;
$effect_duration = 0;
$excellent_hit = 0;
$critical_hit = 0;
 switch($action)
 {
  case 'attack':
  $damage_skill_max = $damage_max_total;
  $damage_skill_min = $damage_min_total;
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  break;
  case 'skill1': //Plasma Storm
  $damage_skill_max = 250 + floor($player_energy/10);
  $damage_skill_min = floor($damage_skill_max*5/6);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 50;
  $targets = 3;
  break;
  case 'skill2': //Raid
  $damage_skill_max = 200 + floor($player_energy/10);
  $damage_skill_min = floor($damage_skill_max*5/6);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 9;
  break;
  case 'skill3':
  case 'skill4':
  case 'skill5':
  case 'skill6':
  case 'skill7':
  $damage_skill_max = $damage_max_total + 40 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 20 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 10;
  break;
  case 'skill8': //Defense
  $effect = 8;
  $effect_duration = 3;
  $mp_used = 30;
  break;
  case 'skill9': //Triple Shot
  $damage_skill_max = $damage_max_total;
  $damage_skill_min = $damage_min_total;
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 5;
  $targets = 3;
  break;
  case 'skillA': //Explosion
  $damage_skill_max = $damage_wiz_max_total + 110 + floor(($damage_wiz_max_total + 110)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 80 + floor(($damage_wiz_min_total + 80)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 90;
  break;
  case 'skillB': //Requiem
  $damage_skill_max = $damage_wiz_max_total + 100 + floor(($damage_wiz_max_total + 100)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 70 + floor(($damage_wiz_min_total + 70)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 100;
  $targets = 3;
  break;
  case 'skillC': //Pollution
  $damage_skill_max = $damage_wiz_max_total + 120 + floor(($damage_wiz_max_total + 120)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 90 + floor(($damage_wiz_min_total + 90)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 120;
  $targets = 3;
  break;
  case 'skillD': //Power Slash
  $damage_skill_max = $damage_max_total + 40 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 20 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 10;
  break;
  case 'skill21': //Impale
  $damage_skill_max = $damage_max_total + 120 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 70 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 8;
  break;
  case 'skill22': //Twisting Slash
  $damage_skill_max = $damage_max_total + 110 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 60 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 10;
  $targets = 3;
  break;
  case 'skill23': //Greater Fortitude
  $effect = 23;
  $effect_duration = 20;
  $mp_used = 22;
  break;
  case 'skill24': //Death Stab
  $damage_skill_max = $damage_max_total + 140 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 85 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 15;
  break;
  case 'skill25': //Rageful Blow
  $damage_skill_max = $damage_max_total + 120 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 70 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 25;
  $targets = 3;
  break;
  case 'skill26': //Explosion
  $damage_skill_max = $damage_max_total + 135 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 90 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 30;
  $targets = 3;
  break;
  case 'skill27': //Fire Slash
  $damage_skill_max = $damage_max_total + 20 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 10 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 15;
  break;
  case 'skill28': //Flame Strike
  $damage_skill_max = $damage_max_total + 30 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 20 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 20;
  $targets = 3;
  break;
  case 'skill29': //Gigantic Storm
  $damage_skill_max = $damage_max_total + 120 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 80 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 190;
  $targets = 3;
  break;
  case 'skill30': //Energy Ball
  $damage_skill_max = $damage_wiz_max_total + 4 + floor(($damage_wiz_max_total + 4)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 3 + floor(($damage_wiz_min_total + 3)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 1;
  break;
  case 'skill31': //Fire Ball
  $damage_skill_max = $damage_wiz_max_total + 12 + floor(($damage_wiz_max_total + 12)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 8 + floor(($damage_wiz_min_total + 8)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 3;
  break;
  case 'skill32': //Power Wave
  $damage_skill_max = $damage_wiz_max_total + 21 + floor(($damage_wiz_max_total + 21)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 14 + floor(($damage_wiz_min_total + 14)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 5;
  break;
  case 'skill33': //Meteor
  $damage_skill_max = $damage_wiz_max_total + 31 + floor(($damage_wiz_max_total + 31)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 21 + floor(($damage_wiz_min_total + 21)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 12;
  break;
  case 'skill34': //Lighting
  $damage_skill_max = $damage_wiz_max_total + 25 + floor(($damage_wiz_max_total + 25)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 17 + floor(($damage_wiz_min_total + 17)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 15;
  break;
  case 'skill35': //Ice
  $damage_skill_max = $damage_wiz_max_total + 15 + floor(($damage_wiz_max_total + 15)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 10 + floor(($damage_wiz_min_total + 10)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 38;
  break;
  case 'skill36': //Poison
  $damage_skill_max = $damage_wiz_max_total + 18 + floor(($damage_wiz_max_total + 18)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 12 + floor(($damage_wiz_min_total + 12)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $effect = 36;
  $effect_duration = 5;
  $mp_used = 42;
  break;
  case 'skill37': //Flame
  $damage_skill_max = $damage_wiz_max_total + 37 + floor(($damage_wiz_max_total + 37)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 25 + floor(($damage_wiz_min_total + 25)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 50;
  break;
  case 'skill38': //Twister
  $damage_skill_max = $damage_wiz_max_total + 52 + floor(($damage_wiz_max_total + 52)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 35 + floor(($damage_wiz_min_total + 35)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 60;
  break;
  case 'skill39': //Evil Spirits
  $damage_skill_max = $damage_wiz_max_total + 67 + floor(($damage_wiz_max_total + 67)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 45 + floor(($damage_wiz_min_total + 45)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 90;
  $targets = 3;
  break;
  case 'skill40': //Hellfire
  $damage_skill_max = $damage_wiz_max_total + 180 + floor(($damage_wiz_max_total + 180)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 120 + floor(($damage_wiz_min_total + 120)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 160;
  $targets = 3;
  break;
  case 'skill41': //Aquabeam
  $damage_skill_max = $damage_wiz_max_total + 120 + floor(($damage_wiz_max_total + 120)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 80 + floor(($damage_wiz_min_total + 80)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 140;
  break;
  case 'skill42': //Soul Barrier
  $effect = 42;
  $effect_duration = 20;
  $mp_used = 70;
  break;
  case 'skill44': //Inferno
  $damage_skill_max = $damage_wiz_max_total + 150 + floor(($damage_wiz_max_total + 150)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 100 + floor(($damage_wiz_min_total + 100)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 200;
  $targets = 3;
  break;
  case 'skill45': //Ice Storm
  $damage_skill_max = $damage_wiz_max_total + 120 + floor(($damage_wiz_max_total + 120)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 80 + floor(($damage_wiz_min_total + 80)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 100;
  $targets = 3;
  break;
  case 'skill46': //Decay
  $damage_skill_max = $damage_wiz_max_total + 142 + floor(($damage_wiz_max_total + 142)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 95 + floor(($damage_wiz_min_total + 95)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 110;
  break;
  case 'skill47': //Nova
  $damage_skill_max = $damage_wiz_max_total + 250 + floor(($damage_wiz_max_total + 250)*$staff_rise_final/100);
  $damage_skill_min = $damage_wiz_min_total + 200 + floor(($damage_wiz_min_total + 200)*$staff_rise_final/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 180;
  $targets = 3;
  break;
  case 'skill48': //Wizardry Enhance
  $effect = 48;
  $effect_duration = 20;
  $mp_used = 200;
  break;
  case 'skill52': //Greater Defense
  $effect = 52;
  $effect_duration = 20;
  $mp_used = 30;
  break;
  case 'skill53': //Greater Damage
  $effect = 53;
  $effect_duration = 20;
  $mp_used = 40;
  break;
  case 'skill54': //Penetration
  $damage_skill_max = $damage_max_total + 218 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 144 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 7;
  break;
  case 'skill55': //Ice Arrow
  $damage_skill_max = $damage_max_total + 322 + floor($player_energy/10);
  $damage_skill_min = $damage_min_total + 204 + floor($player_energy/10);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 10;
  break;
  case 'skill56': //Multi Shot
  $damage_skill_max = $damage_max_total;
  $damage_skill_min = $damage_min_total;
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 10;
  $targets = 3;
  break;
//elf summon skills should go here
  case 'skill70': //Drain Life
  $damage_skill_max = $damage_wiz_max_total + 52 + floor(($damage_wiz_max_total + 52)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 35 + floor(($damage_wiz_min_total + 35)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 50;
  break;
  case 'skill71': //Sleep
  $effect = 71;
  $effect_duration = 5;
  $mp_used = 20;
  break;
  case 'skill72': //Chain Lighting
  $damage_skill_max = $damage_wiz_max_total + 105 + floor(($damage_wiz_max_total + 105)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 70 + floor(($damage_wiz_min_total + 70)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 50;
  break;
  case 'skill73': //Damage Reflection
  $effect = 73;
  $effect_duration = 20;
  $mp_used = 40;
  break;
  case 'skill74': //Berserker
  $effect = 74;
  $effect_duration = 20;
  $mp_used = 100;
  break;
  case 'skill75': //Weakness
  $effect = 75;
  $effect_duration = 20;
  $mp_used = 50;
  break;
  case 'skill76': //Lighting Shock
  $damage_skill_max = $damage_wiz_max_total + 142 + floor(($damage_wiz_max_total + 142)*$curse_spell_increment/100);
  $damage_skill_min = $damage_wiz_min_total + 95 + floor(($damage_wiz_min_total + 95)*$curse_spell_increment/100);
  $rand_damage = mt_rand($damage_skill_min, $damage_skill_max);
  $mp_used = 120;
  $targets = 3;
  break;
  case 'skill77': //Innovation
  $effect = 77;
  $effect_duration = 20;
  $mp_used = 70;
  break;
 default:
 $mp_used = 9999;
 }
//if arrows are equipped (not equal to "-10") check if there is at least one arrow
if($arrows!=-10 && $arrows <1)
$mp_used = 9998; //error code for "no arrows"
//critical & excellent damage
if($equipment_excellent!=0)
{
 $tmp = mt_rand(1, 100);
 if($tmp<=$equipment_excellent)
 {
  $rand_damage = $damage_skill_max + $equipment_h_critical_inc + floor(($damage_skill_max + $equipment_h_critical_inc)*0.2);
  $excellent_hit = 1;
 }
}
if($equipment_luck!=0 && $excellent_hit < 1)
{
 $tmp = mt_rand(1, 100);
 if($tmp<=$equipment_luck)
 {
  $rand_damage = $damage_skill_max + $equipment_h_critical_inc;
  $critical_hit = 1;
 }
}
//////////////////////different effects part 2/////////////////////////
  if($_SESSION['player_stats']['effect'] == '53') //greater damage
  $rand_damage = $rand_damage + floor(3+$player_energy/7);
  if($_SESSION['player_stats']['effect'] == '74') //berserker part 1
  $rand_damage = $rand_damage + floor(30+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '75') //weakness
  $rand_damage = $rand_damage - floor(20+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '48' && $damage_wiz_max_total>0) //wizardry enhance ???
  $rand_damage = $rand_damage + floor($rand_damage*floor(20+$player_energy/100)/100);
//////////////////////different effects part 2 end/////////////////////
if($player_mp_cur>=$mp_used)
{
 $_SESSION['player_stats']['player_mp_cur']-=$mp_used;
 if($target == 'player')
 {
  if($action!='attack')
  $rand_damage += $equipment_h_skill_inc;
  if($_SESSION['player_stats']['effect'] == '52') //greater defense
  $defense_total = $defense_total + floor(2+$player_energy/8);
  if($_SESSION['player_stats']['effect'] == '74') //berserker part 2
  $defense_total = $defense_total - floor(10+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '77') //innovation
  $defense_total = $defense_total - floor(20+$player_energy/20);
  if($defense_total<1)
  $defense_total = 0;
  $rand_damage = $rand_damage - $defense_total; //substracting defense
  $damage_bonus = floor($rand_damage*$damage_bonus/100);
  $rand_damage = $rand_damage + $damage_bonus;
  $damage_absorb_value = floor($rand_damage*$damage_absorb_value/100);
  $rand_damage = $rand_damage - $damage_absorb_value; //substracting damage absorb
  $damage_absorb_value2 = floor($rand_damage*$damage_absorb_value2/100);
  $rand_damage = $rand_damage - $damage_absorb_value2; //substracting damage decrease
  if($_SESSION['player_stats']['effect'] == '8') //defense skill
  $rand_damage = ceil($rand_damage/2);
  if($_SESSION['player_stats']['effect'] == '42') //soul barrier
  {
   $soul_barrier_percent = floor(10+$player_energy/100);
   $soul_barrier_value = floor($rand_damage*$soul_barrier_percent/100);
   if($soul_barrier_value>0)
   {
    $rand_damage -= $soul_barrier_value;
    $_SESSION['player_stats']['player_mp_cur']-=$soul_barrier_value;
   }
  }
  if($rand_damage<1)
  $rand_damage = 1; // minimum = 1
 //calculating chance to miss - never miss if player attacks himself, unless special cases:
  if($effect == '71')
  $rand_damage = 'miss'; //always miss if used on player: sleep, reflect (too difficult to calculate, no sense)
  $action_result = 'miss';
 }
 else //if target == enemy...
 {
  if($action!='attack')
  $rand_damage += $equipment_h_skill_inc;
  $enemy_defense = $_SESSION['enemies'][substr($target, 5)]['defense'];
  $enemy_defense_rate = $_SESSION['enemies'][substr($target, 5)]['defense_rate'];
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '52') //greater defense
  $enemy_defense = $enemy_defense + floor(2+$player_energy/8);
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '74') //berserker part 2
  $enemy_defense = $enemy_defense - floor(10+$player_energy/20);
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '77') //innovation
  $enemy_defense = $enemy_defense - floor(20+$player_energy/20);
  if($enemy_defense<1)
  $enemy_defense = 0;
  $rand_damage = $rand_damage - $enemy_defense; //substracting defense
  $damage_bonus = floor($rand_damage*$damage_bonus/100);
  $rand_damage = $rand_damage + $damage_bonus;
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '8') //defense skill
  $rand_damage = ceil($rand_damage/2);
  if($_SESSION['enemies'][substr($target, 5)]['effect'] == '71') //was sleeping - wake up
  {
   $_SESSION['enemies'][substr($target, 5)]['effect'] = 0;
   $_SESSION['enemies'][substr($target, 5)]['effect_duration'] = 0;
  }
  if($rand_damage<1)
  $rand_damage = 1; // minimum = 1
 //calculating chance to miss
  $chance_to_miss = floor($enemy_defense_rate/$damage_rate_total*50);
  if($chance_to_miss<5)
  $chance_to_miss = 5; //minimum = 5
  if($chance_to_miss>95)
  $chance_to_miss = 95; //maximum = 95
  $tmp = mt_rand(1, 100);
  if($tmp<=$chance_to_miss)
  $rand_damage = 'miss';
  $action_result = 'miss';
 }
/////////////////////////final stage////////////////////////////
if($damage_skill_max < 1 && is_numeric($rand_damage))                                           //effect only
{
 if($target == 'player')
 {
  $_SESSION['player_stats']['effect'] = $effect;
  $_SESSION['player_stats']['effect_duration'] = $effect_duration+1;
 }
 else
 {
  $_SESSION['enemies'][substr($target, 5)]['effect'] = $effect;
  $_SESSION['enemies'][substr($target, 5)]['effect_duration'] = $effect_duration+1;
 }
 $action_result = 'effect '.$effect;
}
else if($damage_skill_max>0 && $effect_duration>0 && is_numeric($rand_damage))                  //damage + effect (poison)
{
 if($target == 'player')
 {
  $_SESSION['player_stats']['player_hp_cur'] -=$rand_damage;
  $_SESSION['player_stats']['effect'] = $effect;
  $_SESSION['player_stats']['effect_duration'] = $effect_duration+1;
 }
 else
 {
  $_SESSION['enemies'][substr($target, 5)]['hp_cur'] -=$rand_damage;
  $_SESSION['enemies'][substr($target, 5)]['effect'] = $effect;
  $_SESSION['enemies'][substr($target, 5)]['effect_duration'] = $effect_duration+1;
 }
 if($excellent_hit!=0)
  $action_result = 'dmg '.$rand_damage.' [exc]';
 else if($critical_hit!=0)
  $action_result = 'dmg '.$rand_damage.' [crt]';
 else
  $action_result = 'dmg '.$rand_damage;
}
else if(is_numeric($rand_damage))                                                              //damage only
{
 if($target == 'player')
 {
  $_SESSION['player_stats']['player_hp_cur'] -=$rand_damage;
 }
 else
 {
  $_SESSION['enemies'][substr($target, 5)]['hp_cur'] -=$rand_damage;
 }
 if($excellent_hit!=0)
  $action_result = 'dmg '.$rand_damage.' [exc]';
 else if($critical_hit!=0)
  $action_result = 'dmg '.$rand_damage.' [crt]';
 else
  $action_result = 'dmg '.$rand_damage;
//if arrows
 if($arrows>0)
 {
 if($action=='skill9' || $action=='skill56')
 $_SESSION['player_stats']['arrows'] -=3; //triple shot or multi shot
 else
 $_SESSION['player_stats']['arrows'] -=1;
 }
}
/////////////////////////final stage end////////////////////////
}
else
 {
  $targets = 1; //stop multiple targets if error...
  if($mp_used == 9999)
  $action_result = 'error';
  else if($mp_used == 9998)
  $action_result = 'no arrows';
  else
  $action_result = 'no mp';
 }
}
/////////////////////////action = attack/skill end////////////////////////
//////////////////////different effects - fixing defense/////////////////////////
  $defense_total = $_SESSION['player_stats']['defense_total']; //recalculate for enemy turn - possible change if effect was used
  if($_SESSION['player_stats']['effect'] == '52') //greater defense
  $defense_total = $defense_total + floor(2+$player_energy/8);
  if($_SESSION['player_stats']['effect'] == '74') //berserker part 2
  $defense_total = $defense_total - floor(10+$player_energy/20);
  if($_SESSION['player_stats']['effect'] == '77') //innovation
  $defense_total = $defense_total - floor(20+$player_energy/20);
  if($defense_total<1)
  $defense_total = 0;
//////////////////////different effects - fixing defense end/////////////////////
$output = 'player: '.$target.': '.$action_result.'<br/>';
/////////////////////////drain life////////////////////////////
if($action == 'skill70' && $action_result != 'miss' && $action_result != 'no mp')
{
 $player_hp_cur+=$rand_damage; //drain life summoner skill
 if($player_hp_cur>$player_hp_final)
 $player_hp_cur = $player_hp_final;
 $_SESSION['player_stats']['player_hp_cur'] = $player_hp_cur;
 $output = $output.'[drain life: +'.$rand_damage.']<br/>';
}
/////////////////////////drain life end////////////////////////////
/////////////////////////poison////////////////////////////
if($_SESSION['player_stats']['effect'] == '36')
{
 $poison_dmg = floor($player_hp_final/30); //poison = 1/30 of max health
 $_SESSION['player_stats']['player_hp_cur'] -= $poison_dmg;
 $output = $output.'[poison: -'.$poison_dmg.']<br/>';
}
/////////////////////////poison end////////////////////////////
/////////////////////////reflect////////////////////////////
if($target != 'player' && $_SESSION['enemies'][substr($target, 5)]['effect'] == '73' && is_numeric($rand_damage))
{
 $total_reflect = floor(20 + $player_energy/40);
 $reflect_dmg = floor($rand_damage*$total_reflect/100);

 if($reflect_dmg>0)
 {
  $_SESSION['player_stats']['player_hp_cur'] -= $reflect_dmg;
  $output = $output.'[reflect: -'.$reflect_dmg.']<br/>';
 }
}
/////////////////////////reflect end///////////////////////
$_SESSION['player_stats']['battle_report'] = $output;
/////////////////////////multiple targets///////////////////////
if($targets>1 && $target!='player')
include('battle_click_targets.php');
/////////////////////////multiple targets end///////////////////
/////////////////////////enemy turn////////////////////////////
for($i=0; $i<count($_SESSION['enemies']); $i++)
{
 if(isset($_SESSION['enemies'][$i]['exp']) || $_SESSION['enemies'][$i]['effect'] == '71')
 {
  //dead or sleeping?
 }
 else if($_SESSION['enemies'][$i]['hp_cur']>0)
 {
  $enemy_dmg_max = $_SESSION['enemies'][$i]['damage'];
  $enemy_dmg_min = floor($_SESSION['enemies'][$i]['damage']*5/6);
  $enemy_rand_damage = mt_rand($enemy_dmg_min, $enemy_dmg_max);
  if($_SESSION['enemies'][$i]['effect'] == '53') //greater damage
  $enemy_rand_damage = $enemy_rand_damage + floor(3+$player_energy/7);
  if($_SESSION['enemies'][$i]['effect'] == '74') //berserker part 1
  $enemy_rand_damage = $enemy_rand_damage + floor(30+$player_energy/20);
  if($_SESSION['enemies'][$i]['effect'] == '75') //weakness
  $enemy_rand_damage = $enemy_rand_damage - floor(20+$player_energy/20);
  $enemy_rand_damage = $enemy_rand_damage - $defense_total; //substracting defense
  $damage_absorb_value = floor($enemy_rand_damage*$damage_absorb_value/100);
  $enemy_rand_damage = $enemy_rand_damage - $damage_absorb_value; //substracting damage absorb
  $damage_absorb_value2 = floor($enemy_rand_damage*$damage_absorb_value2/100);
  $enemy_rand_damage = $enemy_rand_damage - $damage_absorb_value2; //substracting damage decrease
  if($_SESSION['player_stats']['effect'] == '8') //defense skill
  $enemy_rand_damage = ceil($enemy_rand_damage/2);
  if($_SESSION['player_stats']['effect'] == '42') //soul barrier
  {
   $soul_barrier_percent = floor(10+$player_energy/100);
   $soul_barrier_value = floor($enemy_rand_damage*$soul_barrier_percent/100);
   if($soul_barrier_value>0)
   {
    $enemy_rand_damage -= $soul_barrier_value;
    $_SESSION['player_stats']['player_mp_cur']-=$soul_barrier_value;
   }
  }
  if($enemy_rand_damage<1)
  $enemy_rand_damage = 1; // minimum = 1
 //calculating chance to miss
  $enemy_dmg_rate = $_SESSION['enemies'][$i]['damage_rate'];
  $chance_to_miss = floor($defense_rate_total/$enemy_dmg_rate*50); //% to miss
  if($chance_to_miss<5)
  $chance_to_miss = 5; //minimum = 5
  if($chance_to_miss>95)
  $chance_to_miss = 95; //maximum = 95
  $tmp = mt_rand(1, 100);
  if($tmp<=$chance_to_miss)
  $enemy_rand_damage = 'miss';
  $enemy_action = 'miss';
  if(is_numeric($enemy_rand_damage))
  {
   $_SESSION['player_stats']['player_hp_cur'] -=$enemy_rand_damage;
   $enemy_action = 'dmg '.$enemy_rand_damage;
  }
  $output = 'enemy'.$i.': player: '.$enemy_action.'<br/>';
/////////////////////////poison////////////////////////////
if($_SESSION['enemies'][$i]['effect'] == '36')
{
 $poison_dmg = floor($_SESSION['enemies'][$i]['hp']/30); //poison = 1/30 of max health
 $_SESSION['enemies'][$i]['hp_cur'] -= $poison_dmg;
 $output = $output.'[poison: -'.$poison_dmg.']<br/>';
}
/////////////////////////poison end////////////////////////////
/////////////////////////reflect////////////////////////////
if(($_SESSION['player_stats']['equipment_reflect']>0 || $_SESSION['player_stats']['effect'] == '73') && is_numeric($enemy_rand_damage))
{
 $total_reflect = $_SESSION['player_stats']['equipment_reflect'];
 if($_SESSION['player_stats']['effect'] == '73')
 $total_reflect += floor(20 + $player_energy/40);
 $reflect_dmg = floor($enemy_rand_damage*$total_reflect/100);

 if($reflect_dmg>0)
 {
  $_SESSION['enemies'][$i]['hp_cur'] -= $reflect_dmg;
  $output = $output.'[reflect: -'.$reflect_dmg.']<br/>';
 }
}
/////////////////////////reflect end///////////////////////
  $_SESSION['player_stats']['battle_report'] = $_SESSION['player_stats']['battle_report'].$output;
 }

}
/////////////////////////enemy turn end////////////////////////////
/////////////////////////enemies defeated in this turn////////////////////////////
for($i=0; $i<count($_SESSION['enemies']); $i++)
{
if($_SESSION['enemies'][$i]['hp_cur']<1 && !isset($_SESSION['enemies'][$i]['exp']))
{
 //was defeated in this turn
$exp_min = $_SESSION['enemies'][$i]['level'] + $_SESSION['enemies'][$i]['defense'];
$exp_max = $exp_min*20;
  $_SESSION['enemies'][$i]['exp'] = mt_rand($exp_min,$exp_max);
  $_SESSION['enemies'][$i]['zen'] = floor(mt_rand($_SESSION['enemies'][$i]['exp'],$_SESSION['enemies'][$i]['exp']*0.1)+1)*mt_rand(0,1); //50% of no zen drop
  include('item_generator.php'); // replace 'no item' with an item
  $_SESSION['player_stats']['player_monsters'] +=1; //increase killed monsters stat
 //checking for level up
 $player_exp_next = ($player_level+9)*$player_level*$player_level;
 $_SESSION['player_stats']['player_exp_tmp'] += $_SESSION['enemies'][$i]['exp']; //calculate exp per round for "online" table
$exp_final = $_SESSION['enemies'][$i]['exp']; //if no bonus or penalty, it won't change...
////////////////exp penalty/bonus/////////////////////
if($_SESSION['player_stats']['player_exp_percent']<100)
{
 $exp_penalty = floor($_SESSION['enemies'][$i]['exp']*($_SESSION['player_stats']['player_exp_percent']/100));
 if($exp_penalty == $_SESSION['enemies'][$i]['exp'])
 $exp_penalty -=1;
 if($exp_penalty < 1)
 $exp_penalty = 1;
 $_SESSION['enemies'][$i]['exp'] = $exp_penalty.' (-'.($exp_final-$exp_penalty).')';
 $exp_final = $exp_penalty;
}
else if($_SESSION['player_stats']['player_exp_percent']>100)
{
 $exp_bonus = floor($_SESSION['enemies'][$i]['exp']*($_SESSION['player_stats']['player_exp_percent']/100));
 if($exp_bonus == $_SESSION['enemies'][$i]['exp'])
 $exp_bonus += 1;
 $_SESSION['enemies'][$i]['exp'] = $exp_bonus.' (+'.($exp_bonus - $exp_final).')';
 $exp_final = $exp_bonus;
}
////////////////exp penalty/bonus end/////////////////////
 if(($_SESSION['player_stats']['player_exp_cur']+$exp_final)>=$player_exp_next) //don't allow adding more than one level per kill
 {
  $_SESSION['player_stats']['player_exp_cur'] = $player_exp_next;
  $_SESSION['player_stats']['player_level'] += 1;
  $note = 1;
 }
 else
 {
  $_SESSION['player_stats']['player_exp_cur'] += $exp_final; // no level up, just add experience
 }
 $_SESSION['player_stats']['zen'] += $_SESSION['enemies'][$i]['zen']; // zen always added
}
}
/////////////////////////enemies defeated in this turn end////////////////////////////
/////////////////////////processing effects////////////////////////////
if($_SESSION['player_stats']['effect_duration']>0)
$_SESSION['player_stats']['effect_duration'] -=1;
if($_SESSION['player_stats']['effect_duration']<1) //final turn
$_SESSION['player_stats']['effect'] = 0; //deleting effect
for($i=0; $i<count($_SESSION['enemies']); $i++)
{
 if($_SESSION['enemies'][$i]['effect_duration']>0)
 $_SESSION['enemies'][$i]['effect_duration'] -=1;
 if($_SESSION['enemies'][$i]['effect_duration']<1) //final turn
 $_SESSION['enemies'][$i]['effect'] = 0; //deleting effect
}
/////////////////////////processing effects end////////////////////////////
$_SESSION['player_stats']['potions_update'] = json_encode($potions_update);
if($_SESSION['player_stats']['player_hp_cur']<1) //defeated
{
$player_level_prev = $player_level - 1;
$player_exp_prev = ($player_level_prev+9)*$player_level_prev*$player_level_prev;
$exp_penalty = floor(($_SESSION['player_stats']['player_exp_cur'] - $player_exp_prev)/2);
$_SESSION['player_stats']['player_exp_cur'] -= $exp_penalty; //penalty = half of earned on this level experience
header('Location: battle_save.php?save=save&map='.$map.'&spot='.$spot.'&action='.$action);
}
else if(isset($note))
header('Location: battle_insert.php?note=1&map='.$map.'&spot='.$spot.'&action='.$action);
else
header('Location: battle_insert.php?map='.$map.'&spot='.$spot.'&action='.$action);
?>