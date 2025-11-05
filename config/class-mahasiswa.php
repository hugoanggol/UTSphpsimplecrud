<?php

include_once 'db-config.php';

class Penduduk extends Database {

    // Input data penduduk
    public function inputPenduduk($data){
        $id       = $data['id_pnddk'];
        $nik        = $data['nik'];
        $nama       = $data['nama'];
        $tempat     = $data['tempat'];
        $tanggal    = $data['tanggal'];
        $tahun      = $data['tahun'];
        $provinsi   = $data['provinsi'];
        $agama      = $data['agama'];
        $gender     = $data['gender'];
        $status     = $data['status'];
        $alamat     = $data['alamat'];

        $query = "INSERT INTO tb_penduduk (nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr, provinsi, agama, gender, sts, alamat)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("ssssssssss",$nik, $nama, $tempat, $tanggal, $tahun, $provinsi, $agama, $gender, $status, $alamat);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Ambil semua data penduduk
    public function getAllPenduduk(){
        $query = "SELECT id_pnddk, nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr, provinsi, agama, gender, sts, alamat
                  FROM tb_penduduk
                  JOIN tb_agama ON agama = kode_agama
                  JOIN tb_provinsi ON provinsi = id_provinsi";
        $result = $this->conn->query($query);
        $penduduk = [];

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $penduduk[] = [
                    'id'         => $row['id_pnddk'],
                    'nik'        => $row['nik'],
                    'nama'       => $row['nama'],
                    'tempat'     => $row['tempat_lhr'],
                    'tanggal'    => $row['tanggal_lhr'],
                    'tahun'      => $row['tahun_lhr'],
                    'provinsi'   => $row['provinsi'],
                    'agama'      => $row['agama'],
                    'gender'     => $row['gender'],
                    'status'     => $row['sts'],
                    'alamat'     => $row['alamat'],
                ];
            }
        }
        return $penduduk;
    }

    // Ambil data penduduk berdasarkan ID
    public function getUpdatePenduduk($id){
        $query = "SELECT * FROM tb_penduduk WHERE id_pnddk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = false;

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $data = [
                'id'         => $row['id_pnddk'],
                'nik'        => $row['nik'],
                'nama'       => $row['nama'],
                'tempat'     => $row['tempat_lhr'],
                'tanggal'    => $row['tanggal_lhr'],
                'tahun'      => $row['tahun_lhr'],
                'provinsi'   => $row['provinsi'],
                'agama'      => $row['agama'],
                'gender'     => $row['gender'],
                'status'     => $row['sts'],
                'alamat'     => $row['alamat'],
            ];
        }
        $stmt->close();
        return $data;
    }

    // Edit data penduduk
    public function editPenduduk($data){
        $nik        = $data['nik'];
        $nama       = $data['nama'];
        $tempat     = $data['tempat'];
        $tanggal    = $data['tanggal'];
        $tahun      = $data['tahun'];
        $provinsi   = $data['provinsi'];
        $agama      = $data['agama'];
        $gender     = $data['gender'];
        $status     = $data['status'];
        $alamat     = $data['alamat'];

        $query = "UPDATE tb_penduduk SET nik = ?, nama = ?, tempat_lhr = ?, tanggal_lhr = ?, tahun_lhr = ?, agama = ?, gender = ?, sts = ?, alamat = ? WHERE id_pnddk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("sssssssssi", $nama, $tempat, $tanggal, $tahun, $provinsi, $agama, $gender, $status, $alamat, $id );
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Hapus data penduduk
    public function deletePenduduk($id){
        $query = "DELETE FROM tb_penduduk WHERE id_pnddk = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // Cari data penduduk
    public function searchPenduduk($kataKunci){
        $likeQuery = "%".$kataKunci."%";
        $query = "SELECT id_pnddk, nik, nama, tempat_lhr, tanggal_lhr, tahun_lhr, provinsi, agama, gender, sts, alamat
                  FROM tb_penduduk
                  JOIN tb_agama ON agama = kode_agama
                  JOIN tb_provinsi ON provinsi = id_provinsi
                  WHERE nik LIKE ? OR nama LIKE ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return [];

        $stmt->bind_param("ss", $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $penduduk = [];

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $penduduk[] = [
                    'id'         => $row['id_pnddk'],
                    'nik'        => $row['nik'],
                    'nama'       => $row['nama'],
                    'tempat'     => $row['tempat_lhr'],
                    'tanggal'    => $row['tanggal_lhr'],
                    'tahun'      => $row['tahun_lhr'],
                    'provinsi'   => $row['provinsi'],
                    'agama'      => $row['agama'],
                    'gender'     => $row['gender'],
                    'status'     => $row['sts'],
                    'alamat'     => $row['alamat'],
                ];
            }
        }
        $stmt->close();
        return $penduduk;
    }

}

?>