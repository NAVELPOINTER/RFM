<?php

$server_name = "localhost";
$user_name = "root";
$password = "";

$database_name = "REMOTE_FILE_MANAGER";

$connect = new mysqli($server_name, $user_name, $password, $database_name);
/*
if($connect->connect_error)
{
        echo "<script>
            alert('Failed to connect');
        </script>";
}else{
        echo "Connected";
}*/