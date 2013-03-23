function get_skill_name(skill) {
switch (skill+'')
{
//general
 case '1':
 tmp = 'Plasma Storm';
 break;
 case '2':
 tmp = 'Raid';
 break;
//weapon
 case '3':
 tmp = 'Uppercut';
 break;
 case '4':
 tmp = 'Cyclone';
 break;
 case '5':
 tmp = 'Lunge';
 break;
 case '6':
 tmp = 'Slash';
 break;
 case '7':
 tmp = 'Falling Slash';
 break;
 case '8':
 tmp = 'Defense';
 break;
 case '9':
 tmp = 'Triple Shot';
 break;
 case 'A':
 tmp = 'Explosion';
 break;
 case 'B':
 tmp = 'Requiem';
 break;
 case 'C':
 tmp = 'Pollution';
 break;
 case 'D':
 tmp = 'Power Slash';
 break;
}
tmp = tmp + ' Skill';
return tmp;
}
function load_items(item_code, shop, player_level, player_class, player_strength, player_agility, player_energy, store_price) {
//"shop": 0=no price; 1=purchasing price; 2=selling price; 3=move from store to inventory; 4=move from inventory to store; 5=market; 6=battle;
//initialize all variables
parse_item_code(item_code);
//begin forming description
description = '<div><br/>';
if(shop==1)
{
//0. calculate purchasing price
if(item_type=='C' || item_type=='D' || item_type=='E')
var bonus_price = 500;
else
var bonus_price = 5;
var item_price = bonus_price + item_effect*(1 + item_level + item_luck + Number(item_option) + Math.ceil(item_excellent/100)*10 + Number(item_harmony) + Number(item_guardian)) + item_durability_cur;
description += 'Valor de compra: ' + item_price + '<br/>';
}
if(shop==2)
{
//0. calculate selling price
if(item_type=='C' || item_type=='D' || item_type=='E')
var bonus_price = 500;
else
var bonus_price = 5;
var item_price = Math.floor((bonus_price + item_effect*(1 + item_level + item_luck + Number(item_option) + Math.ceil(item_excellent/100)*10 + Number(item_harmony) + Number(item_guardian)) + item_durability_cur)/2);
description += 'Valor de venda: ' + item_price + '<br/>';
}
if(shop==6)
description += '[clique no item para pegar]<br/>';
if(typeof store_price != "undefined")
description += 'Price: ' + store_price + '<br/>';
//1. item name > capitalize and remove underscores
        newVal = '';
        item_name = item_name_source.split('_');
        for(var c=0; c < item_name.length; c++) {
                newVal += item_name[c].substring(0,1).toUpperCase() +
item_name[c].substring(1, item_name[c].length) + ' ';
        }
        item_name = newVal;
  //1.1. adding + item level if necessary
  if(item_level!=0)
  item_name = item_name + ' + ' + item_level + ' ';

name_to_add = item_name;

 //1.2. coloring name if necessary
    if(item_type == "D" || item_type == "E" || (item_type == "B" && item_sub_type == '9') || (item_type == "B" && item_sub_type == '8'))
    name_to_add = '<a class=&quot;yellow&quot;>' + item_name + '</a>'; //yellow name
    else if(item_name.indexOf("Divine")>-1)
     name_to_add = '<a class=&quot;pink&quot;>' + item_name + '</a>'; //pink for archangel items
    else if(item_socket!=0)
     name_to_add = '<a class=&quot;purple&quot;>' + item_name + '</a>'; //purple for socket items
    else if(item_excellent!=0)
    {
     if(item_excellent>9)
          name_to_add = '<a class=&quot;brown&quot;>Ancient ' + item_name + '</a>'; //brown for double excellent items
     else
     name_to_add = '<a class=&quot;green&quot;>Excellent ' + item_name + '</a>'; //green for excellent items
    }
    else if(item_level > 6)
    {
     name_to_add = '<a class=&quot;yellow&quot;>' + item_name + '</a>'; //yellow for items with level +7 and above
    }
    else
    {
     if(item_level > 3 || item_option!=0 || item_luck!=0 || item_skill!=0)
      name_to_add = '<a class=&quot;blue&quot;>' + item_name + '</a>'; //blue for items with level +3 and above
    }
  description += '<b>' + name_to_add + '</b><br/>';
//1.1. optional description
var optional_desc = '';
 if(item_type == "9")
 optional_desc = 'Defesa: ' + (item_effect + item_level);//shield defense is here to avoid coloring it blue for excellent items
 if(item_type == "A")
{
 optional_desc = 'Elemental Resistance + ' + (1 + item_level);
}
 if(item_type == "B")
{
    if(item_sub_type == '9')
 optional_desc = '<a class=&quot;red&quot;>Sem reparo</a><br/>Aumento magia Dmg + 10%<br/>Aumento de dano + 10%<br/>Aumento de velocidade + 10';
    else if(item_sub_type == '8')
 optional_desc = '<a class=&quot;red&quot;>Sem reparo</a><br/>I.D. of Kanturu Chief Scientist<br/>Allows access to the Refinery Tower';
    else if(item_sub_type == '6')
 optional_desc = 'Vai se transformar em um monstro<br/>se equipar';
    else if(item_sub_type == 'A')
 optional_desc = 'Dropadar depois do level 40';
    else if(item_sub_type == 'B')
 optional_desc = 'Dropadar depois do level 80';
    else
 optional_desc = 'Elemental Resistance + ' + (1 + item_level);
}
 if(item_type == "C")
{
    if(item_sub_type == '1')
optional_desc = 'Absorb 20% of damage<br/>Max HP +50 increase';
    if(item_sub_type == '2')
optional_desc = 'Increase Wizardry Dmg + 30%<br/>Increase Damage + 30%';
    if(item_sub_type == '4')
optional_desc = 'Absorb 10% of damage<br/>Increase 15% of damage<br/>';
    if(item_sub_type == '6')
optional_desc = '<a class=&quot;blue&quot;>Absorb final damage 10%<br/>Increase speed</a>';
    if(item_sub_type == '7')
optional_desc = '<a class=&quot;blue&quot;>Increase final damage 10%<br/>Increase speed</a>';
    if(item_sub_type == '8')
optional_desc = '<a class=&quot;blue&quot;>Absorb 30% of damage</a><br/>Max HP +50 increase';
    if(item_sub_type == '9')
optional_desc = '<a class=&quot;blue&quot;>Increase Wizardry Dmg + 40%<br/>Increase Damage + 40%</a>';
}
 if(item_type == "D")
{
    if(item_sub_type == '1')
optional_desc = 'Refinar o item para + 6';
    if(item_sub_type == '2')
optional_desc = 'Refinar o item para + 9';
    if(item_sub_type == '3')
optional_desc = 'Resetar refinamento do item';
    if(item_sub_type == '4')
optional_desc = 'Jewel for item reinforcement';
    if(item_sub_type == '5')
optional_desc = 'Grant power to reinforced items';
    if(item_sub_type == '6')
optional_desc = 'Grant power to reinforced items';
    if(item_sub_type == '7')
optional_desc = 'Usado para refinar itens';
}
 if(item_type == "E")
{
    if(item_sub_type == '1')
optional_desc = 'Used for Chaos Machine';
    if(item_sub_type == '2')
optional_desc = 'Used for creating fruits';
    if(item_sub_type == '3')
optional_desc = 'Jewel with impurities';
    if(item_sub_type == '4' || item_sub_type == '5')
optional_desc = 'A pack of 10 jewels';
}
 if(item_type == "H")
{
optional_desc = 'Dropar para receber item ou Ouro';
}
 if(item_type == "I")
{
    if(item_sub_type == '1' || item_sub_type == '2' || item_sub_type == '3')
optional_desc = 'Bring it back to Cherry Blossom Spirit';
    if(item_sub_type == '4' || item_sub_type == '5')
optional_desc = 'Used to create Cloak of Invisibility';
    if(item_sub_type == '6' || item_sub_type == '7')
optional_desc = 'Used to create Devil Square Invitation';
    if(item_sub_type == '8' || item_sub_type == '9')
optional_desc = 'Used to create Scroll of Blood';
    if(item_sub_type == 'A')
optional_desc = 'Collect 5 pieces to create lost map';
    if(item_sub_type == 'B')
optional_desc = 'Sign infused with traces of dimensions<br/>Collect five and the signs will transform into a Mirror of Dimensions';
    if(item_sub_type == 'C' || item_sub_type == 'D')
optional_desc = 'Used to create Fragment Of Horn';
    if(item_sub_type == 'E' || item_sub_type == 'F')
optional_desc = 'Used to create Broken Horn';
    if(item_sub_type == 'G')
optional_desc = 'Used to create Horn Of Fenrir';
    if(item_sub_type == 'H')
optional_desc = 'Used for creating 2nd level wings';
    if(item_sub_type == 'I' || item_sub_type == 'J')
optional_desc = 'Used for creating 3rd level wings';
    if(item_sub_type == 'K' || item_sub_type == 'L')
optional_desc = 'Combine with a key to open';
    if(item_sub_type == 'M' || item_sub_type == 'N')
optional_desc = 'Open a sealed box';
}
 if(item_type == "J")
{
    if(item_sub_type == 'A' || item_sub_type == 'B' || item_sub_type == 'C' || item_sub_type == 'D')
optional_desc = 'Adds 1-3 points to stats';
}
 if(item_type == "K")
{
optional_desc = 'Ticket para o evento';
}
if(optional_desc!='')
description += '<br/>' + optional_desc;
//2. check item effect
if(item_effect!=0)
{
 switch (item_type)
{
  case "1":
  effect_kind='One-Handed Dano: ' + Math.floor((item_effect + item_level*3 + (Math.ceil(item_excellent/100)*30))*5/6) + '~' + (item_effect + item_level*3 + Math.ceil(item_excellent/100)*30);
  break;
  case "2":
  effect_kind='Two-Handed Dano: ' + Math.floor((item_effect + item_level*3 + (Math.ceil(item_excellent/100)*30))*5/6) + '~' + (item_effect + item_level*3 + Math.ceil(item_excellent/100)*30);
  break;
  case "3":
  case "4":
  case "5":
  case "6":
  case "7":
  effect_kind='Defesa: ' + (item_effect + item_level*3 + Math.ceil(item_excellent/100)*30);
  break;
  case "8":
if(item_sub_type == '1')
  effect_kind='Defesa: ' + (item_effect + item_level*3) + '<br/>Increase: ' + (12 + item_level*2) + ' % of damage<br/>Absorb: ' + (12 + item_level*2) + ' % of damage<br/>Increase speed';
else
  effect_kind='Defesa: ' + (item_effect + item_level*2) + '<br/>Increase: ' + (25 + item_level*2) + ' % of damage<br/>Absorb: ' + (25 + item_level*2) + ' % of damage<br/>Increase speed';
  break;
  case "9":
  effect_kind='Defesa Rate: ' + (item_effect*3 + item_level*3 + Math.ceil(item_excellent/100)*30);
  break;
  case "F":
if(item_sub_type == '1' || item_sub_type == '2' || item_sub_type == '3' || item_sub_type == '4' || item_sub_type == '5')
    effect_kind='Restores ' + item_effect + '% of HP';
else if(item_sub_type == '6' || item_sub_type == '7' || item_sub_type == '8' || item_sub_type == '9')
    effect_kind='Restores ' + item_effect + '% of MP';
else if(item_sub_type == 'A')
    effect_kind='Cures poisoning';
  break;
  case "J":
    switch(item_durability_cur)
    {
     case 1:
     effect_kind_type = 'Strength';
     break;
     case 2:
     effect_kind_type = 'Agility';
     break;
     case 3:
     effect_kind_type = 'Stamina';
     break;
     case 4:
     effect_kind_type = 'Energy';
     break;
     case 5:
     effect_kind_type = 'Defense';
     break;
     case 6:
     effect_kind_type = 'Damage';
     break;
     case 7:
     effect_kind_type = 'HP';
     break;
     case 8:
     effect_kind_type = 'Mana';
     break;
     default:
     effect_kind_type = 'Unknown value';
    }
    effect_kind = effect_kind_type + ' Increase + ' + item_effect;
  break;
  default:
effect_kind ='unknown effect';
}
if(item_excellent!=0 || item_type == 'J')
  description += '<br/><a class=&quot;blue&quot;>' + effect_kind + '</a>';
else if(item_type=='1' && item_sub_type=='5')
{//skip book effect
}
else
  description += '<br/>' + effect_kind;
}
//3. durability/life (for pets)
if(item_durability_max!=0 && item_durability_cur!=0)
{
 if(item_type=='C')
 description += '<br/>Life: ' + item_durability_cur; //pet
 else if(item_type=='J')
 description += '<br/><a class=&quot;pink&quot;>Quantidade: ' + item_durability_max + ' turnos</a>';
 else if(item_type=='I' || item_type=='F' || (item_type=='1' && item_sub_type=='6') || (item_type=='1' && item_sub_type=='7'))
 description += '<br/>Numero de itens: ' + item_durability_cur + '/' + item_durability_max;
 else
 description += '<br/>Durabilidade [' + item_durability_cur + '/' + item_durability_max + ']'; //durability
}
//4. check requirements
if(requirement_1.slice(0,1)!='0')
{
 var requirement_1_value = Number(requirement_1.slice(1,4)) + item_level*5 + Math.ceil(item_excellent/100)*30;
 switch (requirement_1.slice(0,1))
 {
  case '1':
    //required strength
    if(requirement_1_value > player_strength)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de forca: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_strength) + ')</a>';
    else
    description += '<br/>' + 'Pontos de forca: ' + requirement_1_value; 
    break;
  case '2':
    //required agility
    if(requirement_1_value > player_agility)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de agilidade: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_agility) + ')</a>';
    else
    description += '<br/>' + 'Pontos de agilidade: ' + requirement_1_value; 
    break;
  case '3':
    //required energy
    if(requirement_1_value > player_energy)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de magia: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_energy) + ')</a>';
    else
    description += '<br/>' + 'Pontos de magia: ' + requirement_1_value; 
    break;
  case '4':
    //required level
    if(requirement_1_value > player_level)
    description += '<br/><a class=&quot;red&quot;>' + 'Nivel requerido: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_level) + ')</a>';
    else
    description += '<br/>' + 'Nivel requerido: ' + requirement_1_value; 
    break;
  case '5':
    //required stamina
    if(requirement_1_value > player_stamina)
    description += '<br/><a class=&quot;red&quot;>' + 'Usable HP: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_stamina) + ')</a>';
    else
    description += '<br/>' + 'Usable HP: ' + requirement_1_value; 
    break;
 }
}
if(requirement_2.slice(0,1)!='0')
{
 var requirement_2_value = Number(requirement_2.slice(1,4)) + item_level*5 + Math.ceil(item_excellent/100)*30;
 switch (requirement_2.slice(0,1))
 {
  case '1':
    //required strength
    if(requirement_2_value > player_strength)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de forca: ' + requirement_2_value + ' (Falta&nbsp;' + Number(requirement_2_value-player_strength) + ')</a>';
    else
    description += '<br/>' + 'Pontos de forca: ' + requirement_2_value; 
    break;
  case '2':
    //required agility
    if(requirement_2_value > player_agility)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de agilidade: ' + requirement_2_value + ' (Faltando&nbsp;' + Number(requirement_2_value-player_agility) + ')</a>';
    else
    description += '<br/>' + 'Pontos de agilidade: ' + requirement_2_value; 
    break;
  case '3':
    //required energy
    if(requirement_2_value > player_energy)
    description += '<br/><a class=&quot;red&quot;>' + 'Pontos de magia: ' + requirement_2_value + ' (Faltando&nbsp;' + Number(requirement_2_value-player_energy) + ')</a>';
    else
    description += '<br/>' + 'Pontos de magia: ' + requirement_2_value; 
    break;
  case '4':
    //required level
    if(requirement_2_value > player_level)
    description += '<br/><a class=&quot;red&quot;>' + 'Nivel requerido: ' + requirement_2_value + ' (Faltando&nbsp;' + Number(requirement_2_value-player_level) + ')</a>';
    else
    description += '<br/>' + 'Nivel requerido: ' + requirement_2_value; 
    break;
  case '5':
    //required stamina
    if(requirement_1_value > player_stamina)
    description += '<br/><a class=&quot;red&quot;>' + 'Usable HP: ' + requirement_1_value + ' (Faltando&nbsp;' + Number(requirement_1_value-player_stamina) + ')</a>';
    else
    description += '<br/>' + 'Usable HP: ' + requirement_1_value; 
    break;
 }
}
if(item_requirement_add=='!')
{
    if(player_level<380)
    description += '<br/><a class=&quot;red&quot;>' + 'Nivel requerido: 380 (Faltando&nbsp;' + Number(380-player_level) + ')</a>';
    else
    description += '<br/>' + 'Nivel requerido: 380'; 
}
//5. check required class
if(requirement_class!=0)
{
 description += '<br/>';
{
 description += '<br/>';
 switch(requirement_class)
 {
  case 1:
  if(player_class=='1' || player_class=='21')
  description += '<div>Pode ser equipado por Dark Knight</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div>';
  break;
  case 2:
  if(player_class=='2' || player_class=='22')
  description += '<div>Pode ser equipado por Dark Wizard</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div>';
  break;
  case 3:
  if(player_class=='3' || player_class=='23')
  description += '<div>Pode ser equipado por Fairy Elf</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Fairy Elf</div>';
  break;
  case 4:
  if(player_class=='4' || player_class=='24')
  description += '<div>Pode ser equipado por Summoner</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Summoner</div>';
  break;
  case 5:
  if(player_class=='5')
  description += '<div>Pode ser equipado por Magic Gladiator</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  break;
  case 6:
  if(player_class=='6')
  description += '<div>Pode ser equipado por Dark Lord</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Lord</div>';
  break;
  case 7:
  if(player_class=='7')
  description += '<div>Pode ser equipado por Rage Fighter</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Rage Fighter</div>';
  break;
  case 10:
  if(player_class=='1' || player_class=='21')
  description += '<div>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div>';
  else if(player_class=='2' || player_class=='22')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div>Pode ser equipado por Dark Wizard</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div>';
  break;
  case 11:
  if(player_class=='1' || player_class=='21')
  description += '<div>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Fairy Elf</div>';
  else if(player_class=='3' || player_class=='23')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div>Pode ser equipado por Fairy Elf</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Fairy Elf</div>';
  break;
  case 12:
  if(player_class=='2' || player_class=='22')
  description += '<div>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Fairy Elf</div>';
  else if(player_class=='3' || player_class=='23')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div>Pode ser equipado por Fairy Elf</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Fairy Elf</div>';
  break;
  case 13:
  if(player_class=='2' || player_class=='22')
  description += '<div>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Summoner</div>';
  else if(player_class=='4' || player_class=='24')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div>Pode ser equipado por Summoner</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Summoner</div>';
  break;
  case 14:
  if(player_class=='2' || player_class=='22')
  description += '<div>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  else if(player_class=='5')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div>Pode ser equipado por Magic Gladiator</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  break;
  case 15:
  if(player_class=='1' || player_class=='21')
  description += '<div>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  else if(player_class=='5')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div>Pode ser equipado por Magic Gladiator</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Knight</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  break;
  case 16:
  if(player_class=='2' || player_class=='22')
  description += '<div>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Summoner</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  else if(player_class=='4' || player_class=='24')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div>Pode ser equipado por Summoner</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  else if(player_class=='5')
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Summoner</div><div>Pode ser equipado por Magic Gladiator</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Dark Wizard</div><div class=&quot;redback&quot;>Pode ser equipado por Summoner</div><div class=&quot;redback&quot;>Pode ser equipado por Magic Gladiator</div>';
  break;
  case 21:
  if(player_class=='21')
  description += '<div>Pode ser equipado por Blade Knight</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Blade Knight</div>';
  break;
  case 22:
  if(player_class=='22')
  description += '<div>Pode ser equipado por Soul Master</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Soul Master</div>';
  break;
  case 23:
  if(player_class=='23')
  description += '<div>Pode ser equipado por Muse Elf</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Muse Elf</div>';
  break;
  case 24:
  if(player_class=='24')
  description += '<div>Pode ser equipado por Bloody Summoner</div>';
  else
  description += '<div class=&quot;redback&quot;>Pode ser equipado por Bloody Summoner</div>';
  break;
  default:
  description += '<div class=&quot;redback&quot;>unknown requirement class</div>';
 }
}

}
//6. staff wiz damage rise or speed increase
var bold_add_info = '';
if((item_type=='1' && item_sub_type=='3') || (item_type=='2' && item_sub_type=='3'))
bold_add_info = '<br/><a class=&quot;blue&quot;><b>Dano magico ' + Math.floor((item_effect + item_level*3 + Math.ceil(item_excellent/100)*30)*5/6) + '% rise</b></a>';
if((item_type=='1' && item_sub_type=='5'))
bold_add_info = '<br/><a class=&quot;blue&quot;><b>Curse Spell Increment ' + Math.floor(item_effect + item_level*3 + Math.ceil(item_excellent/100)*30) + '%</b></a>';
if(item_type=='6' && item_level>3)
bold_add_info = '<br/><a class=&quot;blue&quot;><b>Swimming speed increase</b></a>';
if(item_type=='7' && item_level>3)
bold_add_info = '<br/><a class=&quot;blue&quot;><b>Moving speed increase</b></a>';

