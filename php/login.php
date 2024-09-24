<?php

$user = "root";
$pass = "root";
$host = "localhost";
$datab = "Mathez";
$numCta = $_POST["numCta"];
$passwd = $_POST["passwd"];

$connecction = mysqli_connect($host, $user, $pass);

if (!$connecction) {
    echo "Error" .mysql_error();
} else {
    echo "<b><h3>Succes</h3></b>";
}

$db = mysqli_select_db($connecction,$datab);

$query = mysqli_query($connecction, "SELECT numCta, passwd 
    FROM usuarios 
    WHERE numCta = '".$numCta."' AND passwd = '".$passwd."' ");

$nr = mysqli_num_rows($query);

if ($nr == 1) {
    header('location: ../homepage.html');
    exit();
} else {
    echo "Invalid username or password."
}

?>