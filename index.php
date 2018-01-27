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
	<div id="addMenu">
		<h2><a href="add_region.php"><img src="image/plus.png"/></a> Dodaj nowy region </h2>
		<h2><a href="add_city.php"><img src="image/plus.png"/></a> Dodaj nowe miasto</h2>
	</div>
	<table>
	<tr> <th>Lp.</th> <th>Nazwa</th> <th>Opcje</th> </tr>

	<?php
		require('connection.php');

		$response = ibase_query($pol, "select r.id, r.nazwa from regiony r order by upper(r.nazwa);");
		$lp = 1;
		while($obj = ibase_fetch_object($response) ){
			echo "\t<tr>\n";
			echo "\t\t<td>".$lp++."</td>\n";
			echo "\t\t<td><button class=\"accordion\">".$obj->NAZWA."</button>\n";
				$response2 = ibase_query($pol, "select * from cities where region='".$obj->NAZWA."';");
				$empty = true;
				echo "\t\t<div class=\"panel\"><ul>";
				while($obj2 = ibase_fetch_object($response2)){
					$empty = false;
					echo "<li>".$obj2->CITY."</li>\n";
				}
				if ($empty) echo "Brak miast\n";
				echo "</ul></div>\n";
			echo "\t</td>\n";
			echo "\t\t<td>".'<a href="edit_region.php?id='.$obj->ID.'"><img src="image/edit.png"/></a>
			<a href="delete_region.php?region='.$obj->NAZWA.'&id='.$obj->ID.'" onclick="return confirm(\'Czy na pewno chcesz skasować państwo '.$obj->NAZWA.' wraz z miastami?\');" ><img src="image/del.png"/></a></td>'."\n";
			echo "\t</tr>\n";
		}

		ibase_close($pol);
	?>
	</table>

	<div class="fixed1">
		<a href="restore.php" onclick="return confirm('Czy jesteś pewny, że chcesz przywrócić domyślne rekordy?');">Przywróć domyślne</a>
	</div>

	<script>
		let acc = document.getElementsByClassName("accordion");
		for (let i = 0; i < acc.length; i++) {
		acc[i].addEventListener("click", function() {
			this.classList.toggle("active");
			let panel = this.nextElementSibling;
			if (panel.style.maxHeight){
			panel.style.maxHeight = null;
			} else {
			panel.style.maxHeight = panel.scrollHeight + "px";
			} 
		});
		}
	</script>
	<script src="script.js"></script>
</body>
</html>

