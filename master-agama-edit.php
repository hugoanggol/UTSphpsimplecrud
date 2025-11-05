<?php 

// Silakan lihat komentar di file data-edit.php untuk penjelasan kode ini, karena struktur dan logikanya serupa.
include_once 'config/class-master.php';
$master = new MasterData();
$dataAgama = $master->getUpdateAgama($_GET['id']);
if(isset($_GET['status'])){
    if($_GET['status'] == 'failed'){
        echo "<script>alert('Gagal mengubah data agama. Silakan coba lagi.');</script>";
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
								<h3 class="mb-0">Edit Agama</h3>
							</div>
							<div class="col-sm-6">
								<ol class="breadcrumb float-sm-end">
									<li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
									<li class="breadcrumb-item active" aria-current="page">Edit Agama</li>
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
										<h3 class="card-title">Formulir Agama</h3>
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
                                    <form action="proses/proses-agama.php?aksi=updateagama" method="POST">
									    <div class="card-body">
                                            <div class="mb-3">
                                                <label for="kode" class="form-label">Kode Agama</label>
                                               <input type="text" class="form-control" id="kode" name="kode" placeholder="Masukkan Nama Kode Agama" value="<?php echo $dataAgama['nama']; ?>" required readonly>
											<div class="mb-3">
												<label for="nama" class="form-label">Nama Agama</label>
												<input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Agama" value="<?php echo $dataAgama['nama']; ?>" required>
											</div>
                                        </div>
									    <div class="card-footer">
                                            <button type="button" class="btn btn-danger me-2 float-start" onclick="window.location.href='master-agama-list.php'">Batal</button>
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