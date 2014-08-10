          <h1 class="page-header">Logs</h1>
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
			
          </div>

<!--          <h2 class="sub-header">Section title</h2> -->
          <div class="table-responsive">
			<table border="1">
				
			  <?php
				$stmt = $mysqli->prepare("select log.id, nodes.name, log.ip, log.timestamp from log inner join nodes where log.node=nodes.id and nodes.owner=? ");
			$stmt->bind_param("s", $_SESSION["uid"]);
				$stmt->execute();
				$stmt->bind_result($id, $node, $ip, $timestamp);
				while($stmt->fetch()){
					echo "<tr><td>" . $id . "</td><td>" . $node . "</td><td>" . $ip . "</td><td>" . $timestamp . "</td></tr>";
					
				}
				$stmt->close();
			  ?>
			  </table>
          </div>
