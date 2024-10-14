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
$connection->setAttribute
(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
// $stmt = $connection->query("SELECT * FROM
// students_table");
// while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
//     echo $row['first_name']."".$row
//     ['last_name']."<br>";
// }

// $stmt = $connection->query("SELECT * FROM
// students_table");
// while($row = $stmt->fetch()){
//     echo $row-> first_name." ".$row->last_name."<br>";
// }

// $gender ="Male";

// $sql = "SELECT * FROM students_table WHERE
// gender = ?";
// $stmt = $connection->prepare($sql);
// $stmt->execute([$gender]);
// $users = $stmt->fetchAll();
// foreach($users as $user){
//     echo $user-> first_name." ".$user->last_name."-".$user->gender."<br>";
// }


// $gender ="Female";

// $sql = "SELECT * FROM students_table WHERE
// gender = :gender";
// $stmt = $connection->prepare($sql);
// $stmt->execute(['gender' => $gender]);
// $users = $stmt->fetchAll();
// foreach($users as $user){
//     echo $user-> first_name." ".$user->last_name."-".$user->gender."<br>";
// }

$id = 37;
$sql = "SELECT * FROM students_table WHERE
id = :id";
$stmt = $connection->prepare($sql);
$stmt->execute(['id' => $id]);
$users = $stmt->fetchAll();
foreach($users as $user){
    echo $user-> first_name." ".$user->last_name."-".$user->gender."<br>";
}