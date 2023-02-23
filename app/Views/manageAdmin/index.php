<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Admin Management</h2>
<div class="d-flex w-100 justify-content-end mb-2">
    <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-add-admin">
        Register Admin
    </button>
</div>
<?php if (session()->getFlashdata('err-add-admin')) : ?>
    <div class="alert alert-danger mt-3 text-left">
        <?= session()->getFlashdata('err-add-admin') ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('msg-add-admin')) : ?>
    <div class="alert alert-success mt-3 text-left">
        <?= session()->getFlashdata('msg-add-admin') ?>
    </div>
<?php endif; ?>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Role</th>
            <!-- <th scope="col">Action</th> -->
        </tr>
    </thead>
    <tbody>
        <?php if (isset($listAdmin)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($listAdmin as $admin) : ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $admin['name'] ?></td>
                    <td><?= $admin['username'] ?></td>
                    <td><?= $admin['role_name'] ?></td>
                    <!-- <td>...</td> -->
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
    </tbody>
</table>
<div class="modal fade" id="modal-add-admin" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Admin</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> -->
            </div>
            <form action="/manage-admin" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="input" class="form-control" id="name" placeholder="Enter Name" name="name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="input" class="form-control" id="username" placeholder="Enter Username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <!-- <div class="form-group">
                        <label for="role">Role</label>
                        <select type="input" class="form-control" id="username" placeholder="Enter Username" name="role">
                            <option value="">--Select Role--</option>
                            <option value="1">Administrator</option>
                            <option value="2">Bank Admin</option>
                        </select>
                    </div> -->
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