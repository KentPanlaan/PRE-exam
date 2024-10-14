<?php
// print_r(PDO::getAvailableDrivers());

$host = "localhost";
$user = "root";
$password = "";
$dbname = "panlaan";
//data source name
$db = "mysql:host=$host;dbname=$dbname";
//PDO instance
$connection = new PDO($db,$user,$password);
$connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

$Id = 4;
$First_Name = "Kent Daril";
$Last_Name = "Panla-an Gwapo";
$Age = 12;
$Gender = "Male";

// $sql = "INSERT INTO table_students(`First_Name`,
// `Last_Name`,`Age`,`Gender`)VALUES(?,?,?,?)";
// $stmt =$connection->prepare($sql);
// $stmt->execute([$First_Name,$Last_Name,$Age,$Gender]);

// $sql = "DELETE FROM table_students WHERE Id = :Id";
// $stmt = $connection->prepare($sql);
// $stmt->execute(['Id' => $Id]);

$sql = "UPDATE table_students SET First_Name = :First_Name,
Last_Name = :Last_Name,Age = :Age,Gender = :Gender WHERE Id = :Id";
$stmt = $connection->prepare($sql);
$stmt->execute(['First_Name' => $First_Name,'Last_Name' => $Last_Name,'Age' => $Age,'Gender'=> $Gender,'Id' => $Id]);

$stmt = $connection->query("SELECT * FROM table_students");
while($row = $stmt->fetch()){
    echo $row['Id']."-".$row['First_Name']." ".$row
    ['Last_Name']."<br>"; 
}

