<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
</head>
<body>

<?php
    require('connection.php');

    $sql="select r.id, r.nazwa from regiony r order by upper(r.nazwa);";
    $odp = ibase_query($pol, $sql);

    while($wiersz = ibase_fetch_object($odp) ){
        echo $wiersz->NAZWA."\t\t";
        echo $wiersz->ID."<br>";

        $sql2 ="select * from cities where region='".$wiersz->NAZWA."';";
        $odp2 = ibase_query($pol, $sql2);
    
        while($wiersz2 = ibase_fetch_object($odp2)){
            echo "\t> ".$wiersz2->REGION."\t\t";
            echo "\t> ".$wiersz2->CITY."\t\t";
            echo "\t> ".$wiersz2->ID."<br>";
        }

        echo "<br>";
    }



    ibase_close($pol);


?>


</body>
</html>

