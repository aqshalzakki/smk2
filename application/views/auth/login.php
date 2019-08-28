<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: 100px;">

        <div class="col-lg-7">

            <div class="card o-hidden border-0 shadow-lg" style="padding: 40px; box-sizing: border-box;">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                              <div class="text-center">
                                  <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                              </div>

                              <?= $this->session->flashdata('message'); ?>

                              <form class="user" method="post" action="">
                                  <div class="form-group">
                                      <input type="text" class="form-control form-control-user <?= is_invalid('username'); ?>" id="username" name="username" placeholder="Masukkan Username" value="<?= set_value('username'); ?>">
                                      <?= form_error('username', '<small class="text-danger ml-3">', '</small>'); ?>
                                  </div>
                                  <div class="form-group">
                                      <input type="password" class="form-control form-control-user <?= is_invalid('password'); ?>" id="password" name="password" placeholder="Password">
                                      <?= form_error('password', '<small class="text-danger ml-3">', '</small>'); ?>
                                  </div>
                                  <button type="submit" class="btn btn-dark btn-user btn-block mt-5">
                                      Login
                                  </button>
                              </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
