function store_to_inv(t_id, store_open) {
nd();//closing pop up

if(store_open!='1')
jConfirm('Remover ' + t_id.name + 'da sua loja?', 'Personal Store', function(r) {store_to_inv_confirmed(r, t_id);});
else
jAlert('Feche sua loja antes de remover itens', 'Personal Store');
}

function inv_to_store(t_id, store_lock) {
nd();//closing pop up

if(store_open!='1')
jPrompt('Insira um valor para ' + t_id.name, '', 'Personal Store', function(r) {inv_to_store_confirmed(r, t_id);});
else
jAlert('Feche sua loja antes de adicionar itens', 'Personal Store');
}



function store_to_inv_confirmed(r, t_id) {
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
  if(xmlhttp.responseText=="no_space")
  document.getElementById("js_output").innerHTML='Not enough space.';
  else
  document.getElementById("js_output").innerHTML='Wrong id parameter.';
 }
 else
 {
   var cell_to_occupy = eval('(' + xmlhttp.responseText + ')');
   document.getElementById("js_output").innerHTML=t_id.name + ' foi removido.';

var item_code = js_current_store[t_id.parentNode.id];

   for(i=0; i<cell_to_occupy.length; i++)
    {
     e = cell_to_occupy[i];
//inventory
     $('#'+e).addClass('occupied');
     js_current_inventory[e] = 1;
//clearing store
     f = Number(t_id.parentNode.id) + Number(cell_to_occupy[i]) - Number(cell_to_occupy[0]);
     $('#'+f).removeClass('occupied');
     js_current_store[f] = 0;
    }
     document.getElementById(t_id.parentNode.id).innerHTML = '';

     js_current_inventory[cell_to_occupy[0]] = item_code;
   document.getElementById(cell_to_occupy[0]).innerHTML = load_items(item_code, 4, player_level, player_class, player_strength, player_agility, player_energy);

$('#'+cell_to_occupy[0]+'>img').click(function(){inv_to_store(this, store_open);});

count_items -=1;
if(store_open!='1')
 $('.pstore_info').text('Personal Store foi fechada (' + count_items + ')');
else
 $('.pstore_info').text('Personal Store aberta (' + count_items + ')');

 }
    }//end of if no server response
  }//end of internal function
xmlhttp.open("GET","function.pstore.php?id=" + t_id.parentNode.id + "&rand=" + Math.random(),true);
xmlhttp.send();
}//end of "r" (confirmed)
}



function inv_to_store_confirmed(r, t_id) {
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
  if(xmlhttp.responseText=="no_space")
  document.getElementById("js_output").innerHTML='Not enough space.';
  else
  document.getElementById("js_output").innerHTML='Wrong id parameter.';
 }
else
{
var cell_to_occupy = eval('(' + xmlhttp.responseText + ')');
    document.getElementById("js_output").innerHTML=t_id.name + ' foi adicionado.';

if(t_id.parentNode.id<70)
var item_code = js_current_inventory[t_id.parentNode.id];
else
var item_code = js_current_equipment[t_id.parentNode.id];


//occupying cells in store
   for(i=0; i<cell_to_occupy.length; i++)
    {
     e = cell_to_occupy[i];
     $('#'+e).addClass('occupied');
     js_current_store[e] = 1;
    }
     js_current_store[cell_to_occupy[0]] = item_code;
   document.getElementById(cell_to_occupy[0]).innerHTML = load_items(item_code, 3, player_level, player_class, player_strength, player_agility, player_energy, r);

$('#'+cell_to_occupy[0]+'>img').click(function(){store_to_inv(this, store_open);});

count_items +=1;
if(store_open!='1')
 $('.pstore_info').text('Personal Store foi fechada (' + count_items + ')');
else
 $('.pstore_info').text('Personal Store aberta (' + count_items + ')');


//clearing inventory or equipment
if(t_id.parentNode.id<70)
{
for(i=0; i<cell_to_occupy.length; i++)
 {
  f = Number(t_id.parentNode.id) + Number(cell_to_occupy[i]) - Number(cell_to_occupy[0]);
  $('#'+f).removeClass('occupied');
  js_current_inventory[f] = 0;
 }
}
else
{
  $('#'+t_id.parentNode.id).removeClass('occupied');
  js_current_equipment[t_id.parentNode.id] = 0;
  $( document.getElementById(t_id.parentNode.id).parentNode.childNodes[0] ).removeClass('occupied');
}
document.getElementById(t_id.parentNode.id).innerHTML = '';

}
    }
  }
xmlhttp.open("GET","function.pstore.php?id=" + t_id.parentNode.id + "&price=" + r + "&rand=" + Math.random(),true);
xmlhttp.send();

}
}



function open_pstore() {
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
 if(xmlhttp.responseText!="ok")
 {
 if(xmlhttp.responseText=="no_money")
 jAlert('Not enough money', 'Message');
 else
 jAlert('Id error', 'Message');
}
else
{
  document.getElementById('zen_value').innerHTML = document.getElementById('zen_value').innerHTML - 1000;
  store_open = 1;
  jAlert('Sua Personal Store aberta', 'Personal Store');
  $('.pstore_info').text('Personal Store aberta (' + count_items + ')');
}
    }
  }
xmlhttp.open("GET","function.pstore.php?action=open" + "&rand=" + Math.random(),true);
xmlhttp.send();

}

function close_pstore() {
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
 if(xmlhttp.responseText!="ok")
 {
jAlert('id error', 'Message');
}
else
{
 store_open = 0;
 jAlert('Sua Personal Store foi fechada', 'Personal Store');
 $('.pstore_info').text('Personal Store foi fechada (' + count_items + ')');
}
    }
  }
xmlhttp.open("GET","function.pstore.php?action=close" + "&rand=" + Math.random(),true);
xmlhttp.send();

}