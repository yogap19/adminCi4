<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>
<div class="container">
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <?php foreach ($breadcrumb as $key => $b): ?>
        <li class="breadcrumb-item"><a href="<?= base_url('User/'.strtolower($b)) ; ?>"><?= $b ; ?></a></li>
    <?php endforeach; ?>
  </ol>
</nav>
<?php if (count($breadcrumb) == 1) : ?>
    <div class="row d-flex justify-content-evenly mb-3">
        <div class="col">
            <a href="<?= base_url('User/barang') ; ?>">
                <div class="card text-center text-white p-3" style="background: #1c4645;">
                    <h4>Barang</h4>
                    <span>(Untuk pengeluaran bahan baku)</span>
                </div>
            </a>
        </div>
        <div class="col" >
            <a href="<?= base_url('User/jasa') ; ?>">
                <div class="card text-center text-white p-3" style="background: #1c4645;">
                    <h4>Jasa</h4>
                    <span>(Untuk pengeluaran jasa)</span>
                </div>
            </a>
        </div>
    </div>
<?php endif; ?>

    <?= $this->renderSection('pengeluaran'); ?>
    <?php if (count($breadcrumb) == 1) :?>
        <div class="card shadow mb-3" >
                <!-- DataTales Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold" style="color: #1c4645;">Data Pengeluaran / <?= date('d-M-y') ; ?></h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Pemasok</th>
                                    <th>kontak</th>
                                    <th>Jumlah Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $i=1; foreach($transaksi as $p) : ?>
                                <form action="<?= base_url('Admin/editBarang/'.$p['id']) ; ?>" method="get">
                                <?php if($p['created_at'] == date('Y-m-d')) : ?>
                                <?php $i%2 != 0? $color = 'rgba(218,218,218,.5)':$color='' ; ?>
                                <tr style="background: <?= $color; ?>">
                                    <td><?= $i ; ?></td>
                                    <td><?= $p['namaBarang'] ; ?></td>
                                    <td><?= $p['pemasok'] ; ?></td>
                                    <td><?= $p['kontak'] ; ?></td>
                                    <td><?= $p['quantity'] ; ?></td>
                                    <td>Rp. <?= number_format($p['hargaBeli'],2,',','.') ; ?></td>
                                    <td>Rp. <?= number_format($p['hargaBeli'] * $p['quantity'],2,',','.'); ?></td>
                                </tr>
                                <?php endif; ?>
                            </form>
                        <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>


<?= $this->endSection(); ?>