<h1 class="h3 mb-4 text-gray-800">Pegawai</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold tr-text-primary">Tambah Pegawai</h6>
    </div>
    <form action="./proses/proses_pegawai.php?aksi=tambah" method="POST">
        <div class="card-body">
            <div class="">
                <label class="form-label">NIP</label>
                <input type="text" class="form-control" name="nip" placeholder="" value="">
            </div>
            <div class="mt-3">
                <label class="form-label">Nama Pegawai</label>
                <input type="text" class="form-control" name="nama" placeholder="Maxhill Abraham" value="">
            </div>
            <div class="mt-3">
                <label class="form-label">Jenis Kelamin</label>
                <div class="">

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk1" value="Laki-laki" checked>
                        <label class="form-check-label" for="jk1">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="jk2" value="Perempuan">
                        <label class="form-check-label" for="jk2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="2" class="form-control"></textarea>
            </div>
            <div class="mt-3 form-group">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-control">
                    <option value="Tetap">Tetap</option>
                    <option value="Kontrak">Kontrak</option>
                </select>
            </div>
            <div class="mt-3">
                <label class="form-label">Jabatan</label>
                <input type="text" class="form-control" name="jabatan" placeholder="" value="">
            </div>
            <div class="mt-3">
                <label class="form-label">Bagian</label>
                <input type="text" class="form-control" name="bagian" placeholder="" value="">
            </div>
        </div>
        <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn btn-success">
                Simpan
            </button>
        </div>
    </form>
</div>