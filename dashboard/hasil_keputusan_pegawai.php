<?php
$status = $_GET['status'];
$bagian = $user['id_bagian'] == 5 ? (isset($_GET['bagian']) ? $_GET['bagian'] : 3) : $user['id_bagian'];
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

?>
<h1 class="h3 mb-4 text-gray-800">Hasil Keputusan Pegawai</h1>

<!-- DataTales Example -->

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-end">
        <h6 class="font-weight-bold">Bagian</h6>
    </div>
    <form action="" method="GET">
        <input type="hidden" name="halaman" value="hasil-keputusan-pegawai">
        <input type="hidden" name="status" value="<?= $status ?>">
        <div class="card-body">
            <div class="row">
                <?php
                if ($user['id_bagian'] == 5) {
                ?>

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
                <?php
                }
                ?>
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

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold">Hasil Keputusan Pegawai <?= ucfirst($status) ?></h6>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Vektor V</th>
                        <th>Vektor S</th>
                        <th>Peringkat</th>
                        <th>Keputusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_bagian='$bagian' AND status='$status' AND tahun='$tahun'");
                    $data = mysqli_fetch_assoc($query);
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT*FROM detail_keputusan JOIN pegawai ON detail_keputusan.nip = pegawai.nip WHERE detail_keputusan.id_keputusan='$data[id]' ORDER BY detail_keputusan.vektor_v DESC");
                    while ($res = mysqli_fetch_assoc($query)) {
                    ?>
                        <tr class="<?= $res['nip'] == $user['nip'] ? 'bg-success text-light' : '' ?>">
                            <td><?= $res['nip'] ?></td>
                            <td><?= $res['nama_pegawai'] ?></td>
                            <td><?= $res['vektor_v'] ?></td>
                            <td><?= $res['vektor_s'] ?></td>
                            <td><?= $no++ ?></td>
                            <td><?= $res['keputusan'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>