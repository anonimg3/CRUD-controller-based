<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Regiony świata</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
	<h1>Regiony świata</h1>
	<hr>
	<form action="add_region.php" onsubmit="return validation()" method="post">
		<p>Nazwa regionu:</p>
		<input type="text" class="inputValue" required minlength="3" maxlength="30" name="region">
		<br>
		<input type="submit" value="Dodaj region">
	</form>

	<?php
		if(isset($_POST['region'])){
			require('connection.php');
			$region = $_POST['region'];

			if(ibase_query($pol, "insert into regiony (id,nazwa) values (gen_id(ident,1),'".$region."');")){
				header("Location: index.php");
			}else{
				echo "<script> alert('Wystąpił nieoczekiwany błąd');</script>";
			}

			ibase_close($pol);	
		}
	?>
	<script src="script.js"></script>
</body>
</html>