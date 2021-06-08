<?php
session_start();
require 'config.php';
$id = $_POST['id'];
$sql = "SELECT * FROM gallery WHERE '$id'=id";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $filename = $row["picture_name"];
    fclose("gallery/$filename");
    unlink("gallery/$filename");
}
$sql = "DELETE FROM gallery WHERE '$id' = id";
$result = mysqli_query($link, $sql);
