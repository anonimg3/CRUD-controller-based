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
	<form action="add_city.php" onsubmit="return validation()" method="post">
		<p>Wybierz państwo:</p>
		<div class="select">	
			<select name="slct" id="slct">				
				<?php
					require('connection.php');
					$response = ibase_query($pol, "select r.id, r.nazwa from regiony r order by upper(r.nazwa);");
					while($obj = ibase_fetch_object($response) ){
						echo '<option value="'.$obj->NAZWA.'">'.$obj->NAZWA.'</option>';
					}	
					ibase_close($pol);
				?>
			</select>
		</div>
		<p>Nazwa miasta:</p>
		<input class="inputValue" type="text" required minlength="3" maxlength="30" name="city">
		<br>
		<input type="submit" value="Dodaj miasto">
	</form>

	<?php
		if(isset($_POST['city']) && isset($_POST['slct'])){
			require('connection.php');
			$city = $_POST['city'];
			$panstwo = $_POST['slct'];
			
			if(ibase_query($pol, "insert into cities (id,region,city) values (gen_id(ident,1),'$panstwo','$city');")){
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