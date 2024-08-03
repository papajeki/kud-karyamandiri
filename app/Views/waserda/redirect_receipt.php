<!-- redirect_to_receipt.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Receipt Redirect</title>
    <script>
        function openReceiptInNewTab() {
            var receiptUrl = "<?= base_url('waserda/kasir/receipt/' . $id_penjualan) ?>";
            window.open(receiptUrl, '_blank');
            window.location.href = "<?= base_url('waserda/kasir') ?>"; // Redirect to another page after opening the tab
        }
    </script>
</head>
<body onload="openReceiptInNewTab()">
    <p>Redirecting to receipt...</p>
</body>
</html>
