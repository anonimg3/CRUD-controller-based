<?php
    require('connection.php');


    $sql0 = 'drop table regiony;';
    $odp = ibase_query($pol, $sql0);

    $sql0 = 'drop table cities;';
    $odp = ibase_query($pol, $sql0);
    

    ibase_close($pol);

?>
