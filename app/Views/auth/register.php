<?= $this->extend('layout/auth') ?>

<?= $this->section('auth-content') ?>

<div class="d-flex flex-column mt-3 mb-2">
    <h5>Electicity Payment</h5>
    <span>Register new account</span>
</div>
<form action="/register" method="post">
    <div class="input-group mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" required>
    </div>

    <div class="input-group mb-3">
        <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" required>
    </div>

    <div class="input-group mb-3">
        <select class="form-control" name="rates" required>
            <option value="">--Select Rates--</option>
            <?php foreach ($rates as $rate) : ?>
                <option value="<?= $rate['id_rates'] ?>"><?= $rate['class'] ?> - <?= $rate['power'] ?> - <?= "Rp " . number_format($rate['ratesperkwh'],2,',','.') ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="input-group mb-3">
        <input type="input" name="kwh_number" class="form-control" placeholder="nomor kWh" aria-label="nomor kWh" required>
    </div>

    <div class="input-group mb-3">
        <input type="input" name="name" class="form-control" placeholder="Name" aria-label="Nama" required>
    </div>

    <div class="input-group mb-3">
        <textarea class="form-control" placeholder="Address..." rows="3" name="address" required></textarea>
    </div>

    <button class="btn btn-primary btn-block w-100" type="submit">Register</button>
    <span class="auth-span-info d-block mt-3">Already have account ? <a href="/login">Login</a></span>
</form>

<?= $this->endSection() ?>