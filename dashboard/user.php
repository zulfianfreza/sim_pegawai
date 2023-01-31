<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">User</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data User</h6>
        <a href="index.php?halaman=tambah-user" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Bagian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM user JOIN bagian ON user.id_bagian = bagian.id_bagian");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['username'] ?></td>
                            <td><?= $data['role'] ?></td>
                            <td><?= $data['id_bagian'] == '6' ? '' : $data['nama_bagian'] ?></td>
                            <td>
                                <?php
                                if ($data['level'] != 1) {
                                ?>
                                    <a href="index.php?halaman=ubah-user&username=<?= $data['username'] ?>">
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <a href="./proses/proses_user.php?aksi=hapus&username=<?= $data['username'] ?>">
                                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </a>
                                <?php
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>