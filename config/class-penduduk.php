<?php 

// Memasukkan file konfigurasi database
include_once 'db-config.php';

class penduduk extends Database {

    // Method untuk input data penduduk
    public function inputPenduduk($data){
        // Mengambil data dari parameter $data
        $nik         = $data['nik'];
        $nama        = $data['nama'];
        $tempat      = $data['tempat'];
        $tanggal     = $data['tanggal'];
        $tahun       = $data['tahun'];
        $alamat      = $data['alamat'];
        $provinsi    = $data['provinsi'];
        $domisili    = $data['domisili'];
        $perkerjaan  = $data['perkerjaan'];
        $agama       = $data['agama'];
        $status      = $data['status'];
        // Menyiapkan query SQL untuk insert data menggunakan prepared statement
        $query = "INSERT INTO tb_penduduk (nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr,  alamat, provinsi, domisili, perkerjaan, agama, sts) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        // Mengecek apakah statement berhasil disiapkan
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssssss", $nik, $nama, $tempat , $tanggal , $tahun , $alamat , $provinsi , $domisili, $perkerjaan, $agama, $status );
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mengambil semua data penduduk
    public function getAllPenduduk(){
        // Menyiapkan query SQL untuk mengambil data penduduk beserta agama dan provinsi
        $query = "SELECT id_pnddk, nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr,  alamat, provinsi, domisili, perkerjaan, agama,  sts
                  FROM tb_penduduk
                  JOIN tb_agama ON agama = kode_agama
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        // Menyiapkan array kosong untuk menyimpan data penduduk
        $penduduk = [];
        // Mengecek apakah ada data yang ditemukan
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                $penduduk[] = [
                    'id' => $row['id_pnddk'],
                    'nik' => $row['nik'],
                    'nama' => $row['nama'],
                    'tempat' => $row['tempat_lhr'],
                    'tanggal' => $row['tanggal_lhr'],
                    'tahun' => $row['tahun_lhr'],
                     'alamat' => $row['alamat'],
                    'provinsi' => $row['provinsi'],
                    'domisili' => $row['domisili'],
                    'perkerjaan' => $row['perkerjaan'],
                     'agama' => $row['agama'],
                    'status' => $row['sts'],
                ];
            }
        }
        // Mengembalikan array data penduduk
        return $penduduk;
    }

    // Method untuk mengambil data penduduk berdasarkan ID
    public function getUpdatePenduduk($id){
        // Menyiapkan query SQL untuk mengambil data penduduk berdasarkan ID menggunakan prepared statement
        $query = "SELECT * FROM tb_penduduk WHERE id_pnddk= ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;
        if($result->num_rows > 0){
            // Mengambil data penduduk
            $row = $result->fetch_assoc();
            // Menyimpan data dalam array
            $data = [
             'id' => $row['id_pnddk'],
             'nik' => $row['nik'],
             'nama' => $row['nama'],
             'tempat' => $row['tempat_lhr'],
             'tanggal' => $row['tanggal_lhr'],
             'tahun' => $row['tahun_lhr'],
             'alamat' => $row['alamat'],
             'provinsi' => $row['provinsi'],
             'domisili' => $row['domisili'],
             'perkerjaan' => $row['perkerjaan'],
             'agama' => $row['agama'],
             'status' => $row['sts'],
            ];
        }
        $stmt->close();
        // Mengembalikan data penduduk
        return $data;
    }

    // Method untuk mengedit data penduduk
    public function editPenduduk($data){
        // Mengambil data dari parameter $data
        $id          = $data['id'];
        $nik         = $data['nik'];
        $nama        = $data['nama'];
        $tempat      = $data['tempat'];
        $tanggal     = $data['tanggal'];
        $tahun       = $data['tahun'];
        $alamat      = $data['alamat'];
        $provinsi    = $data['provinsi'];
        $domisili    = $data['domisili'];
        $perkerjaan  = $data['perkerjaan'];
        $agama       = $data['agama'];
        $status      = $data['status'];
        // Menyiapkan query SQL untuk update data menggunakan prepared statement
        $query = "UPDATE tb_penduduk SET nik = ?, nama = ?, tempat_lhr = ?, tanggal_lhr = ?,tahun_lhr = ?, alamat = ?, provinsi = ?, domisili = ?, perkerjaan = ?, agama  = ?, sts = ? WHERE id_pnddk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("sssssssssssi",$nik, $nama, $tempat , $tanggal , $tahun , $alamat , $provinsi , $domisili, $perkerjaan, $agama, $status, $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk menghapus data penduduk
    public function deletePenduduk($id){
        // Menyiapkan query SQL untuk delete data menggunakan prepared statement
        $query = "DELETE FROM tb_penduduk WHERE id_pnddk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        // Mengembalikan hasil eksekusi query
        return $result;
    }

    // Method untuk mencari data penduduk berdasarkan kata kunci
    public function searchPenduduk($kataKunci){
        // Menyiapkan LIKE query untuk pencarian
        $likeQuery = "%".$kataKunci."%";
        // Menyiapkan query SQL untuk pencarian data penduduk menggunakan prepared statement
        $query = "SELECT id_pnddk, nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr,  alamat, provinsi, domisili, perkerjaan, agama, sts
                  FROM tb_penduduk
                  JOIN tb_agama ON agama = kode_agama
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE nik LIKE ? OR nama LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt){
            // Mengembalikan array kosong jika statement gagal disiapkan
            return [];
        }
        // Memasukkan parameter ke statement
        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        // Menyiapkan array kosong untuk menyimpan data penduduk
        $penduduk = [];
        if($result->num_rows > 0){
            // Mengambil setiap baris data dan memasukkannya ke dalam array
            while($row = $result->fetch_assoc()) {
                // Menyimpan data penduduk dalam array
                $penduduk[] = [
                    'id' => $row['id_pnddk'],
                    'nik' => $row['nik'],
                    'nama' => $row['nama'],
                    'tempat' => $row['tempat_lhr'],
                    'tanggal' => $row['tanggal_lhr'],
                    'tahun' => $row['tahun_lhr'],
                     'alamat' => $row['alamat'],
                    'provinsi' => $row['provinsi'],
                    'domisili' => $row['domisili'],
                    'perkerjaan' => $row['perkerjaan'],
                     'agama' => $row['agama'],
                    'status' => $row['sts'],
                ];
            }
        }
        $stmt->close();
        // Mengembalikan array data mahasiswa yang ditemukan
        return $penduduk;
    }

}

?>