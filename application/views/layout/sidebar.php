<div class="az-sidebar">
    <div class="az-sidebar-header">
        <a href="<?= base_url() . ''; ?>" class="az-logo">
            <img src="<?= base_url() . 'assets/img/app/logo.svg'; ?>" width="60%">
        </a>
    </div>

    <div class="az-sidebar-loggedin d-flex align-items-center bg-light mx-3 rounded-10">
        <div class="az-img-user online">
            <i class="bx bxs-user-circle tx-40"></i>
        </div>
        <div class="media-body p-0">
            <p class="p-0 m-0 small">Helo,</p>
            <p class="font-weight-bold p-0 m-0"><?= getUserData()['name']; ?></p>
        </div>
    </div>

    <div class="az-sidebar-body">
        <ul class="nav">
            <li class="nav-label">Main Menu</li>
            <li class="nav-item <?= ($this->uri->segment(1) == 'dashboard' || $this->uri->segment(1) == '' ? 'active' : ''); ?>">
                <a href="<?= base_url() . ''; ?>" class="nav-link">
                    <i class="fa fa-home"></i>
                    Dashboard
                </a>
            </li>
            <?php if (isFrontdesk()) : ?>
                <li class="nav-item <?= ($this->uri->segment(1) == 'motor' ? 'active' : ''); ?>">
                    <a href="<?= base_url() . 'motor'; ?>" class="nav-link">
                        <i class="fa fa-motorcycle"></i>
                        Motor
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'service' ? 'active' : ''); ?>">
                    <a href="<?= base_url() . 'service'; ?>" class="nav-link">
                        <i class="fa fa-wrench"></i>
                        Jasa Servis
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'transaksi'  ? 'active show' : ''); ?>">
                    <a href="" class="nav-link with-sub">
                        <i class="fa fa-money-bill-transfer"></i>
                        Transaksi
                    </a>
                    <nav class="nav-sub">
                        <a href="<?= base_url() . 'transaksi'; ?>" class="nav-sub-link <?= ($this->uri->segment(1) == 'transaksi' ? 'active' : ''); ?>">
                            <i class="bx bx-list-ul mr-2"></i> List Data
                        </a>
                        <a href="<?= base_url() . 'transaksi/add'; ?>" class="nav-sub-link <?= ($this->uri->segment(1) == 'transaksi' && $this->uri->segment(2) == 'add' ? 'active' : ''); ?>">
                            <i class="bx bx-plus mr-2"></i> Services
                        </a>
                        <a href="<?= base_url() . 'transaksi/add-sparepart'; ?>" class="nav-sub-link <?= ($this->uri->segment(1) == 'transaksi' && $this->uri->segment(2) == 'add-sparepart' ? 'active' : ''); ?>">
                            <i class="bx bx-plus mr-2"></i> Spareparts
                        </a>
                    </nav>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'penjualan' ? 'active' : ''); ?>">
                    <a href="<?= base_url() . 'penjualan'; ?>" class="nav-link">
                        <i class="fa fa-coins"></i>
                        Penjualan
                    </a>
                </li>

            <?php endif; ?>
            <?php if (isPartman()) : ?>
                <li class="nav-item <?= ($this->uri->segment(1) == 'spart-cat' || $this->uri->segment(1) == 'spart-prod' ? 'active' : ''); ?>">
                    <a href="" class="nav-link with-sub">
                        <i class="fa fa-cogs"></i>
                        Spareparts
                    </a>
                    <nav class="nav-sub">
                        <a href="<?= base_url() . 'spart-cat'; ?>" class="nav-sub-link <?= ($this->uri->segment(1) == 'spart-cat' ? 'active' : ''); ?>">Category</a>
                        <a href="<?= base_url() . 'spart-prod'; ?>" class="nav-sub-link <?= ($this->uri->segment(1) == 'spart-prod' ? 'active' : ''); ?>">Products</a>
                    </nav>
                </li>
            <?php endif; ?>
            <?php if (isSuperAdmin()) : ?>
                <li class="nav-label mt-5">Karyawan</li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'montir' ? 'active' : ''); ?>">
                    <a href="<?= base_url() . 'montir'; ?>" class="nav-link">
                        <i class="fa fa-user-cog"></i>
                        Montir
                    </a>
                </li>
                <li class="nav-item <?= ($this->uri->segment(1) == 'user' ? 'active' : ''); ?>">
                    <a href="<?= base_url() . 'user'; ?>" class="nav-link">
                        <i class="fa fa-users"></i>
                        User
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>