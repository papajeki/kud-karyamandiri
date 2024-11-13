<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Atur lebar dan tata letak untuk printer termal 80mm */
        .receipt-container {
            width: 80mm;
            margin: 0 auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 10px;
        }

        .text-center {
            text-align: center;
        }

        /* CSS untuk mode cetak */
        @media print {
            body * {
                visibility: hidden;
            }
            .receipt-container, .receipt-container * {
                visibility: visible;
            }
            .receipt-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 80mm;
                padding: 0;
                margin: 0;
                border: none;
            }
        }

        /* Hapus padding table dan atur font untuk printer termal */
        .table {
            margin-bottom: 0;
        }

        .table th, .table td {
            padding: 4px;
            font-size: 10px;
            line-height: 1.2;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h5 class="text-center">Karya Mandiri</h5>
    <p class="text-center"><?= $transaction['struk'] ?></p>
    <hr>
    <p>Date: <?= date('d-m-Y H:i:s', strtotime($transaction['tanggal'])) ?></p>

    <table class="table table-borderless table-sm">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $index => $item): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp.<?= number_format($item['harga'], 2, ',', '.') ?></td>
                    <td>Rp.<?= number_format($item['harga'] * $item['jumlah'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <p style="font-size: 12px;">Total: Rp.<?= number_format($transaction['total_belanja'], 2, ',', '.') ?></p>

    <button class="btn btn-primary mt-3" onclick="window.print()">Print</button>
</div>

</body>
</html>
