<?php
$status = $_GET['status'];
?>

<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Penilaian Pegawai Tetap</h6>
    </div>
    <form action="./proses/proses_penilaian.php?aksi=tambah" method="POST">
        <div class="card-body">

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="" class="form-label">Periode</label>
                        <select name="periode" id="" class="form-control">
                            <?php
                            $bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
                            for ($i = 0; $i < 12; $i++) {
                            ?>
                                <option value="<?= $bulan[$i] ?>" <?= $i == (date('m') - 1) ? 'selected' : '' ?>><?= $bulan[$i] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="" class="form-label">Tahun</label>
                        <select name="tahun" id="" class="form-control">
                            <?php $tahun_sekarang = date('Y') ?>
                            <option value="<?= $tahun_sekarang - 1 ?>"><?= $tahun_sekarang - 1 ?></option>
                            <option value="<?= $tahun_sekarang ?>" selected><?= $tahun_sekarang ?></option>
                            <option value="<?= $tahun_sekarang + 1 ?>"><?= $tahun_sekarang + 1 ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Pegawai</label>
                <select name="nip" id="" class="form-control" required>
                    <option value="" disabled selected>NIP - Nama</option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM pegawai WHERE status='$status' AND id_bagian='$user[id_bagian]'");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $data['nip'] ?>"><?= $data['nip'] . ' - ' . $data['nama_pegawai'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <?php
            $query = mysqli_query($koneksi, "SELECT*FROM kriteria");
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <input type="hidden" name="id_kriteria[]" value="<?= $data['id_kriteria'] ?>">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group row">
                            <label for="" class="col-sm-6 col-form-label"><?= $data['kriteria'] ?></label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="nilai[]" value="" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan[]" id="" rows="1" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
            <div class="form-group">
                <label for="" class="form-label">Catatan</label>
                <textarea name="catatan" class="form-control" id="" cols="30" rows="3"></textarea>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Simpan
            </button>
        </div>
    </form>
</div>