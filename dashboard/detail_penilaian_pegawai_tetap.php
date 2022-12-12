<?php
$query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip JOIN user ON penilaian.username = user.username WHERE id_penilaian='$_GET[id]'");
$data = mysqli_fetch_assoc($query);
?>
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Penilaian</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Detail Penilaian Pegawai Tetap</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <p>NIP</p>
                <p>Nama</p>
                <p>Penilai</p>
                <p>Tanggal Penilaian</p>
            </div>
            <div class="col-sm-4">
                <p>: <?= $data['nip'] ?></p>
                <p>: <?= $data['nama_pegawai'] ?></p>
                <p>: <?= $data['nama'] ?></p>
                <p>: <?= $data['tanggal'] ?></p>
            </div>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>No.</th>
                <th>Indikator Penilaian</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
            <tbody>
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT*FROM detail_penilaian JOIN kriteria ON detail_penilaian.id_kriteria = kriteria.id_kriteria WHERE id_penilaian='$data[id_penilaian]'");
                while ($res = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $res['kriteria'] ?></td>
                        <td><?= $res['nilai'] ?></td>
                        <td><?= $res['keterangan'] ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <p>Catatan : </p>
        <p><?= $data['catatan'] ? $data['catatan'] : '-' ?></p>
    </div>
</div>