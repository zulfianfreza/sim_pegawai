<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Pegawai</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Pegawai</h6>
        <a href="index.php?halaman=tambah-pegawai" class="btn btn-success">
            <i class="fas fa-plus"></i> Tambah
        </a>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM pegawai");
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
                            <td><?= $data['bagian'] ?></td>
                            <td>
                                <a href="index.php?halaman=ubah-pegawai&nip=<?= $data['nip'] ?>">
                                    <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                </a>
                                <a href="./proses/proses_pegawai.php?aksi=hapus&nip=<?= $data['nip'] ?>">
                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </a>
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