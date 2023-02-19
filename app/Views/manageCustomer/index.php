<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Costumers Management</h2>
<div class="d-flex w-100 justify-content-end mb-2">
    <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-add-customer">
        Register Customers
    </button>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Username</th>
            <th scope="col">Name</th>
            <th scope="col">kWh number</th>
            <th scope="col">Address</th>
            <th scope="col">Class</th>
            <th scope="col">Class Code</th>
            <th scope="col">Power</th>
            <th scope="col">Rates / kWh</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if (isset($customers)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($customers as $customer) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $customer['username'] ?></td>
                    <td><?= $customer['name'] ?></td>
                    <td><?= $customer['kwh_number'] ?></td>
                    <td><?= $customer['address'] ?></td>
                    <td><?= $customer['class'] ?></td>
                    <td><?= $customer['class_code'] ?></td>
                    <td><?= $customer['power'] ?></td>
                    <td><?= "Rp " . number_format($customer['ratesperkwh'], 2, ',', '.') ?></td>
                    <td>
                        <button class="btn" data-bs-toggle="modal" data-bs-target="#edit-user-<?= $customer['id_customer'] ?>">
                            <img src="/images/edit-user.png" width="25px">
                        </button>
                        <div class="modal fade" id="edit-user-<?= $customer['id_customer'] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Customer</h5>
                                    </div>
                                    <form action="/manage-customer/<?= $customer['id_customer'] ?>" method="post">
                                        <input type="hidden" name="_method" value="put">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" placeholder="Enter Username" aria-label="Username" value="<?= $customer['username'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label">Name</label>
                                                    <input type="input" class="form-control" placeholder="Enter Name" name="name" required value="<?= $customer['name'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Rates</label>
                                                <select class="form-control" name="rates" required>
                                                    <option>--Select Rates--</option>
                                                    <?php foreach ($rates as $rate) : ?>
                                                        <option value="<?= $rate['id_rates'] ?>" <?= $rate['id_rates'] == $customer['id_rates'] ? "selected" : "" ?>><?= $rate['class'] ?> - <?= $rate['power'] ?> - <?= "Rp " . number_format($rate['ratesperkwh'], 2, ',', '.') ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label">kWh Number</label>
                                                    <input type="input" name="kwh_number" class="form-control" placeholder="Enter kWh Number" aria-label="nomor kWh" required value="<?= $customer['kwh_number'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label">Address</label>
                                                    <textarea class="form-control" placeholder="Address..." rows="3" name="address" required><?= $customer['address'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<div class="modal fade" id="modal-add-customer" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Customer</h5>
            </div>
            <form action="/manage-customer" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username" aria-label="Username" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" aria-label="password" required>
                    </div>
                    <div class="form-group">
                        <label>Rates</label>
                        <select class="form-control" id="username" name="rates" required>
                            <option value="">--Select Rates--</option>
                            <?php foreach ($rates as $rate) : ?>
                                <option value="<?= $rate['id_rates'] ?>"><?= $rate['class'] ?> - <?= $rate['power'] ?> - <?= "Rp " . number_format($rate['ratesperkwh'], 2, ',', '.') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label">Name</label>
                            <input type="input" class="form-control" placeholder="Enter Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label">kWh Number</label>
                            <input type="input" name="kwh_number" class="form-control" placeholder="Enter kWh Number" aria-label="nomor kWh" required>
                    </div>
                    <div class="form-group">
                        <label">Address</label>
                            <textarea class="form-control" placeholder="Address..." rows="3" name="address" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>