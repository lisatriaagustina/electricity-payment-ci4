<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<section class="auth-container">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5 card-auth">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <img src="/images/energy.png" alt="logo" width="100px">
                        <?php if (session()->getFlashdata('err-auth')) : ?>
                            <div class="alert alert-danger mt-3 text-left">
                                <?= session()->getFlashdata('err-auth') ?>
                            </div>
                        <?php endif; ?>
                        <?= $this->renderSection('auth-content') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>