                                <input type="hidden" name="id" id="id" class="form-control" value="<?= $data['id']; ?>">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Kode Barang <span class="text-danger">*</span></label>
                                            <input type="text" name="kode" id="kode" class="form-control" value="<?= $data['kode']; ?>" required readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Nama Barang <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="<?= $data['nama_barang']; ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label>Harga <span class="text-danger">*</span></label>
                                            <input type="number" name="harga" id="harga" class="form-control" value="<?= $data['harga']; ?>" required>
                                        </div>
                                    </div>
                                </div>