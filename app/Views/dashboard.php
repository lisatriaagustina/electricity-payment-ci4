<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<!-- Dashboard Admin -->
<?php if (session()->get('role') == 'admin') : ?>
    <h2 class="mb-4">Dashboard Admin</h2>
    <div class="row d-flex justify-content-between">
        <div class="col text-right">
            <button class="btn btn-primary mb-3">Generate Penggunaan Untuk Semua User</button>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah User</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <img src="/images/user.png" alt="gambar" width="80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Jumlah Admin</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                        </div>
                        <div class="col-auto">
                            <img src="/images/admin.png" alt="gambar" width="80">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Dashboard Customer -->
<?php if (session()->get('role') == 'customer') : ?>
    <h2 class="mb-4">Dashboard Customer</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
<?php endif; ?>
<?= $this->endSection(); ?>