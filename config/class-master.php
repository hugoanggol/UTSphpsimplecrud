<?php

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class MasterData extends Database {

    // Method untuk mendapatkan daftar agama
    public function getAgama(){
        $query = "SELECT * FROM tb_agama";
        $result = $this->conn->query($query);
        $agama = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $agama[] = [
                    'id' => $row['kode_agama'],
                    'nama' => $row['nama_agama']
                ];
            }
        }
        return $agama;
    }

    // Method untuk mendapatkan daftar provinsi
    public function getProvinsi(){
        $query = "SELECT * FROM tb_provinsi";
        $result = $this->conn->query($query);
        $provinsi = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $provinsi[] = [
                    'id' => $row['id_provinsi'],
                    'nama' => $row['nama_provinsi']
                ];
            }
        }
        return $provinsi;
    }

    // Method untuk mendapatkan daftar status penduduk menggunakan array statis
    public function getStatus(){
        return [
            ['id' => 1, 'nama' => 'Menikah'],
            ['id' => 2, 'nama' => 'Tidak Menikah'],
        
        ];
    }
   
    // Method untuk input data agama
    public function inputAgama($data){
        $kodeAgama = $data['kode'];
        $namaAgama = $data['nama'];
        $query = "INSERT INTO tb_agama (kode_agama, nama_agama) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $kodeAgama, $namaAgama);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data agama berdasarkan kode
    public function getUpdateAgama($id){
        $query = "SELECT * FROM tb_agama WHERE kode_agama = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $agama = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $agama = [
                'id' => $row['kode_agama'],
                'nama' => $row['nama_agama']
            ];
        }
        $stmt->close();
        return $agama;
    }

    // Method untuk mengedit data agama
    public function updateAgama($data){
        $kodeAgama = $data['kode'];
        $namaAgama = $data['nama'];
        $query = "UPDATE tb_agama SET nama_agama = ? WHERE kode_agama= ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("ss", $namaAgama, $kodeAgama);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data agama
    public function deleteAgama($id){
        $query = "DELETE FROM tb_agama WHERE kode_agama = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk input data provinsi
    public function inputProvinsi($data){
        $namaProvinsi = $data['nama'];
        $query = "INSERT INTO tb_provinsi (nama_provinsi) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("s", $namaProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk mendapatkan data provinsi berdasarkan id
    public function getUpdateProvinsi($id){
        $query = "SELECT * FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $provinsi = null;
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $provinsi = [
                'id' => $row['id_provinsi'],
                'nama' => $row['nama_provinsi']
            ];
        }
        $stmt->close();
        return $provinsi;
    }

    // Method untuk mengedit data provinsi
    public function updateProvinsi($data){
        $idProvinsi = $data['id'];
        $namaProvinsi = $data['nama'];
        $query = "UPDATE tb_provinsi SET nama_provinsi = ? WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("si", $namaProvinsi, $idProvinsi);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Method untuk menghapus data provinsi
    public function deleteProvinsi($id){
        $query = "DELETE FROM tb_provinsi WHERE id_provinsi = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

}

?>