<?php

// Memasukkan file class-penduduk.php untuk mengakses class Penduduk
include '../config/class-mahasiswa.php';
// Membuat objek dari class Penduduk
$Penduduk = new Penduduk();
// Mengambil data penduduk dari form input menggunakan metode POST dan menyimpannya dalam array
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
// Memanggil method inputPenduduk untuk memasukkan data penduduk dengan parameter array $dataPenduduk
$input = $Penduduk->inputPenduduk($dataPenduduk);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>