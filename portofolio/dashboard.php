<?php
include "config/koneksi.php";
session_start();
session_regenerate_id();

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>yahaha</h1>
</body>
</html>