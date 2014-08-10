<?php
session_start();
if(isset($_POST["code"])){
	 $mysqli = new mysqli("mysql.lobsternetworks.com", "battleaxe", "ba7713ax3", "battleaxe_data");
	$stmt = $mysqli->prepare("select code from codes where code=?");
	$stmt->bind_param("s", $_POST["code"]);
	$stmt->execute();
	$stmt->bind_result($code);
	$stmt->fetch();
	$stmt->close();
	if($_POST["code"] != $code){
		$mysqli->close();
		echo "Fake code detected; Killer Robots deployed";
		exit();
	}
	if($_POST["password"] != $_POST["password2"]){
		$mysqli->close();
		echo "Passwords do not match please try again";
		exit();
	}
	$stmt = $mysqli->prepare("insert into users(`name`, `email`, `password`, `admin`) values(?, ?, ?, ?)");
	$admin=0;
	$stmt->bind_param("ssss", $_POST["name"], $_POST["email"], md5($_POST["password"]), $admin);
	$stmt->execute();
	$stmt->close();
        $stmt = $mysqli->prepare("select id, admin, name from users where email=?");
        $stmt->bind_param("s", $_POST["email"]);
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
    <link href="css/starter-template.css" rel="stylesheet">

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
          <a class="navbar-brand" href="/">BattleAxe</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>BattleAxe Registrations</h1>
        <p class="lead">Use the form below to register for BattleAxe with your registration code. </p>
<form class="form-horizontal" method="post" action="register.php">
<fieldset>

<!-- Form Name -->
<legend>Register</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="name">Name: </label>
  <div class="controls">
    <input id="name" name="name" type="text" placeholder="Name" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="email">Email:</label>
  <div class="controls">
    <input id="email" name="email" type="text" placeholder="Email Address" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password">Password:</label>
  <div class="controls">
    <input id="password" name="password" type="password" placeholder="Password" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" for="password2">Password Again:</label>
  <div class="controls">
    <input id="password2" name="password2" type="password" placeholder="Password" class="input-xlarge" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="control-group">
  <label class="control-label" for="code">Registration Code:</label>
  <div class="controls">
    <input id="code" name="code" type="text" placeholder="Code" class="input-xlarge" required="" value="<?php if(isset($_GET["code"])){echo $_GET["code"];}?>">
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="submit"></label>
  <div class="controls">
    <button id="submit" name="submit" class="btn btn-primary">Submit</button>
  </div>
</div>

</fieldset>
</form>

      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

