<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Verification & Validation</h2>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">kWh number</th>
            <th scope="col">Address</th>
            <th scope="col">Month</th>
            <th scope="col">Year</th>
            <th scope="col">Meter</th>
            <th scope="col">Bill</th>
            <th scope="col">Status</th>
            <th scope="col">#</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($bills)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($bills as $bill) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $bill['name'] ?></td>
                    <td><?= $bill['kwh_number'] ?></td>
                    <td><?= $bill['address'] ?></td>
                    <td><?= $bill['month'] ?></td>
                    <td><?= $bill['year'] ?></td>
                    <td><?= $bill['final_meter'] - $bill['initial_meter'] ?></td>
                    <td><?= "Rp " . number_format(($bill['ratesperkwh'] * ($bill['final_meter'] - $bill['initial_meter']) + $admin_fee), 2, ',', '.') ?></td>
                    <td><?= $bill['status'] ?></td>
                    <td>
                        <a href="/verification-and-validation/<?= $bill['id_bill'] ?>" class="btn btn-primary" style="color:white;">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<?= $this->endSection(); ?>