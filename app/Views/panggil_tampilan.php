    <main id="main">
        <!--==========================
      Services Section
    ============================-->
        <section id="portfolio" class="wow fadeInUp">
            <div class="container">
                <div class="section-header">
                    <h2 style="text-align: center;">Daftar Barang</h2>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row no-gutters">
                    <?php foreach ($barang as $barang) { ?>
                        <div class="col-lg-3 col-md-3" style="padding: 10px">
                            <div class="portfolio-item wow fadeInUp">
                                <a href="<?= base_url("detail_barang/" . $barang['id']); ?>" class="">
                                    <img src="<?= base_url("img/" . $barang['gambar']); ?>" alt="">
                                    <div class="portfolio-overlay">
                                        <div class="portfolio-info">
                                            <h2 class="wow fadeInUp"><?= $barang['nama_barang']; ?> </h2>
                                            <h4 class="wow fadeInUp"><?= "Rp " . number_format($barang["harga"],2,',','.')?> </h4>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section><!-- #portfolio -->

        <!--==========================
        Clients Section
        ============================-->