<?= $this->extend('layout/main') ?>

<?= $this->section('main-content') ?>
<div class="dashboard-layout">
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex justify-content-center align-items-center" href="/">
                <img src="/images/find-logo.png" alt="logo" class="d-inline-block align-text-top logo-dashboard">
                <span>Find and Found</span>
            </a>
            <div class="d-flex">
                <a class="nav-link link-navigate active" href="/">Home</a>
                <a class="nav-link link-navigate" href="">Find Stuff</a>
                <a class="nav-link link-navigate" href="">Maps</a>
                <a class="nav-link link-navigate" href="" tabindex="-1" aria-disabled="true">Profile</a>
                <?php if (!session()->get('IS_LOGIN')) : ?>
                    <a href="/login" class="btn btn-outline-primary btn-nav">Login</a>
                <?php else : ?>
                    <form action="/logout" method="post">
                        <button type="submit" class="btn btn-outline-danger btn-nav">Logout</button>
                    </form>
                <?php endif ?>
            </div>
        </div>
    </nav>
    <?= $this->renderSection('dashboard-content') ?>
</div>
<?= $this->endSection() ?>