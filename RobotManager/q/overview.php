          <h1 class="page-header">Dashboard</h1>
          <div class="row placeholders">
			<?php 
			if(isset($_SESSION["debug"]) and $_SESSION["debug"] == 10){
				echo "<pre>";
				print_r($_SESSION);
				print_r($_GET);
				print_r($_POST);
				echo "</pre>";
			}
			?>
			<p>Welcome <?php echo $_SESSION["name"]; ?>!</p>
			
          </div>

          <h2 class="sub-header">Dashboard Overview</h2>
          <div class="table-responsive">
		<p>Insert useful charts and such.  </p>
          </div>
