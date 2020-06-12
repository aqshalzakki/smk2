
<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; SMKN2 Bandung 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Keluar</a>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>


<!-- Tambah Data Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1"  aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="titleModal">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-2">
        <form action="<?= base_url('admin/tambahData'); ?>" method="post">
            <input type="hidden" name="id" id="id" value="">
            <div class="form-group">
              <label for="Kode">Kode Inventaris</label>
              <input type="text" class="form-control" id="kodeinventaris" name="kodeInventaris" placeholder="10000xx">
            </div>
            <div class="form-group">
              <label for="Nama">Nama Barang</label>
              <input type="text" class="form-control" id="namabarang" name="namaBarang">
            </div>
            <div class="form-group">
              <label for="Jumlah">Jumlah</label>
              <input type="text" class="form-control" id="jumlah" name="jumlah">
            </div>
            <div class="form-group">
              <label for="Kondisi">Kondisi</label>
              <input type="text" class="form-control" id="kondisi" name="kondisi">
            </div>
            <div class="form-group">
              <label for="jenis">Jenis Barang</label>
              <select class="form-control" id="jenis" name="jenis">
                <option disabled selected>Elektronik</option>
                  <option>1</option>
                <option disabled selected>Peralatan Olahraga</option>
                  <option>2</option>
                <option disabled selected>Alat Tulis</option>
                  <option>3</option>
                <option  disabled selected>Properti Kelas</option>
                  <option>4</option>
              </select>
            </div>
            <div class="form-group">
              <label for="nama">Keterangan</label>
              <textarea class="form-control" id="keterangan" rows="2" name="keterangan"></textarea>
            </div>
        
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambah</button>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
        </div>
          </form>
      </div>
    </div>
  </div>

  <!-- Modal hapus data -->
  <div class="modal fade" id="hapusModal" tabindex="-1"  aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title" id="titleModal">Hapus Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?= base_url('admin/hapus_barang'); ?>" method="post">
          <div class="modal-body mx-2">
            <h6 class="text-center">Anda yakin ingin menghapus data ini?<h6>
            <input type="hidden" name="kode_inventaris">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Hapus</button>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Detail Peminjam -->
  <div class="modal fade" id="modalDetailPeminjam" tabindex="-1"  aria-labelledby="myModalLabel"
  aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header text-center">
          <h4 class="modal-title" id="titleModal">Detail Peminjam</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('vendor/vendor/'); ?>jquery/jquery.min.js"></script>
  <script src="<?= base_url('vendor/vendor/'); ?>bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('vendor/vendor/'); ?>jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('vendor/'); ?>js/sb-admin-2.min.js"></script>
  
  <!-- JS dataTables -->
  <script type="text/javascript" charset="utf8" src="<?= base_url('vendor/vendor/'); ?>/dataTables/datatables.js"></script>

  <!-- Custom Script -->
  <script type="text/javascript" src="<?= base_url('vendor/js/script.js'); ?>"></script>
  
</body>

</html>
