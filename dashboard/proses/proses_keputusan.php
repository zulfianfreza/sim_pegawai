<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nip = $_POST['nip'];
    $vektor_v = $_POST['vektor_v'];
    $vektor_s = $_POST['vektor_s'];
    $keputusan = $_POST['keputusan'];
    $id_bagian = $_POST['id_bagian'];
    $tahun = $_POST['tahun'];
    $status = $_POST['status'];
    $sekarang = date("Y-m-d H:i:s");

    $query = mysqli_query($koneksi, "SELECT*FROM keputusan WHERE id_bagian='$id_bagian' AND status='$status' AND tahun='$tahun'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $data = mysqli_fetch_assoc($query);
        $query = mysqli_query($koneksi, "UPDATE keputusan SET tanggal='$sekarang' WHERE id='$data[id]'");

        $query = mysqli_query($koneksi, "DELETE FROM detail_keputusan WHERE id_keputusan='$data[id]'");

        for ($i = 0; $i < count($keputusan); $i++) {
            $query = mysqli_query($koneksi, "INSERT INTO detail_keputusan(id_keputusan, nip, vektor_v, vektor_s, keputusan) VALUES('$data[id]', '$nip[$i]', '$vektor_v[$i]', '$vektor_s[$i]', '$keputusan[$i]')");

            if (!$query) {
                echo mysqli_error($koneksi);
            }
        }

        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Keputusan berhasil diperbarui';
        header('location:../index.php?halaman=keputusan-pegawai&status=' . $status . '&bagian=' . $id_bagian . '&tahun=' . $tahun);
    } else {

        $query = mysqli_query($koneksi, "INSERT INTO keputusan (id_bagian, status, tahun, tanggal) VALUES('$id_bagian', '$status', '$tahun', '$sekarang')");
        if ($query) {
            $id = mysqli_insert_id($koneksi);

            for ($i = 0; $i < count($keputusan); $i++) {
                $query = mysqli_query($koneksi, "INSERT INTO detail_keputusan(id_keputusan, nip, vektor_v, vektor_s, keputusan) VALUES('$id', '$nip[$i]', '$vektor_v[$i]', '$vektor_s[$i]', '$keputusan[$i]')");

                if (!$query) {
                    echo mysqli_error($koneksi);
                }
            }

            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_message'] = 'Pemberian keputusan berhasil';
            header('location:../index.php?halaman=keputusan-pegawai&status=' . $status . '&bagian=' . $id_bagian . '&tahun=' . $tahun);
        }
    }
}
