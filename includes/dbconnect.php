<?php

$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbDatabasename = "dbfms";

$conn = new mysqli($dbServername, $dbUsername, $dbPassword, $dbDatabasename); 

if($conn->connect_error){
    die("Could not connect to the database!".$conn->connection_error);
}