<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="card shadow p-3">
        <form action="<?= base_url('User/pemasukan_') ; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="namaBarang" class="form-label">Nama Barang</label>
                        <select name="namaBarang" id="namaBarang" class="form-control">
                            <?php foreach($barang as $b) : ?>
                                <option value="<?= $b['namaBarang'] ; ?>" class="<?= $b['quantity']==0?'bg-danger text-white':'' ; ?>"  <?= $b['quantity']==0?'disabled':'' ; ?>><?= $b['jenisBarang']; ?> (<?= $b['namaBarang'] ; ?>) <?= $b['quantity']==0?'KOSONG':'' ; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah Barang</label>
                        <input type="text" class="form-control" name="quantity" id="quantity">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="pembeli" class="form-label">Nama Pembeli</label>
                        <input type="text" class="form-control" name="pembeli" id="pembeli">
                    </div>
                    <div class="mb-3">
                        <label for="kontak" class="form-label">kontak</label>
                        <input type="text" class="form-control" name="kontak" id="kontak">
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
                            <label for="image" class="form-label fw-bold">Bukti Pembayaran</label>
                        </div>
                        <div class="col-12">
                            <div class="custom-file">
                                <input class="custom-file-input" type="file" id="image" name="image" onchange="preview()">
                                <label for="image" class="col-12 custom-file-label">Bukti Pembayaran</label>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn col-3 text-white" style="background: #1C4645;">Simpan</button>
            </div>
        </form>
    </div>
    <div class="card shadow mt-3">
        <!-- DataTales Pemasukan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold" style="color: #1c4645;">Data Pemasukan / <?= date('d-M-y') ; ?></h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <!-- <th>Jenis Barang</th> -->
                                <th>tanggal</th>
                                <!-- <th>Harga</th> -->
                                <th>Jumlah Keluaran</th>
                                <!-- <th>Total</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($pemasukan as $p) : ?>
                            <tr>
                                <?php if($p['updated_at'] == date('Y-m-d')) : ?>
                                <td><?= $i ; ?></td>
                                <td><?= $p['namaBarang'] ; ?></td>
                                <td><?= date('d-M-Y', strtotime($p['updated_at'])) ; ?></td>
                                <td><?= $p['quantity'] ; ?></td>
                                <?php $i++;  endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection(); ?>