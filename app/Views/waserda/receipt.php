<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .receipt-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="receipt-container">
    <h2 class="text-center">Receipt</h2>
    <hr>
    <p><strong>Date:</strong> <?= date('d-m-Y H:i:s', strtotime($transaction['tanggal'])) ?></p>
    <p><strong>Transaction ID:</strong> <?= $transaction['id_penjualan'] ?></p>
    <p><strong>Total:</strong> Rp.<?= number_format($transaction['total_belanja'], 2, ',', '.') ?></p>

    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Item Name</th>
                <th>Quantity</th>
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

    <button class="btn btn-primary mt-3" onclick="window.print()">Print</button>
</div>

</body>
</html>
