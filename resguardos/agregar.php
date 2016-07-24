<?php

//$_POST['empleado']
$tableData = $_POST['tabla'];
$tableData = json_decode($tableData,TRUE);
echo $tableData[1];
/*$tableData = stripcslashes($_POST['tabla']);

// Decode the JSON array
$tableData = json_decode($tableData,TRUE);

// now $tableData can be accessed like a PHP array
echo $tableData[0]['Equipo_Modelo'];
echo $tableData[1]['Equipo_Modelo'];*/


?>