////////////////////////empty in inv//////////////////////////////
function js_empty_in_inventory(id_s, item_size) {
if(Number(id_s) > 69 && Number(id_s) < 82)
{
 //equipment cell
 if(js_current_equipment[Number(id_s)]!='0')
return [Number(id_s)];
 else
return 'no_space';
}
var item_size = Number(item_size);
if(id_s<100)
js_inv = js_current_inventory;
else if(id_s>99 && id_s<220)
js_inv = js_current_vault;
else if(id_s>249 && id_s<282)
js_inv = js_current_npc32;
switch (item_size)
{
 case 11:
return [Number(id_s)];
 break;
 case 12:
return [Number(id_s), Number(id_s)+8];
 break;
 case 13:
return [Number(id_s), Number(id_s)+8, Number(id_s)+16];
 break;
 case 14:
return [Number(id_s), Number(id_s)+8, Number(id_s)+16, Number(id_s)+24];
 break;
 case 22:
return [Number(id_s), Number(id_s)+1, Number(id_s)+8, Number(id_s)+9];
 break;
 case 23:
return [Number(id_s), Number(id_s)+1, Number(id_s)+8, Number(id_s)+9, Number(id_s)+16, Number(id_s)+17];
 break;
 case 24:
return [Number(id_s), Number(id_s)+1, Number(id_s)+8, Number(id_s)+9, Number(id_s)+16, Number(id_s)+17, Number(id_s)+24, Number(id_s)+25];
 break;
 case 42:
return [Number(id_s), Number(id_s)+1, Number(id_s)+2, Number(id_s)+3, Number(id_s)+8, Number(id_s)+9, Number(id_s)+10, Number(id_s)+11];
 break;
 case 53:
return [Number(id_s), Number(id_s)+1, Number(id_s)+2, Number(id_s)+3, Number(id_s)+4, Number(id_s)+8, Number(id_s)+9, Number(id_s)+10, Number(id_s)+11, Number(id_s)+12, Number(id_s)+16, Number(id_s)+17, Number(id_s)+18, Number(id_s)+19, Number(id_s)+20];
 break;
 case 32:
return [Number(id_s), Number(id_s)+1, Number(id_s)+2, Number(id_s)+8, Number(id_s)+9, Number(id_s)+10];
 break;
 case 33:
return [Number(id_s), Number(id_s)+1, Number(id_s)+2, Number(id_s)+8, Number(id_s)+9, Number(id_s)+10, Number(id_s)+16, Number(id_s)+17, Number(id_s)+18];
 break;
}
}
////////////////////////drag_init//////////////////////////////
function drag_init(target_id) {
	var $div = $('.main_table');
	$(target_id)
		.drag("start",function( ev, dd ){
			nd();
			$( this ).css('z-index', 5);
			$( this ).addClass("active");

			dd.limit = $div.offset();
			dd.limit.top = dd.limit.top - $('.main_table').offset().top;
			dd.limit.left = dd.limit.left - $('.main_table').offset().left;
			dd.limit.bottom = dd.limit.top + $div.outerHeight() - $( this ).outerHeight();
			dd.limit.right = dd.limit.left + $div.outerWidth() - $( this ).outerWidth();

fix_x = 0;
fix_y = 0;
if($(this.parentNode).hasClass('pet') && this.alt == '11')
{
fix_x = -16;
fix_y = -16;
}
if($(this.parentNode).hasClass('armor') && (this.alt == '32' || this.alt == '33'))
{
fix_x = 16;
}
if(($(this.parentNode).hasClass('hand1') || $(this.parentNode).hasClass('hand2')) && (this.alt == '11' || this.alt == '12' || this.alt == '13' || this.alt == '14'))
{
fix_x = -16;
}
			var item_size = this.alt;
			var item_size1 = Number(item_size.slice(0,1));
			var item_size2 = Number(item_size.slice(1,2));
			var item_size3 = item_size1*item_size2;
			jQuery.event.special.drop.multi = item_size3;
			jQuery.event.special.drop.tolerance = function( event, proxy, target)
{
var tmp_size = dd.drag.alt;
if(target.width > 40)
{
 if ( (proxy.top + proxy.height/2) > (target.top-4) && (proxy.left + proxy.width/2) > (target.left-4) && (proxy.top + proxy.height/2) < (target.top + target.height + 4) && (proxy.left + proxy.width/2) < (target.left + target.width + 4) )
  return 1;
 else 
  return 0;
}
switch(tmp_size)
{
 case '11':
 if ( proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4 )
  return 1;
 else 
  return 0;
 break;
 case '12':
 if (
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4 )
  return 1;
 else 
  return 0;
 break;
 case '13':
 if (
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4)
  return 1;
 else 
  return 0;
 break;
 case '14':
 if (
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+99) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+99) - target.top > -4 && proxy.left - target.left > -4)
  return 1;
 else 
  return 0;
 break;
 case '22':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4)
  return 1;
 else 
  return 0;
 break;
 case '23':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+33) - target.left > -4)
  return 1;
 else 
  return 0;
 break;
 case '24':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+99) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+99) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+99) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+99) - target.top > -4 && (proxy.left+33) - target.left > -4)
  return 1;
 else 
  return 0;
 break;
 case '42':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+66) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+66) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+99) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+99) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+99) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+99) - target.left > -4
)
  return 1;
 else 
  return 0;
 break;
 case '53':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+33) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+66) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+66) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+99) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+99) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+99) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+99) - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+99) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+99) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+132) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+132) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+132) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+132) - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+132) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+132) - target.left > -4
)
  return 1;
 else 
  return 0;
 break;
 case '32':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+66) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+66) - target.left > -4
)
  return 1;
 else 
  return 0;
 break;
 case '33':
