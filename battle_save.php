<?php
session_start();
if(!isset($_SESSION['user_id']))
{
 header("Location: ucp.php?action=login");
 exit();
}
else if($_SESSION['char_id']=='0')
{
 header("Location: character.php");
 exit();
}
if(!isset($_GET['action']) || !isset($_GET['save']) || !isset($_GET['map']) || !isset($_GET['spot']))
exit('error');
$action = $_GET['action'];
$save = $_GET['save'];
$map = $_GET['map'];
$spot = $_GET['spot'];
$user_id = $_SESSION['user_id'];
include("database.php");
global $conn;
$char_id = $_SESSION['char_id'];
$query = "SELECT level, inventory, equipment FROM characters WHERE id='$char_id'";
$result = mysql_query($query,$conn);
$dbarray = mysql_fetch_array($result);
$player_level = $dbarray[0];
$current_inventory = $dbarray[1];
$current_equipment = $dbarray[2];
////////////////////saving zen/////////////////////////////
if($_SESSION['player_stats']['zen']>0)
{
 $add_zen = $_SESSION['player_stats']['zen'];
 $query = "UPDATE users SET zen=zen+'$add_zen' WHERE id='$user_id'";
 if(!mysql_query($query, $conn))
 exit('mysql_error');
}
////////////////////saving zen end/////////////////////////
////////////////////arrows/////////////////////////////
if($_SESSION['player_stats']['arrows']!=-10)
{
 $current_equipment = json_decode($current_equipment);
 if($_SESSION['player_stats']['arrows']<1) //delete
  $current_equipment[6] = 0;
 else
 {
  $arrows_left = str_pad($_SESSION['player_stats']['arrows'], 3, "0", STR_PAD_LEFT);
  $new_item_code = substr_replace($current_equipment[6], $arrows_left, 42, 3);
  $current_equipment[6] = $new_item_code;
 }
  $current_equipment = json_encode($current_equipment);
}
////////////////////arrows end/////////////////////////
////////////////////update potions/////////////////////////
$potions_update = json_decode($_SESSION['player_stats']['potions_update']);
if(count($potions_update)>0) //increased in battle_click.php if player uses a potion
{
 $current_inventory = json_decode($current_inventory);
 for($i=0; $i<count($potions_update); $i++)
 {
  $tmp_type = 'F';
  $tmp_sub_type = $potions_update[$i];
  $found = 0;
  $a=0;
  while($a<count($current_inventory) && $found < 1)
  {
   if($current_inventory[$a]!='0' && $current_inventory[$a]!='1')
   {
    $item_type = substr($current_inventory[$a],0,1);
    $item_sub_type = substr($current_inventory[$a],5,1);

    if($tmp_type == $item_type && $tmp_sub_type == $item_sub_type)
    {
    $current_inventory[$a] = 0;
    $found = 1;
    }
   }
   $a++;
  }
 }
$current_inventory = json_encode($current_inventory);
$_SESSION['player_stats']['potions_update'] = json_encode(array()); //reset array for next turn
}
////////////////////update potions end/////////////////////////
////////////////////hp/mp regeneration/////////////////////////
$hp_restore = ceil($_SESSION['player_stats']['player_hp_final']/100 + ($_SESSION['player_stats']['player_hp_final']/100)*$_SESSION['player_stats']['equipment_hp_regeneration']); //1%, min 1 hp, + % from rings and necklace;
$mp_restore = ceil($_SESSION['player_stats']['player_mp_final']/100); //1%, min 1 hp;
$_SESSION['player_stats']['player_hp_cur'] += $hp_restore;
if($_SESSION['player_stats']['player_hp_cur'] > $_SESSION['player_stats']['player_hp_final'])
$_SESSION['player_stats']['player_hp_cur'] = $_SESSION['player_stats']['player_hp_final'];

$_SESSION['player_stats']['player_mp_cur'] += $mp_restore;
if($_SESSION['player_stats']['player_mp_cur'] > $_SESSION['player_stats']['player_mp_final'])
$_SESSION['player_stats']['player_mp_cur'] = $_SESSION['player_stats']['player_mp_final'];
////////////////////hp/mp regeneration end/////////////////////////
$add_levels = 0;
$new_exp = $_SESSION['player_stats']['player_exp_cur'];
$new_monsters = $_SESSION['player_stats']['player_monsters'];
if($player_level<$_SESSION['player_stats']['player_level'])
$add_levels = $_SESSION['player_stats']['player_level'] - $player_level;
$new_hp = $_SESSION['player_stats']['player_hp_cur'];
$new_mp = $_SESSION['player_stats']['player_mp_cur'];
if($new_hp<1)
{
 $defeat = 1;
 $new_hp = 1;
}
if(!isset($defeat))
$_SESSION['player_stats']['battle_report'] = 'ready';
if(count($potions_update)>0 && $_SESSION['player_stats']['arrows']!=-10)
$query = "UPDATE characters SET level=level+'$add_levels', points=points+('$add_levels'*5), hp_cur='$new_hp', mp_cur='$new_mp', experience='$new_exp', inventory='$current_inventory', equipment='$current_equipment', monsters='$new_monsters' WHERE id='$char_id'";
else if(count($potions_update)>0)
$query = "UPDATE characters SET level=level+'$add_levels', points=points+('$add_levels'*5), hp_cur='$new_hp', mp_cur='$new_mp', experience='$new_exp', inventory='$current_inventory', monsters='$new_monsters' WHERE id='$char_id'";
else if($_SESSION['player_stats']['arrows']!=-10)
$query = "UPDATE characters SET level=level+'$add_levels', points=points+('$add_levels'*5), hp_cur='$new_hp', mp_cur='$new_mp', experience='$new_exp', equipment='$current_equipment', monsters='$new_monsters' WHERE id='$char_id'";
else
$query = "UPDATE characters SET level=level+'$add_levels', points=points+('$add_levels'*5), hp_cur='$new_hp', mp_cur='$new_mp', experience='$new_exp', monsters='$new_monsters' WHERE id='$char_id'";
if(!mysql_query($query, $conn))
exit('mysql_error');
else
{
 if(isset($defeat))
 {
  header('Location: battle_insert.php?map='.$map.'&spot='.$spot.'&action='.$action);
 }
 else if($save == 'save')
 {
//////////////////////////////KS rates/////////////////////////////////
$exp_tmp = ceil($_SESSION['player_stats']['player_exp_tmp'] / $_SESSION['player_stats']['turns']);
$player_name = $_SESSION['player_stats']['player_name'];
$new_time = time();
$sql = "UPDATE online SET time='$new_time', exp='$exp_tmp' WHERE char_name='$player_name'";
if(!mysql_query($sql, $conn))
exit('mysql_error');
//////////////////////////////KS rates end/////////////////////////////////
  unset($_SESSION['enemies']);
  header('Location: battle_insert.php?map='.$map.'&spot='.$spot.'&action='.$action);
 }
 else
 {
  unset($_SESSION['enemies']);
  unset($_SESSION['player_stats']);
  echo '<script type="text/javascript">window.top.location.href = "map.php";</script>';
  exit();
 }
}
?>