<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 text-sm position-fixed" style="background-color: #006a4e;" id="sticky-sidebar">
    <!-- Brand Logo -->
    <a href="<?=base_url()?>" class="brand-link" style="background-color: #006a4e;">
      <img src="<?=base_url()?>assets/img/brandaudit.png" alt="<?=base_name()?>" class="brand-image" style="opacity: .8; widht:45px; height:45px;">
      <span class="brand-text" style="color:white;"><?=base_name()?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=base_url()?>assets/img/m3avataaars.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$this->userdata->data->result->nama_user?></a>
          <a href="#" class="d-block"><?=ucwords($this->userdata->data->result->role)?></a>
        </div>
      </div> -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?=base_url()?>" class="nav-link <?=(@$active == "home")?'active':''?>">
            <img src="<?=base_url()?>assets/img/beranda.png">
              <p style="color: white;">
                Beranda
              </p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?=base_url()?>admin/scan" class="nav-link <?=(@$active == "scan")?'active':''?>">
            <img src="<?=base_url()?>assets/img/scan.png">
              <p style="color: white;">
                Scan Produk
              </p>
            </a>
          </li> -->
          <li class="nav-item">
            <a href="<?=base_url()?>admin/lokasi" class="nav-link <?=(@$active == "lokasi")?'active':''?>">
            <img src="<?=base_url()?>assets/img/lokasi.png">
              <p style="color: white;">
                  Lokasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/produk" class="nav-link <?=(@$active == "produk")?'active':''?>">
            <img src="<?=base_url()?>assets/img/produk.png">
              <p style="color: white;">
                Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/relawan" class="nav-link <?=(@$active == "relawan")?'active':''?>">
            <img src="<?=base_url()?>assets/img/relawan.png">
              <p style="color: white;">
                Relawan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/jenis_produk" class="nav-link <?=(@$active == "jenis produk")?'active':''?>">
            <img src="<?=base_url()?>assets/img/jenis_produk.png">
              <p style="color: white;">
                Jenis Produk
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/instansi" class="nav-link <?=(@$active == "instansi")?'active':''?>">
            <img src="<?=base_url()?>assets/img/instansi.png">
              <p style="color: white;">
                Instansi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/pengguna" class="nav-link <?=(@$active == "pengguna")?'active':''?>">
            <img src="<?=base_url()?>assets/img/user.png">
              <p style="color: white;">
                Pengguna
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/pengumpulan_sampah" class="nav-link <?=(@$active == "pengumpulan sampah")?'active':'background-color: #FFDF00'?>">
            <img src="<?=base_url()?>assets/img/data.png">
              <p style="color: white;">
                Data Pengumpulan Sampah
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=base_url()?>admin/grafik" class="nav-link <?=(@$active == "grafik")?'active':''?>">
            <img src="<?=base_url()?>assets/img/grafik.png">
              <p style="color: white;">
                Grafik
              </p>
            </a>
          </li>   
        <br>

          <li class="nav-item">
            <a href="<?=base_url()?>auth/signout" class="nav-link">
            <img src="<?=base_url()?>assets/img/logout.png">
              <p style="color: white;">
                Keluar
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>