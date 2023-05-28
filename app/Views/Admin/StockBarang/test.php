<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card shadow p-3">
        <form action="<?= base_url('Admin/editHarga_/'.$barang['id']) ; ?>" method="post">
            <div class="mb-3">
                <label for="hargaSatuan" class="form-label">Harga Satuan</label>
                <input type="text" class="form-control" name="hargaSatuan" id="hargaSatuan" value="<?= $barang['hargaSatuan'] ; ?>">
            </div>
            <div class="col-5">
                <button type="submit" class="col-5 text-white btn" style="background: #1c4645;">Simpan</button>
            </div>
        </form>
        <div class="row m-3">
            <button type="submit" class="text-white btn bg-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Anda yakin ingin menghapus data ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form action="<?= base_url('Admin/deleteBarang_/'.$barang['id']) ; ?>" method="post">
                <button type="submit" class="btn btn-danger">Hapus</button>
            </form>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

        <!-- <input type="text" name="city" list="citynames">
<datalist id="citynames">
    <option value="Boston">1</option>
    <option value="Cambridge">2</option>
    <option value="Cambridge">3</option>
    <option value="Cambridge">4</option>
    <option value="Cambridge">5</option>
    <option value="Cambridge">6</option>
</datalist> -->


   <!-- <?php if($pemasukanHarian > $pengeluaranHarian) : ?>
                <div class="col">
                <?= ($pemasukanHarian / $pengeluaranHarian *100) ; ?> Naik <i class="fa-solid fa-arrow-trend-up text-success"></i>
                </div>
            <?php else : ?> 
                <div class="col">
                <?= (array_sum($pengeluaranHarian) / array_sum($pemasukanHarian) *100) ; ?> % <i class="fa-solid fa-arrow-trend-down text-danger"></i>
                </div>
            <?php endif; ?> -->