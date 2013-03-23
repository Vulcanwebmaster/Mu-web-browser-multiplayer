<?php
session_start();
if(!isset($_SESSION['user_id']))
exit('error');
if(!isset($_GET['id']))
exit('error');
if(!is_numeric($_GET['id']))
exit('error');
$id_clicked = intval($_GET['id']);
if($id_clicked > 82)
exit('error');
//loading inventory & equipment
$user_id = $_SESSION['user_id'];
$char_id = $_SESSION['char_id'];
include("database.php");
global $conn;
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
if($id_clicked<70)
{
if(!isset($current_inventory[$id_clicked]))
exit('error');
if($current_inventory[$id_clicked]=='0' && $current_inventory[$id_clicked]=='1')
exit('error');
}
if($id_clicked>69 && $id_clicked<82)
{
if(!isset($current_equipment[$id_clicked]))
exit('error1');
if($current_equipment[$id_clicked]=='0' && $current_equipment[$id_clicked]=='1')
exit('error');
}
if($id_clicked<70)
 $item_to_sell = $current_inventory[$id_clicked];
else
 $item_to_sell = $current_equipment[$id_clicked];
include('function.common.php');
parse_item_code($item_to_sell);
 if($item_type=='C' || $item_type=='D' || $item_type=='E')
 $bonus_price = 500;
 else
 $bonus_price = 5;
 $selling_price = floor(($bonus_price + $item_effect*(1 + $item_level + $item_luck + $item_option + ceil($item_excellent/100)*10 + $item_harmony + $item_guardian) + $item_durability_cur)/2);
 $item_size = intval(substr($item_to_sell,2,2));
if($id_clicked > 69 && $id_clicked <82)
 $array_to_clear = array($id_clicked); //empty one of equipment slots
else
{
switch($item_size)
{
 case '11':
 $array_to_clear = array($id_clicked);
 break;
 case '12':
 $array_to_clear = array($id_clicked, $id_clicked+8);
 break;
 case '13':
 $array_to_clear = array($id_clicked, $id_clicked+8, $id_clicked+16);
 break;
 case '14':
 $array_to_clear = array($id_clicked, $id_clicked+8, $id_clicked+16, $id_clicked+24);
 break;
 case '22':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+8, $id_clicked+9);
 break;
 case '23':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+8, $id_clicked+9, $id_clicked+16, $id_clicked+17);
 break;
 case '24':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+8, $id_clicked+9, $id_clicked+16, $id_clicked+17, $id_clicked+24, $id_clicked+25);
 break;
 case '42':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+2, $id_clicked+3, $id_clicked+8, $id_clicked+9, $id_clicked+10, $id_clicked+11);
 break;
 case '53':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+2, $id_clicked+3, $id_clicked+4, $id_clicked+8, $id_clicked+9, $id_clicked+10, $id_clicked+11, $id_clicked+12, $id_clicked+16, $id_clicked+17, $id_clicked+18, $id_clicked+19, $id_clicked+20);
 break;
 case '32':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+2, $id_clicked+8, $id_clicked+9, $id_clicked+10);
 break;
 case '33':
 $array_to_clear = array($id_clicked, $id_clicked+1, $id_clicked+2, $id_clicked+8, $id_clicked+9, $id_clicked+10, $id_clicked+16, $id_clicked+17, $id_clicked+18);
 break;
}
}
if($id_clicked<70)
{
 for($i=0; $i<count($array_to_clear); $i++)
 {
  $e = $array_to_clear[$i];
  $current_inventory[$e] = 0;
 }
 //saving updated inventory
 $current_inventory = json_encode($current_inventory);
 $query = "UPDATE characters SET inventory='$current_inventory' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
}
else
{
 $current_equipment[$array_to_clear[0]] = 0;
 $current_equipment = array_slice($current_equipment, 70);
 //saving updated equipment
 $current_equipment = json_encode($current_equipment);
 $query = "UPDATE characters SET equipment='$current_equipment' WHERE id='$char_id'";
 if(!mysql_query($query,$conn))
 exit('mysql_error');
}
//saving updated money
$query = "UPDATE users SET zen=zen+'$selling_price' WHERE id='$user_id'";
if(!mysql_query($query, $conn))
exit('mysql_error');
echo json_encode($array_to_clear);
?>