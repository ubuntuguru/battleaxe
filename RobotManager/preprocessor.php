<?php


if(isset($_GET["q"])){
	switch($_GET["q"]){
		case 'nodes':
			include "p/nodes.php";
			break;
		default:
			break;
	}

}
