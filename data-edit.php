<?php 

include_once 'config/class-master.php';
include_once 'config/class-mahasiswa.php';
$master = new MasterData();
$Penduduk = new penduduk ();
// Mengambil daftar agama, provinsi, gender dan status pendudk
$agamaList = $master->getAgama();
// Mengambil daftar provinsi
$provinsiList = $master->getProvinsi();
// Mengambil daftar status penduduk
$statusList = $master->getStatus();
// Mengambil daftar status penduduk
$genderList = $master->getGender();
// Mengambil data penduduk yang akan diedit berdasarkan id dari parameter GET
$dataPenduduk = $Penduduk->getUpdatePenduduk($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data penduduk. Silakan coba lagi.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
	<head>
		<?php include 'template/header.php'; ?>
	</head>

	<body class="layout-fixed fixed-header fixed-footer sidebar-expand-lg sidebar-open bg-body-tertiary">

		<div class="app-wrapper">

			<?php include 'template/navbar.php'; ?>

			<?php include 'template/sidebar.php'; ?>

			<main class="app-main">

				<div class="app-content-header">
					<div class="container-fluid">
						<div class="row">
							<div class="col-sm-6">
								<h3 class="mb-0">Edit Data Penduduk</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Formulir Penduduk</h3>
										<div class="card-tools">
											<button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse">
												<i data-lte-icon="expand" class="bi bi-plus-lg"></i>
												<i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
											</button>
											<button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove">
												<i class="bi bi-x-lg"></i>
											</button>
										</div>
									</div>
                                    <form action="proses/proses-edit.php" method="POST">
									    <div class="card-body">
                                            <input type="hidden" name="id" value="<?php echo $dataPenduduk['id']; ?>">
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">Nomor Induk Penduduk</label>
                                                <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK PendudUK" value="<?php echo $dataPenduduk['nik']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap Penduduk</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama Penduduk" value="<?php echo $dataPenduduk['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tempat" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukkan Tempat Lahir" value="<?php echo $dataPenduduk['tempat']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                                <input type="number" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal Lahir" value="<?php echo $dataPenduduk['tanggal']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun Lahir</label>
                                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun tahun" value="<?php echo $dataPenduduk['tahun']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data penduduk yang dipilih
                                                    foreach ($provinsiList as $provinsi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProvinsi = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data selebriti
                                                        if($dataPenduduk['provinsi'] == $provinsi['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedProvinsi = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$provinsi['id'].'" '.$selectedProvinsi.'>'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="agama" class="form-label">Agama</label>
                                                <select class="form-select" id="provinsi" name="agama" required>
                                                    <option value="" selected disabled>Pilih Agama</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data penduduk yang dipilih
                                                    foreach ($agamaList as $agama){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedAgama = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data selebriti
                                                        if($dataPenduduk['agama'] == $agama['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedAgama = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$agama['id'].'" '.$selectedAgama.'>'.$agama['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                             <div class="mb-3">
                                                <label for="gender" class="form-label">Gender</label>
                                                <select class="form-select" id="gender" name="gender" required>
                                                    <option value="" selected disabled>Pilih Gender</option>
                                                    <?php
                                                    // Iterasi daftar gender dan menandai yang sesuai dengan data penduduk yang dipilih
                                                    foreach ($genderList as $gender){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedGender = "";
                                                        // Mengecek apakah gender saat ini sesuai dengan data penduduk
                                                        if($dataPenduduk['gender'] == $gender['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedGender = "selected";
                                                        }
                                                        // Menampilkan opsi provinsi dengan penanda yang sesuai
                                                        echo '<option value="'.$gender['id'].'" '.$selectedGender.'>'.$gender['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status selebriti dan menandai yang sesuai dengan data selebriti yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data selebriti
                                                        if($dataPenduduk['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                                 <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" required><?php echo $dataPenduduk['alamat']; ?></textarea>
                                            </div>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="submit" class="btn btn-warning float-end">Update Data</button>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</main>

			<?php include 'template/footer.php'; ?>

		</div>
		
		<?php include 'template/script.php'; ?>

	</body>
</html>