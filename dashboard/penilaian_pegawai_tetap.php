<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Penilaian Pegawai Tetap</h6>
        <?php
        if ($_SESSION['login_type'] != 'nip') {
        ?>
            <a href="index.php?halaman=tambah-penilaian-pegawai-tetap" class="btn btn-success">
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
                        <th>Penilai</th>
                        <th>Tanggal Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip JOIN user ON penilaian.username = user.username");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nip'] ?></td>
                        <td><?= $data['nama_pegawai'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td>
                            <a href="index.php?halaman=detail-penilaian-pegawai-tetap&id=<?= $data['id_penilaian'] ?>">
                                <button class="btn btn-info btn-sm">Detail</button>
                            </a>
                            <?php
                            if ($_SESSION['login_type'] != 'nip') {
                            ?>
                                <a href="index.php?halaman=ubah-penilaian-pegawai-tetap&id=<?= $data['id_penilaian'] ?>">
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <a href="./proses/proses_penilaian.php?aksi=hapus&id=<?= $data['id_penilaian'] ?>">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </a>
                            <?php
                            }
                            ?>
                        </td>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>