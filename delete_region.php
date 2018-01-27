<?php
	if(isset($_GET['id']) && isset($_GET['region'])){
		require('connection.php');

		$id = $_GET['id'];
		$region = $_GET['region'];

		$sql="delete from cities where region='".$region."';";
		ibase_query($pol, $sql);

		$sql="delete from regiony where id=".$id.';';
		ibase_query($pol, $sql);

		ibase_close($pol);
	}

	header("Location: index.php");
?>