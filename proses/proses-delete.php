<?php

// Memasukkan file class-penduduk.php untuk mengakses class Penduduk
include_once '../config/class-penduduk.php';
// Membuat objek dari class Penduduk
$penduduk = new Penduduk();
// Mengambil id penduduk dari parameter GET
$id = $_GET['id'];
// Memanggil method deletePenduduk untuk menghapus data penduduk berdasarkan id
$delete = $penduduk->deletePenduduk($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>