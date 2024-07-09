<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .struk-container {
            width: 80mm;
            padding: 10mm;
            margin: auto;
            border: 1px solid #ddd;
        }
        .struk-header {
            text-align: center;
        }
        .struk-items {
            width: 100%;
            margin-top: 10mm;
        }
        .struk-items th, .struk-items td {
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        .struk-footer {
            text-align: right;
            margin-top: 10mm;
        }
    </style>
</head>
<body>

<div class="struk-container">
    <div class="struk-header">
        <h2>Struk Pembelian</h2>
        <p>Struk: <?= $struk ?></p>
        <p>Tanggal: <?= $tanggal ?></p>
    </div>

    <table class="struk-items">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart_items as $item): ?>
                <tr>
                    <td><?= $item['nama_barang'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td>Rp.<?= number_format($item['price'], 2, ',', '.') ?></td>
                    <td>Rp.<?= number_format($item['total_price'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="struk-footer">
        <p>Total Belanja: Rp.<?= number_format($total_belanja, 2, ',', '.') ?></p>
        <p>Metode Pembayaran: <?= $metode_pembayaran ?></p>
    </div>
</div>

</body>
</html>
