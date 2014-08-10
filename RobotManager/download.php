<?php
session_start();
if(md5($_SESSION["uid"]) != $_SESSION["hid"]){
        echo '<meta http-equiv="refresh" content="0; url=/login.php" />';
        exit();
}
if(isset($_GET["key"]) and isset($_GET["uuid"])){

	$mysqli = new mysqli("dbs.battleaxe.lobsternetworks.com", "battleaxe", "ba7713ax3", "battleaxe");
	$stmt = $mysqli->prepare("select `pri_key`, `pub_key` from nodes where UUID=?");
	$stmt->bind_param("s", $_GET["uuid"]);
	$stmt->execute();
	$stmt->bind_result($pri, $pub);
	$stmt->fetch();
	$stmt->close();
if($_GET["key"] == "pri"){
	$file_name = "private.key";
	$data = $pri;
}elseif($_GET["key"] == "pub"){
        $file_name = "public.key";
        $data = $pub;
}else{
	echo "error";
	exit();
}
header("Content-Type: text/plain; charset=utf-8");
header("Content-Disposition: attachment; filename=\"$file_name\"");
echo $data;
$mysqli->close();
}
