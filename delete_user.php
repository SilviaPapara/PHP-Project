<?php
session_start();
require 'config.php';
$id_user = $_SESSION['id'];
$sql = "DELETE FROM users WHERE '$id_user' = id_";
$result = mysqli_query($link, $sql);
if ($result) {
	header("Location: logout.php");
}
