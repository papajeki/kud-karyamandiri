<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>


<div class="d-flex" style="margin:1em;">
    <!-- search -->
    <form class="d-flex" id="search-form">
        <input class="form-control me-2" type="search" name="q" id="search-input" placeholder="Search" aria-label="Search" style="border-radius: 12em;" value="<?= isset($_GET['q']) ? esc($_GET['q']) : '' ?>">
        <button class="btn btn-outline-success" type="button" id="search-button" style="border-radius: 12em;">Search</button>
    </form>
    <button class="btn btn-primary ms-auto" type="button" id="complete-transaction-button">Selesaikan Transaksi</button>
</div>


<!-- Product Table -->
<div id="product-table-container" class="mb-5">
    <?= $this->include('components/tabelbarangtransaksi', ['result' => $result]) ?>
</div>

<div class="container">
    <div class="row">
        <!-- Cart Table -->
        <div class="col-12 col-lg-8">
            <table class="table table-bordered" id="cart-table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Barcode</th>
                        <th scope="col">Nama Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Cart items will be dynamically added here -->
                </tbody>
            </table>
        </div>

        <div class="col-12 col-lg-4">
            <div class="p-4 d-flex justify-content-center" style="background-color: green; min-width:12em;">
                <span style="font-size:18px; font-weight:bold;">Total Harga</span>
            </div>
            <div style="background-color: grey;min-height:10em;" class="d-flex justify-content-center align-items-center">
                <span id="total-price" style="font-size: 24px; font-weight: bold;">Rp.0</span>
            </div>
        </div>
    </div>
</div>
<!-- Modal untuk memilih metode pembayaran -->
<div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentMethodModalLabel">Pilih Metode Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="cash" value="cash" checked>
        <label class="form-check-label" for="cash">Cash</label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="paymentMethod" id="credits" value="credits">
        <label class="form-check-label" for="credits">Credit</label>
    </div>
    <!-- Dropdown untuk memilih anggota -->
    <div class="form-group mt-3" id="anggota-select-container" style="display: none;">
        <label for="anggota">Pilih Anggota:</label>
        <select class="form-select" id="anggota-select" name="id_anggota">
            <option value="">-- Pilih Anggota --</option>
            <?php foreach($anggotaList as $anggota): ?>
                <option value="<?= $anggota['id_anggota'] ?>"><?= $anggota['surename'] ?> - <?= $anggota['kelompok_tani'] ?>  </option>
            <?php endforeach; ?>
        </select>
    </div>
</div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-payment-button">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Complete Transaction Form -->
<form id="complete-transaction-form" method="post" action="<?= base_url('waserda/kasir/selesaitransaksi') ?>" style="display:none;">
    <input type="hidden" name="id_anggota" value="ID_ANGGOTA_HERE">
    <input type="hidden" name="metode_pembayaran" id="metode_pembayaran_input" value="cash">
    <input type="hidden" name="total_belanja" id="total_belanja_input" value="">
    <div id="cart-items-inputs"></div>
