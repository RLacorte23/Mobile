<?php

// set_time_limit(0);   //optional lang eto chill

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";   //no password
$dbName = "sample";  // the database name

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbName);

$file = '../data/data.csv';

echo 'starting';

while (true) {
    $csvFile = fopen($file, 'r');

    while (($row = fgetcsv($csvFile)) !== FALSE) {
        $sensor_value = $row[0];

        $SQL = "INSERT INTO gas_sensor(sensor_value) VALUES (?);";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $SQL))
        {
            echo "an error has occured";
            return;
        }
        mysqli_stmt_bind_param($stmt, 'i', $sensor_value);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    fclose($csvFile);

    file_put_contents($file, '');
    
    sleep(10);
}
