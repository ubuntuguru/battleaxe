<?php
session_start();
$_SESSION = "null";
session_destroy();
echo '<meta http-equiv="refresh" content="0; url=/index.php" />';
?>
