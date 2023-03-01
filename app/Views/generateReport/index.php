<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Generate Report</h2>
<div class="d-flex w-100 justify-content-end mb-2">
    <form action="/generate-report" method="post">
        <button type="submit" class="btn btn-primary text-white" <?= count($data_report) > 0 ? '' : 'disabled' ?>>
            Generate Report Pdf
        </button>
    </form>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Customer name</th>
            <th scope="col">kWh number</th>
            <th scope="col">Total meter</th>
            <th scope="col">Ratesperkwh</th>
            <th scope="col">Admin fee</th>
            <th scope="col">Total bill</th>
            <th scope="col">Bank payment</th>
            <th scope="col">Pay date</th>
            <th scope="col">Total pay</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($data_report)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($data_report as $data) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $data['name'] ?></td>
                    <td><?= $data['kwh_number'] ?></td>
                    <td><?= $data['final_meter'] - $data['initial_meter'] ?></td>
                    <td><?= "Rp " . number_format($data['ratesperkwh'], 2, ',', '.') ?></td>
                    <td><?= $admin_fee ?></td>
                    <td><?= "Rp " . number_format(($data['ratesperkwh'] * ($data['final_meter'] - $data['initial_meter'])) + $admin_fee, 2, ',', '.') ?></td>
                    <td><?= $data['bank_name'] ?></td>
                    <td><?= $data['pay_date'] ?></td>
                    <td><?= "Rp " . number_format($data['total_pay'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<?= $this->endSection(); ?>