if(bold_add_info!='')
{
if(requirement_class=='00')
bold_add_info = '<br/>' + bold_add_info;
else
bold_add_info = bold_add_info + '<br/>';
description += bold_add_info;
}

//7. separator
if(requirement_class=='00')
{
if(item_skill!=0 ||item_luck!=0 || item_option!=0 || item_excellent!=0 || item_harmony!=0 || item_guardian!=0)
description +='<br/>';
}


//8. check harmony option
if(item_harmony!='00')
{
 var item_harmony_type = Number(item_harmony.slice(0,1));
 var item_harmony_value = Number(item_harmony.slice(1,2));
 if(item_type == '1' || item_type == '2')
  {
    switch(item_harmony_type)
    {
     case 1:
     description += '<br/><a class=&quot;yellow&quot;>Min Damage Increase + ' + item_harmony_value*3 + '</a><br/>';
     break;
     case 2:
     description += '<br/><a class=&quot;yellow&quot;>Max Damage Increase + ' + item_harmony_value*5 + '</a><br/>';
     break;
     case 3:
     description += '<br/><a class=&quot;yellow&quot;>Required STR Decrease + ' + item_harmony_value*8 + '</a><br/>';
     break;
     case 4:
     description += '<br/><a class=&quot;yellow&quot;>Required AGI Decrease + ' + item_harmony_value*8 + '</a><br/>';
     break;
     case 5:
     description += '<br/><a class=&quot;yellow&quot;>Critical Damage Increase + ' + item_harmony_value*6 + '</a><br/>';
     break;
     case 6:
     description += '<br/><a class=&quot;yellow&quot;>Skill Damage Increase + ' + item_harmony_value*5 + '</a><br/>';
     break;
   }
  }

 if(item_type == '3' || item_type == '4' || item_type == '5' || item_type == '6' || item_type == '7' || item_type == '8' || item_type == '9')
  {
    switch(item_harmony_type)
    {
     case 1:
     description += '<br/><a class=&quot;yellow&quot;>Defense Increase + ' + item_harmony_value*5 + '</a><br/>';
     break;
     case 2:
     description += '<br/><a class=&quot;yellow&quot;>Maximum HP Increase + ' + item_harmony_value*6 + '</a><br/>';
     break;
     case 3:
     description += '<br/><a class=&quot;yellow&quot;>HP Recovery Rate + ' + item_harmony_value + '%</a><br/>';
     break;
     case 4:
     description += '<br/><a class=&quot;yellow&quot;>Mana Recovery Rate + ' + item_harmony_value + '%</a><br/>';
     break;
     case 5:
     description += '<br/><a class=&quot;yellow&quot;>Defense Rate Increase + ' + item_harmony_value*2 + '</a><br/>';
     break;
     case 6:
     description += '<br/><a class=&quot;yellow&quot;>Damage Decrease Rate + ' + item_harmony_value + '%</a><br/>';
     break;
    }
  }
}

