<?php
    require('connection.php');

    ibase_query($pol, 'delete from regiony where id > 0;');
    ibase_query($pol, 'delete from cities where id > 0;');
    
    $sql1 = 'create table regiony (
            id int not null,
            nazwa varchar(30) not null,
            constraint regiony_pk primary key(id),
            constraint regiony_u unique(nazwa)
            );';
    ibase_query($pol, $sql1);

    $sql2 = 'create generator ident;';
    ibase_query($pol, $sql2);

    $sql3 = 'set generator ident to 100;';
    ibase_query($pol, $sql3);

    $sql4 = 'create table cities (
            id int not null,
            city varchar(30) not null,
            region varchar(30) not null,
            constraint cities_pk primary key(id),
            constraint cities_u unique(city)
            );';
    ibase_query($pol, $sql4);

    $sql5 = array(
            "insert into regiony (id,nazwa) values (1,'Francja');",
            "insert into regiony (id,nazwa) values (2,'Polska');",
            "insert into regiony (id,nazwa) values (3,'Hiszpania');",
            "insert into regiony (id,nazwa) values (4,'Włochy');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Francja','Paryż');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Francja','Lyon');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Francja','Nicea');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Francja','Marsylia');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Polska','Warszawa');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Polska','Łódź');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Polska','Poznań');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Hiszpania','Madryt');",
            "insert into cities (id,region,city) values (gen_id(ident,1),'Włochy','Rzym');",);

    for($i=0;$i<count($sql5);$i++){
        ibase_query($pol, $sql5[$i]);
    }

    header("Location: index.php");

    ibase_close($pol);
?>
