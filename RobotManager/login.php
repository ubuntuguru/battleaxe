<?php
//start the session
session_start();

//if session is legit proceed to dashboard
if(isset($_SESSION["hid"]) and isset($_SESSION["uid"]) and md5($_SESSION["uid"]) == $_SESSION["hid"]){
	echo '<meta http-equiv="refresh" content="0; url=/dashboard.php" />';
	exit();
}

//run login check
if(isset($_POST["email"]) and isset($_POST["password"])){
	$mysqli = new mysqli("dbs.battleaxe.lobsternetworks.com", "battleaxe", "ba7713ax3", "battleaxe");
	$stmt = $mysqli->prepare("select id, admin, name from users where email=? and password=?");
	$stmt->bind_param("ss", $_POST["email"], md5($_POST["password"]));
	$stmt->execute();
	$stmt->bind_result($id, $admin, $name);
	$stmt->fetch();
	if($id > 0){
		$_SESSION["uid"] = $id;
		$_SESSION["hid"] = md5($id);
		$_SESSION["admin"] = $admin;
		$_SESSION["name"] = $name;
		$_SESSION["email"] = $_POST["email"];
		
		echo '<meta http-equiv="refresh" content="0; url=/dashboard.php" />';
	}else{
		$login="failed";
	}
	$stmt->close();
	$mysqli->close();
	if(!isset($login)){
		exit();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>BattleAxe</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">


  </head>

  <body>

    <div class="container">
	
      <form class="form-signin" role="form" method="POST" action="/login.php">
		  <h1>BattleAxe</h1>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="email" class="form-control" placeholder="Email address" required autofocus name="email" value="<?php if($login == "failed"){echo $_POST["email"];}?>">
        <input type="password" class="form-control" placeholder="Password" required name="password">
        <div class="checkbox">
       <!--
			<label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
		-->
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign in</button>
		  <a href="/register.php"  class="btn btn-lg btn-block btn-primary" > Register</a>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