//9. check skill
if(item_skill!=0)
  description += '<br/><a class=&quot;blue&quot;>' + get_skill_name(item_skill) + '</a><br/>';


//10. check luck (0 or 1)
if(item_luck!=0)
description += '<br/><a class=&quot;blue&quot;>Chance (success of Jewel of Soul + 25%)<br/>Chance (Dano critico rate + 5%)</a>';


//11. check option
  if(item_option!=0)
  {
    switch(item_type)
    {
     case '1':
     case '2':
if(item_sub_type == '7')
     description += '<br/><a class=&quot;blue&quot;>Additional Wizardry Dmg + ' + item_option*4 + '</a>';
else
     description += '<br/><a class=&quot;blue&quot;>Additional Dmg + ' + item_option*4 + '</a>';
     break;
     case "3":
     case "4":
     case "5":
     case "6":
     case "7":
     case "8":
     description += '<br/><a class=&quot;blue&quot;>Additional Defense + ' + item_option*4 + '</a>';
     break;
     case '9':
     description += '<br/><a class=&quot;blue&quot;>Additional Defense Rate + ' + item_option*5 + '</a>';
     break;
     case 'A':
     description += '<br/><a class=&quot;blue&quot;>Automatic HP recovery ' + item_option + '%</a>';
     break;
     case 'B':
if(item_sub_type == '7')
     description += '<br/><a class=&quot;blue&quot;>Increase maximum mana + ' + item_option + '%</a>'; //ring of magic
else
     description += '<br/><a class=&quot;blue&quot;>Automatic HP recovery ' + item_option + '%</a>';
     break;
    }
  }

