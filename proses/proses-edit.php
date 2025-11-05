<?php

// Memasukkan file class-penduduk.php untuk mengakses class Penduduk
include_once '../config/class-mahasiswa.php';
// Membuat objek dari class Penduduk
$Penduduk = new Penduduk;
// Mengambil data penduduk dari form edit menggunakan metode POST dan menyimpannya dalam array
$dataPenduduk = [
    'nik' => $_POST['nik'],
    'nama' => $_POST['nama'],
    'tempat' => $_POST['tempat'],
    'tanggal' => $_POST['tanggal'],
    'tahun' => $_POST['tahun'],
    'provinsi' => $_POST['provinsi'],
    'agama' => $_POST['agama'],
    'gender' => $_POST['gender'],
    'status' => $_POST['status'],
    'alamat' => $_POST['alamat'],
];
// Memanggil method edit Penduduk untuk mengupdate data penduduk dengan parameter array $dataPenduduk
$edit = $Penduduk->editPenduduk($dataPenduduk);
// Mengecek apakah proses edit berhasil atau tidak - true/false
if($edit){
    // Jika berhasil, redirect ke halaman data-list.php dengan status editsuccess
    header("Location: ../data-list.php?status=editsuccess");
} else {
    // Jika gagal, redirect ke halaman data-edit.php dengan status failed dan membawa id penduduk
    header("Location: ../data-edit.php?id=".$dataPenduduk['id']."&status=failed");
}

?>