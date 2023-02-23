<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Pay Electricity</h2>
<div class="row">
    <?php if (isset($detail_bill)) : ?>
        <?php if (session()->getFlashdata('msg-pay')) : ?>
            <div class="col-12">
                <div class="alert alert-success mt-3 text-left">
                    <?= session()->getFlashdata('msg-pay') ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usage & Bill details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3 font-weight-bold">Username</div>
                        <div class="col">: <?= $detail_bill['username'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Name</div>
                        <div class="col">: <?= $detail_bill['name'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Address</div>
                        <div class="col">: <?= $detail_bill['address'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">kWh number</div>
                        <div class="col">: <?= $detail_bill['kwh_number'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">RatesPerkWh</div>
                        <div class="col">: <?= $detail_bill['ratesperkwh'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Initital Meter</div>
                        <div class="col">: <?= $detail_bill['initial_meter'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Final Meter</div>
                        <div class="col">: <?= $detail_bill['final_meter'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Meter Result</div>
                        <div class="col">: <?= $detail_bill['final_meter'] - $detail_bill['initial_meter'] ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Admin Fee</div>
                        <div class="col">: <?= "Rp " . number_format($admin_fee, 2, ',', '.') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Total Bill</div>
                        <div class="col">: <?= "Rp " . number_format(($detail_bill['ratesperkwh'] * ($detail_bill['final_meter'] - $detail_bill['initial_meter'])) + $admin_fee, 2, ',', '.') ?></div>
                    </div>
                    <div class="row">
                        <div class="col-3 font-weight-bold">Status</div>
                        <div class="col">: <?= $detail_bill['status'] ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment details</h6>
                </div>
                <div class="card-body">
                    <!-- SUCCESS / PROCESS -->
                    <?php if ($detail_bill['status'] == 'success' || $detail_bill['status'] == 'process') : ?>
                        <div class="row">
                            <div class="col-5 font-weight-bold">Payment time</div>
                            <div class="col">: <?= $detail_payment['pay_date'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5 font-weight-bold">Bank</div>
                            <div class="col">: <?= $detail_payment['bank_name'] ?> - <?= $detail_payment['bank_acc_number'] ?> - <?= $detail_payment['bank_user'] ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5 font-weight-bold">Total payment</div>
                            <div class="col">: <?= "Rp " . number_format($detail_payment['total_pay'], 2, ',', '.') ?></div>
                        </div>
                        <div class="row">
                            <div class="col-5 font-weight-bold">Proof of payment</div>
                            <div class="col-7">: </div>
                            <div class="col">
                                <img data-bs-toggle="modal" data-bs-target="#modalImage" src="<?= $detail_payment['picture'] ?>" alt="payment" style="width: 35%; cursor: pointer">
                            </div>
                            <div class="modal fade" id="modalImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Proof of payment</h5>
                                        </div>
                                        <div class="modal-body">
                                            <img src="<?= $detail_payment['picture'] ?>" alt="payment" style="width: 100%">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <!-- PENDING -->
                    <?php if ($detail_bill['status'] == 'pending') : ?>
                        <form action="/pay-electricity" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?= $detail_bill['id_bill'] ?>" name="id_bill">
                            <div class="row mb-2">
                                <div class="col-4 font-weight-bold">Bank</div>
                                <div class="col">
                                    <select class="form-select" name="bank" id="bank" required>
                                        <option selected>-- Select bank --</option>
                                        <?php foreach ($banks as $bank) : ?>
                                            <option value="<?= $bank['id_bank'] ?>"><?= $bank['bank_name'] ?> - <?= $bank['bank_acc_number'] ?> - <?= $bank['bank_user'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                            <div class="col-4 font-weight-bold">Bank Account Number</div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <span id="bank-detail">-</span>
                                </div>
                            </div>
                        </div> -->
                            <div class="row">
                                <div class="col-4 font-weight-bold">Total pay</div>
                                <div class="col">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="totalPay" placeholder="Total Pay" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5 font-weight-bold">Proof of payment</div>
                                <div class="col-7">: </div>
                                <div class="col">
                                    <input type="file" name="payPhoto" required />
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary w-25 ml-2" type="submit">Pay</button>
                            </div>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php else : ?>
        <h2>No Bill for now</h2>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>