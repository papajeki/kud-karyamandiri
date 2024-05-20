<?= $this->extend('testerlayout') ?>;
<?= $this->section('content') ?>

<div class="d-flex flex-column">
    <h2 class="p-5">Harga Tonkol buah sawit PT.Bahari Gembira Riya</h2>
    <form class="p-5 d-flex flex-column" action="" style="margin:auto">
        <div class="d-flex flex-column justify-content-center p-3">
            <label style="text-align: center;font-weight:bold" for="harga_tbs">Harga TBS saat ini</label>
            <input class="textInput" 
            style="
                background-color:#D9D9D9;
                color:black;
                padding:1em;
                border-radius:6px;
                border-style:none;" 
                type="text" name="harga_tbs" id="harga_tbs" placeholder="Rp.2.100,-Kg">
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
             type="text" name="update_harga_tbs" id="update_harga_tbs">
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
                type="date" name="start_harga_tbs" id="start_harga_tbs">
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
                type="date" name="end_harga_tbs" id="end_harga_tbs">
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