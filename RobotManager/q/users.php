          <h1 class="page-header">Dashboard</h1>
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

          <h2 class="sub-header">Section title</h2>
          <div class="table-responsive">
			<table border="1">
				
			  <?php
				$stmt = $mysqli->prepare("select id, name, admin, email from users limit 10");
				$stmt->execute();
				$stmt->bind_result($id, $name, $admin, $email);
				while($stmt->fetch()){
					echo "<tr><td>" . $id . "</td><td>" . $name . "</td><td>" . $admin . "</td><td>" . $email ."</td></tr>";
					
				}
				$stmt->close();
			  ?>
			  </table>
          </div>