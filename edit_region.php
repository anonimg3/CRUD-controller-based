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
	<form action="edit_region.php" onsubmit="return validation()" method="post">
		<p>Nazwa regionu:</p>
		<?php
			if(isset($_GET['id'])){
				require('connection.php');

				$id = $_GET['id'];
				$response = ibase_query($pol, "select * from regiony where id='".$id."';");
				
				while($obj = ibase_fetch_object($response) ){
					echo "\t".'<input type="hidden" name="oldRegion" value="'.$obj->NAZWA.'">'."\n";
					echo "\t".'<input type="hidden" name="id" value="'.$obj->ID.'">'."\n";
					echo "\t".'<input class="inputValue" type="text" required minlength="3" maxlength="30" name="newRegion" value="'.$obj->NAZWA.'"><br>'."\n";
					echo "\t".'<p>Miasta:</p>'."\n";
					$response2 = ibase_query($pol, "select * from cities where region='".$obj->NAZWA."';");
					while($obj2 = ibase_fetch_object($response2)){
						echo "\t".'<a href="delete_city.php?regionID='.$obj->ID.'&id='.$obj2->ID.'" onclick="return confirm(\'Czy na pewno chcesz skasować miasto '.$obj2->CITY.'?\');" ><img src="image/del.png"/></a>'."\n";
						echo "\t".'<input class="inputValue" type="text" required minlength="3" maxlength="30" name="'.$obj2->ID.'" value="'.$obj2->CITY.'"><br>'."\n";
					}
				}
				ibase_close($pol);
			}
		?>
		<input type="submit" value="Zapisz zmiany">
	</form>

	<?php
		if(isset($_POST['newRegion'])){
			require('connection.php');

			$id = $_POST['id'];
			$newRegion = $_POST['newRegion'];
			$oldRegion = $_POST['oldRegion'];

			ibase_query($pol, "update regiony set nazwa = '".$newRegion."' where id='".$id."';");
			$response = ibase_query($pol, "select * from cities where region='".$oldRegion."';");

			while($obj = ibase_fetch_object($response)){
				ibase_query($pol, "update cities set city = '".$_POST[$obj->ID]."' where id='".$obj->ID."';");
			}

			ibase_query($pol, "update cities set region = '".$newRegion."' where region='".$oldRegion."';");
			ibase_close($pol);	

			header("Location: index.php");
		}
	?>
	<script src="script.js"></script>
</body>
</html>