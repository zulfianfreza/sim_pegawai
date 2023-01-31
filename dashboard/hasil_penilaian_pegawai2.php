<?php
$status = $_GET['status'];
$bagian = isset($_GET['bagian']) ? $_GET['bagian'] : 3;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Hasil Penilaian <i class="fa fa-info-circle" data-toggle="modal" data-target="#exampleModal"></i></h1>

<div class="modal fade " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Perbaikan Bobot</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Skala</th>
                            <th>Keterangan</th>
                            <th>Perbaikan Bobot</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT*FROM perbaikan_bobot");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?= $data['id_kriteria'] ?></td>
                                <td><?= $data['kriteria'] ?></td>
                                <td><?= $data['skala'] ?></td>
                                <td><?= $data['keterangan'] ?></td>
                                <td><?= $data['perbaikan_bobot'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Bagian</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="hasil-penilaian-pegawai">
        <input type="hidden" name="status" value="<?= $status ?>">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-4">
                    <select name="bagian" id="" class="form-control">
                        <?php

                        $query = mysqli_query($koneksi, "SELECT*FROM bagian WHERE id_bagian !=6");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $data['id_bagian'] ?>" <?= $data['id_bagian'] == $bagian ? 'selected' : '' ?>><?= $data['nama_bagian'] ?></option>
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
                            <option value="<?= $data['tahun'] ?>" <?= $data['tahun'] == $tahun ? 'selected' : '' ?>><?= $data['tahun'] ?></option>
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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Hasil Penilaian Pegawai <?= ucfirst($status) ?></h6>
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Nilai Vektor V</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $vektorv = 0;
                    $vektors = 0;
                    $data_vektorv = [];
                    $data_nip = [];
                    $data_nama = [];
                    $query = mysqli_query($koneksi, "SELECT*FROM pegawai JOIN penilaian ON pegawai.nip = penilaian.nip WHERE pegawai.status='$status' AND pegawai.id_bagian='$bagian' AND penilaian.tahun='$tahun'");
                    while ($data = mysqli_fetch_assoc($query)) {
                        $vektorv_temp = 1;
                    ?>
                        <tr>
                            <td><?= $data['nip'] ?></td>
                            <td><?= $data['nama_pegawai'] ?></td>
                            <?php
                            $query2 = mysqli_query($koneksi, "SELECT AVG(dp.nilai) as 'nilai', pb.perbaikan_bobot FROM detail_penilaian dp JOIN perbaikan_bobot pb ON dp.id_kriteria = pb.id_kriteria WHERE dp.id_penilaian IN (SELECT penilaian.id_penilaian FROM penilaian WHERE penilaian.nip='$data[nip]' AND penilaian.tahun='$tahun') GROUP BY dp.id_kriteria;");
                            while ($data2 = mysqli_fetch_assoc($query2)) {
                                $v = pow($data2['nilai'], $data2['perbaikan_bobot']);
                                $vektorv_temp = $vektorv_temp * $v;
                            }
                            $check = mysqli_num_rows($query2);
                            $vektorv = $check == 0 ? 0 : $vektorv_temp;
                            $vektors = $vektors + $vektorv;
                            array_push($data_vektorv, $check == 0 ? 0 : $vektorv_temp);
                            array_push($data_nip, $data['nip']);
                            array_push($data_nama, $data['nama_pegawai']);
                            ?>
                            <td><?= $vektorv ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Nilai Vektor V</th>
                        <th>Nilai Vektor S</th>
                        <th>Peringkat</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    array_multisort($data_vektorv, SORT_DESC, $data_nip, $data_nama);
                    for ($i = 0; $i < count($data_nip); $i++) {
                        // foreach ($data_vektorv as $res) {
                    ?>
                        <tr>
                            <td><?= $data_nip[$i] ?></td>
                            <td><?= $data_nama[$i] ?></td>
                            <td><?= $data_vektorv[$i] ?></td>
                            <td><?= $data_vektorv[$i] / $vektors ?></td>
                            <td><?= $i + 1 ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>