if(
proxy.top - target.top < 4 && proxy.left - target.left < 4 && proxy.top - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+33) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+33) - target.top > -4 && proxy.left - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+33) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+33) - target.left > -4
||
proxy.top - target.top < 4 && (proxy.left+66) - target.left < 4 && proxy.top - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+33) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+33) - target.top > -4 && (proxy.left+66) - target.left > -4
||
(proxy.top+66) - target.top < 4 && proxy.left - target.left < 4 && (proxy.top+66) - target.top > -4 && proxy.left - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+33) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+33) - target.left > -4
||
(proxy.top+66) - target.top < 4 && (proxy.left+66) - target.left < 4 && (proxy.top+66) - target.top > -4 && (proxy.left+66) - target.left > -4
)
  return 1;
 else 
  return 0;
 break;
}
}
			tmp_array = js_empty_in_inventory(this.parentNode.id, this.alt);
			if(tmp_array!='no_space')
			{
			 for(i=0; i<tmp_array.length; i++)
			 {
			  var e=tmp_array[i];
			  $('#'+e).removeClass('occupied');
if(e>69 && e<82)
$( document.getElementById(e).parentNode.childNodes[0] ).removeClass('occupied');
			 }
			}
		})
		.drag(function( ev, dd ){
			$( this ).css({
				top: Math.min( dd.limit.bottom + fix_y, Math.max( dd.limit.top, Math.round( dd.offsetY / 33 ) * 33)+6 + fix_y),
				left: Math.min( dd.limit.right + fix_x, Math.max( dd.limit.left, Math.round( dd.offsetX / 33 ) * 33)+6 + fix_x)
				//top: dd.offsetY,
				//left: dd.offsetX
			});
		},{ relative:true})
		.drag("end",function( ev, dd ){
			$( this ).removeClass("active");
			$( this ).css('z-index', 1);
			var item_size = this.alt;
			var item_size1 = Number(item_size.slice(0,1));
			var item_size2 = Number(item_size.slice(1,2));
			var item_size3 = item_size1*item_size2;
/////////////forming array of drop targets//////////////////////
var drop_array=new Array();
if($(dd.drop).hasClass('slot'))
{
 if($(this).hasClass('pet')){$.each(dd.drop, function(index, value) {if($(this).hasClass('pet'))drop_array.push(value);});}
 if($(this).hasClass('helm')){$.each(dd.drop, function(index, value) {if($(this).hasClass('helm'))drop_array.push(value);});}
 if($(this).hasClass('wings')){$.each(dd.drop, function(index, value) {if($(this).hasClass('wings'))drop_array.push(value);});}
 if($(this).hasClass('hand1')){$.each(dd.drop, function(index, value) {if($(this).hasClass('hand1'))drop_array.push(value);});}
 if($(this).hasClass('necklace')){$.each(dd.drop, function(index, value) {if($(this).hasClass('necklace'))drop_array.push(value);});}
 if($(this).hasClass('armor')){$.each(dd.drop, function(index, value) {if($(this).hasClass('armor'))drop_array.push(value);});}
 if($(this).hasClass('hand2')){$.each(dd.drop, function(index, value) {if($(this).hasClass('hand2'))drop_array.push(value);});}
 if($(this).hasClass('gloves')){$.each(dd.drop, function(index, value) {if($(this).hasClass('gloves'))drop_array.push(value);});}
 if($(this).hasClass('ring1')){$.each(dd.drop, function(index, value) {if($(this).hasClass('ring1'))drop_array.push(value);});}
 if($(this).hasClass('pants')){$.each(dd.drop, function(index, value) {if($(this).hasClass('pants'))drop_array.push(value);});}
 if($(this).hasClass('ring2')){$.each(dd.drop, function(index, value) {if($(this).hasClass('ring2'))drop_array.push(value);});}
 if($(this).hasClass('boots')){$.each(dd.drop, function(index, value) {if($(this).hasClass('boots'))drop_array.push(value);});}
}
else
{
$.each(dd.drop, function(index, value) { 
drop_array.push(value);
});
}
/////////////forming array of drop targets end//////////////////
if(drop_array.length == 0)
{
			$( this ).animate({
				top: dd.originalY,
				left: dd.originalX
			}, 120 );
			if(tmp_array!='no_space')
			{
			 for(i=0; i<tmp_array.length; i++)
			 {
			  var e=tmp_array[i];
			  $('#'+e).addClass('occupied');
if(e>69 && e<82)
$( document.getElementById(e).parentNode.childNodes[0] ).addClass('occupied');
			 }
			}
}
else if($(dd.drop).hasClass('jewel_drop') && $(this).hasClass('jewel'))
{
      jewel_drop(this.parentNode.id, dd.drop[0].id, tmp_array, dd.originalY, dd.originalX);
}
else if (!$(dd.drop).hasClass('occupied') && this.parentNode.id != dd.drop[0].id && !$(dd.drop).hasClass('slot') && dd.drop.length == item_size3)
{
 if(typeof npc32_kind != "undefined")
      move_item (this.parentNode.id, dd.drop[0].id, tmp_array, dd.originalY, dd.originalX, item_size, npc32_kind);
 else
      move_item (this.parentNode.id, dd.drop[0].id, tmp_array, dd.originalY, dd.originalX, item_size);
}
else if (!$(drop_array).hasClass('occupied') && this.parentNode.id != drop_array[0].id && $(dd.drop).hasClass('slot'))
{
 if(typeof npc32_kind != "undefined")
      move_item (this.parentNode.id, drop_array[0].id, tmp_array, dd.originalY, dd.originalX, item_size, npc32_kind);
 else
      move_item (this.parentNode.id, drop_array[0].id, tmp_array, dd.originalY, dd.originalX, item_size);
}
else
{
			$( this ).animate({
				top: dd.originalY,
				left: dd.originalX
			}, 120 );
			if(tmp_array!='no_space')
			{
			 for(i=0; i<tmp_array.length; i++)
			 {
			  var e=tmp_array[i];
			  $('#'+e).addClass('occupied');
if(e>69 && e<82)
$( document.getElementById(e).parentNode.childNodes[0] ).addClass('occupied');
			 }
			}
}
		});
}
////////////////////////drag_init end//////////////////////////
////////////////////////drop_init//////////////////////////////
function drop_init() {
	$('.inv_cell')
		.drop("dropstart",function( ev, dd ){
			if($(this).hasClass('occupied'))
{
if($(this).hasClass('jewel_drop') && $(dd.drag).hasClass('jewel'))
$( this ).addClass("dropactiveyellow");
else
$( this ).addClass("dropactivered");
}
			else
			$( this ).addClass("dropactive");
		})

		.drop("dropend",function( ev, dd ){
			$( this ).removeClass("dropactive");
			$( this ).removeClass("dropactivered");
			$( this ).removeClass("dropactiveyellow");
		});

	$('.equip_cell')
		.drop("dropstart",function( ev, dd ){

if($(this).hasClass('pet') && $(dd.drag).hasClass('pet')
||
$(this).hasClass('helm') && $(dd.drag).hasClass('helm')
||
$(this).hasClass('wings') && $(dd.drag).hasClass('wings')
||
$(this).hasClass('hand1') && $(dd.drag).hasClass('hand1')
||
$(this).hasClass('necklace') && $(dd.drag).hasClass('necklace')
||
$(this).hasClass('armor') && $(dd.drag).hasClass('armor')
||
$(this).hasClass('hand2') && $(dd.drag).hasClass('hand2')
||
$(this).hasClass('gloves') && $(dd.drag).hasClass('gloves')
||
$(this).hasClass('ring1') && $(dd.drag).hasClass('ring1')
||
$(this).hasClass('pants') && $(dd.drag).hasClass('pants')
||
$(this).hasClass('ring2') && $(dd.drag).hasClass('ring2')
||
$(this).hasClass('boots') && $(dd.drag).hasClass('boots')
)
{
			if($(this).hasClass('occupied'))
                        {
			$( this ).addClass("dropactivered");
			$( this.parentNode.childNodes[0] ).addClass("dropactivered");
                        }
			else
                        {
			$( this ).addClass("dropactive");
			$( this.parentNode.childNodes[0] ).addClass("dropactive");
                        }
}
		})

		.drop("dropend",function( ev, dd ){
			$( this ).removeClass("dropactive");
			$( this ).removeClass("dropactivered");
			$( this.parentNode.childNodes[0] ).removeClass("dropactive");
			$( this.parentNode.childNodes[0] ).removeClass("dropactivered");
		});
}
////////////////////////drop_init//////////////////////////////
////////////////////////jewel_drop_initialize//////////////////////////////
function jewel_drop_ini() {
for(i=0; i<64; i++)
{
 if(js_current_inventory[i]!='0' && js_current_inventory[i]!='1')
 {
 var item_type = js_current_inventory[i].slice(0,1);
 var item_size = Number(js_current_inventory[i].slice(2,4));
 if(item_type == '1' || item_type == '2' || item_type == '3' || item_type == '4' || item_type == '5' || item_type == '6' || item_type == '7' || item_type == '8' || item_type == '9')
  {
   var array_to_add_jewel_drop = js_empty_in_inventory(i, item_size);
   for(e=0; e<array_to_add_jewel_drop.length; e++)
   $('#'+array_to_add_jewel_drop[e]).addClass('jewel_drop');
  }
 }
}

}
////////////////////////jewel_drop_initialize//////////////////////////////
////////////////////////move item//////////////////////////////
function move_item(id_s, id_t, array_to_clear, y_to_return, x_to_return, item_size, npc32_kind) {
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
     $('#js_output').text('No free space.');
else if(xmlhttp.responseText=="no_equip")
     $('#js_output').text('Cannot equip in this slot.');
else if(xmlhttp.responseText=="no_requirement")
     $('#js_output').text('Check item requirements.');
else
     $('#js_output').text('Id error.');
			$( document.getElementById(id_s).childNodes[0] ).animate({
				top: y_to_return,
				left: x_to_return
			}, 120 );
			if(tmp_array!='no_space')
			{
			 for(i=0; i<tmp_array.length; i++)
			 {
			  var e=tmp_array[i];
			  $('#'+e).addClass('occupied');
if(e>69 && e<82)
$( document.getElementById(e).parentNode.childNodes[0] ).addClass('occupied');
			 }
			}
}
else
{
var array_to_insert = eval('(' + xmlhttp.responseText + ')');
    $('#js_output').text('Cell ' + id_s + ' moved to ' + id_t + '.');
//where to clear
if(id_s<70)
{
var item_code = js_current_inventory[array_to_clear[0]];
for(i=0; i<array_to_clear.length; i++)
 {
  e = array_to_clear[i];
  js_current_inventory[e] = '0';
$('#' + e).removeClass('jewel_drop');
 }
}
if(id_s>69 && id_s<82)
{
  var item_code = js_current_equipment[array_to_clear[0]];
  js_current_equipment[array_to_clear[0]] = '0';
}
if(id_s>99 && id_s<220)
{
var item_code = js_current_vault[array_to_clear[0]];
for(i=0; i<array_to_clear.length; i++)
 {
  e = array_to_clear[i];
  js_current_vault[e] = '0';
 }
}
if(id_s>249 && id_s<282)
{
var item_code = js_current_npc32[array_to_clear[0]];
for(i=0; i<array_to_clear.length; i++)
 {
  e = array_to_clear[i];
  js_current_npc32[e] = '0';
 }
npc32_predict();
}
//where to insert
if(id_t<70)
{
for(i=0; i<array_to_insert.length; i++)
 {
  e = array_to_insert[i];
   $('#'+e).addClass('occupied');
  js_current_inventory[e] = '1';
 }
js_current_inventory[array_to_insert[0]] = item_code;
jewel_drop_ini();
}
if(id_t>69 && id_t<82)
{
  $('#'+array_to_insert[0]).addClass('occupied');
$( document.getElementById(array_to_insert[0]).parentNode.childNodes[0] ).addClass('occupied');
  js_current_equipment[array_to_insert[0]] = item_code;
}
if(id_t>99 && id_t<220)
{
for(i=0; i<array_to_insert.length; i++)
 {
  e = array_to_insert[i];
   $('#'+e).addClass('occupied');
  js_current_vault[e] = '1';
 }
js_current_vault[array_to_insert[0]] = item_code;
}
if(id_t>249 && id_t<282)
{
for(i=0; i<array_to_insert.length; i++)
 {
  e = array_to_insert[i];
   $('#'+e).addClass('occupied');
  js_current_npc32[e] = '1';
 }
js_current_npc32[array_to_insert[0]] = item_code;
npc32_predict();
}
$('#'+array_to_insert[0]).append( $('#'+array_to_clear[0] + '>img') );
item_size = Number(item_size);
if(id_t == 70 && item_size == 11)
{
 set_margin_left = 16;
 set_margin_top = 16;
}
else if(id_t == 75 && (item_size == 32 || item_size == 33))
{
 set_margin_left = -16;
 set_margin_top = 0;
}
else if ((id_t == 73 || id_t == 76) && (item_size == 11 || item_size == 12 || item_size == 13 || item_size == 14))
{
 set_margin_left = 16;
 set_margin_top = 0;
}
else
{
 set_margin_left = 0;
 set_margin_top = 0;
}
$('#'+array_to_insert[0] + '>img').css({
left: $('#'+array_to_insert[0]).position().left,
top: $('#'+array_to_insert[0]).position().top,
marginLeft: set_margin_left,
marginTop: set_margin_top
});
if(typeof player_damage_max != "undefined" && ((id_t>69 && id_t <82)||(id_s>69 && id_s <82)))
{
update_stats ();
reload_skills();
}
}
    }
  }
