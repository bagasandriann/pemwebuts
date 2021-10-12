<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="sidebar-brand-text mx-3">BeritaKu<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        User
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('User'); ?>">
            <i class="fa-solid fa-fw fa-user"></i>
            <span>My Profile</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fa-solid fa-fw fa-book-open"></i>
            <span>Category</span>
        </a>
        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header"></h6>
                <a class="collapse-item" href=<?= base_url('berita/olahraga') ?>>Olahraga</a>
                <a class=" collapse-item" href=<?= base_url('berita/bisnis') ?>>Bisnis</a>
                <a class="collapse-item" href=<?= base_url('berita/kesehatan') ?>>Kesehatan</a>
                <div class="collapse-divider"></div>

            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->