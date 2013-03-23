////////////////////////parse item code//////////////////////////////
function parse_item_code (item_code) {
item_type = item_code.slice(0,1);
item_size = Number(item_code.slice(2,4));
item_sub_type = item_code.slice(5,6);
item_effect = Number(item_code.slice(7,11));
item_level = Number(item_code.slice(12,14));
item_luck = Number(item_code.slice(15,16));
requirement_1 = item_code.slice(17,21);
requirement_2 = item_code.slice(22,26);
item_requirement_add = item_code.slice(21,22);
requirement_class = Number(item_code.slice(27,29));
item_skill = item_code.slice(30,31);
item_option = Number(item_code.slice(32,33));
item_excellent = Number(item_code.slice(34,36));
item_harmony = item_code.slice(37,39);
item_guardian = item_code.slice(40,41);
item_durability_cur = Number(item_code.slice(42,45));
item_durability_max = Number(item_code.slice(46,49));
item_socket = item_code.slice(50,56);
item_name_source = item_code.slice(57);
}
////////////////////////parse item code end//////////////////////////////