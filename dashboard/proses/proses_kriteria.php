<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $kode = $_POST['kode'];
    $kriteria = $_POST['kriteria'];
    $bobot = $_POST['bobot'];

    $query = mysqli_query($koneksi, "SELECT*FROM kriteria where id_kriteria='$kode'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Duplikat kode kriteria';
        header('location:../index.php?halaman=kriteria');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO kriteria VALUES('$kode', '$kriteria', '$bobot')");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data kriteria berhasil.';
        header('location:../index.php?halaman=kriteria');
    } else {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Tambah data kriteria gagal.';
        header('location:../index.php?halaman=kriteria');
    }
}

if ($_GET['aksi'] == 'ubah') {
    $kode = $_POST['kode'];
    $kriteria = $_POST['kriteria'];
    $bobot = $_POST['bobot'];

    $query = mysqli_query($koneksi, "UPDATE kriteria SET kriteria='$kriteria', bobot='$bobot' WHERE id_kriteria='$kode'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Ubah data kriteria berhasil.';
        header('location:../index.php?halaman=kriteria');
    } else {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Ubah data kriteria gagal.';
        header('location:../index.php?halaman=kriteria');
    }
}

if ($_GET['aksi'] == 'hapus') {
    $kode = $_GET['kode'];

    $query = mysqli_query($koneksi, "DELETE FROM kriteria WHERE id_kriteria='$kode'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data kriteria berhasil';
        header('location:../index.php?halaman=kriteria');
    }
}
