<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card shadow p-3">
        <h3 class="text-center fw-bold" style="color: #1c4645;">Form Tambah Barang</h3>
        <form action="<?= base_url('Admin/tambahBarang_') ; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jenisBarang" class="form-label fw-bold">Jenis Barang</label>
                        <input type="text" class="form-control" name="jenisBarang" id="jenisBarang" placeholder="ikan,tepung,minyak,dll.">
                    </div>
                    <div class="mb-3">
                        <label for="namaBarang" class="form-label fw-bold">Merek Barang</label>
                        <input type="text" class="form-control" name="namaBarang" id="namaBarang">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="hargaBeli" class="form-label fw-bold">Harga Beli</label>
                        <input type="text" class="form-control" name="hargaBeli" id="hargaBeli" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                    </div>
                    <div class="mb-3">
                        <label for="hargaJual" class="form-label fw-bold">Harga Jual</label>
                        <input type="text" class="form-control" name="hargaJual" id="hargaJual" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <!-- preview -->
                    <img src="<?= base_url('img'); ?>/logo.svg" alt="logo.png" class="img-thumbnail img_preview" style="border-color: blue;">
                </div>
                <div class="col-8">
                    <input type="hidden" id="oldImage" name="oldImage">
                    <div class="col-1">
                        <label for="image" class="form-label fw-bold">Upload Gambar</label>
                    </div>
                    <div class="col-12">
                        <div class="custom-file">
                            <input class="custom-file-input" type="file" id="image" name="image" onchange="preview()">
                            <label for="image" class="col-12 custom-file-label">Tambah Gambar</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn text-light m-2 text-center" style="background: #1c4645;">Simpan</button>
            </div> 
        </form>
    </div>
</div>

<?= $this->endSection(); ?>