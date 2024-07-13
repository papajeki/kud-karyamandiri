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

<!-- Complete Transaction Form -->
<form id="complete-transaction-form" method="post" action="<?= base_url('waserda/kasir/selesaitransaksi') ?>" style="display:none;">
    <input type="hidden" name="id_anggota" value="ID_ANGGOTA_HERE">
    <input type="hidden" name="metode_pembayaran" value="cash">
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
    const cartItemsInputs = document.getElementById('cart-items-inputs');
    const totalPriceElement = document.getElementById('total-price');
    const cartTableBody = document.querySelector('#cart-table tbody');
    const totalBelanjaInput = document.getElementById('total_belanja_input');
    let totalPrice = 0;
    let cartItemCount = 0;

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

        // Submit the form
        completeTransactionForm.submit();
    });
});
</script>

<?= $this->endSection() ?>
