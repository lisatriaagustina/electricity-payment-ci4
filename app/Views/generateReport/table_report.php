<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        .heading {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="heading">
        <h2><?= strtoupper(date('F')) ?> <?= date('Y') ?> PAYMENT REPORT</h2>
    </div>
    <table>
        <!-- <thead> -->
        <tr>
            <th class="tdth-report" style="width: 3%">No</th>
            <th class="tdth-report">Customer Name</th>
            <th class="tdth-report">kWh Number</th>
            <th class="tdth-report">Total Meter</th>
            <th class="tdth-report" style="width: 11%">Ratesperkwh</th>
            <th class="tdth-report">Admin Fee</th>
            <th class="tdth-report" style="width: 13%">Total Bill</th>
            <th class="tdth-report">Bank Payment</th>
            <th class="tdth-report">Pay Date</th>
            <th class="tdth-report" style="width: 11%">Total Pay</th>
        </tr>
        <!-- </thead> -->
        <!-- <tbody> -->
        <?php if (isset($data_report)) : ?>
            <?php $i = 1 ?>
            <?php foreach ($data_report as $data) : ?>
                <tr>
                    <td class="tdth-report"><?= $i++ ?></td>
                    <td class="tdth-report"><?= $data['name'] ?></td>
                    <td class="tdth-report"><?= $data['kwh_number'] ?></td>
                    <td class="tdth-report"><?= $data['final_meter'] - $data['initial_meter'] ?></td>
                    <td class="tdth-report"><?= "Rp " . number_format($data['ratesperkwh'], 2, ',', '.') ?></td>
                    <td class="tdth-report"><?= $admin_fee ?></td>
                    <td class="tdth-report"><?= "Rp " . number_format(($data['ratesperkwh'] * ($data['final_meter'] - $data['initial_meter'])) + $admin_fee, 2, ',', '.') ?></td>
                    <td class="tdth-report"><?= $data['bank_name'] ?></td>
                    <td class="tdth-report"><?= $data['pay_date'] ?></td>
                    <td class="tdth-report"><?= "Rp " . number_format($data['total_pay'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif ?>
        <!-- </tbody> -->
    </table>
</body>

</html>