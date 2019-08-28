<div class="container" style="margin-top: 60px;">
    <div class="row">
        <div class="col-md-12">

        <?= $this->session->flashdata('message'); ?>

            <div class="card my-4">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="<?= base_url('vendor/img/' . $user['gambar']); ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $user['nama_pegawai']; ?></h5>
                        <p class="card-text">NIP : <?= $user['nip']; ?></p>
                        <p class="card-text">Alamat : <?= $user['alamat']; ?></p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>