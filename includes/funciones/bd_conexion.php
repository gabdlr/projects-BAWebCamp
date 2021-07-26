<?php

$conn = new mysqli('localhost', 'root', 'root', 'database');

if ($conn -> connect_error) {

    echo $error -> $conn->connection_error;

}

?>
