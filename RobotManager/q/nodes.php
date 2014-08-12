          <h1 class="page-header">Nodes</h1>
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
<?php
if(isset($_GET["node"])){
	$stmt = $mysqli->prepare("select id, name from nodes where UUID=?");
	$stmt->bind_param("s", $_GET["node"]);
	$stmt->execute();
	$stmt->bind_result($id, $node);
	$stmt->fetch();
	$stmt->close();
	
?>
	<h2 class="sub-header">Node - <?php echo $node; ?></h2>
	<div class="table-responsive">
	<table border="1" class="table table-striped">
	<thead><th>Name</th><th>Value</th></thead>
<?php
	$stmt = $mysqli->prepare("select data from log where node=? order by id desc limit 1");
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$stmt->bind_result($data);
	$stmt->fetch();
	$stmt->close();
	#var_dump($data);
	$data = json_decode($data, true);
	foreach($data as $name => $value){
		echo "<tr><td>" . $name . "</td><td>" . $value . "</td></tr>";
	}
	?>
	</table>
	</div>
	<?php
}
?>
          <h2 class="sub-header">List O' Nodes</h2>
          <div class="table-responsive">
	<p>This page lists all nodes that you own.  Eventually you will be able to share nodes to other users.</p>	
		<table border="1" class="table table-striped">
		<thead><tr><th>UUID</th><th>Node</th><th>IP</th><th>Last Updated(MST)</th><th>Owner</th><th>Group</th><th>Keys</th><th>Edit/Delete</th></tr></thead>
				
			  <?php
				$stmt = $mysqli->prepare("select `nodes`.`id`, `nodes`.`UUID`, `nodes`.`name`, `nodes`.`ip`, `nodes`.`last_updated`, `users`.`id`, `users`.`name`, `nodes`.`group` from `nodes` inner join `users` where `users`.`id`=`nodes`.`owner` and owner=?");
				$stmt->bind_param("s", $_SESSION["uid"]);
				$stmt->execute();
				$stmt->bind_result($id, $uuid, $node, $ip, $lu, $owner_id, $owner, $group);
				while($stmt->fetch()){
echo "<tr><td>" . $uuid . "</td>";
echo "<td><a href='dashboard.php?q=nodes&node=$uuid'>" . $node . "</a></td>";
echo "<td><a href='http://" . $ip . "/'>" . $ip . "</a></td>";
echo "<td>" . date("Y-m-d H:m:s", Strtotime($lu)) . "</td>";
echo "<td>" . $owner . "</td>";
echo "<td>" . $group . "</td>";
if($_SESSION["admin"] > 5){ $a_priv = "<a href='download.php?key=pri&uuid=$uuid'><span class=\"glyphicon glyphicon-eye-close\"/></a>";}else{$a_priv = " ";}
echo "<td><a href='download.php?key=pub&uuid=" . $uuid . "' ><span class=\"glyphicon glyphicon-eye-open\"/></a> $a_priv <a href=\"#\" ><span class=\"glyphicon glyphicon-refresh\" /></a></td>";
if($_SESSION["uid"] == $owner_id){$a_del = "<a href='dashboard.php?q=nodes&d=$uuid'><span class=\"glyphicon glyphicon-remove-circle\"></span></a>";}
if($_SESSION["uid"] == $owner_id){$a_edit = "<a href='#'><span class=\"glyphicon glyphicon-wrench\"></span></a>";}
echo "<td>$a_edit $a_del</td></tr>";
					
				}
				$stmt->close();
			  ?>
			<tr><td colspan=7>
<form method="post" action="dashboard.php?q=nodes&action=add" >
Node Name:
<input type="text" name="node" />
<button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-plus-sign"/></button>
</form>
			</td></tr>
			  </table>
          </div>
