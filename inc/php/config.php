<?php
//connect to the database
$link = mysqli_connect('162.241.217.213', 'noahknam_nona', 'Chand3lur3Lilligant', 'noahknam_personal');

if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}


?>