<?php
session_start();
class Koneksi {
    var $hostname = "localhost";
    var $username = "root";
    var $database = "pwl";
    var $password = "";
    var $conn;

    function check_db(){
        $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        if($this->conn){
            return "Koneksi sukses";
        }
    }

    function getData($kode = null){
        if($kode == null){
            $data = mysqli_query($this->conn, "SELECT * FROM barang");
        } else {
            $data = mysqli_fetch_assoc(mysqli_query($this->conn, "SELECT * FROM barang WHERE kode_barang = '$kode'"));
        }
        return $data;
    }

    function insert($data){
        $kode = $data['kode'];
        $nama = $data['nama'];
        $harga = $data['harga'];
        $satuan = $data['satuan'];
        $jumlah = $data['jumlah'];
        $submit = mysqli_query($this->conn, "INSERT INTO `barang`(`kode_barang`, `nama`, `harga`, `satuan`, `jumlah`) VALUES ('$kode','$nama','$harga','$satuan','$jumlah')");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Kode sudah ada!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil ditambahkan!
            </div>';
        }
    }

    function update($data){
        $kode = $data['kode'];
        $nama = $data['nama'];
        $harga = $data['harga'];
        $satuan = $data['satuan'];
        $jumlah = $data['jumlah'];
        $submit = mysqli_query($this->conn, "UPDATE `barang` SET `nama`='$nama',`harga`='$harga',`satuan`='$satuan',`jumlah`='$jumlah' WHERE `kode_barang`='$kode'");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Gagal memperbarui data!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil diperbarui!
            </div>';
        }
    }

    function hapusData($kode){
        $submit = mysqli_query($this->conn, "DELETE FROM `barang` WHERE kode_barang = '$kode'");
        if(!$submit){
            $_SESSION['message'] = '<div class="alert alert-danger" role="alert">
            Gagal menghapus data!
            </div>';
        } else {
            $_SESSION['message'] = '<div class="alert alert-success" role="alert">
            Data berhasil dihapus!
            </div>';
        }
    }
}