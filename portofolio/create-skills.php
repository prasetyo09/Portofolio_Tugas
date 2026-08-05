<?php
session_start();
session_regenerate_id();

include "config/koneksi.php";

if (!isset($_SESSION['NAME'])) {
    header("location:index.php");
    exit();
}

// Jika tombol simpan ditekan, maka data akan tersimpan
$id = isset($_GET['edit']) ? $_GET['edit'] : '';
$query = mysqli_query($conn, "SELECT * FROM skills WHERE id ='$id'");
$row  = mysqli_fetch_assoc($query);

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $progress = $_POST['progress'];
  
    if($id){
        $update = mysqli_query($conn, "UPDATE skills SET name='$name', progress='$progress' WHERE id='$id'");
        header("location:skills.php?update=berhasil");

    } else{
        $insert = mysqli_query($conn, "INSERT INTO skills (name, progress) VALUES ('$name', '$progress')");
        header("location:skills.php?tambah=berhasil");
    }
    
}
//tampil semua data dari user

?>

