<div class="container ml-4 mb-5" style="margin-top: 60px;">
    <div class="row">
        <div class="col-md-6">
            <form action="<?= base_url('pegawai/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control <?= is_invalid('nama'); ?>" name="nama" id="nama" value="<?= $user['nama_pegawai']; ?>">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control <?= is_invalid('nip'); ?>" name="nip" id="nip" value="<?= $user['nip']; ?>">
                    <?= form_error('nip', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control <?= is_invalid('alamat'); ?>" name="alamat" id="alamat" value="<?= $user['alamat']; ?>">
                    <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <div class="custom-file my-2">
                        <input type="file" class="custom-file-input input-gambar-pegawai" name="gambar" id="customFile" style="cursor: pointer !important;">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                </div>

                <button class="btn btn-success" type="submit">Edit Profile</button>
            </form>
        </div>
    </div>
</div>