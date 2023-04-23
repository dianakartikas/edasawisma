<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <?php
    $uri = service('uri');
    ?>
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon ">
            <img src="<?= base_url(); ?>/img/pkk.png" alt="logo-pkk" height="50">
        </div>
        <div class="sidebar-brand-text mx-3">Dasawisma <span><small>batangtoru</small></span></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($uri->getSegment(1) == 'dashboard' ? 'active' : null) ?>">

        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Beranda</span></a>
    </li>

    <?php if (in_groups('superadmin')) : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Tambah
        </div>
        <li class="nav-item <?= ($uri->getSegment(1) == 'pengguna' ? 'active' : null) ?>">
            <a class="nav-link" href="/pengguna">
                <i class="fas fa-fw fa-user"></i>
                <span>Pengguna</span></a>
        </li>
    <?php endif; ?>
    <hr class="sidebar-divider my-0">
    <!-- Heading -->
    <div class="sidebar-heading">
        UTAMA
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($uri->getSegment(1) == 'kepala-keluarga' ||  $uri->getSegment(1) == 'desa-kelurahan' || $uri->getSegment(1) == 'anggota' || $uri->getSegment(1) == 'anggota-admin' || $uri->getSegment(1) == 'kepala-keluarga-admin' ? 'active' : null) ?>">
        <a class="nav-link" href="<?= base_url('main'); ?>" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Data Main</span>
        </a>
        <div id="collapseTwo" class="collapse <?= ($uri->getSegment(1) == 'kepala-keluarga' || $uri->getSegment(1) == 'desa-kelurahan' || $uri->getSegment(1) == 'anggota' || $uri->getSegment(1) == 'anggota-admin' || $uri->getSegment(1) == 'kepala-keluarga-admin' ? 'show' : null) ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">data-data Main:</h6>
                <?php if (in_groups('superadmin')) : ?>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'desa-kelurahan' ? 'active' : null) ?>" href="/desa-kelurahan">Desa / Kelurahan</a>

                    <a class="collapse-item <?= ($uri->getSegment(1) == 'kepala-keluarga' ? 'active' : null) ?>" href="/kepala-keluarga-admin">Kepala Rumah Tangga</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'anggota' ? 'active' : null) ?>" href="/anggota">Anggota</a>
                <?php endif; ?>
                <?php if (in_groups('admin')) : ?>

                    <a class="collapse-item <?= ($uri->getSegment(1) == 'kepala-keluarga-admin' ? 'active' : null) ?>" href="/kepala-keluarga-admin">Kepala Rumah Tangga</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'anggota-admin' ? 'active' : null) ?>" href="/anggota-admin">Anggota</a>
                <?php endif; ?>

            </div>
        </div>
    </li>


    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?= ($uri->getSegment(1) == 'kriteria-rumah' ||  $uri->getSegment(1) == 'sumber-air' ||  $uri->getSegment(1) == 'makanan-pokok' || $uri->getSegment(1) == 'kriteria-rumah-admin' || $uri->getSegment(1) == 'sumber-air-admin' || $uri->getSegment(1) == 'makanan-pokok-admin' ? 'active' : null) ?>">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Data Keadaan</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= ($uri->getSegment(1) == 'kriteria-rumah' ||  $uri->getSegment(1) == 'sumber-air' ||  $uri->getSegment(1) == 'makanan-pokok' || $uri->getSegment(1) == 'kriteria-rumah-admin' || $uri->getSegment(1) == 'sumber-air-admin' || $uri->getSegment(1) == 'makanan-pokok-admin' ? 'show' : null) ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">data-data keadaan:</h6>
                <?php if (in_groups('superadmin')) : ?>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'kriteria-rumah' ? 'active' : null) ?>" href="/kriteria-rumah">Rumah</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'sumber-air' ? 'active' : null) ?>" href="/sumber-air">Sumber Air</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'makanan-pokok' ? 'active' : null) ?>" href="/makanan-pokok">Makanan Pokok</a>
                <?php endif; ?>
                <?php if (in_groups('admin')) : ?>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'kriteria-rumah-admin' ? 'active' : null) ?>" href="/kriteria-rumah-admin">Rumah</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'sumber-air-admin' ? 'active' : null) ?>" href="/sumber-air-admin">Sumber Air</a>
                    <a class="collapse-item <?= ($uri->getSegment(1) == 'makanan-pokok-admin' ? 'active' : null) ?>" href="/makanan-pokok-admin">Makanan Pokok</a>
                <?php endif; ?>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        KEGIATAN
    </div>
    <!-- Heading -->

    <li class="nav-item <?= ($uri->getSegment(1) == 'kegiatan'  || $uri->getSegment(1) == 'kegiatan-admin' ? 'active' : null) ?>">
        <?php if (in_groups('superadmin')) : ?>
            <a class="nav-link" href="/kegiatan">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Kegiatan</span>
            </a>
        <?php endif; ?>
        <?php if (in_groups('admin')) : ?>
            <a class="nav-link" href="/kegiatan-admin">
                <i class="fas fa-fw fa-briefcase"></i>
                <span>Kegiatan</span>
            </a>
        <?php endif; ?>

    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        LAPORAN
    </div>
    <!-- Heading -->
    <li class="nav-item <?= ($uri->getSegment(1) == 'laporan' ? 'active' : null) ?>">
        <a class="nav-link" href="/laporan">
            <i class="fas fa-fw fa-file"></i>
            <span>Laporan</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        KELUAR
    </div>
    <!-- Heading -->
    <li class="nav-item <?= ($uri->getSegment(1) == 'logout' ? 'active' : null) ?>">
        <a class="nav-link" href="/logout">
            <i class="fas fa-fw fa-arrow-right"></i>
            <span>Keluar</span></a>
    </li>
    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>