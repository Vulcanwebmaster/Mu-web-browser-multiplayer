<?php
function parse_item_code($item_code)
{
global $item_type,$item_size,$item_sub_type,$item_effect,$item_level,$item_luck,$item_requirement1,$item_requirement2,$requirement_class,$item_requirement_add;
global $item_skill,$item_option,$item_excellent,$item_harmony,$item_guardian,$item_durability_cur,$item_durability_max,$item_socket,$item_name;
 $item_type = substr($item_code,0,1);
 $item_size = intval(substr($item_code,2,2));
 $item_sub_type = substr($item_code,5,1);
 $item_effect = intval(substr($item_code,7,4));
 $item_level = intval(substr($item_code,12,2));
 $item_luck = intval(substr($item_code,15,1));
 $item_requirement1 = substr($item_code,17,4);
 $item_requirement2 = substr($item_code,22,4);
 $requirement_class = intval(substr($item_code,27,2));
 $item_requirement_add = substr($item_code,21,1);
 $item_skill = substr($item_code,30,1);
 $item_option = intval(substr($item_code,32,1));
 $item_excellent = intval(substr($item_code,34,2));
 $item_harmony = intval(substr($item_code,37,2));
 $item_guardian = intval(substr($item_code,40,1));
 $item_durability_cur = intval(substr($item_code,42,3));
 $item_durability_max = intval(substr($item_code,46,3));
 $item_socket = substr($item_code,50,6);
 $item_name = substr($item_code,57);
}
?>