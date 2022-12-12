<?php
$kode = $_GET['kode'];
$query = mysqli_query($koneksi, "SELECT*FROM kriteria WHERE id_kriteria='$kode'");
$data = mysqli_fetch_assoc($query);
?>

<h1 class="h3 mb-4 text-gray-800">Kriteria</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Kriteria</h6>
    </div>
    <form action="./proses/proses_kriteria.php?aksi=ubah" method="POST">
        <div class="card-body">
            <div class="">
                <label class="form-label">Kode</label>
                <input type="text" class="form-control" name="kode" placeholder="" value="<?= $data['id_kriteria'] ?>">
            </div>
            <div class="mt-3">
                <label class="form-label">Kriteria</label>
                <input type="text" class="form-control" name="kriteria" placeholder="" value="<?= $data['kriteria'] ?>">
            </div>
            <div class="mt-3">
                <label class="form-label">Bobot</label>
                <select name="bobot" id="" class="form-control">
                    <option value="5" <?= $data['bobot'] == 5 ? 'selected' : '' ?>>5 - Sangat Penting</option>
                    <option value="4" <?= $data['bobot'] == 4 ? 'selected' : '' ?>>4 - Penting</option>
                    <option value="3" <?= $data['bobot'] == 3 ? 'selected' : '' ?>>3 - Cukup Penting</option>
                    <option value="3" <?= $data['bobot'] == 2 ? 'selected' : '' ?>>2 - Kurang Penting</option>
                </select>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Ubah
            </button>
        </div>
    </form>
</div>