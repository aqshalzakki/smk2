
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- breadcrum Barang -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="<?= base_url($nama_level); ?>"> Home </a>
            <span>/</span>
            <a href="<?= base_url($nama_level . '/peminjaman'); ?>">
                <span> Peminjaman Barang </span>
            </a>
        </li>
    </ol>

    <!-- Content -->

    <h1>
        <?php if($nama_level != 'admin') : ?>
            Pinjam Barang
        <?php else : ?>
            Data Peminjam
        <?php endif; ?>
    </h1>

    <div class="row mt-4">

            <!-- Jika levelnya SELAIN ADMIN maka form ini AKAN ditampilkan  -->
            <?php if($nama_level != 'admin') : ?>
                <div class="col-md-7">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="kode-barang">Kode Barang</label>
                            <input type="text" class="form-control" id="kode-barang" name="kode-barang" value="<?= set_value('kode-barang'); ?>">
                            <?= form_error('kode-barang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="jumlah-barang">Jumlah Barang</label>
                            <input type="text" class="form-control" id="jumlah-barang" name="jumlah-barang" value="<?= set_value('jumlah-barang'); ?>">
                            <?= form_error('jumlah-barang', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <button class="btn btn-success" name="submit" type="submit">Pinjam</button>
                    </form>

                    <p class="mt-4"><span class="text-success">*</span> Untuk Kode Barang silahkan Anda lihat dihalaman Inventaris</p>
                </div>

                <?php else : ?>

                    <!-- Jika levelnya ADMIN maka tabel ini AKAN ditampilkan -->
                    <div class="col-md-6">
                            <?php if($peminjam) : ?>
                                <?= $this->session->flashdata('message'); ?>
                                <div class="card list-peminjam" style="width: 18rem;">
                                    <ul class="list-group list-group-flush">

                                        <?php foreach($peminjam as $p) : ?>
                                            
                                            <?php $nama = $this->db->get_where('pegawai', ['id_pegawai' => $p['id_pegawai']])->row_array()['nama_pegawai'];?> 

                                            <li class="list-group-item" data-id="<?= $p['id_peminjaman']; ?>" data-nama="<?= $nama; ?>" data-toggle="modal" data-target="#modalDetailPeminjam"><?= $nama; ?></li>
                                        
                                        <?php endforeach; ?>

                                    </ul>
                                </div>
                            <?php else : ?>

                                <h5><i>Tidak ada peminjam</i></h5>

                            <?php endif; ?>
                    </div>

            <?php endif; ?>

        
    </div>


</div>
<!-- /.container-fluid -->

    <!-- Modal Detail Peminjam -->
    <div class="modal fade modalDetailPeminjam" id="detailPeminjam" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</div>
<!-- End of Main Content -->