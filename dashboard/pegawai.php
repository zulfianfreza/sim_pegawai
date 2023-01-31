<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pegawai</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Pegawai</h6>
        <?php
        if ($user['role'] == 'admin') {
        ?>
            <a href="index.php?halaman=tambah-pegawai" class="btn btn-success">
                <i class="fas fa-plus"></i> Tambah
            </a>
        <?php
        }
        ?>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Jabatan</th>
                        <th>Bagian</th>
                        <th width="60px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $string = $user['role'] == 'admin' ? "SELECT*FROM pegawai JOIN bagian ON pegawai.id_bagian = bagian.id_bagian" : "SELECT*FROM pegawai JOIN bagian ON pegawai.id_bagian = bagian.id_bagian WHERE pegawai.id_bagian='$user[id_bagian]'";
                    $query = mysqli_query($koneksi, $string);
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nip'] ?></td>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['jenis_kelamin'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td><?= $data['status'] ?></td>
                            <td><?= $data['jabatan'] ?></td>
                            <td><?= $data['nama_bagian'] ?></td>
                            <td>
                                <?php
                                if ($user['role'] == 'admin') {
                                ?>
                                    <a href="index.php?halaman=ubah-pegawai&nip=<?= $data['nip'] ?>">
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <a href="./proses/proses_pegawai.php?aksi=hapus&nip=<?= $data['nip'] ?>">
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