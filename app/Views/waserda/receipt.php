<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .receipt-container {
            max-width: 60mm;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h5 class="text-center">Karya Mandiri</h5>
    <p  class="text-center" style="font-size: 10px;"> <?= $transaction['struk'] ?></p>
    <hr>
    <p style="font-size: 8px;">Date: <?= date('d-m-Y H:i:s', strtotime($transaction['tanggal'])) ?></p>

    <table class="table mt-4 table-sm">
        <thead>
            <tr>
                <th style="font-size: 8px;">No</th>
                <th style="font-size: 8px;">Name</th>
                <th style="font-size: 8px;">Qty</th>
                <th style="font-size: 8px;">Price</th>
                <th style="font-size: 8px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $index => $item): ?>
                <tr>
                    <td style="font-size: 8px;"><?= $index + 1 ?></td>
                    <td style="font-size: 8px;"><?= $item['nama_barang'] ?></td>
                    <td style="font-size: 8px;"><?= $item['jumlah'] ?></td>
                    <td style="font-size: 8px;">Rp.<?= number_format($item['harga'], 2, ',', '.') ?></td>
                    <td style="font-size: 8px;">Rp.<?= number_format($item['harga'] * $item['jumlah'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p style="font-size: 12px;">Total: Rp.<?= number_format($transaction['total_belanja'], 2, ',', '.') ?></p>

    <button class="btn btn-primary mt-3" onclick="window.print()">Print</button>
</div>

</body>
</html>
