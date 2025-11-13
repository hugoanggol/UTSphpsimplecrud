<?php

// Memasukkan file class-penduduk.php untuk mengakses class Penduduk
include '../config/class-penduduk.php';
// Membuat objek dari class Penduduk
$penduduk = new Penduduk();
// Mengambil data penduduk dari form input menggunakan metode POST dan menyimpannya dalam array
$dataPenduduk = [
    'nik'      => $_POST['nik'],
    'nama'     => $_POST['nama'],
   'tempat'    => $_POST['tempat'],
    'tanggal'  => $_POST['tanggal'],
    'tahun'    => $_POST['tahun'],
    'alamat'   => $_POST['alamat'],
    'provinsi' =>$_POST['provinsi'],
    'domisili' => $_POST['domisili'],
    'perkerjaan' => $_POST['perkerjaan'],
     'agama'   => $_POST['agama'],
    'status'   => $_POST['status']
];
// Memanggil method inputPenduduk untuk memasukkan data mahasiswa dengan parameter array $dataPenduduk
$input = $penduduk->inputPenduduk($dataPenduduk);
// Mengecek apakah proses input berhasil atau tidak - true/false
if($input){
    // Jika berhasil, redirect ke halaman data-list.php dengan status inputsuccess
    header("Location: ../data-list.php?status=inputsuccess");
} else {
    // Jika gagal, redirect ke halaman data-input.php dengan status failed
    header("Location: ../data-input.php?status=failed");
}

?>