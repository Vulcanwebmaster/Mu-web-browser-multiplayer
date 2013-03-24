<?php
$conn = mysql_connect("your-ip", "user", "pass") or die(mysql_error());
mysql_select_db('database-name', $conn) or die(mysql_error());
?>
