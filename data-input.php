<?php 

include_once 'config/class-master.php';
$master = new MasterData();
// Mengambil daftar agama, provinsi, dan status penduduk
$agamaList = $master->getAgama();
// Mengambil daftar provinsi
$provinsiList = $master->getProvinsi();
// Mengambil daftar status penduduk
$statusList = $master->getStatus();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
    // Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal menambahkan data penduduk. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Input Penduduk</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Input Data Penduduk</li>
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
                                    <form action="proses/proses-input.php" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="nik" class="form-label">Nomor Induk Kependuduk (NIK)</label>
                                                <input type="number" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK Kependuduk" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap penduduk" required>
                                            </div>
                                             <div class="mb-3">
                                                <label for="tempat" class="form-label">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukkan Tempat Lahir" required>
                                            </div>
                                             <div class="mb-3">
                                                <label for="tanggal" class="form-label">Tanggal Lahir</label>
                                                <input type="number" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan  Tanggal Lahir" required>
                                            </div>
                                             <div class="mb-3">
                                                <label for="tahun" class="form-label">Tahun Lahir</label>
                                                <input type="number" class="form-control" id="tahun" name="tahun" placeholder="Masukkan Tahun Lahir" required>
                                            </div>
                                             <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                               <input type="text" class="form-control"  id="alamat" name="alamat" rows="3" placeholder="Masukkan Alamat Lengkap Sesuai KTP" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                <select class="form-select" id="provinsi" name="provinsi" required>
                                                    <option value="" selected disabled>Pilih Provinsi</option>
                                                    <?php
                                                    // Iterasi daftar provinsi dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($provinsiList as $provinsi){
                                                        echo '<option value="'.$provinsi['id'].'">'.$provinsi['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="domisili" class="form-label">Domisili</label>
                                                <input type="text" class="form-control" id="domisili" name="domisili" placeholder="Masukkan Domisili" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="perkerjaan" class="form-label">Perkerjaan</label>
                                                <input type="text" class="form-control" id="perkerjaan" name="perkerjaan" placeholder="Masukkan Perkerjaan" required>
                                            </div>
                                             <div class="mb-3">
                                                <label for="agama" class="form-label">Agama</label>
                                                <select class="form-select" id="agama" name="agama" required>
                                                    <option value="" selected disabled>Pilih Agama</option>
                                                    <?php 
                                                    // Iterasi daftar agama dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($agamaList as $agama){
                                                        echo '<option value="'.$agama['id'].'">'.$agama['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" selected disabled>Pilih Status</option>
                                                    <?php 
                                                    // Iterasi daftar status mahasiswa dan menampilkannya sebagai opsi dalam dropdown
                                                    foreach ($statusList as $status){
                                                        echo '<option value="'.$status['id'].'">'.$status['nama'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='data-list.php'">Batal</button>
                                            <button type="reset" class="btn btn-secondary me-2 float-start">Reset</button>
                                            <button type="submit" class="btn btn-primary float-end">Submit</button>
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