//12. check excellent option
  if(item_excellent!=0)
  {
   if(item_type == '1' || item_type == '2' || item_type == 'A')
   {
    switch(item_excellent)
    {
     case 1:
     description += '<br/><a class=&quot;blue&quot;>Excellent damage rate + 10%</a>';
     break;
     case 2:
     description += '<br/><a class=&quot;blue&quot;>Increase dmg + 2%</a>';
     break;
     case 3:
     description += '<br/><a class=&quot;blue&quot;>Increase attacking speed + 7</a>';
     break;
     case 4:
     description += '<br/><a class=&quot;blue&quot;>Increase dmg + lvl/20</a>';
     break;
     case 5:
     description += '<br/><a class=&quot;blue&quot;>Increase life after monster + life/8</a>';
     break;
     case 6:
     description += '<br/><a class=&quot;blue&quot;>Increase mana after monster + mana/8</a>';
     break;
    }
   }
   else
   {
    switch(item_excellent)
    {
     case 1:
     description += '<br/><a class=&quot;blue&quot;>Damage decrease + 4%</a>';
     break;
     case 2:
     description += '<br/><a class=&quot;blue&quot;>Defense success rate + 10%</a>';
     break;
     case 3:
     description += '<br/><a class=&quot;blue&quot;>Increase HP + 4%</a>';
     break;
     case 4:
     description += '<br/><a class=&quot;blue&quot;>Increase mana + 4%</a>';
     break;
     case 5:
     description += '<br/><a class=&quot;blue&quot;>Increase zen after hunt + 40%</a>';
     break;
     case 6:
     description += '<br/><a class=&quot;blue&quot;>Reflect damage + 5%</a>';
     break;
    }
   }
  }

