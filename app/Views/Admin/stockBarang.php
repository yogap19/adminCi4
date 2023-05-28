<?= $this->extend('Template/index'); ?>

<?= $this->section('content'); ?>

<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold" style="color: #1c4645;">Data Barang / <?= date('d-M-y') ; ?></h6>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-end">
                <a href="<?= base_url('Admin/tambahBarang') ; ?>" class="btn text-white mb-2" style="background: #1c4645;"><i class="fa-solid fa-plus"></i> Tambah Barang </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr style="background-color: #1c4645; color:aliceblue;">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jumlah sisa</th>
                            <th>Kontak Pemasok</th>
                            <th>Pengaturan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr style="background-color: #1c4645; color:aliceblue;">
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Jumlah sisa</th>
                            <th>Kontak Pemasok</th>
                            <th>Pengaturan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $i=1; foreach($barang as $b) : ?>
                        <form action="<?= base_url('Admin/editHarga_/'.$b['id']) ; ?>" method="post">
                        <?php $i%2 != 0? $color = 'rgba(218,218,218,.5)':$color='' ; ?>
                            <tr style="background: <?= $color; ?>">
                                <td><?= $i ; ?></td>
                                <td><?= $b['jenisBarang'] ; ?> (<?= $b['namaBarang'] ; ?>)</td>
                                <td><input type="text" class="form-control" name="hargaBeli" id="hargaBeli" value="<?= $b['hargaBeli'] ; ?>"></td>
                                <td><input type="text" class="form-control" name="hargaJual" id="hargaJual" value="<?= $b['hargaJual'] ; ?>"></td>
                                <td><?= $b['quantity'] ; ?></td>
                                <td><?= $b['kontak'] ; ?></td>
                                <td class="d-flex justify-content-evenly">
                                    <a class="btn bg-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $b['id'] ; ?>"><i class="fa-solid fa-trash text-white"></i></a>
                                    <button class="btn" style="background: #1c4645;"><i class="fa-solid fa-check text-white"></i></i></button>
                                </td>
                            </tr>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="delete<?= $b['id'] ; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Menghapus Barang</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Anda yakin ingin <strong class="text-danger">MENGHAPUS</strong> barang <strong><?= $b['jenisBarang'].' {'.$b['namaBarang'] ; ?>}</strong>  ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-danger">Hapus</button>
                            </div>
                            </div>
                        </div>
                        </div>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready( function () {
    $('#dataTable').DataTable();
} );
</script>
<?= $this->endSection(); ?>


