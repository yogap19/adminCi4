<?= $this->extend('User/pengeluaran'); ?>

<?= $this->section('pengeluaran'); ?>

<div class="card shadow mb-3">
        <h4 class="m-2 text-center">Pengeluaran ( <?= date('d/M/Y')  ?> ) </h4>

        <form action="<?= base_url('User/pengeluaran_') ; ?>" method="post" enctype="multipart/form-data">
            <div class="row">
            <div class="col-6">
                <div class="m-3">
                    <label for="namaBarang" class="form-label">Nama barang {Merek}</label>
                    <select name="namaBarang" id="namaBarang" class="form-control">
                        <?php foreach($barang as $b) : ?>
                            <option value="<?= $b['namaBarang'] ; ?>"><?= $b['jenisBarang'] ; ?>(<?= $b['namaBarang'] ; ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="m-3">
                    <label for="quantity" class="form-label">Jumlah barang {kg/L/Satuan}</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Bahan 1">
                </div>

            </div>
            <div class="col-6">
                <div class="m-3">
                    <label for="pemasok" class="form-label">Nama Toko (Pemasok)</label>
                    <input type="text" class="form-control" id="pemasok" name="pemasok" placeholder="Bahan 1">
                </div>

                <div class="m-3">
                    <label for="kontak" class="form-label">Kontak</label>
                    <input type="text" class="form-control" maxlength="13" id="kontak" name="kontak" placeholder="Bahan 1" onkeypress="return event.charCode >= 48 && event.charCode <=57">
                </div>
            </div>
            <div class="row ml-3 mt-3">
                <div class="row">
                    <div class="col-4">
                        <!-- preview -->
                        <img src="<?= base_url('img'); ?>/logo.svg" alt="logo.png" class="img-thumbnail img_preview" style="border-color: blue;">
                    </div>
                    <div class="col-8">
                        <input type="hidden" id="oldImage" name="oldImage">
                        <div class="col-1">
                            <label for="image" class="form-label fw-bold">Upload</label>
                        </div>
                        <div class="col-12">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="image" name="image" onchange="preview()">
                                <label for="image" class="col-12 custom-file-label">logo.png</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                <button type="submit" class="btn text-white fw-bold" style="background: #1c4645;">Simpan</button>
            </div>
            </form>
        </div>
    </div>

<?= $this->endSection(); ?>