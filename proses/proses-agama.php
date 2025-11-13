<?php

// Memasukkan file class-master.php untuk mengakses class MasterData
include '../config/class-master.php';
// Membuat objek dari class MasterData
$master = new MasterData();
// Mengecek aksi yang dilakukan berdasarkan parameter GET 'aksi'
if($_GET['aksi'] == 'inputagama'){
    // Mengambil data agama dari form input menggunakan metode POST dan menyimpannya dalam array
    $dataAgama = [
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method inputAgama untuk memasukkan data agama dengan parameter array $dataAgama
    $input = $master->inputAgama($dataAgama);
    if($input){
        // Jika berhasil, redirect ke halaman master-agama-list.php dengan status inputsuccess
        header("Location: ../master-agama-list.php?status=inputsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-agama-input.php dengan status failed
        header("Location: ../master-agama-input.php?status=failed");
    }
} elseif($_GET['aksi'] == 'updateagama'){
    // Mengambil data agama dari form edit menggunakan metode POST dan menyimpannya dalam array
    $dataAgama = [
        'id' => $_POST['id'],
        'kode' => $_POST['kode'],
        'nama' => $_POST['nama']
    ];
    // Memanggil method updateAgama untuk mengupdate data agama dengan parameter array $dataAgama
    $update = $master->updateAgama($dataAgama);
    if($update){
        // Jika berhasil, redirect ke halaman master-agama-list.php dengan status editsuccess
        header("Location: ../master-agama-list.php?status=editsuccess");
    } else {
        // Jika gagal, redirect ke halaman master-agama-edit.php dengan status failed dan membawa id agama
        header("Location: ../master-agama-edit.php?id=".$dataAgama['id']."&status=failed");
    }
} elseif($_GET['aksi'] == 'deleteagama'){
    // Mengambil id agama dari parameter GET
    $id = $_GET['id'];
    // Memanggil method deleteAgama untuk menghapus data agama berdasarkan id
    $delete = $master->deleteAgama($id);
    if($delete){
        // Jika berhasil, redirect ke halaman master-agama-list.php dengan status deletesuccess
        header("Location: ../master-agama-list.php?status=deletesuccess");
    } else {
        // Jika gagal, redirect ke halaman master-agama-list.php dengan status deletefailed
        header("Location: ../master-agama-list.php?status=deletefailed");
    }
}

?>