<?php
$query = mysqli_query($koneksi, "SELECT*FROM pegawai WHERE nip='$_GET[nip]'");
$data = mysqli_fetch_assoc($query);
?>

<h1 class="h3 mb-4 text-gray-800">Pegawai</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Ubah Pegawai</h6>
    </div>
    <form action="./proses/proses_pegawai.php?aksi=ubah&nip=<?= $data['nip'] ?>" method="POST">
        <div class="card-body">
            <div class="">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" placeholder="" value="<?= $data['nip'] ?>" readonly>
            </div>
            <div class="mt-3">
                <label class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" name="nama" placeholder="Maxhill Abraham" value="<?= $data['nama_pegawai'] ?>">
            </div>
            <div class="mt-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="jk1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'checked' : '' ?>>
                        <label class="form-check-label" for="jk2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="2" class="form-control"><?= $data['alamat'] ?></textarea>
            </div>
            <div class="mt-3 form-group">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="Tetap" <?= $data['status'] == 'tetap' ? 'selected' : '' ?>>Tetap</option>
                    <option value="Kontrak" <?= $data['status'] == 'Kontrak' ? 'selected' : '' ?>>Kontrak</option>
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" placeholder="" value="<?= $data['jabatan']  ?>">
            </div>
            <div class="mt-3">
                <label class="form-label">Bagian</label>
                <select name="bagian" id="" class="form-control">
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM bagian WHERE nama_bagian!='Admin'");
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <option value="<?= $res['id_bagian'] ?>" <?= $res['id_bagian'] == $data['id_bagian'] ? 'selected' : '' ?>><?= $res['nama_bagian'] ?></option>
                    <?php
                    }
                    ?>
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