////////////////////////stats_init//////////////////////////////
function stats_init () {
switch(player_class)
{
 case 1:
 case 21:
 player_damage_max = Math.floor(player_strength/4);
 player_damage_min = Math.floor(player_strength/6);
 player_damage_rate = Math.floor(player_level*5+(player_agility*3)/2+player_strength/4);
 player_defense = Math.floor(player_agility/3);
 player_defense_rate = Math.floor(player_agility/3);
 player_hp = 35+player_level*2+player_stamina*3;
 player_mp = Math.floor(10+player_level*0.5+player_energy);
 break;
 case 2:
 case 22:
 player_damage_max = Math.floor(player_strength/8);
 player_damage_min = Math.floor(player_strength/12);
 player_damage_rate = Math.floor(player_level*5+(player_agility*3)/2+player_strength/4);
 player_defense = Math.floor(player_agility/4);
 player_defense_rate = Math.floor(player_agility/3);
 player_hp = 30+player_level+player_stamina*2;
 player_mp = player_level*2+player_energy*2;
 player_wiz_damage_max = Math.floor(player_energy/4);
 player_wiz_damage_min = Math.floor(player_energy/9);
 break;
 case 3:
 case 23:
 player_damage_max = Math.floor(player_strength/8 + player_agility/4);
 player_damage_min = Math.floor(player_strength/14 + player_agility/7);
 player_damage_rate = Math.floor(player_level*5+(player_agility*3)/2+player_strength/4);
 player_defense = Math.floor(player_agility/10);
 player_defense_rate = Math.floor(player_agility/4);
 player_hp = 40+player_level+player_stamina*2;
 player_mp = Math.floor(6+player_level*1.5+player_energy*1.5);
 break;
 case 4:
 case 24:
 player_damage_max = Math.floor(player_strength/8);
 player_damage_min = Math.floor(player_strength/12);
 player_damage_rate = Math.floor(player_level*5+(player_agility*3)/2+player_strength/4);
 player_defense = Math.floor(player_agility/3);
 player_defense_rate = Math.floor(player_agility/4);
 player_hp = 33+player_level+player_stamina*2;
 player_mp = Math.floor(4+player_level*1.5+player_energy*1.5);
 player_wiz_damage_max = Math.floor(player_energy/4);
 player_wiz_damage_min = Math.floor(player_energy/9);
 break;
}
}
////////////////////////add_points//////////////////////////////
function add_points(stat) {
if (window.ActiveXObject)
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
else
  xmlhttp=new XMLHttpRequest();
 xmlhttp.onreadystatechange=function()
  {
if(xmlhttp.readyState==4 && xmlhttp.status>400)
{
 $('#js_output').text('Server error');
}
else if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 if(xmlhttp.responseText!='ok')
 {
 $('#js_output').text('Id error');
 $('.add_stats').each(function(index) {
   this.src = add_button.src;
 });
 }
else
{
 $('#js_output').text(stat + ' added');
 player_points-=1;
 $('#points_val').text('points: ' + player_points);
 if(stat == 'strength')
 player_strength+=1;
 else if(stat == 'agility')
 player_agility+=1;
 else if(stat == 'stamina')
 player_stamina+=1;
 else if(stat == 'energy')
 player_energy+=1;
 if(player_points<1)
 $('.add_stats').remove();
for(i=0; i<64; i++)
{
 if(js_current_inventory[i]!='0' && js_current_inventory[i]!='1')
 document.getElementById(i).innerHTML = load_items(js_current_inventory[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
 target_id = '#' + i + '>img';
 drag_init(target_id);
}
//////////////////////updating right click on items//////////////////////////
$('.item').rightClick( function(){
  t_id = $(this).parent().attr('id');
  if(t_id<64)
  {
   var item_type = js_current_inventory[t_id].slice(0,1);
   var item_sub_type = js_current_inventory[t_id].slice(5,6);
   if(item_type == 'F' || item_type == 'G')
   jConfirm('Do you want to use this item?', 'Confirm Using', function(r) {using_confirmed(r, t_id, item_type, item_sub_type);});
  }
});
//////////////////////updating right click on items//////////////////////////
 stats_init();
 $('#stats_strength').html(player_strength);
 $('#stats_agility').html(player_agility);
 $('#stats_stamina').html(player_stamina);
 $('#stats_energy').html(player_energy);
 $('#stats_damage_rate').html(player_damage_rate);
 update_stats();
  $('.add_stats').each(function(index) {
    this.src = add_button.src;
  });
}
    }
  }
xmlhttp.open("GET","function.add_stats.php?stat=" + stat + "&rand=" + Math.random(),true);
xmlhttp.send();
}
////////////////////////update_stats//////////////////////////////
function update_stats (no_update) {
var hand1_damage_min = 0;
var hand1_damage_max = 0;
var hand2_damage_min = 0;
var hand2_damage_max = 0;
var shield_defense_rate = 0;
var equipment_defense = 0;
var hand1_staff_option = 0;
var hand2_staff_option = 0;
var hand1_staff_rise = 0;
var hand2_staff_rise = 0;
var staff_rise_final = 0;
var curse_spell_increment = 0;
//excellent options
var equipment_damage_level_20 = 0;
var equipment_damage_2p = 0;
var equipment_defense_rate_10p = 0;
var equipment_damage_decrease_4p = 0;
var equipment_increase_hp_4p = 0;
var equipment_increase_mp_4p = 0;
//harmony options
var equipment_h_min_dmg = 0;
var equipment_h_max_dmg = 0;
var equipment_h_defense_inc = 0;
var equipment_h_inc_hp = 0;
var equipment_h_def_rate_inc = 0;
var equipment_h_dmg_dec = 0;
var pet_damage = 0;
var wings_damage = 0;
var wiz_ring_damage = 0;
var equipment_hp_bonus = 0;
var equipment_damage_absorb = 0;
equipment_skills = [];
//////////////////////////////slot-by-slot///////////////////////////////////////
//pet
 if(js_current_equipment[70]!='0')
{
  var item_code = js_current_equipment[70];
  parse_item_code (item_code);
  if(item_sub_type=='1')
 {
  equipment_damage_absorb += 0.2;
  equipment_hp_bonus +=50;
 }
  if(item_sub_type=='2')
  pet_damage = 0.3;
  if(item_sub_type=='4')
 {
  pet_damage = 0.1;
  equipment_damage_absorb += 0.15;
 }
  if(item_sub_type=='6')
  equipment_damage_absorb += 0.1;
  if(item_sub_type=='7')
  pet_damage = 0.1;
  if(item_sub_type=='8')
 {
  equipment_damage_absorb += 0.3;
  equipment_hp_bonus +=50;
 }
  if(item_sub_type=='9')
  pet_damage = 0.4;
 if(item_skill!=0 && jQuery.inArray(item_skill,equipment_skills)<0)
 equipment_skills.push(item_skill);
}
//helm
 if(js_current_equipment[71]!='0')
{
  var item_code = js_current_equipment[71];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
  equipment_defense += (item_effect + item_option*4);
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//wings
 if(js_current_equipment[72]!='0')
{
  var item_code = js_current_equipment[72];
  parse_item_code(item_code);
  equipment_defense += (item_effect + item_option*4 + item_level*3);
 //first or second level wings?
 if(item_sub_type=='1')
 {
  wings_damage = (12 + item_level*2)/100;
  equipment_damage_absorb += (12 + item_level*2)/100;
 }
 else
 {
  wings_damage = (25 + item_level*2)/100;
  equipment_damage_absorb += (25 + item_level*2)/100;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//hand1
 if(js_current_equipment[73]!='0')
{
  var item_code = js_current_equipment[73];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
 switch(item_excellent)
 {
  case 4:
  equipment_damage_level_20 += (player_level/20);
  break;
  case 2:
  equipment_damage_2p +=0.02;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_min_dmg += item_harmony_value*3;
     break;
     case 2:
     equipment_h_max_dmg += item_harmony_value*5;
     break;
   }
 }
  hand1_damage_min = Math.floor(item_effect*5/6) + item_option*4;
  hand1_damage_max = item_effect + item_option*4;
if((item_type=='1' && item_sub_type=='3') || (item_type=='2' && item_sub_type=='3'))
 {
  hand1_staff_option = item_option*4;
  hand1_staff_rise = Math.floor(item_effect*5/6);
 }
if(item_type=='1' && item_sub_type=='5')
curse_spell_increment = item_effect;

 if(item_skill!=0 && jQuery.inArray(item_skill,equipment_skills)<0)
 equipment_skills.push(item_skill);
}
//necklace
 if(js_current_equipment[74]!='0')
{
  var item_code = js_current_equipment[74];
  parse_item_code(item_code);
 switch(item_excellent)
 {
  case 4:
  equipment_damage_level_20 += (player_level/20);
  break;
  case 2:
  equipment_damage_2p +=0.02;
  break;
 }
}
//armor
 if(js_current_equipment[75]!='0')
{
  var item_code = js_current_equipment[75];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
  equipment_defense += (item_effect + item_option*4);
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//hand2
 if(js_current_equipment[76]!='0')
{
  var item_code = js_current_equipment[76];
  parse_item_code(item_code);
  var item_effect2 = item_effect + item_level*3 + Math.ceil(item_excellent/100)*30;
 if(item_type!='9')
 {
if((item_type=='1' && item_sub_type=='3') || (item_type=='2' && item_sub_type=='3'))
{
  hand2_staff_option = item_option*4;
  hand2_staff_rise = Math.floor(item_effect2*5/6);
}
if(item_type=='1' && item_sub_type=='5')
{
 if(curse_spell_increment<item_effect2)
 curse_spell_increment = item_effect2;
}
 switch(item_excellent)
 {
  case 4:
  equipment_damage_level_20 += (player_level/20);
  break;
  case 2:
  equipment_damage_2p +=0.02;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_min_dmg += item_harmony_value*3;
     break;
     case 2:
     equipment_h_max_dmg += item_harmony_value*5;
     break;
   }
 }
     hand2_damage_min = Math.floor(item_effect2*5/6) + item_option*4;
     hand2_damage_max = item_effect2 + item_option*4;
 }
 else
 {
  equipment_defense += item_effect + item_level;
  shield_defense_rate = item_effect*3 + item_level*3 + Math.ceil(item_excellent/100)*30 + item_option*5;
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
 }
 if(item_skill!=0 && jQuery.inArray(item_skill,equipment_skills)<0)
 equipment_skills.push(item_skill);
}
//gloves
 if(js_current_equipment[77]!='0')
{
  var item_code = js_current_equipment[77];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
  equipment_defense += (item_effect + item_option*4);
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//ring 1
 if(js_current_equipment[78]!='0')
{
  var item_code = js_current_equipment[78];
  parse_item_code(item_code);
  if(item_sub_type=='7' && item_option!=0)
  equipment_increase_mp_4p +=item_option/100;
  if(item_sub_type=='9')
  wiz_ring_damage = 0.1;
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
}
//pants
 if(js_current_equipment[79]!='0')
{
  var item_code = js_current_equipment[79];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
  equipment_defense += (item_effect + item_option*4);
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//ring 2
 if(js_current_equipment[80]!='0')
{
  var item_code = js_current_equipment[80];
  parse_item_code(item_code);
  if(item_sub_type=='7' && item_option!=0)
  equipment_increase_mp_4p +=item_option/100;
  if(item_sub_type=='9')
  wiz_ring_damage = 0.1;
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
}
//boots
 if(js_current_equipment[81]!='0')
{
  var item_code = js_current_equipment[81];
  parse_item_code(item_code);
  item_effect += item_level*3 + Math.ceil(item_excellent/100)*30;
  equipment_defense += (item_effect + item_option*4);
 switch(item_excellent)
 {
  case 1:
  equipment_damage_decrease_4p +=0.04;
  break;
  case 2:
  equipment_defense_rate_10p +=0.1;
  break;
  case 3:
  equipment_increase_hp_4p +=0.04;
  break;
  case 4:
  equipment_increase_mp_4p +=0.04;
  break;
 }
 if(item_harmony!='00')
 {
  var item_harmony_type = Number(item_harmony.slice(0,1));
  var item_harmony_value = Number(item_harmony.slice(1,2));
    switch(item_harmony_type)
    {
     case 1:
     equipment_h_defense_inc += item_harmony_value*5;
     break;
     case 2:
     equipment_h_inc_hp += item_harmony_value*6;
     break;
     case 5:
     equipment_h_def_rate_inc += item_harmony_value*2;
     break;
     case 6:
     equipment_h_dmg_dec += item_harmony_value/100;
     break;
   }
 }
}
//////////////////////////////defense end///////////////////////////////////
if(hand1_damage_min>=hand2_damage_min)
{
 hand2_damage_min = 0;
 hand2_damage_max = 0;
}
else
{
 hand1_damage_min = 0;
 hand1_damage_max = 0;
}
var damage_min_total = Math.floor(player_damage_min + hand1_damage_min + hand2_damage_min + equipment_damage_level_20 + equipment_h_min_dmg);
var damage_max_total = Math.floor(player_damage_max + hand1_damage_max + hand2_damage_max + equipment_damage_level_20 + equipment_h_max_dmg);
if(damage_min_total>damage_max_total)
damage_min_total = damage_max_total;
var damage_value = damage_min_total + ' ~ ' + damage_max_total;
var damage_bonus = Math.floor((pet_damage + wings_damage + equipment_damage_2p + wiz_ring_damage)*100);
if(damage_bonus!=0)
damage_value += ' (+' + damage_bonus + '%)';
player_hp_final = Math.floor((player_hp + equipment_hp_bonus + equipment_h_inc_hp)*(1 + equipment_increase_hp_4p));
if(player_hp_cur>player_hp_final)
player_hp_cur=player_hp_final;
player_mp_final = Math.floor(player_mp*(1 + equipment_increase_mp_4p));
if(player_mp_cur>player_mp_final)
player_mp_cur=player_mp_final;
var damage_absorb_value = equipment_damage_absorb*100 + '%';
if(equipment_damage_decrease_4p!=0 || equipment_h_dmg_dec!=0)
damage_absorb_value += ' (+' + (equipment_damage_decrease_4p + equipment_h_dmg_dec)*100 + '%)';
if(typeof no_update == "undefined")
{
 $('#stats_damage').html(damage_value);
 $('#stats_defense').html(player_defense + equipment_defense + equipment_h_defense_inc);
 $('#stats_defense_rate').html(Math.floor((player_defense_rate + shield_defense_rate + equipment_h_def_rate_inc)*(1 + equipment_defense_rate_10p)));
 $('#stats_hp').html(player_hp_cur + ' / ' + player_hp_final);
 $('#stats_damage_absorb').html(damage_absorb_value);
 $('#stats_mp').html(player_mp_cur + ' / ' + player_mp_final);
}
if(player_class =='2' || player_class =='4' || player_class =='22' || player_class =='24')
{
var damage_wiz_min_total = Math.floor(player_wiz_damage_min + hand1_staff_option + hand2_staff_option + equipment_damage_level_20 + equipment_h_min_dmg);
var damage_wiz_max_total = Math.floor(player_wiz_damage_max + hand1_staff_option + hand2_staff_option + equipment_damage_level_20 + equipment_h_max_dmg);
if(damage_wiz_min_total>damage_wiz_max_total)
damage_wiz_min_total = damage_wiz_max_total;
if(hand1_staff_rise>hand2_staff_rise)
staff_rise_final = hand1_staff_rise + '%';
else
staff_rise_final = hand2_staff_rise + '%';
if(curse_spell_increment!=0)
staff_rise_final = staff_rise_final + ' (' + curse_spell_increment + '%)';
 var wiz_damage_value = damage_wiz_min_total + ' ~ ' + damage_wiz_max_total;
 if(damage_bonus!=0)
 wiz_damage_value += ' (+' + damage_bonus + '%)';
if(typeof no_update == "undefined")
{
 $('#wiz_damage').html('Wiz Damage');
 $('#stats_wiz_damage').html(wiz_damage_value);
 $('#staff_rise').html('Staff Rise');
 $('#stats_staff_rise').html(staff_rise_final);
}
}
//function end
}
////////////////////////update_stats end//////////////////////////////