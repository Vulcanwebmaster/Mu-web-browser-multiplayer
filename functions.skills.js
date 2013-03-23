function reload_skills() {
if(equipment_skills.length>0 || js_current_skills.length!=current_skills.length)
{
js_current_skills = equipment_skills.concat(current_skills);

$('#skills_title').text('Skills (' + js_current_skills.length + ')');

$('.action_cont').remove();


for(i=0; i<js_current_skills.length; i++)
{
var test = get_skill_description(js_current_skills[i]);

test = "('" + test + "',ADAPTIVE_WIDTH, 160,320,2)";
test = 'onmouseover="overlib' + test + '" onmouseout="nd()" ';

var insert="<div class='action_cont'><img height='28px' width='20px' class='action' id='skill"+js_current_skills[i]+"'" + test + "src='skills/skill" + js_current_skills[i] + ".gif'/></div>";
$('.image_reel').append(insert);
}


first_image = 1;
image_reelPosition = 0;
$(".image_reel").css({left: '0px'});

//Show the paging and activate its first link
var imageWidth = $(".window").width()/6;
var imageSum = $(".image_reel img").size() + 1;
var imageReelWidth = imageWidth * imageSum;
//Adjust the image reel to its new size
$(".image_reel").css({'width' : imageReelWidth});
}
}