if(((id_s>249 && id_s<282) || (id_t>249 && id_t<282)) && typeof npc32_kind != "undefined")
xmlhttp.open("GET","function.move_item.php?id1=" + id_s + "&id2=" + id_t +"&npc32_kind=" + npc32_kind + "&rand=" + Math.random(),true);
else
xmlhttp.open("GET","function.move_item.php?id1=" + id_s + "&id2=" + id_t +"&rand=" + Math.random(),true);
xmlhttp.send();
}
////////////////////////move item end//////////////////////////////
/////////////////////////jewel_drop////////////////////////////////
function jewel_drop(id_s, id_t, array_to_clear, y_to_return, x_to_return) {
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
 $('#js_output').text('Id error.');
			$( document.getElementById(id_s).childNodes[0] ).animate({
				top: y_to_return,
				left: x_to_return
			}, 120 );
			if(tmp_array!='no_space')
			{
			 for(i=0; i<tmp_array.length; i++)
			 {
			  var e=tmp_array[i];
			  $('#'+e).addClass('occupied');
			 }
			}
}
else
{
var array_to_insert = eval('(' + xmlhttp.responseText + ')');
 if(array_to_insert[2] == '1' || array_to_insert[2] == '2')
   $('#js_output').text('Jewel combination failed');
 else
   $('#js_output').text('Jewel combination success');
//delete jewel
js_current_inventory[id_s] = '0';
$('#'+id_s+'>img').remove();
if(array_to_insert[2]!='2')
 {
 //update item
 js_current_inventory[array_to_insert[0]] = array_to_insert[1];
 document.getElementById(array_to_insert[0]).innerHTML = load_items(array_to_insert[1], 0, player_level, player_class, player_strength, player_agility, player_energy);
 target_id = '#' + array_to_insert[0] + '>img';
 drag_init(target_id);
 }
}
    }
  }
