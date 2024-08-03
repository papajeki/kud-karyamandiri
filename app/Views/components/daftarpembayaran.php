<table class="table">
    <thead>
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Nominal Pembayaran</th>
                <th scope="col">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($pembayaran)): ?>
                <?php foreach($pembayaran as $transaksi): ?>
                    <tr>
                        <td><?= esc($transaksi['tanggal_bayar']) ?></td>
                        <td><?= esc(number_format($transaksi['nominal_pembayaran'], 0, ',', '.')) ?></td>
                        <td><?= esc($transaksi['deskripsi']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Belum ada riwayat transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>