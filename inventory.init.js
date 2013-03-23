$(document).ready( function() {
var target_id = '.item';
drag_init(target_id);
drop_init();
$('.item').rightClick( function(){
  t_id = $(this).parent().attr('id');
  if(t_id<64)
  {
   var item_type = js_current_inventory[t_id].slice(0,1);
   var item_sub_type = js_current_inventory[t_id].slice(5,6);
   if(item_type == 'F' || item_type == 'G')
   jConfirm('Usar esse item?', 'Confirm Using', function(r) {using_confirmed(r, t_id, item_type, item_sub_type);});
  }
});
});