<?php
// session_start();
require_once("koneksi.php");
$db = new Koneksi();
$db->check_db();
if(isset($_POST['submit'])){
    $data['kode'] = $_POST['kode'];
    $data['nama'] = $_POST['nama'];
    $data['harga'] = $_POST['harga'];
    $data['satuan'] = $_POST['satuan'];
    $data['jumlah'] = $_POST['jumlah'];
    $submit = $db->insert($data);
    header("Location: index.php");
} else if(isset($_POST['edit'])){
    $data['kode'] = $_POST['kode'];
    $data['nama'] = $_POST['nama'];
    $data['harga'] = $_POST['harga'];
    $data['satuan'] = $_POST['satuan'];
    $data['jumlah'] = $_POST['jumlah'];
    $submit = $db->update($data);
    header("Location: index.php");
} else if(isset($_GET['edit'])){
    $kode = $_GET['edit'];
    $data = $db->getData($kode);
?>
<div class="form-group">
    <label for="kode">Kode Barang</label>
    <input class="form-control" type="number" name="kode" value="<?= $data['kode_barang']; ?>" readonly/>
</div>
<div class="form-group">
    <label for="nama">Nama Barang</label>
    <input class="form-control" type="text" name="nama" value="<?= $data['nama']; ?>"/>
</div>
<div class="form-group">
    <label for="harga">Harga Barang</label>
    <input class="form-control" type="number" name="harga" value="<?= $data['harga']; ?>"/>
</div>
<div class="form-group">
    <label for="satuan">Satuan</label>
    <input class="form-control" type="text" name="satuan" value="<?= $data['satuan']; ?>"/>
</div>
<div class="form-group">
    <label for="jumlah">Jumlah</label>
    <input class="form-control" type="number" name="jumlah" value="<?= $data['jumlah']; ?>"/>
</div>
<?php
} else if(isset($_GET['hapus'])){
    $kode = $_GET['hapus'];
    $data = $db->hapusData($kode);
    header("Location: index.php");
}
?>
