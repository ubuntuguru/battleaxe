			<?php
			if($_GET["debug"] == "on"){
				$_SESSION["debug"] = 10;
			}elseif($_GET["debug"] == "off"){
				$_SESSION["debug"] = 0;
			}
			?> 
		<h1 class="page-header">Your an Admin?</h1>
          <div class="row placeholders">
			<?php 
			if($_SESSION["debug"] == 10){
				echo "<pre>";
				print_r($_SESSION);
				print_r($_GET);
				print_r($_POST);
				echo "</pre>";
			}
			?>
			<p>Welcome <?php echo $_SESSION["name"]; ?>!</p>
			
          </div>

          <h2 class="sub-header">Settings</h2>
          <div class="table-responsive">
			<p>
				Debug <a href="?q=admin&debug=on">On</a> <a href="?q=admin&debug=off">Off</a> 
			  </p>
 
			  
          </div>