<?php
	if(isset($_GET['id']) && isset($_GET['regionID'])){
		require('connection.php');

		$id = $_GET['id'];
		$regionID = $_GET['regionID'];
		ibase_query($pol, "delete from cities where id=".$id.';');

		ibase_close($pol);
		header("Location: edit_region.php?id=".$regionID);
	}
?>