<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_cataloge";

$conn= new mysqli($servername , $username , $password , $dbname);

if ($conn->connect_error) {

    die("connection filed" . $conn->connect_error);

}

?>