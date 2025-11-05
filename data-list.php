<?php

include_once 'config/class-mahasiswa.php';
$Penduduk = new  Penduduk();
// Menampilkan alert berdasarkan status yang diterima melalui parameter GET
if(isset($_GET['status'])){
	// Mengecek nilai parameter GET 'status' dan menampilkan alert yang sesuai menggunakan JavaScript
	if($_GET['status'] == 'inputsuccess'){
		echo "<script>alert('Data penduduk berhasil ditambahkan.');</script>";
	} else if($_GET['status'] == 'editsuccess'){
		echo "<script>alert('Data penduduk berhasil diubah.');</script>";
	} else if($_GET['status'] == 'deletesuccess'){
		echo "<script>alert('Data penduduk berhasil dihapus.');</script>";
	} else if($_GET['status'] == 'deletefailed'){
		echo "<script>alert('Gagal menghapus data penduduk. Silakan coba lagi.');</script>";
	}
}
$dataPenduduk = $Penduduk->getAllPenduduk();


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
								<h3 class="mb-0">Daftar Penduduk</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Beranda</li>
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
										<h3 class="card-title">Tabel Penduduk</h3>
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
									<div class="card-body p-0 table-responsive">
										<table class="table table-striped" role="table">
											<thead>
												<tr>
													<th>No</th>
													<th>NIK</th>
													<th>Nama</th>
													<th>Tempatlahir</th>
													<th>Tanggallahir</th>
													<th>Tahunlahir</th>
													<th>Provinsi</th>
													<th>Agama</th>
													<th>Gender</th>
													<th>Alamat</th>
													<th class="text-center">Status</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if(count($dataPenduduk) == 0){
													    echo '<tr class="align-middle">
															<td colspan="10" class="text-center">Tidak ada data penduduk.</td>
														</tr>';
													} else {
														foreach ($dataPenduduk as $index => $Penduduk){
														if($Penduduk['status'] == 1){
														    $Penduduk['status'] = '<span class="badge bg-success">Menikah</span>';
														} elseif($Penduduk['status'] == 2){
															$Penduduk['status'] = '<span class="badge bg-danger">Belum Menikah</span>';
														}
															echo '<tr class="align-middle">
																<td>'.($index + 1).'</td>
																<td>'.$Penduduk['nik'].'</td>
																<td>'.$Penduduk['nama'].'</td>
																<td>'.$Penduduk['tempat'].'</td>
																<td>'.$Penduduk['tanggal'].'</td>
																<td>'.$Penduduk['tahun'].'</td>
																<td>'.$Penduduk['provinsi'].'</td>
																<td>'.$Penduduk['agama'].'</td>
																<td>'.$Penduduk['gender'].'</td>
																<td>'.$Penduduk['alamat'].'</td>
																<td class="text-center">'.$Penduduk['status'].'</td>
																<td class="text-center">
																	<button type="button" class="btn btn-sm btn-warning me-1" onclick="window.location.href=\'data-edit.php?id='.$Penduduk['id'].'\'"><i class="bi bi-pencil-fill"></i> Edit</button>
																	<button type="button" class="btn btn-sm btn-danger" onclick="if(confirm(\'Yakin ingin menghapus data penduduk ini?\')){window.location.href=\'proses/proses-delete.php?id='.$Penduduk['id'].'\'}"><i class="bi bi-trash-fill"></i> Hapus</button>
																</td>
															</tr>';
														}
													}
												?>
											</tbody>
										</table>
									</div>
									<div class="card-footer">
										<button type="button" class="btn btn-primary" onclick="window.location.href='data-input.php'"><i class="bi bi-plus-lg"></i> Tambah Penduduk</button>
									</div>
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