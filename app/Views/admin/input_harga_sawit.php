<?= $this->extend('testerlayout') ?>;
<?= $this->section('content') ?>

<div class="d-flex flex-column">
    <h2 class="p-5">Harga Tonkol buah sawit PT.Bahari Gembira Riya</h2>
    <form class="p-5 d-flex flex-column" action="<?= base_url('/admin/input_harga_sawit') ?>" style="margin:auto" method="post">
        <div class="d-flex flex-column justify-content-center p-3">
            <label style="text-align: center;font-weight:bold" for="harga_tbs">Harga TBS saat ini</label>
            <input class="textInput" 
            style="
                background-color:#D9D9D9;
                color:black;
                padding:1em;
                border-radius:6px;
                border-style:none;
                text-align:center" 
                type="text" name="harga_tbs" id="harga_tbs" value="Rp.<?php echo $harga_sawit['harga']; ?>/Kg" readonly>
        </div>

        <div class="d-flex flex-column justify-content-center p-3">
            <label style="text-align: center;font-weight:bold"for="update_harga_tbs">Update Harga</label>
            <input
            style="
                background-color:#D9D9D9;
                color:black;
                padding:1em;
                border-radius:6px;
                border-style:none;" 
             type="text" name="harga" id="harga">
        </div>
        <span class="d-flex" style="margin:auto;font-size:18px;font-weight:bold">Tanggal berlaku</span>
        <div class="d-flex flex-column p-3" style="gap:1em">
            <div class="d-flex flex-column" style="gap:1em">
                <span style="margin:auto;font-weight:bold">Sejak</span>
                <input 
            style="
                background-color:#D9D9D9;
                color:black;
                padding:1em;
                border-radius:6px;
                border-style:none;" 
                type="date" name="tanggal_berlaku" id="tanggal_berlaku">
            </div>

            <div class="d-flex flex-column" style="gap:1em">
                <span style="margin:auto;font-weight:bold">Hingga</span>
                <input 
            style="
                background-color:#D9D9D9;
                color:black;
                padding:1em;
                border-radius:6px;
                border-style:none;" 
                type="date" name="tanggal_berakhir" id="tanggal_berakhir">
            </div>
        </div>
        <button class="btn btn-success" style="border-radius: 20em;" type="submit">
            Update Harga
        </button>
    </form>
</div>

<style>
    .textInput::placeholder {
        color: black;
    }
</style>

<?= $this->endsection() ?>