function npc32_transform() {
if (window.ActiveXObject)
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
else
  xmlhttp=new XMLHttpRequest();
 xmlhttp.onreadystatechange=function()
  {
if(xmlhttp.readyState==4 && xmlhttp.status>400)
{
 $('#npc32_output').text('Improper item combination');
 $('#js_output').text('Server error');
}
else if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 if(xmlhttp.responseText.slice(0,1)!='[')
{
 $('#npc32_output').text('Improper item combination');
if(xmlhttp.responseText=="no_space")
 $('#js_output').text('Clear 5x3 space in inventory');
else if(xmlhttp.responseText=="no_money")
 $('#js_output').text('Not enough money');
else if(xmlhttp.responseText=="mix_fail")
 {
  $('#npc32_output').text('No items');
  $('#js_output').text('Item combination failed');
  for(i=250; i<282; i++)
   {
    document.getElementById(i).innerHTML = '';
    $('#'+i).removeClass('occupied');
    js_current_npc32[i] = 0;
   }
 }
else
  $('#js_output').text('Id error');
}
else
{
 $('#npc32_output').text('Improper item combination');
 var js_new_npc32 = eval('(' + xmlhttp.responseText + ')');
var npc32_first = js_new_npc32.shift();
if(npc32_first == 'mix_fail')
 $('#js_output').text('Item combination failed');
else
 $('#js_output').text('Item combination success');

var js_array_250 = new Array();
 for(i=0; i<250; i++)
 {
  js_array_250[i]=0;
 }
js_current_npc32 = js_array_250.concat(js_new_npc32);

for(i=250; i<282; i++)
{
if(js_current_npc32[i]=='0')
 {
  document.getElementById(i).innerHTML = '';
  $('#'+i).removeClass('occupied');
 }
else
 {
  $('#'+i).addClass('occupied');
  document.getElementById(i).innerHTML = '';
  if(js_current_npc32[i]!=1)
{
  document.getElementById(i).innerHTML = load_items(js_current_npc32[i], 0, player_level, player_class, player_strength, player_agility, player_energy);
  target_id = '#' + i + '>img';
  drag_init(target_id);
}
 }
}
 if(npc32_id!='chaos_machine')
 {
  document.getElementById('npc32_inventory_ani').innerHTML = '<img src="' + mix_button_ani.src + '"/>';
  setTimeout("document.getElementById('npc32_inventory_ani').innerHTML =''",600);
 }
}
    }
  }
xmlhttp.open("GET","function.npc32_transform.php?id=" + npc32_id + "&rand=" + Math.random(),true);
xmlhttp.send();
}
function npc32_predict() {
var npc32_count = new Array();
for(i=250; i<282; i++)
{
if(js_current_npc32[i]!='0' && js_current_npc32[i]!='1')
  npc32_count.push(js_current_npc32[i]);
}
if(npc32_count.length==0)
$('#npc32_output').text('No items');
/////////////////////////////////
else if(npc32_id=='chaos_machine')
{
 var npc32_count_new = new Array();

for(i=0; i<npc32_count.length; i++)
{
 var type_sub_type = npc32_count[i].slice(0,1) + '' + npc32_count[i].slice(5,6);
 npc32_count_new.push(type_sub_type);
}
if(npc32_count.length == 2 && jQuery.inArray('E2', npc32_count_new)>-1 && jQuery.inArray('E1', npc32_count_new)>-1)
document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Fruit Of Creation<br/>Success: 80%<br/>Price: 1,000 Zen</a>';
else if(npc32_count.length == 3 && jQuery.inArray('I4', npc32_count_new)>-1 && jQuery.inArray('I5', npc32_count_new)>-1 && jQuery.inArray('E1', npc32_count_new)>-1)
document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Cloak of Invisibility<br/>Success: 80%<br/>Price: 1,000 Zen</a>';
else
$('#npc32_output').text('Improper item combination');
}
/////////////////////////////////
else if(npc32_id=='cblossom')
{
  if(npc32_count.length>1)
 $('#npc32_output').text('Improper item combination');
  if(npc32_count.length==1)
 {
  var item_code = npc32_count[0];
  parse_item_code(item_code);
if(item_type=='I' && (item_sub_type =='1' || item_sub_type =='2' || item_sub_type =='3') && item_durability_cur == item_durability_max)
  document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Cherry Blossom Gift<br/>Success: 90%</a>';
else
 $('#npc32_output').text('Improper item combination');
 }
}
/////////////////////////////////
else if(npc32_id=='lahap')
{
  if(npc32_count.length==10)
 {
  var bless10 = 0;
  var soul10 = 0;
  for(i=0; i<npc32_count.length; i++)
  {
   if(npc32_count[i].slice(0,1) == 'D' && npc32_count[i].slice(5,6) == '1')
   bless10+=1;
   else if(npc32_count[i].slice(0,1) == 'D' && npc32_count[i].slice(5,6) == '2')
   soul10+=1;
  }
  if(bless10 == 10)
   document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Pack of Jewel of Bless x 10</a>';
  else if(soul10 == 10)
   document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Pack of Jewel of Soul x 10</a>';
  else
   $('#npc32_output').text('Improper item combination');
 }
 else if(npc32_count.length==1)
 {
  var item_code = npc32_count[0];
  parse_item_code(item_code);

  if(item_type=='E' && item_sub_type == '4')
   document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: 10 Jewels of Bless</a>';
  else if(item_type=='E' && item_sub_type == '5')
   document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: 10 Jewels of Soul</a>';
  else
   $('#npc32_output').text('Improper item combination');
 }
 else
 {
  if(npc32_count.length>0)
   $('#npc32_output').text('Improper item combination');
 }
}
/////////////////////////////////
else if(npc32_id=='osbourne')
{
  if(npc32_count.length>1)
 $('#npc32_output').text('Improper item combination');
  if(npc32_count.length==1)
 {
  var item_code = npc32_count[0];
  parse_item_code(item_code);

if((item_type=='1' || item_type=='2' || item_type=='9') && item_option!=0 && item_excellent == 0 && item_level>3)
  document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Lower Refining Stone<br/>Success: 20%</a>';
else if((item_type=='1' || item_type=='2' || item_type=='9') && item_excellent!= 0)
  document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Higher Refining Stone<br/>Success: 50%</a>';
else
 $('#npc32_output').text('Improper item combination');
 }
}
/////////////////////////////////
else if(npc32_id=='jerridon')
{
  if(npc32_count.length>1)
 $('#npc32_output').text('Improper item combination');
  if(npc32_count.length==1)
 {
  var item_code = npc32_count[0];
  parse_item_code(item_code);
if(item_harmony!='00')
  document.getElementById('npc32_output').innerHTML = '<a class="yellow">Item: Restored Item</a>';
else
 $('#npc32_output').text('Improper item combination');
 }
}
/////////////////////////////////
}