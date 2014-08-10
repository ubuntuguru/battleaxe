<?php
include 'UUID.php';

session_start();
if(md5($_SESSION["uid"]) != $_SESSION["hid"]){
	echo '<meta http-equiv="refresh" content="0; url=/login.php" />';
	exit();
}

	$mysqli = new mysqli("dbs.battleaxe.lobsternetworks.com", "battleaxe", "ba7713ax3", "battleaxe");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="BattleAxe">
    <meta name="author" content="George Moody">
    <link rel="icon" href="../../favicon.ico">

    <title>BattleAxe</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">

  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">BattleAxe</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/dashboard.php">Dashboard</a></li>
            <li><a href="/dashboard.php?q=profile">Profile</a></li>
			<li><a href="/logout.php">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			  <li class="<?php if($_GET["q"] == "overview"){echo "active";} if(!isset($_GET["q"])){echo "active";}?>"><a href="?q=overview">Overview</a></li>
            <li class="<?php if($_GET["q"] == "nodes"){echo "active";} ?>"><a href="?q=nodes">Nodes</a></li>
            <li class="<?php if($_GET["q"] == "logs"){echo "active";} ?>"><a href="?q=logs">Logs</a></li>
           <!--<li class="<?php if($_GET["q"] == "profile"){echo "active";} ?>"><a href="?q=profile">Profile</a></li>-->
          </ul>
		<?php
		if(isset($_SESSION["admin"]) and $_SESSION["admin"] > 5){
		?>
          <ul class="nav nav-sidebar">
            <li class=<?php if(isset($_GET["q"]) and $_GET["q"] == "admin"){echo "active";} ?>""><a href="?q=admin">Admin</a></li>
			<li class="<?php if($_GET["q"] == "users"){echo "active";} ?>"><a href="?q=users">Users</a></li>
			<li class="<?php if($_GET["q"] == "groups"){echo "active";} ?>"><a href="?q=groups">Groups</a></li>
			<li class="<?php if($_GET["q"] == "all_nodes"){echo "active";} ?>"><a href="?q=all_nodes">All Nodes</a></li>

          </ul>
		<?php
		}
		?>	
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

<?php
	if(isset($_GET["q"])){
	$path_parts = pathinfo($_GET['q']);
	$q  = $path_parts['basename'];
	}else{$q="";}
	if(file_exists("q/" . $q . ".php")){
		include "q/" . $q . ".php";
	}elseif(!isset($_GET["q"])){
		include "q/overview.php";
	}else{
		echo "q not enabled";
	}

?>

        </div>

      </div>

    </div>
	  


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/docs.min.js"></script>
  </body>
</html>

<?php
	$mysqli->close();
?>
