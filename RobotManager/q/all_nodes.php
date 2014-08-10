          <h1 class="page-header">All Nodes</h1>
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
			
          </div>

<!--          <h2 class="sub-header">Section title</h2> -->
          <div class="table-responsive">
			<table border="1">
				
			  <?php
				$stmt = $mysqli->prepare("select id, name, ip from nodes limit 10");
				$stmt->execute();
				$stmt->bind_result($id, $node, $ip);
				while($stmt->fetch()){
					echo "<tr><td>" . $id . "</td><td>" . $node . "</td><td>" . $ip . "</td></tr>";
					
				}
				$stmt->close();
			  ?>
			  </table>
          </div>