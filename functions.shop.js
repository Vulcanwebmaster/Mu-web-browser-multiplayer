function buy_item(t_id) {
nd();//closing pop up
jConfirm('Comprar o item ' + t_id.name + '?', 'Confirm Buying', function(r) {buying_confirmed(r, t_id);});
}

function buying_confirmed(r, t_id) {
if(r)
{
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
 if(xmlhttp.responseText.slice(0,1)!='[')
 {
  if(xmlhttp.responseText=="no_money" || xmlhttp.responseText=="no_space")
  document.getElementById("js_output").innerHTML='Not enough money or space.';
  else
  document.getElementById("js_output").innerHTML='Wrong id parameter.';
 }
 else
 {
   var cell_to_occupy = eval('(' + xmlhttp.responseText + ')');
   document.getElementById("js_output").innerHTML=t_id.name + ' Foi comprado.';
   var item_code = js_shop_inventory[Number(t_id.parentNode.id)-1000];
   //document.getElementById("main_table_td2").innerHTML= t_id.parentNode.id;

  parse_item_code(item_code);
if(item_type=='C' || item_type=='D' || item_type=='E')
var bonus_price = 500;
else
var bonus_price = 5;

   var item_price = bonus_price + item_effect*(1 + item_level + item_luck + Number(item_option) + Math.ceil(item_excellent/100)*10 + Number(item_harmony) + Number(item_guardian)) + item_durability_cur;
   document.getElementById("zen_value").innerHTML = Number(document.getElementById("zen_value").innerHTML) - Number(item_price);

   for(i=0; i<cell_to_occupy.length; i++)
    {
     e = cell_to_occupy[i];
     //document.getElementById(e).className='occupied';
     $('#'+e).addClass('occupied');
     js_current_inventory[e] = 1;
    }
     js_current_inventory[cell_to_occupy[0]] = item_code;
   document.getElementById(cell_to_occupy[0]).innerHTML = load_items(item_code, 2, player_level, player_class, player_strength, player_agility, player_energy);
$('#'+cell_to_occupy[0]+'>img').click(function(){sell_item(this);});
 }//end of if no money
    }//end of if no server response
  }//end of internal function
xmlhttp.open("GET","function.buy_item.php?id=" + (Number(t_id.parentNode.id)-1000) + "&shop=" + js_shop_inventory[120] + "&rand=" + Math.random(),true);
xmlhttp.send();
}//end of "r" (confirmed)
}


function sell_item(t_id) {
nd();//closing pop up

jConfirm('Vender o item ' + t_id.name + '?', 'Confirm Selling', function(r) {selling_confirmed(r, t_id);});
}


function selling_confirmed(r, t_id) {
if(r)
{
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
 if(xmlhttp.responseText=="error" || xmlhttp.responseText=="empty" || xmlhttp.responseText.slice(0,1)!='[')
 {
document.getElementById("js_output").innerHTML='Error: wrong id parameter.';
}
else
{
var cell_to_clear = eval('(' + xmlhttp.responseText + ')');
    document.getElementById("js_output").innerHTML=t_id.name + ' foi vendido.';

if(cell_to_clear[0]<70)
var item_code = js_current_inventory[cell_to_clear[0]];
else
var item_code = js_current_equipment[cell_to_clear[0]];

  parse_item_code(item_code);
if(item_type=='C' || item_type=='D' || item_type=='E')
var bonus_price = 500;
else
var bonus_price = 5;

var item_price = Math.floor((bonus_price + item_effect*(1 + item_level + item_luck + Number(item_option) + Math.ceil(item_excellent/100)*10 + Number(item_harmony) + Number(item_guardian)) + item_durability_cur)/2);
document.getElementById("zen_value").innerHTML = Number(document.getElementById("zen_value").innerHTML) + Number(item_price);

if(cell_to_clear[0]<70)
{
for(i=0; i<cell_to_clear.length; i++)
 {
  e = cell_to_clear[i];
  document.getElementById(e).innerHTML = '';
   $('#'+e).removeClass('occupied');
  js_current_inventory[e] = 0;
 }
}
else
{
  document.getElementById(cell_to_clear[0]).innerHTML = '';
   $('#'+cell_to_clear[0]).removeClass('occupied');
  js_current_equipment[cell_to_clear[0]] = 0;
$( document.getElementById(cell_to_clear[0]).parentNode.childNodes[0] ).removeClass('occupied');
}

}
    }
  }
xmlhttp.open("GET","function.sell_item.php?id=" + t_id.parentNode.id + "&rand=" + Math.random(),true);
xmlhttp.send();

}
}