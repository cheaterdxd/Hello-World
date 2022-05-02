<?php
$link = mysqli_connect("database", "root", "tiger", null);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success";
$dbs = mysqli_query($link, "select schema_name from information_schema.schemata");
foreach($dbs as $db){
    mysqli_query($link, "use ".$db['schema_name']);
    $tables = mysqli_query($link,"select table_name from information_schema.tables where table_schema=database()");
    foreach($tables as $tb){
        $records = mysqli_query($link, 'select * from '.$tb);
        foreach($records as $rec){
            echo $rec;
            echo '\n';
        }
    }
}

mysqli_close($link)
?>
