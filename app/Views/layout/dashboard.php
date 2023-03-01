<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar" class="nav-dashboard">
        <div class="custom-menu">
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <i class="fa fa-bars"></i>
                <span class="sr-only">Toggle Menu</span>
            </button>
        </div>
        <div class="p-4 d-flex justify-content-between flex-column h-100">
            <div class="">
                <h1><a href="index.html" class="logo">EL-Payment <span>Electicity Payment</span></a></h1>
                <ul class="list-unstyled components mb-5">

                    <!-- menu admin -->
                    <?php if (session()->get('role') == 'admin') : ?>
                        <li class="<?= session()->get('menu-active') == 'dashboard' ? 'active' : '' ?>">
                            <a href="/"><span class="fa fa-dashboard mr-3 <?= session()->get('menu-active') == 'dashboard' ? 'text-white' : '' ?>"></span>Dashboard</a>
                        </li>
                        <li class="<?= session()->get('menu-active') == 'manage-admin' ? 'active' : '' ?>">
                            <a href="/manage-admin"><span class="fa fa-cogs mr-3 <?= session()->get('menu-active') == 'manage-admin' ? 'text-white' : '' ?>"></span>Manage Admin</a>
                        </li>
                        <li class="<?= session()->get('menu-active') == 'manage-customer' ? 'active' : '' ?>">
                            <a href="/manage-customer"><span class="fa fa-users mr-3 <?= session()->get('menu-active') == 'manage-customer' ? 'text-white' : '' ?>"></span>Manage Customer</a>
                        </li>
                        <li class="<?= session()->get('menu-active') == 'verification-and-validation' ? 'active' : '' ?>">
                            <a href="/verification-and-validation"><span class="fa fa-check-circle-o mr-3 <?= session()->get('menu-active') == 'verification-and-validation' ? 'text-white' : '' ?>"></span>Verification & Validation</a>
                        </li>
                        <li class="<?= session()->get('menu-active') == 'generate-report' ? 'active' : '' ?>">
                            <a href="/generate-report"><span class="fa fa-file-pdf-o mr-3 <?= session()->get('menu-active') == 'generate-report' ? 'text-white' : '' ?>"></span>Generate Report</a>
                        </li>
                    <?php endif; ?>

                    <!-- menu bank -->
                    <?php if (!session()->get('role') == 'bank') : ?>
                        <li class="">
                            <a href="#"><span class="fa fa-dashboard mr-3"></span>Dashboard</a>
                        </li>
                        <!-- <li>
                            <a href="/manage-admin"><span class="fa fa-cogs mr-3"></span>Manage Admin</a>
                        </li> -->
                        <li>
                            <a href="/verification-and-validation"><span class="fa fa-check-circle-o mr-3"></span>Verification & Validation</a>
                        </li>
                        <li>
                            <a href="/generate-report"><span class="fa fa-file-pdf-o mr-3"></span>Generate Report</a>
                        </li>
                    <?php endif; ?>

                    <!-- menu customer -->
                    <?php if (session()->get('role') == 'customer') : ?>
                        <li class="<?= session()->get('menu-active') == 'dashboard' ? 'active' : '' ?>">
                            <a href="/"><span class="fa fa-dashboard mr-3 <?= session()->get('menu-active') == 'dashboard' ? 'text-white' : '' ?>"></span>Dashboard</a>
                        </li>
                        <li class="<?= session()->get('menu-active') == 'pay-electricity' ? 'active' : '' ?>">
                            <a href="/pay-electricity"><span class="fa fa-money mr-3 <?= session()->get('menu-active') == 'pay-electricity' ? 'text-white' : '' ?>"></span>Pay Electricity</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="footer">
                <div class="text-center">
                    <p>Login sebagai <?= session()->get('name') ?> | <?= session()->get('role') ?></p>
                </div>
                <form action="/logout" method="post" class="mb-3">
                    <button class="btn btn-danger w-100"><span class="fa fa-power-off"></span> Logout</button>
                </form>
                <div class="text-center">
                    <p>Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script><br>Made with <i class="fa fa-heart mr-1 ml-1"></i> by Lisa Agustina
                    </p>
                </div>
            </div>

        </div>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="p-4 p-md-5 pt-5">
        <?= $this->renderSection('dashboard-content') ?>
    </div>
</div>
<?= $this->endSection() ?>