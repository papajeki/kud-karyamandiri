<?= $this->extend('layout_kasir') ?>
<?= $this->section('content') ?>

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
            <table class="table" id="cart-table">
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
<form id="complete-transaction-form" method="post" action="<?= base_url('waserda/kasir/completeTransaction') ?>" style="display:none;">
    <input type="hidden" name="id_anggota" value="ID_ANGGOTA_HERE">
    <input type="hidden" name="metode_pembayaran" value="cash">
    <input type="hidden" name="total_belanja" id="total_belanja_input" value="">
    <div id="cart-items-inputs"></div>
</form>


<!-- Hidden receipt container for printing -->
<div id="receipt-container" style="display:none;">
    <h3>Struk Pembelian</h3>
    <p>Tanggal: <span id="receipt-date"></span></p>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody id="receipt-items">
            <!-- Receipt items will be dynamically added here -->
        </tbody>
    </table>
    <p>Total: <span id="receipt-total"></span></p>
</div>


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
    const receiptContainer = document.getElementById('receipt-container');
    const receiptDate = document.getElementById('receipt-date');
    const receiptItems = document.getElementById('receipt-items');
    const receiptTotal = document.getElementById('receipt-total');
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
                const existingCartItem = cartTableBody.querySelector(`tr[data-id="${id}"]`);
                if (existingCartItem) {
                    const quantityCell = existingCartItem.querySelector('td:nth-child(4)');
                    const priceCell = existingCartItem.querySelector('td:nth-child(5)');
                    const currentQuantity = parseInt(quantityCell.innerText);
                    const newQuantity = currentQuantity + quantity;
                    quantityCell.innerText = newQuantity;
                    priceCell.innerText = price * newQuantity;

                    // Update total price
                    totalPrice += price * quantity;
                    totalPriceElement.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;
                    totalBelanjaInput.value = totalPrice; // Update hidden input
                    return;
                }

                // Add new item to cart table
                cartItemCount++;
                const cartRow = document.createElement('tr');
                cartRow.setAttribute('data-id', id);
                cartRow.innerHTML = `
                    <td>${cartItemCount}</td>
                    <td>${barcode}</td>
                    <td>${name}</td>
                    <td>${quantity}</td>
                    <td>${price * quantity}</td>
                    <td><button class="btn btn-primary btn-remove-from-cart" type="button">Hapus</button></td>
                `;
                cartTableBody.appendChild(cartRow);

                // Update total price
                totalPrice += price * quantity;
                totalPriceElement.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;
                totalBelanjaInput.value = totalPrice; // Update hidden input

                // Add event listener to the remove button
                cartRow.querySelector('.btn-remove-from-cart').addEventListener('click', function() {
                    const row = this.closest('tr');
                    const priceToDeduct = parseFloat(row.querySelector('td:nth-child(5)').innerText);
                    totalPrice -= priceToDeduct;
                    totalPriceElement.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;
                    totalBelanjaInput.value = totalPrice; // Update hidden input
                    row.remove();
                    cartItemCount--; // Decrease the cart item count
                });
            });
        });
    }

    completeTransactionButton.addEventListener('click', function() {
        // Prepare the cart items for submission
        cartItemsInputs.innerHTML = '';
        cartTableBody.querySelectorAll('tr').forEach(row => {
            const id = row.getAttribute('data-id');
            const quantity = row.querySelector('td:nth-child(4)').innerText;
            const price = row.querySelector('td:nth-child(5)').innerText;

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

    completeTransactionForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(completeTransactionForm);

        fetch(completeTransactionForm.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill the receipt content
                receiptDate.innerText = new Date().toLocaleString();
                receiptItems.innerHTML = '';
                cartTableBody.querySelectorAll('tr').forEach(row => {
                    const name = row.querySelector('td:nth-child(3)').innerText;
                    const quantity = row.querySelector('td:nth-child(4)').innerText;
                    const price = row.querySelector('td:nth-child(5)').innerText;

                    receiptItems.innerHTML += `
                        <tr>
                            <td>${name}</td>
                            <td>${quantity}</td>
                            <td>${price}</td>
                        </tr>
                    `;
                });
                receiptTotal.innerText = `Rp.${totalPrice.toFixed(2).replace('.', ',')}`;

                // Show and print the receipt
                receiptContainer.style.display = 'block';
                window.print();
                receiptContainer.style.display = 'none';

                // Clear the cart and reset the total price
                cartTableBody.innerHTML = '';
                totalPrice = 0;
                totalPriceElement.innerText = 'Rp.0';
                totalBelanjaInput.value = 0;
                cartItemCount = 0;
            } else {
                alert('Transaction failed. Please try again.');
            }
        })
        .catch(error => console.error('Error:', error));
    });

    attachAddToCartEventListeners();
});

</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<?= $this->endSection() ?>
