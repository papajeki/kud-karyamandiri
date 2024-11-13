<div style="max-height: 300px; overflow-y: auto;">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Tanggal</th>
                <th scope="col">Jenis Transaksi</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($riwayat)): ?>
                <?php foreach ($riwayat as $index => $transaksi): ?>
                        <tr>
                            <td><?= esc($transaksi['tanggal']) ?></td>
                            <td><?= esc($transaksi['jenis_transaksi']) ?></td>
                            <td><?= esc(number_format($transaksi['jumlah'], 0, ',', '.')) ?></td>
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
</div>