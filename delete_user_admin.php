<?php
session_start();
require "config.php";
$id=$_POST["id"];
$sql="DELETE FROM users WHERE id_='$id'";
$result=mysqli_query($link,$sql);