xmlhttp.open("GET","function.jewel_drop.php?id1=" + id_s + "&id2=" + id_t +"&rand=" + Math.random(),true);
xmlhttp.send();
}
/////////////////////////jewel_drop end////////////////////////////////
/////////////////////////using item////////////////////////////////
function using_confirmed(r, t_id, item_type, item_sub_type){
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
 if(xmlhttp.responseText=='no_requirement')
 $('#js_output').text('Check item requirements');
 else
 $('#js_output').text('Id error');
}
else
{
var cell_to_clear = eval('(' + xmlhttp.responseText + ')');
var success_effect = cell_to_clear.shift();

for(i=0; i<cell_to_clear.length; i++)
 {
   e = cell_to_clear[i];
   $('#'+e).html('');
   $('#'+e).removeClass('occupied');
   $('#'+e).removeClass('jewel_drop');
   js_current_inventory[e] = 0;
 }
if(item_type == 'F')
{
 $('#js_output').text('potion is used');
  if(typeof player_damage_max != "undefined" && success_effect!='0')
  {
   if(item_sub_type == '1' || item_sub_type == '2' || item_sub_type == '3' || item_sub_type == '4' || item_sub_type == '5')
   {
    player_hp_cur = success_effect;
    $('#stats_hp').html(player_hp_cur + ' / ' + player_hp_final);
   }
   else if(item_sub_type == '6' || item_sub_type == '7' || item_sub_type == '8' || item_sub_type == '9')
   {
    player_mp_cur = success_effect;
    $('#stats_mp').html(player_mp_cur + ' / ' + player_mp_final);
   }
  }
}
else if(item_type == 'G')
{
 $('#js_output').text('skill is learned');
  if(typeof player_damage_max != "undefined" && success_effect!='0')
  {
   current_skills.push(success_effect);
   reload_skills();
  }
}
}
    }
  }
xmlhttp.open("GET","function.use_item.php?id=" + t_id +"&rand=" + Math.random(),true);
xmlhttp.send();
}
}
/////////////////////////using item end////////////////////////////////