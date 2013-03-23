<?php
if(!isset($i))
exit('error');
if(mt_rand(0,999)<1)  //drop rare item 0.1%
{
 $xml = simplexml_load_file('drop/rare.xml');
 $a=0;
 $droplist = array();
 foreach($xml->children() as $child)
 {
  $droplist[$a]= "$child";
  $a++;
 }
$tmp = mt_rand(0, count($droplist)-1);
$item_code = $droplist[$tmp];
$_SESSION['enemies'][$i]['item'] = $item_code;
}
else if(mt_rand(0,3)<1)  //drop regular item 25%
{
$drop_file = ceil($_SESSION['enemies'][$i]['level'] / 10); //1-10 - 1.xml, 11-20 - 2.xml, etc.
if (file_exists('drop/'.$drop_file.'.xml'))
 $xml = simplexml_load_file('drop/'.$drop_file.'.xml');
else
 $xml = simplexml_load_file('drop/1.xml');
 $a=0;
 $droplist = array();
 foreach($xml->children() as $child)
 {
  $droplist[$a]= "$child";
  $a++;
 }
$tmp = mt_rand(0, count($droplist)-1);
$item_code = $droplist[$tmp];
if(!function_exists('parse_item_code'))
include('function.common.php');
parse_item_code($item_code);
if($item_type == '1' || $item_type == '2' || $item_type == '3' || $item_type == '4' || $item_type == '5' || $item_type == '6' || $item_type == '7' || $item_type == '9' || $item_type == 'A' || $item_type == 'B')
{
 //random excellent
  if(mt_rand(0,199) < 1) //0.5%
  {
   $item_excellent_new = mt_rand(1,6);
   $item_excellent_new = str_pad($item_excellent_new, 2, "0", STR_PAD_LEFT);
   $item_code = substr_replace($item_code, $item_excellent_new, 34, 2);
  }
 //random level (0,1,2,3 - 25% for each)
  if(!isset($item_excellent_new)) // no chance for level increase for excellent items
  {
   $item_level_new = mt_rand(0,3);
   $item_level_new = str_pad($item_level_new, 2, "0", STR_PAD_LEFT);
   $item_code = substr_replace($item_code, $item_level_new, 12, 2);
  }
 //random option
   $item_option_new = 0;
   if(mt_rand(0,9) < 1) //10%
   $item_option_new = 1;
   if(mt_rand(0,99) < 1) //1%
   $item_option_new = 2;
   $item_code = substr_replace($item_code, $item_option_new, 32, 1);
 //random skill (33%)
 if(($item_type == '1' || $item_type == '2' || $item_type == '9') && mt_rand(0,2)<1)
 {
  $rand_skill = 0;
  if(($item_type == '1' || $item_type == '2') && $item_sub_type == '1')
  $rand_skill = mt_rand(3,6); //sword skills
  else if(($item_type == '1' || $item_type == '2') && $item_sub_type == '2')
  $rand_skill = 7; //falling slash for axe
  else if($item_type == '2' && ($item_sub_type == '8' || $item_sub_type == '9'))
  $rand_skill = 9; //triple shot for bow/crossbow
  else if($item_type == '9')
  $rand_skill = 8; //defense for shield
  else if($item_type == '1' && $item_sub_type == '5' && $item_effect == 23) //summoner books
  $rand_skill = 'A';
  else if($item_type == '1' && $item_sub_type == '5' && $item_effect == 29)
  $rand_skill = 'B';
  else if($item_type == '1' && $item_sub_type == '5' && $item_effect == 36)
  $rand_skill = 'C';
  $item_code = substr_replace($item_code, $rand_skill, 30, 1);
 }
}
if($item_type == '1' || $item_type == '2' || $item_type == '3' || $item_type == '4' || $item_type == '5' || $item_type == '6' || $item_type == '7' || $item_type == '9')
{ // no luck for rings and pendants
 if(mt_rand(0,2)<1)  //33%
 $item_code = substr_replace($item_code, '1', 15, 1);
}
$_SESSION['enemies'][$i]['item'] = $item_code;
}
?>