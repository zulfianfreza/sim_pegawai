<?php

session_start();
include '../../koneksi.php';

if ($_GET['aksi'] == 'tambah') {
    $nip = $_POST['nip'];
    $catatan = $_POST['catatan'];
    $periode = $_POST['periode'];
    $tahun = $_POST['tahun'];
    $sekarang = date("Y-m-d H:i:s");
    $id_kriteria = $_POST['id_kriteria'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip WHERE penilaian.nip='$nip' AND penilaian.periode='$periode' AND penilaian.tahun='$tahun'");
    $check = mysqli_num_rows($query);

    if ($check > 0) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Penilaian untuk ' . $nip . ' pada periode ' . $periode . ' ' . $tahun . ' telah dilakukan. ';
        header('location:../index.php?halaman=tambah-penilaian-pegawai&status=' . $status);
        exit();
    }

    $query = mysqli_query($koneksi, "SELECT*FROM pegawai WHERE nip='$nip'");
    $data = mysqli_fetch_assoc($query);
    $status = strtolower($data['status']);

    $query = mysqli_query($koneksi, "INSERT INTO penilaian (nip, periode, tahun, username, tanggal, catatan) VALUES ('$nip', '$periode', '$tahun', '$_SESSION[username]', '$sekarang', '$catatan')");
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
        header('location:../index.php?halaman=penilaian-pegawai&status=' . $status);
    } else {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = mysqli_error($koneksi);
        header('location:../index.php?halaman=tambah-penilaian-pegawai&status=' . $status);
    }
}

if ($_GET['aksi'] == 'ubah') {
    $nip = $_POST['nip'];
    $catatan = $_POST['catatan'];
    $sekarang = date("Y-m-d H:i:s");
    $id = $_GET['id'];
    $nilai = $_POST['nilai'];
    $keterangan = $_POST['keterangan'];

    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip WHERE penilaian.id_penilaian='$id'");
    $data = mysqli_fetch_assoc($query);
    $status = strtolower($data['status']);

    $query = mysqli_query($koneksi, "UPDATE penilaian SET catatan='$catatan' WHERE id_penilaian=$_GET[id]");

    for ($i = 0; $i < count($nilai); $i++) {
        $query = mysqli_query($koneksi, "UPDATE detail_penilaian SET nilai='$nilai[$i]', keterangan='$keterangan[$i]' WHERE id='$id[$i]'");

        if (!$query) {
            $_SESSION['toast_type'] = 'success';
            $_SESSION['toast_message'] = mysqli_error($koneksi);
            header('location:../index.php?halaman=ubah-penilaian-pegawai&status=' . $status);
        }
    }

    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Ubah Penilaian berhasil';
    header('location:../index.php?halaman=penilaian-pegawai&status=' . $status);
}

if ($_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "SELECT*FROM penilaian JOIN pegawai ON penilaian.nip = pegawai.nip WHERE penilaian.id_penilaian='$id'");
    $data = mysqli_fetch_assoc($query);
    $status = strtolower($data['status']);

    $query = mysqli_query($koneksi, "DELETE FROM penilaian WHERE id_penilaian='$id'");


    if ($query) {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = 'Hapus data penilaian berhasil';
        header('location:../index.php?halaman=penilaian-pegawai&status=' . $status);
    } else {
        $_SESSION['toast_type'] = 'success';
        $_SESSION['toast_message'] = mysqli_error($koneksi);
        header('location:../index.php?halaman=penilaian-pegawai&status=' . $status);
    }
}