</form>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchButton = document.getElementById('search-button');
    const searchInput = document.getElementById('search-input');
    const productTableContainer = document.getElementById('product-table-container');
    const completeTransactionButton = document.getElementById('complete-transaction-button');
    const completeTransactionForm = document.getElementById('complete-transaction-form');
    const confirmPaymentButton = document.getElementById('confirm-payment-button');
    const cartItemsInputs = document.getElementById('cart-items-inputs');
    const totalPriceElement = document.getElementById('total-price');
    const cartTableBody = document.querySelector('#cart-table tbody');
    const totalBelanjaInput = document.getElementById('total_belanja_input');
    const creditsRadioButton = document.getElementById('credits');
    const cashRadioButton = document.getElementById('cash');
    const anggotaSelectContainer = document.getElementById('anggota-select-container');
    let totalPrice = 0;
    let cartItemCount = 0;

    searchInput.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
            event.preventDefault(); // Mencegah form dari submit default
            searchButton.click();   // Memicu klik pada tombol pencarian
        }
    });
    searchButton.addEventListener('click', function() {
        const query = searchInput.value;

        fetch(`<?= base_url('waserda/kasir') ?>?q=${query}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(data => {
            productTableContainer.innerHTML = data;
            attachAddToCartEventListeners();
        })
        .catch(error => console.error('Error:', error));
    });

    function attachAddToCartEventListeners() {
        const buttons = document.querySelectorAll('.btn-add-to-cart');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const id = this.getAttribute('data-id');
                const name = row.querySelector('td:nth-child(1)').innerText;
                const barcode = row.querySelector('td:nth-child(2)').innerText;
                const price = parseFloat(row.querySelector('.quantity').getAttribute('data-price'));
                const quantity = parseInt(row.querySelector('.quantity').value);

                // Check if item already in cart
                const existingRow = cartTableBody.querySelector(`tr[data-id="${id}"]`);
                if (existingRow) {
                    const existingQuantityElement = existingRow.querySelector('td:nth-child(4)');
                    const existingPriceElement = existingRow.querySelector('td:nth-child(5)');
                    const existingQuantity = parseInt(existingQuantityElement.innerText);

                    existingQuantityElement.innerText = existingQuantity + quantity;
                    existingPriceElement.innerText = (parseFloat(existingPriceElement.innerText) + (price * quantity)).toFixed(2).replace('.', ',');
                } else {
                    cartTableBody.innerHTML += `
                        <tr data-id="${id}">
                            <td>${++cartItemCount}</td>
                            <td>${barcode}</td>
                            <td>${name}</td>
                            <td>${quantity}</td>
                            <td>${(price * quantity).toFixed(2).replace('.', ',')}</td>
                            <td><button class="btn btn-danger btn-remove-from-cart">Remove</button></td>
                        </tr>
                    `;
                }

                totalPrice += price * quantity;
                totalPriceElement.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;
                attachRemoveFromCartEventListeners();
            });
        });
    }

    function attachRemoveFromCartEventListeners() {
        const removeButtons = document.querySelectorAll('.btn-remove-from-cart');

        removeButtons.forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                const price = parseFloat(row.querySelector('td:nth-child(5)').innerText.replace(',', '.'));

                totalPrice -= price;
                totalPriceElement.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;
                row.remove();
            });
        });
    }

    completeTransactionButton.addEventListener('click', function() {
        // Tampilkan modal metode pembayaran
        const paymentMethodModal = new bootstrap.Modal(document.getElementById('paymentMethodModal'));
        paymentMethodModal.show();
    });

    creditsRadioButton.addEventListener('change', function() {
        if (this.checked) {
            anggotaSelectContainer.style.display = 'block';
        }
    });

    cashRadioButton.addEventListener('change', function() {
        if (this.checked) {
            anggotaSelectContainer.style.display = 'none';
        }
    });
    document.getElementById('confirm-payment-button').addEventListener('click', function() {
    const selectedPaymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
    const selectedAnggotaId = document.getElementById('anggota-select').value;

    if (selectedPaymentMethod === 'credits' && !selectedAnggotaId) {
            alert('Silakan pilih anggota terlebih dahulu.');
            return;}

    cartItemsInputs.innerHTML = '';
    cartTableBody.querySelectorAll('tr').forEach(row => {
        const id = row.getAttribute('data-id');
        const quantity = row.querySelector('td:nth-child(4)').innerText;
        const price = row.querySelector('td:nth-child(5)').innerText.replace(',', '.');

        cartItemsInputs.innerHTML += `
            <input type="hidden" name="cart[${id}][id_barang]" value="${id}">
            <input type="hidden" name="cart[${id}][quantity]" value="${quantity}">
            <input type="hidden" name="cart[${id}][total_price]" value="${price}">
        `;
    });

    // Set total_belanja input value
    totalBelanjaInput.value = totalPrice;

    // Set metode pembayaran input value
    document.querySelector('input[name="metode_pembayaran"]').value = selectedPaymentMethod;
        // Set id_anggota input value jika menggunakan kredit
        if (selectedPaymentMethod === 'credits') {
        document.querySelector('input[name="id_anggota"]').value = selectedAnggotaId;
        }

    // Submit the form
    completeTransactionForm.submit();
});
});
</script>

<?= $this->endSection() ?>
