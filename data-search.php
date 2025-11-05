<?php

include_once 'config/class-mahasiswa.php';
$Penduduk = new Penduduk();
$kataKunci = '';
// Mengecek apakah parameter GET 'search' ada
if(isset($_GET['search'])){
	// Mengambil kata kunci pencarian dari parameter GET 'search'
	$kataKunci = $_GET['search'];
	// Memanggil method searchPenduduk untuk mencari data penduduk berdasarkan kata kunci dan menyimpan hasil dalam variabel $cariPenduduk
	$cariPenduduk = $Penduduk->searchPenduduk($kataKunci);
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
								<h3 class="mb-0">Cari Penduduk</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Cari Data</li>
								</ol>
							</div>
						</div>
					</div>
				</div>

				<div class="app-content">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12">
								<div class="card mb-3">
									<div class="card-header">
										<h3 class="card-title">Pencarian Penduduk</h3>
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
									<div class="card-body">
										<form action="data-search.php" method="GET">
											<div class="mb-3">
												<label for="search" class="form-label">Masukkan NIK atau Nama Penduduk</label>
												<input type="text" class="form-control" id="search" name="search" placeholder="Cari berdasarkan NIK atau Nama Penduduk" value="<?php echo $kataKunci; ?>" required>
											</div>
											<button type="submit" class="btn btn-primary"><i class="bi bi-search-heart-fill"></i> Cari</button>
										</form>
									</div>
								</div>
								<div class="card">
									<div class="card-header">
										<h3 class="card-title">Hasil Pencarian</h3>
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
									<div class="card-body">
										<?php
										// Mengecek apakah parameter GET 'search' ada
										if(isset($_GET['search'])){
											// Mengecek apakah ada data penduduk yang ditemukan
											if(count($cariPenduduk) > 0){
												// Menampilkan tabel hasil pencarian
												echo '<table class="table table-striped" role="table">
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
													<tbody>';
													// Iterasi data penduduk yang ditemukan dan menampilkannya dalam tabel
													foreach ($cariPenduduk as $index => $Penduduk){
														// Mengubah status penduduk menjadi badge dengan warna yang sesuai
														if($Penduduk['status'] == 1){
															$Penduduk['status'] = '<span class="badge bg-success">Menikah</span>';
														} elseif($Penduduk['status'] == 2){
															$Penduduk['status'] = '<span class="badge bg-danger">Belum Menikah</span>';
														}
														
														// Menampilkan baris data penduduk dalam tabel
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
												echo '</tbody>
												</table>';
											} else {
												// Menampilkan pesan jika tidak ada data penduduk yang ditemukan
												echo '<div class="alert alert-warning" role="alert">
														Tidak ditemukan data penduduk yang sesuai dengan kata kunci "<strong>'.htmlspecialchars($_GET['search']).'</strong>".
													  </div>';
											}
										} else {
											// Menampilkan pesan jika form pencarian belum disubmit
											echo '<div class="alert alert-info" role="alert">
													Silakan masukkan kata kunci pencarian di atas untuk mencari data penduduk.
												  </div>';
										}
										?>
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