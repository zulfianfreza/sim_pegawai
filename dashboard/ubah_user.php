<?php
$query = mysqli_query($koneksi, "SELECT*FROM user where username='$_GET[username]'");
$data = mysqli_fetch_assoc($query);
?>
<h1 class="h3 mb-4 text-gray-800">User</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Tambah User</h6>
    </div>
    <form action="./proses/proses_user.php?aksi=ubah" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="" value="<?= $data['nama'] ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" placeholder="" value="<?= $data['username'] ?>" readonly>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" placeholder="" value="">
                <small id="emailHelp" class="form-text text-muted">Isi password jika akan dirubah, biarkan tetap kosong jika tidak ada perubahan.</small>
            </div>
            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role" id="" class="form-control" onchange="showBagian(this)">
                    <option value="admin" <?= $data['role'] == 'admin' ? 'selected' : '' ?>>admin</option>
                    <option value="kabag" <?= $data['role'] == 'kabag' ? 'selected' : '' ?>>kabag</option>
                </select>
            </div>
            <div class="form-group" id="bagian" style="display: <?= $data['role'] == 'admin' ? 'none' : 'block' ?>;">
                <label class="form-label">Bagian</label>
                <select name="bagian" id="" class="form-control">
                    <option value="" selected disabled>Bagian</option>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM bagian WHERE id_bagian !=6");
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

<script>
    function showBagian(element) {
        document.getElementById('bagian').style.display = element.value == 'admin' ? 'none' : 'block'
    }
</script>