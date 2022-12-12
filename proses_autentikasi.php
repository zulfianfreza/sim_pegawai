<?php

include './koneksi.php';
session_start();

if ($_GET['aksi'] == 'login_user') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if (!$username or !$password) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username atau password tidak boleh kosong.';
        header('location:index.php');
    }
    $query = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username' AND password='$password'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $data = mysqli_fetch_assoc($query);
        $_SESSION['logged_in'] = true;
        $_SESSION['login_type'] = 'user';
        $_SESSION['username'] = $data['username'];
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Login berhasil.';
        header('location:dashboard');
    } else {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Username atau password salah, silahkan coba kembali.';
        header('location:index.php');
    }
}

if ($_GET['aksi'] == 'login_nip') {
    $nip = $_POST['nip'];
    $query = mysqli_query($koneksi, "SELECT*FROM pegawai WHERE nip='$nip'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $_SESSION['logged_in'] = true;
        $_SESSION['login_type'] = 'nip';
        $_SESSION['nip'] = $nip;
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Login berhasil.';
        header('location:dashboard');
    } else {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'NIP tidak ada, silahkan coba kembali.';
        header('location:login.php');
    }
}

if ($_GET['aksi'] == 'logout') {
    unset($_SESSION['username']);
    header('location:index.php');
}