function get_skill_description(skill) {

var attr = 0;

switch (skill+'')
{
//general
 case '1':
 tmp = 'Plasma Storm<br/><br/>Dano: 250 + ENE/5<br/>Targets: 3<br/>Mana: 50';
 attr = 'Lighting attribute';
 break;

 case '2':
 tmp = 'Raid<br/><br/>Dano: 200 + ENE/10<br/>Targets: 1<br/>Mana: 9';
 attr = 'Fire attribute';
 break;


//weapon
 case '3':
 tmp = 'Uppercut<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;

 case '4':
 tmp = 'Cyclone<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;

 case '5':
 tmp = 'Lunge<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;

 case '6':
 tmp = 'Slash<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;

 case '7':
 tmp = 'Falling Slash<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;

 case '8':
 tmp = 'Defesa<br/><br/>Reducao de dano<br/>de 50% por 3 turnos<br/>Mana: 30';
 break;

 case '9':
 tmp = 'Triple Shot<br/><br/>Shoot 3 arrows<br/>Targets: 3<br/>Mana: 5';
 break;

 case 'A':
 tmp = 'Explosion<br/><br/>Curse Dano: 80 ~ 110<br/>Targets: 1<br/>Mana: 90';
 break;

 case 'B':
 tmp = 'Requiem<br/><br/>Curse Dano: 70 ~ 100<br/>Targets: 3<br/>Mana: 100';
 break;

 case 'C':
 tmp = 'Pollution<br/><br/>Curse Dano: 90 ~ 120<br/>Targets: 3<br/>Mana: 120';
 break;

 case 'D':
 tmp = 'Power Slash<br/><br/>Dano: 20 ~ 40<br/>Targets: 1<br/>Mana: 10';
 break;


//DK
 case '21':
 tmp = 'Impale<br/><br/>Dano: 70 ~ 120<br/>Targets: 1<br/>Mana: 8';
 break;

 case '22':
 tmp = 'Twisting Slash<br/><br/>Dano: 60 ~ 110<br/>Targets: 3<br/>Mana: 10';
 attr = 'Wind attribute';
 break;

 case '23':
 tmp = 'Greater Fortitude<br/><br/>Increase HP 12% + ENE/20<br/>Duracao: 20 turnos<br/>Mana: 22';
 break;

 case '24':
 tmp = 'Death Stab<br/><br/>Dano: 85 ~ 140<br/>Targets: 1<br/>Mana: 15';
 attr = 'Wind attribute';
 break;

 case '25':
 tmp = 'Rageful Blow<br/><br/>Dano: 70 ~ 120<br/>Targets: 3<br/>Mana: 25';
 attr = 'Earth attribute';
 break;

 case '26':
 tmp = 'Explosion<br/><br/>Dano: 90 ~ 135<br/>Targets: 3<br/>Mana: 30';
 attr = 'Ice attribute';
 break;


//MG
 case '27':
 tmp = 'Fire Slash<br/><br/>Dano: 10 ~ 20<br/>Targets: 1<br/>Mana: 15';
 attr = 'Fire attribute';
 break;

 case '28':
 tmp = 'Flame Strike<br/><br/>Dano: 20 ~ 30<br/>Targets: 3<br/>Mana: 20';
 attr = 'Fire attribute';
 break;

 case '29':
 tmp = 'Gigantic Storm<br/><br/>Dano: 80 ~ 120<br/>Targets: 3<br/>Mana: 190';
 attr = 'Lighting attribute';
 break;


//DW
 case '30':
 tmp = 'Energy Ball<br/><br/>Dano magico: 3 ~ 4<br/>Targets: 1<br/>Mana: 1';
 break;

 case '31':
 tmp = 'Fire Ball<br/><br/>Dano magico: 8 ~ 12<br/>Targets: 1<br/>Mana: 3';
 attr = 'Fire attribute';
 break;

 case '32':
 tmp = 'Power Wave<br/><br/>Dano magico: 14 ~ 21<br/>Targets: 1<br/>Mana: 5';
 break;

 case '33':
 tmp = 'Meteor<br/><br/>Dano magico: 21 ~ 31<br/>Targets: 1<br/>Mana: 12';
 attr = 'Fire attribute';
 break;

 case '34':
 tmp = 'Lighting<br/><br/>Dano magico: 17 ~ 25<br/>Targets: 1<br/>Mana: 15';
 attr = 'Lighting attribute';
 break;

 case '35':
 tmp = 'Ice<br/><br/>Dano magico: 10 ~ 15<br/>Targets: 1<br/>Mana: 38';
 attr = 'Ice attribute';
 break;

 case '36':
 tmp = 'Poison<br/><br/>Dano magico: 12 ~ 18<br/>Poison Duracao: 5 turnos<br/>Mana: 42';
 attr = 'Poison attribute';
 break;

 case '37':
 tmp = 'Flame<br/><br/>Dano magico: 25 ~ 37<br/>Targets: 1<br/>Mana: 50';
 attr = 'Fire attribute';
 break;

 case '38':
 tmp = 'Twister<br/><br/>Dano magico: 35 ~ 52<br/>Targets: 1<br/>Mana: 60';
 attr = 'Wind attribute';
 break;

 case '39':
 tmp = 'Evil Spirits<br/><br/>Dano magico: 45 ~ 67<br/>Targets: 3<br/>Mana: 90';
 break;

 case '40':
 tmp = 'Hellfire<br/><br/>Dano magico: 120 ~ 180<br/>Targets: 3<br/>Mana: 160';
 attr = 'Fire attribute';
 break;

 case '41':
 tmp = 'Aquabeam<br/><br/>Dano magico: 80 ~ 120<br/>Targets: 1<br/>Mana: 140';
 attr = 'Water attribute';
 break;

 case '42':
 tmp = 'Soul Barrier<br/><br/>Reducao de dano<br/>10 + ENE/100 (%)<br/>Duracao: 20 turnos<br/>Mana: 70';
 break;

 case '43':
 tmp = 'Cometfall<br/><br/>Dano magico: 70 ~ 105<br/>Targets: 1<br/>Mana: 150';
 attr = 'Lighting attribute';
 break;

 case '44':
 tmp = 'Inferno<br/><br/>Dano magico: 100 ~ 150<br/>Targets: 3<br/>Mana: 200';
 break;

 case '45':
 tmp = 'Ice Storm<br/><br/>Dano magico: 80 ~ 120<br/>Targets: 3<br/>Mana: 100';
 attr = 'Ice attribute';
 break;

 case '46':
 tmp = 'Decay<br/><br/>Dano magico: 95 ~ 142<br/>Targets: 1<br/>Mana: 110';
 attr = 'Poison attribute';
 break;

 case '47':
 tmp = 'Nova<br/><br/>Dano magico: 200 ~ 250<br/>Targets: 3<br/>Mana: 180';
 attr = 'Fire attribute';
 break;

 case '48':
 tmp = 'Wizardry Enhance<br/><br/>Aumento dano magico<br/>20 + ENE/100 (%)<br/>Duracao: 20 turnos<br/>Mana: 200';
 break;


//elf
 case '51':
 tmp = 'Heal<br/><br/>Heal 5 + ENE/5 HP<br/>Mana: 20';
 break;

 case '52':
 tmp = 'Greater Defense<br/><br/>Aumento defesa 2 + ENE/8<br/>Duracao: 20 turnos<br/>Mana: 30';
 break;

 case '53':
 tmp = 'Greater Damage<br/><br/>Aumento defesa 3 + ENE/7<br/>Duracao: 20 turnos<br/>Mana: 40';
 break;

 case '54':
 tmp = 'Penetration<br/><br/>Dano: 144 ~ 218<br/>Targets: 1<br/>Mana: 7';
 attr = 'Wind attribute';
 break;

 case '55':
 tmp = 'Ice Arrow<br/><br/>Dano: 204 ~ 322<br/>Targets: 1<br/>Mana: 10';
 attr = 'Ice attribute';
 break;

 case '56':
 tmp = 'Multi Shot<br/><br/>Shoot 5 arrows<br/>Targets: 3<br/>Mana: 10';
 break;

 case '57':
 tmp = 'Summon Goblin<br/><br/>Life: 60<br/>Dano: 9 ~ 11<br/>Mana: 40';
 break;

 case '58':
 tmp = 'Summon Stone Golem<br/><br/>Life: 465<br/>Dano: 62 ~ 68<br/>Mana: 70';
 break;

 case '59':
 tmp = 'Summon Assasin<br/><br/>Life: 800<br/>Dano: 95 ~ 100<br/>Mana: 110';
 break;

 case '60':
 tmp = 'Summon Elite Yeti<br/><br/>Life: 900<br/>Dano: 105 ~ 110<br/>Mana: 160';
 break;

 case '61':
 tmp = 'Summon Dark Knight<br/><br/>Life: 3000<br/>Dano: 150 ~ 155<br/>Mana: 200';
 break;

 case '62':
 tmp = 'Summon Bali<br/><br/>Life: 5000<br/>Dano: 165 ~ 170<br/>Mana: 250';
 break;

 case '63':
 tmp = 'Summon Soldier<br/><br/>Life: 5000<br/>Dano: 300 ~ 310<br/>Mana: 350';
 break;


//summoner
 case '70':
 tmp = 'Drain Life<br/><br/>Curse Damage: 35 ~ 52<br/>Restaurar HP<br/>Mana: 50';
 break;

 case '71':
 tmp = 'Sleep<br/><br/>Effect: target sleeps<br/>Duracao: 5 turnos<br/>Mana: 20';
 break;

 case '72':
 tmp = 'Chain Lighting<br/><br/>Curse Dano: 70 ~ 105<br/>Targets: 1<br/>Mana: 85';
 attr = 'Lighting attribute';
 break;

 case '73':
 tmp = 'Damage Reflection<br/><br/>Reflect dmg 20 + ENE/40 (%)<br/>Duracao: 20 turnos<br/>Mana: 40';
 break;

 case '74':
 tmp = 'Berserker<br/><br/>Aumento dano 30 + ENE/20<br/>Aumento defesa 10 + ENE/20<br/>Duracao: 20 turnos<br/>Mana: 100';
 break;

 case '75':
 tmp = 'Weakness<br/><br/>Reducao dano 20 + ENE/20<br/>Duracao: 20 turnos<br/>Mana: 50';
 break;

 case '76':
 tmp = 'Lighting Shock<br/><br/>Curse Dano: 95 ~ 142<br/>Targets: 3<br/>Mana: 120';
 attr = 'Lighting attribute';
 break;

 case '77':
 tmp = 'Innovation<br/><br/>Reducao defesa 20 + ENE/20<br/>Duracao: 20 turnos<br/>Mana: 70';
 break;


 default:
 tmp = 'unknown skill: '+skill;
}
if(attr!=0)
tmp = tmp + '<br/><a class=&quot;blue&quot;>' + attr + '</a>';

tmp = '<br/><div>' + tmp + '</div><br/>';
return tmp;

}