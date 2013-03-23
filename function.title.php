<?php
$page = ucwords(str_replace("_"," ",basename($_SERVER['SCRIPT_NAME'], ".php")));
if($page == 'Index')
{
 echo '<title>MU BROWSER MMORPG</title>';
 echo '<meta name="description" content="MU jogo de navegador online mmorpg mu." />';
}
else
echo '<title>MU BROWSER MMORPG - '.$page.'</title>';
?>