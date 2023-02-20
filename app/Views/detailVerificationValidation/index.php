<?= $this->extend('layout/dashboard') ?>

<?= $this->section('dashboard-content') ?>
<h2 class="mb-4">Details</h2>
<div class="row">
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
                    <div class="col-3 font-weight-bold">Total Bill</div>
                    <div class="col">: <?= "Rp " . number_format($detail_bill['ratesperkwh'] * ($detail_bill['final_meter'] - $detail_bill['initial_meter']), 2, ',', '.') ?></div>
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
                <div class="row">
                    <div class="col-5 font-weight-bold">Payment time</div>
                    <div class="col">: 10-10-2023</div>
                </div>
                <div class="row">
                    <div class="col-5 font-weight-bold">Total payment</div>
                    <div class="col">: <?= "Rp " . number_format($detail_bill['ratesperkwh'] * ($detail_bill['final_meter'] - $detail_bill['initial_meter']), 2, ',', '.') ?></div>
                </div>
                <div class="row">
                    <div class="col-5 font-weight-bold">Proof of payment</div>
                    <div class="col-7">: </div>
                    <div class="col">
                        <img data-bs-toggle="modal" data-bs-target="#modalImage" src="/images/tf-example.png" alt="payment" style="width: 35%; cursor: pointer">
                    </div>
                    <div class="modal fade" id="modalImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Proof of payment</h5>
                                </div>
                                <div class="modal-body">
                                <img src="/images/tf-example.png" alt="payment" style="width: 100%">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>