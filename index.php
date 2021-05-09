<?php
// session_start();
require_once("koneksi.php");
$db = new Koneksi();
$db->check_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="assets/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="assets/js/jquery.min.js"></script>
    <title>OOP Tampil Data</title>
</head>
<body>
    <h1 style="text-align: center">CRUD dengan OOP PHP</h1>
    <?php if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    } ?>
    <button type="button" style="margin-left: 20px" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
        Tambah Data Baru
    </button><br /><br />
    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Satuan</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $no = 1;
        $data = $db->getData();
        foreach($data as $data){ ?>
        <tr>
            <td><?= $no; ?></td>
            <td><?= $data["kode_barang"]; ?></td>
            <td><?= $data["nama"]; ?></td>
            <td><?= "Rp " . number_format($data["harga"],2,',','.')?></td>
            <td><?= $data["satuan"]; ?></td>
            <td><?= $data["jumlah"]; ?></td>
            <td>
                <a href="javascript:void(0)" data-kode="<?= $data['kode_barang']; ?>" class="btn btn-primary btn-edit">Edit</a>
                <a href="crud.php?hapus=<?= $data['kode_barang']; ?>" class="btn btn-danger">Hapus</a>
            </td>
        </tr>
        <?php
        $no++; 
        } ?>
    </table>
    <!-- Modal tambah -->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="crud.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahModalLabel">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="kode">Kode Barang</label>
                            <input class="form-control" type="number" name="kode" placeholder="Masukkan Kode Barang" />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Barang</label>
                            <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama Barang" />
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga Barang</label>
                            <input class="form-control" type="number" name="harga" placeholder="Masukkan Harga Barang" />
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <input class="form-control" type="text" name="satuan" placeholder="Satuan" />
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input class="form-control" type="number" name="jumlah" placeholder="Jumlah" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Data Barang -->
    <div class="modal fade" id="detailBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="crud.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailBarangTitle" style="color: black">Edit Data Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="dataBarang"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $('.btn-edit').on('click',function(){
        const data = "<img src='assets/img/loading.gif'/> Silahkan Tunggu";
        $('#dataBarang').html(data);
        // get data from button edit
        const kode = $(this).data('kode');
        // Set data to Form Edit
        $.ajax({
			url: 'crud.php?edit='+kode,
			type: 'get',
			success: function(data) {
				// Show Data
				$('#dataBarang').html(data);
			}
		});
        // Call Modal Detail Pendaftar
        $('#detailBarang').modal('show');
    });
    </script>
</body>
</html>