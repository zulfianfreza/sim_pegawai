<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $bagian = isset($_POST['bagian']) ? $_POST['bagian'] : 6;

    $query = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username sudah ada.';
        header('location:../index.php?halaman=tambah-user');
        exit();
    }

    $query = mysqli_query($koneksi, "INSERT INTO user (nama, username, password, role, id_bagian) VALUES ('$nama', '$username', '$password', '$role', '$bagian')");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Tambah data user berhasil.';
        header('location:../index.php?halaman=user');
    } else {

        echo mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'ubah') {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $bagian = isset($_POST['bagian']) ? $_POST['bagian'] : 6;

    $query = mysqli_query($koneksi, "SELECT*FROM user where username='$username'");
    $data = mysqli_fetch_assoc($query);
    $password = $_POST['password'] ? md5($_POST['password']) : $data['password'];

    $query = mysqli_query($koneksi, "UPDATE user SET nama='$nama', password='$password', role='$role', id_bagian='$bagian' WHERE username='$username'");
    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Ubah data user berhasil.';
        header('location:../index.php?halaman=user');
    } else {
        echo mysqli_error($koneksi);
    }
}

if ($_GET['aksi'] == 'hapus') {
    $username = $_GET['username'];

    $query = mysqli_query($koneksi, "DELETE FROM user WHERE username='$username'");

    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data user berhasil';
        header('location:../index.php?halaman=user');
    }
}
