<?php
$status = $_GET['status'];
$bagian = isset($_GET['bagian']) ? $_GET['bagian'] : 3;
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

?>

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">Keputusan</h1>


<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Bagian</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="keputusan-pegawai">
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
        <h6 class="m-0 font-weight-bold">Keputusan Pemberian Bonus Pegawai <?= ucfirst($status) ?></h6>
    </div>
    <form action="./proses/proses_keputusan.php?aksi=tambah" method="post">
        <div class="card-body">


            <div class="table-responsive">
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
                <?php
                }
                ?>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Nilai Vektor V</th>
                            <th>Nilai Vektor S</th>
                            <th>Peringkat</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>



                        <?php
                        array_multisort($data_vektorv, SORT_DESC, $data_nip, $data_nama);
                        for ($i = 0; $i < count($data_nip); $i++) {
                            // foreach ($data_vektorv as $res) {
                        ?>
                            <tr>
                                <input type="hidden" name="id_bagian" value="<?= $bagian ?>">
                                <input type="hidden" name="tahun" value="<?= $tahun ?>">
                                <input type="hidden" name="status" value="<?= $status ?>">
                                <td><?= $data_nip[$i] ?></td>
                                <input type="hidden" name="nip[]" value="<?= $data_nip[$i] ?>">
                                <td><?= $data_nama[$i] ?></td>
                                <td><?= $data_vektorv[$i] ?></td>
                                <input type="hidden" name="vektor_v[]" value="<?= $data_vektorv[$i] ?>">
                                <td><?= $data_vektorv[$i] / $vektors ?></td>
                                <input type="hidden" name="vektor_s[]" value="<?= $data_vektorv[$i] / $vektors ?>">
                                <td><?= $i + 1 ?></td>
                                <td>
                                    <select name="keputusan[]" id="" class="form-control">
                                        <?php
                                        if ($status == 'kontrak') {
                                        ?>
                                            <option value="Perpanjang">Perpanjang</option>
                                            <option value="Stop Kontrak">Stop Kontrak</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="-">-</option>
                                            <option value="Bonus">Bonus</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button class="btn btn-success" type="submit">
                <?php
                $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_bagian='$bagian' AND tahun='$tahun' AND status='$status'");
                $check = mysqli_num_rows($query);
                ?>
                <?= $check == 1 ? 'Perbarui' : 'Simpan' ?>
            </button>
        </div>
    </form>
</div>