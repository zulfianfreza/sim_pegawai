<?php
$status = $_GET['status'];

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Hasil Penilaian</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Hasil Penilaian Pegawai <?= ucfirst($status) ?></h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-6">
                <p>Bobot</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Skala</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysqli_query($koneksi, "SELECT*FROM kriteria JOIN bobot on kriteria.id_bobot = bobot.id_bobot");
                        while ($data = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <td><?= $data['id_kriteria'] ?></td>
                                <td><?= $data['kriteria'] ?></td>
                                <td><?= $data['skala'] ?></td>
                                <td><?= $data['keterangan'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <p>Perbaikan Bobot</p>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kriteria</th>
                            <th>Skala</th>
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
                                <td><?= $data['perbaikan_bobot'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

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
                    $no = 1;
                    $query1 = mysqli_query($koneksi, "SELECT*FROM pegawai JOIN penilaian ON pegawai.nip = penilaian.nip WHERE pegawai.status='$status'");
                    $vektorv = 0;
                    $vektors = 0;
                    $data_vektorv = [];
                    $data_nip = [];
                    $data_nama = [];
                    while ($data1 = mysqli_fetch_assoc($query1)) {
                        $vektorv_temp = 1;
                        $query2 = mysqli_query($koneksi, "SELECT*FROM detail_penilaian dp1 JOIN perbaikan_bobot pb1 ON dp1.id_kriteria = pb1.id_kriteria WHERE dp1.id_penilaian='$data1[id_penilaian]'");
                        while ($data2 = mysqli_fetch_assoc($query2)) {
                            $v = pow($data2['nilai'], $data2['perbaikan_bobot']);
                            $vektorv_temp = $vektorv_temp * $v;
                        }
                        $vektorv = $vektorv_temp;
                        $vektors = $vektors + $vektorv;
                        array_push($data_vektorv, $vektorv_temp);
                        array_push($data_nip, $data1['nip']);
                        array_push($data_nama, $data1['nama_pegawai']);
                    ?>
                        <tr>
                            <td><?= $data1['nip'] ?></td>
                            <td><?= $data1['nama_pegawai'] ?></td>
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