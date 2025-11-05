<?php

// Memasukkan file class-penduduk.php untuk mengakses class Penduduk
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Penduduk
$Penduduk = new penduduk();
// Mengambil id penduduk dari parameter GET
$id = $_GET['id'];
// Memanggil method delete Penduduk untuk menghapus data penduduk berdasarkan id
$delete = $Penduduk->deletePenduduk($id);
// Mengecek apakah proses delete berhasil atau tidak - true/false
if($delete){
    // Jika berhasil, redirect ke halaman data-list.php dengan status deletesuccess
    header("Location: ../data-list.php?status=deletesuccess");
} else {
    // Jika gagal, redirect ke halaman data-list.php dengan status deletefailed
    header("Location: ../data-list.php?status=deletefailed");
}

?>