<!-- Page Heading -->
<?php
$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
$periode = isset($_GET['periode']) ? $_GET['periode'] : $bulan[date('m') - 1];
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');
$status = $_GET['status'];
?>
<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Periode</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="penilaian-pegawai">
        <input type="hidden" name="status" value="<?= $status ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <select name="periode" id="" class="form-control">
                        <?php

                        for ($i = 0; $i < 12; $i++) {
                        ?>
                            <option value="<?= $bulan[$i] ?>" <?= $bulan[$i] == $periode ? 'selected' : '' ?>><?= $bulan[$i] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select name="tahun" id="" class="form-control">
                        <?php
                        $query = mysqli_query($koneksi, "SELECT distinct(tahun) FROM penilaian GROUP BY tahun");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $data['tahun'] ?>"><?= $data['tahun'] ?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-center">
            <button class="btn btn-success" type="submit">Filter</button>
        </div>
    </form>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Data Penilaian Pegawai <?= ucfirst($status) ?></h6>
        <?php
        if ($_SESSION['login_type'] != 'nip') {
        ?>
            <a href="index.php?halaman=tambah-penilaian-pegawai&status=<?= $status ?>" class="btn btn-success">
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
                        <th>Periode</th>
                        <th>Tahun</th>
                        <th>Penilai</th>
                        <th>Tanggal Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip JOIN user ON penilaian.username = user.username WHERE pegawai.status='$status' AND pegawai.id_bagian='$user[id_bagian]' AND penilaian.periode='$periode' AND penilaian.tahun='$tahun'");
                    while ($data = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nip'] ?></td>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <td><?= $data['periode'] ?></td>
                            <td><?= $data['tahun'] ?></td>
                            <td><?= $data['nama'] ?></td>
                            <td><?= $data['tanggal'] ?></td>
                            <td>
                                <a href="index.php?halaman=detail-penilaian-pegawai&status=<?= strtolower($data['status']) ?>&id=<?= $data['id_penilaian'] ?>">
                                    <button class="btn btn-info btn-sm">Detail</button>
                                </a>
                                <?php
                                if ($_SESSION['login_type'] != 'nip') {
                                ?>
                                    <a href="index.php?halaman=ubah-penilaian-pegawai&status=<?= strtolower($data['status']) ?>&id=<?= $data['id_penilaian'] ?>">
                                        <button class="btn btn-warning btn-sm"><i class="fa fa-pencil-alt"></i></button>
                                    </a>
                                    <a href="./proses/proses_penilaian.php?aksi=hapus&id=<?= $data['id_penilaian'] ?>">
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