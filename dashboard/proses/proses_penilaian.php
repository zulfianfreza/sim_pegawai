<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nip = $_POST['nip'];
    $catatan = $_POST['catatan'];
    $sekarang = date("Y-m-d H:i:s");
    $id_kriteria = $_POST['id_kriteria'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];
    $query = mysqli_query($koneksi, "INSERT INTO penilaian (nip, username, tanggal, catatan) VALUES ('$nip', '$_SESSION[username]', '$sekarang', '$catatan')");
    if ($query) {
        $id = mysqli_insert_id($koneksi);

        for ($i = 0; $i < count($nilai); $i++) {
            $query = mysqli_query($koneksi, "INSERT INTO detail_penilaian (id_penilaian, id_kriteria, nilai, keterangan) VALUES ('$id', '$id_kriteria[$i]', '$nilai[$i]', '$keterangan[$i]')");

            if (!$query) {
                echo mysqli_error($koneksi);
            }
        }

        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Penilaian berhasil';
        header('location:../index.php?halaman=penilaian-pegawai-tetap');
    }
}

if ($_GET['aksi'] == 'ubah') {
    $nip = $_POST['nip'];
    $catatan = $_POST['catatan'];
    $sekarang = date("Y-m-d H:i:s");
    $id = $_POST['id'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($koneksi, "UPDATE penilaian SET catatan='$catatan' WHERE id_penilaian=$_GET[id]");

    for ($i = 0; $i < count($nilai); $i++) {
        $query = mysqli_query($koneksi, "UPDATE detail_penilaian SET nilai='$nilai[$i]', keterangan='$keterangan[$i]' WHERE id='$id[$i]'");

        if (!$query) {
            echo mysqli_error($koneksi);
        }
    }

    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Ubah Penilaian berhasil';
    header('location:../index.php?halaman=penilaian-pegawai-tetap');
}

if ($_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_penilaian='$id'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data penilaian berhasil';
        header('location:../index.php?halaman=penilaian-pegawai-tetap');
    }
}
