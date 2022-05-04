<?php
$link = mysqli_connect("database", "root", "tiger", null);

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success\n";
$dbs = mysqli_query($link, "select schema_name from information_schema.schemata;");
while($db = mysqli_fetch_array($dbs,MYSQLI_BOTH)){
    echo($db['SCHEMA_NAME'].PHP_EOL); 
    //mysqli_query($link, "use ".$db['schema_name'].';');
    mysqli_select_db($link, $db['SCHEMA_NAME']);
    $tables = mysqli_query($link,"select table_name from information_schema.tables where table_schema='mysql';"); //.implode("",array($db['SCHEMA_NAME'])).';');
    if(!$tables){
        printf("Error: %s\n", mysqli_error($link));
	exit();
    }
    while($tb = mysqli_fetch_array($tables,MYSQLI_BOTH)){
        $records = mysqli_query($link, 'select * from '.$tb['TABLE_NAME'].' ;');
        while($rec = mysqli_fetch_array($records,MYSQLI_BOTH)){
            echo $rec[0].PHP_EOL;
        }
    }
}

mysqli_close($link)
