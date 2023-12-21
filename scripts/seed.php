<?php

$serverName = "localhost";
$username = "admin";
$password = "12345";
$database = "kud_karyamandiri";


$conn = new mysqli($serverName, $username, $password, $database);

if ($conn->connect_error) {
    die("connection Failed: ". $conn->connect_error);
}

$names=["Udin", "Reza", "Wahyu", "Tri", "Budi"];
$passwordUser = "12345"; 
$surname = ["Handoko", "Waluyo", "Basudara","Sandy", "Edi"];
$roles = ["admin", "kasir", "petani", "ksp"];

for ($i=0; $i <10 ; $i++) { 
    # code...
    $randUsername = $names[rand(0,count($names)-1)] . $i;
    $randSurname = $surname[rand(0,count($surname)-1)];
    $randRole = $roles[rand(0,count($roles)-1)];
    $sql = "INSERT INTO users (username, password, surename, roles) VALUES ('$randUsername', '$passwordUser', '$randSurname', '$randRole')";

    if ($conn->query($sql) === FALSE) {
        echo "error";
        break;
    } else {
        echo "User created" . "Username: $randUsername, surname: $randSurname, $passwordUser, $randRole";
    }
}