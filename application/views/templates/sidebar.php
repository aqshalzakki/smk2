<!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-dark sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-fw fa-school"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SMKN 2 BDG</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Home -->

      <?php 

        $id_level = $this->session->userdata('user')['id_level'];

        $queryMenu = "
          SELECT `user_menu`.`title`, `user_menu`.`id`
          FROM `user_menu`
          JOIN `user_access_menu`
          ON `user_menu`.`id` = `user_access_menu`.`id_menu`
          WHERE `user_access_menu`.`id_level` = $id_level
        "; 
        $menu = $this->db->query($queryMenu)->result_array();

      ?>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <?php foreach($menu as $m) : ?>

        <!-- Heading -->
        <div class="sidebar-heading">
          <?= $m['title']; ?>
        </div>
        
        <?php $submenu = $this->db->get_where('user_submenu', ['id_menu' => $m['id']])->result_array(); ?>
          <?php foreach ($submenu as $sm) : ?>

            <?php if($judul == $sm['submenu']) : ?>
              <!-- Nav Item - Petugas -->
              <li class="nav-item active">
                <a class="nav-link" href="<?= base_url(strtolower($this->session->userdata('user')['nama_level']) . $sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <span><?= $sm['submenu']; ?></span></a>
              </li>
            <?php else : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?= base_url(strtolower($this->session->userdata('user')['nama_level']) . $sm['url']); ?>">
                  <i class="<?= $sm['icon']; ?>"></i>
                  <span><?= $sm['submenu']; ?></span></a>
              </li>
            <?php endif; ?>

          <?php endforeach; ?>
            
            <!-- Divider -->
            <hr class="sidebar-divider">
      
      <?php endforeach; ?>



      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->
