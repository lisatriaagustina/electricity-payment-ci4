<?= $this->extend('layout/auth') ?>

<?= $this->section('auth-content') ?>
<div class="d-flex flex-column mt-3 mb-2">
    <h5>Electicity Payment</h5>
    <span>Please Login</span>
</div>
<form action="/login" method="post">
    <div class="input-group mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" required>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" required>
    </div>

    <button class="btn btn-primary btn-block w-100" type="submit">Login</button>
    <span class="auth-span-info d-block mt-3">Dont have account ? <a href="/register">Register</a></span>
</form>

<?= $this->endSection() ?>