<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $jabatan = $_POST['jabatan'];
    $bagian = $_POST['bagian'];

    if ($nip == '' or $nama == '') {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Silahkan lengkapi semua data.';
        header('location:../index.php?halaman=tambah-pegawai');
        exit();
    }

    $query = mysqli_query($koneksi, "SELECT*FROM pegawai WHERE nip='$nip'");
    $check = mysqli_num_rows($query);
    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'NIP sudah ada';
        header('location:../index.php?halaman=tambah-pegawai');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO pegawai VALUES('$nip', '$nama', '$jenis_kelamin', '$alamat', '$status', '$jabatan', '$bagian')");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data pegawai berhasil.';
        header('location:../index.php?halaman=pegawai');
    }
}

if ($_GET['aksi'] == 'ubah') {
    $nip = $_GET['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $alamat = $_POST['alamat'];
    $status = $_POST['status'];
    $jabatan = $_POST['jabatan'];
    $bagian = $_POST['bagian'];

    $query = mysqli_query($koneksi, "UPDATE pegawai set nama='$nama', jenis_kelamin='$jenis_kelamin', alamat='$alamat', status='$status', jabatan='$jabatan', bagian='$bagian' WHERE nip='$nip'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Ubah data pegawai berhasil.';
        header('location:../index.php?halaman=pegawai');
    }
}

if ($_GET['aksi'] == 'hapus') {
    $nip = $_GET['nip'];

    $query = mysqli_query($koneksi, "DELETE FROM pegawai WHERE nip='$nip'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data pegawai berhasil';
        header('location:../index.php?halaman=pegawai');
    }
}
