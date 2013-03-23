<?php
session_start();
$login_not_required = 1;
include('function.login.php');
$navigation = 'news';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN">
<html>
<head>
<?php include('function.title.php'); ?>
<link href="common.css" rel="stylesheet" type="text/css" />
<link href="ucp.css" rel="stylesheet" type="text/css" />
<script src="jquery.js" type="text/javascript"></script>
</head>
<body>
<table class = "parent_table" cellspacing="0">
<tr>
<td colspan="2" class="parent_table_top"><div class="parent_table_top_ins"><?php include('top_navigation.php'); ?></div></td>
</tr>
<tr><td class="parent_table_left"><?php include('navigation.php'); ?></td><td class="parent_table_middle">
<div class="div_border">
<table cellspacing="0" class="about_table" id="about1">
<tr><td><b>XMU BROWSER</b><hr/>
<div id="mu_logo"><img src="images/monster.png" width="132px" height="180px" /></div>
<b>XMU BROWSER -</b> Muito tempo se passou desde que o milenar Imperio de MU perdeu o controle total sobre o Continente. Enquanto o poder do governo central do MU continuou a se dissolvendo, os senhores feudais tornaram-se redigidos e acoplados em um governo interno sobre o controle de MU, destruindo as fundacoes de sua sociedade. Com o tempo, os feudos e as guerras civis sangrentas destruiram a linda terra de MU, e dela também durante este tempo, entre o sangue e os rasgos associados com tais conflitos, entre as ambicoes obcessivas dos homens e daqueles que seriam mais do que homens, sairia uma escuridao e uma negra sombra, caindo sobre todo o MU. .
<br/><br/>
Ajude-nos a acabar com  a sombra da escuridao, entre para esse maravilhoso mundo do continente MU: <a href="ucp.php?action=register">[Registre-se]</a>
<br/><br/>
Navegadores suportados: IE, Chrome, Firefox, Opera, Safari.
<br/><br/>
Feedback: <a href="#">Suporte ao usuario</a>
</td>
<td>
<?php
echo '<div id="navigation1">TOP 10 [Nivel]</div><div id="top10"><ul>';
$query = "SELECT * FROM characters ORDER BY experience DESC LIMIT 0, 10"; //actual result
$result3 = mysql_query($query,$conn);
$pos = 1;
if(mysql_num_rows($result3)>0)
{
 while($row = mysql_fetch_assoc($result3))
 {
  $tmp_name = $row['name'];
  $tmp_level = $row['level'];
  if($pos != mysql_num_rows($result3))
  echo "<li>".$pos.". ".$tmp_name."<div class='top10level'>".$tmp_level."</div></li>";
  else
  echo "<li style='border-bottom:none;'>".$pos.". ".$tmp_name."<div class='top10level'>".$tmp_level."</div></li>";
  $pos +=1;
 }
}
echo "</ul><div id='rank_all'>[<a href='ranking.php'><b>Ver todos</b></a>]</div></div>";
?>
</td>
</tr></table>
<table cellspacing="0" class="about_table" id="about2">
<tr><td><b>Saiba como jogar</b><hr/>
<div class="screenshot"><a href="images/jogar.png"><img src="images/mu1t.jpg"  alt="Mu Online Plus 1" title="Mu Online screenshot 1" /></a><hr/>Criar personagem</div>
<div class="screenshot"><a href="images/jogar2.png"><img src="images/mu2t.jpg" alt="Mu Online Plus 2" title="Mu Online screenshot 2" /></a><hr/>Inventario</div>
<div class="screenshot"><a href="images/jogar3.png"><img src="images/mu3t.jpg" alt="Mu Online Plus 3" title="Mu Online screenshot 3" /></a><hr/>Chaos Machine</div>
<div class="screenshot"><a href="images/jogar4.png"><img src="images/mu4t.jpg" alt="Mu Online Plus 4" title="Mu Online screenshot 4" /></a><hr/>Como lutar</div>
</td></tr></table>
<div id="about_footer">MU BROWSER - 2013</div>
</div>
</td></tr></table>
<style type="text/css">body, a:hover {cursor: url(http://cur.cursors-4u.net/games/gam-4/gam372.cur), progress !important;}</style><a href="http://www.cursors-4u.com/cursor/2008/12/22/world-of-warcraft-wow-hand-armor.html" target="_blank" title="World Of Warcraft, WoW Hand Armor"><img src="http://cur.cursors-4u.net/cursor.png" border="0" alt="World Of Warcraft, WoW Hand Armor" style="position:absolute; top: 0px; right: 0px;" /></a>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38716885-1']);
  _gaq.push(['_setDomainName', 'xmu.com.br']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>