<div class="container ml-4 mb-5">
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-4">Edit Profile</h1>

            <!-- JIKA YANG LOGIN SEBAGAI PEGAWAI (ID = 3) -->

            <?php if ($user['id_level'] == 3) : ?>
            <form action="<?= base_url('pegawai/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>NIP</label>
                    <input readonly type="text" class="form-control" name="nip" value="<?= $user['nip']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control <?= is_invalid('nama'); ?>" name="nama" id="nama" value="<?= $user['nama_pegawai']; ?>">
                    <?= form_error('nama', '<small class="ml-2 text-danger">', '</small>'); ?>
                </div>

                <!-- JIKA SEBAGAI ADMIN (1) -->

                <?php else : ?>

                <form action="<?= base_url('admin/edit_profile'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>ID Admin</label>
                        <input readonly type="text" class="form-control" name="id_admin" value="<?= $user['id_admin']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control <?= is_invalid('nama'); ?>" name="nama" id="nama" value="<?= $user['nama_admin']; ?>">
                        <?= form_error('nama', '<small class="ml-2 text-danger">', '</small>'); ?>
                    </div>
                <?php endif; ?>
                    
                    <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control <?= is_invalid('alamat'); ?>" name="alamat" id="alamat" value="<?= $user['alamat']; ?>">
                            <?= form_error('alamat', '<small class="ml-2 text-danger">', '</small>'); ?>
                        </div>
                        
                        <div class="form-group">
                            <div class="custom-file my-2">
                                <input type="file" class="custom-file-input input-gambar-pegawai" name="gambar" id="customFile" style="cursor: pointer !important;">
                                <label class="custom-file-label" for="customFile">Pilih gambar...</label>
                                <?= $this->session->flashdata('message'); ?>
                            </div>
                        </div>

                    <button class="btn btn-success" type="submit">Edit Profile</button>
                </form>
        </div>
    </div>
</div>