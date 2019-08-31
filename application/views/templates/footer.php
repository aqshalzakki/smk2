
<!-- Footer -->
<footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
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
  <div>
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
            <button class="btn btn-secondary" type="button" data-dismiss="modal">batal</button>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- Tambah Data Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-2">
        <form action="" method="post">
          <div class="form-group">
            <label for="nama">Kode Inventaris</label>
            <input type="text" class="form-control" id="kodeInventaris" name="kode_inventaris">
          </div>
          <div class="form-group">
            <label for="nama">Nama Barang</label>
            <input type="text" class="form-control" id="namaBarang" name="nama">
          </div>
          <div class="form-group">
            <label for="nama">Jumlah</label>
            <input type="text" class="form-control" id="jumlah" name="jumlah">
          </div>
          <div class="form-group">
            <label for="nama">Kondisi</label>
            <input type="text" class="form-control" id="kondisi" name="kondisi">
          </div>
          <div class="form-group">
            <label for="nama">Keterangan</label>
            <textarea class="form-control" id="keterangan" rows="2`"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Tambah</button>
        <button class="btn btn-secondary" type="button" data-dismiss="modal">batal</button>
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
