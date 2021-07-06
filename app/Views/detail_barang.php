    <section id="team" class="wow fadeInUp">
        <div class="container">
            <div class="section-header" style="font-size: 25px; text-align: center;">
                <h2><?= $barang['nama_barang']; ?></h2>

                <hr>
            </div>
            <div class="row" style="padding-right: 70px; padding-left: 120px">
                <div class="col-lg-9 content">
                    <div class="padding-0 box-v4-alert">
                        <p style="font-size: 16px"><img src="<?= base_url("img/".$barang['gambar']); ?>" alt="" style="width:200px;height:250px;"></p>
                        <p style="font-size: 16px"><b>Nama produk : </b> <?= $barang['nama_barang']; ?> </p>
                        <p style="font-size: 16px"><b>Harga produk : </b> <?= "Rp " . number_format($barang["harga"],2,',','.')?> </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" style="background-color: #b5ffd6; padding: 15px; height: 370px">
                    <div class="member">
                        <div class="details">
                            <h4 style="font-size: 35px">Tersedia </h4>
                            <hr>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
                </div>
            </div>

        </div>
    </section>

    <br>