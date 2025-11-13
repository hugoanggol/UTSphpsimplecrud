<?php 

include_once 'config/class-master.php';
include_once 'config/class-penduduk.php';
$master = new MasterData();
$penduduk = new Penduduk();
// Mengambil daftar agama, provinsi, dan status penduduk
$agamaList = $master->getagama();
// Mengambil daftar provinsi
$provinsiList = $master->getProvinsi();
// Mengambil daftar status penduduk
$statusList = $master->getStatus();
// Mengambil data penduduk yang akan diedit berdasarkan id dari parameter GET
$dataPenduduk = $penduduk->getUpdatePenduduk($_GET['id']);
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
								<h3 class="mb-0">Edit Penduduk</h3>
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
                                                <label for="nik" class="form-label">Nomor Induk Kependuduk (NIK)</label>
                                                <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK Penduduk" value="<?php echo $dataPenduduk['nik']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap Penduduk" value="<?php echo $dataPenduduk['nama']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tempat" class="form-label">Tempat lahir</label>
                                                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukkan Tempat Lahir" value="<?php echo $dataPenduduk['tempat']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                                <input type="number" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal Lahir" value="<?php echo $dataPenduduk['tanggal']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun Lahir</label>
                                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun Lahir" value="<?php echo $dataPenduduk['tahun']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                 <input type="text" class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" value="<?php echo $dataPenduduk['alamat']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($provinsiList as $provinsi){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedProvinsi = "";
                                                        // Mengecek apakah provinsi saat ini sesuai dengan data mahasiswa
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
                                                <label for="domisili" class="form-label">Domisili</label>
                                                <input type="domisili" class="form-control" id="domisili" name="domisili" placeholder="Masukkan Domisili" value="<?php echo $dataPenduduk['domisili']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="perkerjaan" class="form-label">Perkerjaan</label>
                                                <input type="perkerjaan" class="form-control" id="perkerjaan" name="perkerjaan" placeholder="Masukkan Perkerjaan" value="<?php echo $dataPenduduk['perkerjaan']; ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="agama" class="form-label">Agama</label>
                                                <select class="form-select" id="agama" name="agama" required>
                                                    <option value="" selected disabled>Pilih Agama</option>
                                                    <?php 
                                                    // Iterasi daftar agama dan menandai yang sesuai dengan data penduduk yang dipilih
                                                    foreach ($agamaList as $agama){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedAgama = "";
                                                        // Mengecek apakah agama saat ini sesuai dengan data penduduk
                                                        if($dataPenduduk['agama'] == $agama['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedAgama = "selected";
                                                        }
                                                        // Menampilkan opsi agama dengan penanda yang sesuai
                                                        echo '<option value="'.$agama['id'].'" '.$selectedAgama.'>'.$agama['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        
                                            <div class="mb-3">
                                                <label for="sts" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menandai yang sesuai dengan data mahasiswa yang dipilih
                                                    foreach ($statusList as $status){
                                                        // Menginisialisasi variabel kosong untuk menandai opsi yang dipilih
                                                        $selectedStatus = "";
                                                        // Mengecek apakah status saat ini sesuai dengan data mahasiswa
                                                        if($dataPenduduk['status'] == $status['id']){
                                                            // Jika sesuai, tandai sebagai opsi yang dipilih
                                                            $selectedStatus = "selected";
                                                        }
                                                        // Menampilkan opsi status dengan penanda yang sesuai
                                                        echo '<option value="'.$status['id'].'" '.$selectedStatus.'>'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
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