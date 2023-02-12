<?= $this->extend('layout/auth') ?>

<?= $this->section('auth-content') ?>

<div class="d-flex flex-column mt-3 mb-2">
    <h5>Electicity Payment</h5>
    <span>Register new account</span>
</div>
<form action="">
    <div class="input-group mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" required>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" required>
    </div>

    <div class="input-group mb-3">
        <input type="input" name="nomor kWh" class="form-control" placeholder="nomor kWh" aria-label="nomor kWh" required>
    </div>

    <div class="input-group mb-3">
        <input type="input" name="Nama" class="form-control" placeholder="Nama" aria-label="Nama" required>
    </div>

    <div class="input-group mb-3">
        <textarea class="form-control" placeholder="Alamat..." rows="3" required></textarea>
    </div>

    <button class="btn btn-primary btn-block w-100" type="submit">Register</button>
    <span class="auth-span-info d-block mt-3">Already have account ? <a href="/login">Login</a></span>
</form>

<?= $this->endSection() ?>