//13. check socket options
if(item_socket!='000000' && item_socket!='00000A')
{
 description += '<br/><a class=&quot;purple&quot;>Socket item option info</a><br/>';

 var socket_option1 = item_socket.slice(0,2);
 var socket_option2 = item_socket.slice(2,4);
 var socket_option3 = item_socket.slice(4,6);

 if(socket_option1 == '01')
 description += '<br/><a class=&quot;gray&quot;>Socket 1: no item application</a>';
 if(socket_option2 == '01')
 description += '<br/><a class=&quot;gray&quot;>Socket 2: no item application</a>';
 if(socket_option3 == '01')
 description += '<br/><a class=&quot;gray&quot;>Socket 3: no item application</a>';
}


//end forming description
description += '</div><br/>';

switch (item_type)
{
 case '1':
var add_class = 'item hand1 hand2';
 break;
 case '2':
var add_class = 'item hand1';//two-handed weapon can be equipped only in the left slot
 break;
 case '3':
var add_class = 'item armor';
 break;
 case '4':
var add_class = 'item pants';
 break;
 case '5':
var add_class = 'item helm';
 break;
 case '6':
var add_class = 'item gloves';
 break;
 case '7':
var add_class = 'item boots';
 break;
 case '8':
var add_class = 'item wings';
 break;
 case '9':
var add_class = 'item hand2';//shield
 break;
 case 'A':
var add_class = 'item necklace';
 break;
 case 'B':
var add_class = 'item ring1 ring2';
 break;
 case 'C':
var add_class = 'item pet';
 break;
 case 'D':
var add_class = 'item jewel';
 break;
 default:
var add_class = 'item';
}

if(shop==5 || shop==6)
return description;

add_size = "alt='" + item_size + "'";

test = "('" + description + "',ADAPTIVE_WIDTH, 180,320,2)";

if(shop==1)
add_class += ' sell_shop';

if(shop==2)
add_class += ' sell_inv';

if(shop==3)
add_class += ' store_to_inv';

if(shop==4)
add_class += ' inv_to_store';

add_class = 'class=' + '"' + add_class + '"';

test = 'onmouseover="overlib' + test + '" onmouseout="nd()" ';

insert ="<img " + add_class + add_size + " name='" + item_name + "' " + test + " src='items/" + item_type + "/" + item_name_source + ".gif'/>";
return insert;
}
