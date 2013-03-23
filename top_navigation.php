<?php
$logout = 0;
if(isset($_GET['action']))
{
if($_GET['action'] == 'logout')
$logout = 1;
}
echo <<<EOT
<table cellspacing="0" class="top_navigation"><tr><td><a href="index.php">Inicio</a></td><td class="tn_sep"></td><td>
EOT;
if(isset($_SESSION['user_id']) && $logout != 1)
{
 echo '<a href="mypage.php">[';
 echo $_SESSION['username'];
 echo ']'.'</a></td><td class="tn_sep"></td><td><a href="ucp.php?action=logout">Logout</a>';
}
else
{
echo <<<EOT
<a href="ucp.php?action=register">Registrar</a></td><td class="tn_sep"></td><td><a href="ucp.php?action=login"><blink>Login</blink></a>
EOT;
}
echo <<<EOT
</td><td class="tn_sep"></td><td><a href="ranking.php">Ranking</a></td></tr></table>
EOT;
?>
<div class="top_nav_back"></div>
<div class="top_nav_online"><a href="whoisonline.php"><?php include('function.online.php'); ?></a></div>