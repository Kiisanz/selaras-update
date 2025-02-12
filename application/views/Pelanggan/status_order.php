<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Informasi Status Order</span></h2>
        <?php
        if ($this->session->userdata('success')) {
        ?>
            <div class="alert alert-success" role="alert">
                <?= $this->session->userdata('success') ?>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="row ml-5">
        <div class="col-lg-8 mb-5">
            <!-- Tabel Pesanan Belum Selesai -->
            <h4>Pesanan Belum Selesai</h4>
            <table class="status_order table table-bordered mb-3">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Detail</th>
                        <th>Alamat Pengiriman</th>
                        <th>Total Pembayaran</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($status_order as $value) {
                        if ($value->status_order != '4') {
                    ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <?php if ($value->status_pesan == '1') : ?>
                                                <img src="<?= base_url('asset/model-baju/' . $value->gambar_model); ?>"
                                                    alt="<?= $value->nama_produk; ?>"
                                                    class="img-fluid rounded border"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            <?php else : ?>
                                                <img src="<?= base_url('asset/foto-produk/' . $value->gambar); ?>"
                                                    alt="<?= $value->nama_produk; ?>"
                                                    class="img-fluid rounded border"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            <?php endif; ?>

                                        </div>

                                        <div class="ml-4">
                                            <h5 class="mb-1"><?= $value->nama_produk; ?></h5>

                                            <?php if ($value->status_pesan == '1') : ?>
                                                <p class="mb-0 text-muted">
                                                    Quantity: <strong><?= $value->qty_custom; ?></strong>
                                                </p>
                                            <?php else : ?>
                                                <p class="mb-0 text-muted">
                                                    Ukuran: <strong><?= $value->size; ?></strong>
                                                </p>
                                            <?php endif; ?>

                                            <?php if ($value->status_pesan == '1') : ?>
                                                <span class="badge bg-warning text-dark">Pesanan Custom</span>
                                            <?php endif; ?>

                                            <!-- Tanggal Order -->
                                            <p class="mb-0 mt-2 text-muted">
                                                Tgl. Order: <?= $value->tgl_transaksi; ?><br>
                                                <small>Update: <?= $value->update_at; ?></small>
                                            </p>
                                        </div>
                                    </div>
                                    <?php
                                    if ($value->status_order == '0') {
                                        if ($value->status_pesan == '2') {
                                            if ($value->metode_pembayaran == 'cod') {
                                                echo '<span class="badge badge-success">Cash On Delivery (COD)</span><br/>';
                                            }
                                            echo '<span class="badge badge-danger">Belum Bayar</span><br>';
                                        }
                                    } else if ($value->status_order == '1') {
                                        if ($value->metode_pembayaran == 'cod') {
                                            echo '<span class="badge badge-success">Cash On Delivery (COD)</span><br/>';
                                        }
                                        echo '<span class="badge badge-primary">Menunggu Konfirmasi</span><br>';
                                    } else if ($value->status_order == '2') {
                                        if ($value->metode_pembayaran == 'cod') {
                                            echo '<span class="badge badge-success">Cash On Delivery (COD)</span><br/>';
                                        }
                                        echo '<span class="badge badge-warning">Diproses</span><br>';
                                    } else if ($value->status_order == '3') {
                                        if ($value->metode_pembayaran == 'cod') {
                                            echo '<span class="badge badge-success">Cash On Delivery (COD)</span><br/>';
                                        }
                                        echo '<span class="badge badge-info">Dikirim</span><br>';
                                    } else if ($value->status_order == '5') {
                                        echo '<span class="badge badge-danger">Barang Return</span><br>';
                                    }
                                    ?>
                                    <?php
                                    if ($value->status_order == '0') {
                                        if ($value->status_pesan == '2' && $value->metode_pembayaran == 'transfer') { ?>
                                            <?php echo form_open_multipart('pelanggan/katalog/upload_bukti_pembayaran/' . $value->id_transaksi); ?>
                                            <div class="mt-5">
                                                <label>Bukti Pembayaran</label>
                                                <p>No. Rekening: <strong>0123-456-789</strong></p>
                                                <input type="file" name="pembayaran" class="form-control" required>
                                                <button type="submit" class="btn btn-sm btn-primary mt-2">Upload</button>
                                            </div>
                                            </form>
                                            <?php

                                        } else {
                                            if ($value->total_bayar != '0' && $value->metode_pembayaran == 'transfer') {
                                            ?>
                                                <?php echo form_open_multipart('pelanggan/katalog/upload_bukti_pembayaran/' . $value->transaksi_id_transaksi); ?>
                                                <div class="mt-5">
                                                    <label>Bukti Pembayaran</label>
                                                    <p>No. Rekening: <strong>0123-456-789</strong></p>
                                                    <input type="file" name="pembayaran" class="form-control" required>
                                                    <button class="btn btn-sm btn-primary mt-2">Upload</button>
                                                </div>
                                                </form>

                                                <?php if (empty($value->harga_diskon)): ?>
                                                    <div class="d-flex flex-column mb-3">
                                                        <h5 class="font-weight-semi-bold mb-1 mt-4">Gunakan Voucher </h5>
                                                        <form action="<?= base_url('pelanggan/katalog/apply_voucher/' . $value->transaksi_id_transaksi) ?>" method="POST">
                                                            <div class="form-group">
                                                                <label for="kode_voucher">Kode Voucher</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" id="kode_voucher" name="kode_voucher" placeholder="Masukkan kode voucher">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="btn btn-info" onclick="bukaVoucher()">Lihat Voucher</button>
                                                                        <button type="submit" class="btn btn-dark">Gunakan</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>

                                            <?php
                                            } else if ($value->metode_pembayaran == 'cod') { ?>
                                                <p>Pesanan Anda akan segera diproses oleh admin. Silakan siapkan pembayaran saat pesanan diterima!</p>
                                            <?php
                                            } else { ?>
                                                <p>Total Belanja Akan Segera Admin Kirimkan!</p>
                                            <?php
                                            } ?>
                                            <br><br>
                                    <?php }
                                    }
                                    ?>


                                    <?php
                                    if ($value->status_order == '3') { ?>
                                        <?php
                                        if ($value->metode_pembayaran == "cod") { ?>
                                            <p class="w-75">Pesanan Anda sedang dalam perjalanan. Silakan siapkan pembayaran saat pesanan diterima!</p>

                                        <?php } ?>
                                        <a class="btn btn-primary mt-5" href="<?= base_url('pelanggan/katalog/pesanan_diterima/' . $value->transaksi_id_transaksi) ?>">Pesanan Diterima</a>

                                    <?php }
                                    if ($value->status_order == '5') { ?>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $value->id_transaksi ?>">
                                            Return Barang
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal<?= $value->id_transaksi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="<?= base_url('Pelanggan/Katalog/pengembalian_barang/' . $value->id_transaksi) ?>" method="POST">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Return Barang <?= $value->id_transaksi ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">Alasan Return</label>
                                                                <input type="text" name="alasan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                                                <small id="emailHelp" class="form-text text-muted">Silahkan untuk mengisi return barang...</small>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </td>
                                <td>Expedisi: <strong> <?= strtoupper($value->ekspedisi) ?></strong><br>
                                    Estimasi: <?= $value->estimasi ?><br>Alamat:
                                    <br><?= $value->alamat ?>, Kota <?= $value->kota ?> Prov. <?= $value->provinsi ?>
                                </td>
                                <td>
                                    Ongkir : <h6>Rp. <?= number_format($value->ongkir, 0)  ?></h6>
                                    <?php
                                    if ($value->status_pesan == '2') { ?>
                                        Pesanan : <h6>Rp. <?= number_format($value->total_bayar - $value->ongkir, 0)  ?></h6>
                                        Total : <h5><strong>Rp. <?= number_format($value->total_bayar, 0)  ?></strong></h5>
                                        <?php } else if ($value->status_pesan == '1') {
                                        if ($value->total_bayar != '0') { ?>
                                            Pesanan : <h6>Rp. <?= number_format($value->total_bayar - $value->ongkir, 0)  ?></h6>
                                            <?= !empty($value->harga_diskon) ? 'Total : <h6><strong style="font-size: 16px; color: red; text-decoration: line-through;">Rp. ' . number_format($value->total_bayar, 0) . '</strong></h6>' : '' ?>
                                            <h5><strong><?= !empty($value->harga_diskon) ? 'Rp. ' . number_format($value->harga_diskon, 0) : 'Rp. ' . number_format($value->total_bayar, 0) ?></strong></h5>

                                    <?php }
                                    } ?>
                                </td>
                                <?php
                                if ($value->status_pesan == '2') {
                                ?><td class="text-center"><button data-id="<?= $value->id_transaksi ?>" class="btn btn-sm btn-primary"><i class="fas fa-align-justify"></i></button></td>
                                <?php } else if ($value->status_pesan == '1') { ?>
                                    <td class="text-center"><a href="<?= base_url('pelanggan/custome/detail_custome/' . $value->id_transaksi) ?>" class="btn btn-sm btn-success"><i class="fas fa-align-justify"></i></a></td>
                                <?php } ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Tabel Pesanan Sudah Selesai -->
            <h4>Pesanan Sudah Selesai</h4>
            <table class="status_order table table-bordered mb-3">
                <thead class="bg-secondary text-dark">
                    <tr>
                        <th>Id Transaksi</th>
                        <th>Alamat Pengiriman</th>
                        <th>Total Pembayaran</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($status_order as $value) {
                        if ($value->status_order == '4') { // Menampilkan pesanan yang sudah selesai
                    ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <?php if ($value->status_pesan == '1') : ?>
                                                <img src="<?= base_url('asset/model-baju/' . $value->gambar_model); ?>"
                                                    alt="<?= $value->nama_produk; ?>"
                                                    class="img-fluid rounded border"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            <?php else : ?>
                                                <img src="<?= base_url('asset/foto-produk/' . $value->gambar); ?>"
                                                    alt="<?= $value->nama_produk; ?>"
                                                    class="img-fluid rounded border"
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            <?php endif; ?>

                                        </div>

                                        <div class="ml-4">
                                            <h5 class="mb-1"><?= $value->nama_produk; ?></h5>
                                            <?php if ($value->status_pesan == '1') : ?>
                                                <p class="mb-0 text-muted">
                                                    Quantity: <strong><?= $value->qty_custom; ?></strong>
                                                </p>
                                            <?php else : ?>
                                                <p class="mb-0 text-muted">
                                                    Ukuran: <strong><?= $value->size; ?></strong>
                                                </p>
                                            <?php endif; ?>

                                            <small><?= $value->update_at ?></small><br>
                                            <?php
                                            if ($value->status_pesan == '1') {
                                                echo '<span class="badge badge-warning">Pesanan Custom</span><br>';
                                            }
                                            ?>
                                            <!-- Tanggal Order -->
                                            <p class="mb-0 mt-2 text-muted">
                                                Tgl. Order: <?= $value->tgl_transaksi; ?><br>
                                                <small>Update: <?= $value->update_at; ?></small>
                                            </p>
                                        </div>
                                    </div>

                                    <?php
                                    if ($value->status_order == '0') {
                                        if ($value->status_pesan == '2') {
                                            echo '<span class="badge badge-danger">Belum Bayar</span><br>';
                                        }
                                    } else if ($value->status_order == '1') {
                                        echo '<span class="badge badge-primary">Menunggu Konfirmasi</span><br>';
                                    } else if ($value->status_order == '2') {
                                        echo '<span class="badge badge-warning">Diproses</span><br>';
                                    } else if ($value->status_order == '3') {
                                        echo '<span class="badge badge-info">Dikirim</span><br>';
                                    } else if ($value->status_order == '5') {
                                        echo '<span class="badge badge-danger">Barang Return</span><br>';
                                    }
                                    ?>


                                    <?php
                                    // Form Upload Bukti Pembayaran
                                    if ($value->status_order == '0') {
                                        if ($value->status_pesan == '2') { ?>
                                            <?php echo form_open_multipart('pelanggan/katalog/upload_bukti_pembayaran/' . $value->id_transaksi); ?>
                                            <div class="mt-5">
                                                <label>Bukti Pembayaran</label>
                                                <p>No. Rekening: <strong>0123-456-789</strong></p>
                                                <input type="file" name="pembayaran" class="form-control" required>
                                                <button class="btn btn-sm btn-primary mt-2">Upload</button>
                                            </div>
                                            </form>
                                            <?php
                                        } else {
                                            if ($value->total_bayar != '0') {
                                            ?>
                                                <?php echo form_open_multipart('pelanggan/katalog/upload_bukti_pembayaran/' . $value->id_transaksi); ?>
                                                <div class="mt-5">
                                                    <label>Bukti Pembayaran</label>
                                                    <p>No. Rekening: <strong>0123-456-789</strong></p>
                                                    <input type="file" name="pembayaran" class="form-control" required>
                                                    <button class="btn btn-sm btn-primary mt-2">Upload</button>
                                                </div>
                                                </form>
                                            <?php
                                            } else { ?>
                                                <p> Total Belanja Akan Segera Admin Kirimkan!
                                                <?php
                                            } ?>
                                                <br><br>
                                        <?php }
                                    } ?>
                                        <?php
                                        if ($value->status_order == '3') { ?>
                                            <a class="btn btn-primary mt-5" href="<?= base_url('pelanggan/katalog/pesanan_diterima/' . $value->id_transaksi) ?>">Pesanan Diterima</a>
                                        <?php }
                                        if ($value->status_order == '5') { ?>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $value->id_transaksi ?>">
                                                Return Barang
                                            </button>
                                            <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= $value->id_transaksi ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="<?= base_url('Pelanggan/Katalog/pengembalian_barang/' . $value->id_transaksi) ?>" method="POST">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Return Barang <?= $value->id_transaksi ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="exampleInputEmail1">Alasan Return</label>
                                                                        <input type="text" name="alasan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                                                                        <small id="emailHelp" class="form-text text-muted">Silahkan untuk mengisi return barang...</small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                </td>
                                <td>Expedisi: <strong> <?= $value->ekspedisi ?></strong><br>
                                    Estimasi: <?= $value->estimasi ?><br>Alamat:
                                    <br><?= $value->alamat ?>, Kota <?= $value->kota ?> Prov. <?= $value->provinsi ?>
                                </td>
                                <td>
                                    Ongkir : <h6>Rp. <?= number_format($value->ongkir, 0)  ?></h6>
                                    <?php
                                    if ($value->status_pesan == '2') { ?>
                                        Pesanan : <h6>Rp. <?= number_format($value->total_bayar - $value->ongkir, 0)  ?></h6>
                                        Total : <h5><strong>Rp. <?= number_format($value->total_bayar, 0)  ?></strong></h5>
                                        <?php } else if ($value->status_pesan == '1') {
                                        if ($value->total_bayar != '0') { ?>
                                            Pesanan : <h6>Rp. <?= number_format($value->total_bayar - $value->ongkir, 0)  ?></h6>
                                            Total : <h5><strong>Rp. <?= number_format($value->total_bayar, 0)  ?></strong></h5>
                                    <?php }
                                    } ?>
                                </td>
                                <?php
                                if ($value->status_pesan == '2') {
                                ?><td class="text-center"><button data-id="<?= $value->id_transaksi ?>" class="btn btn-sm btn-primary"><i class="fas fa-align-justify"></i></button></td>
                                <?php } else if ($value->status_pesan == '1') { ?>
                                    <td class="text-center"><a href="<?= base_url('pelanggan/custome/detail_custome/' . $value->id_transaksi) ?>" class="btn btn-sm btn-success"><i class="fas fa-align-justify"></i></a></td>
                                <?php } ?>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_voucher" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-semi-bold" id="voucherModalLabel">Daftar Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="tutupVoucher()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="daftar_voucher">
                    <!-- Contoh voucher -->
                    <div class="voucher-item mb-3 p-3 border rounded" style="cursor: pointer;">
                        <h6 class="font-weight-bold">Nama Voucher</h6>
                        <p>Kode: <span class="font-italic">VCR123</span></p>
                        <p>Diskon: <strong>10%</strong></p>
                        <p>Tanggal Berlaku: 01/01/2025 - 01/02/2025</p>
                        <button class="btn btn-info btn-sm" onclick="pilihVoucher('VCR123')">Pilih</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="tutupVoucher()">Tutup</button>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    const baseUrl = '<?= base_url('Admin/KelolaDataMaster/get_voucher') ?>'

    async function getVouchers() {
        try {
            const response = await fetch(baseUrl);
            if (!response.ok) {
                throw new Error('Gagal mengambil data voucher');
            }
            const data = await response.json();
            return data;
        } catch (error) {
            console.error(error);
            return []; // Return empty array if error
        }
    }

    function formatDate(date) {
        const d = new Date(date).toLocaleDateString("id-Id", {
            month: "long",
            day: "numeric",
            year: "numeric"
        });
        return d;
    }

    async function bukaVoucher() {
        const vouchers = await getVouchers();
        const modal = document.getElementById('modal_voucher');
        const daftarVoucher = document.getElementById('daftar_voucher');
        $(modal).modal('show');

        daftarVoucher.innerHTML = ''; // Clear previous voucher list

        vouchers.forEach(voucher => {
            const voucherButton = document.createElement('button');
            voucherButton.className = 'btn btn-outline-dark mb-2 text-left';
            voucherButton.style.width = '100%';
            voucherButton.innerHTML = `
            <div><strong>${voucher.nama_voucher}</strong></div>
            <div>Kode: ${voucher.kode_voucher}</div>
            <div>Diskon: ${parseInt(voucher.diskon_persen)}%</div>
            <div>Tanggal: ${formatDate(voucher.tgl_mulai)} - ${formatDate(voucher.tgl_berakhir)}</div>
            <div>Min. Qty: ${voucher.minimum_pembelian}</div>
        `;
            voucherButton.onclick = () => pilihVoucher(voucher.kode_voucher);
            daftarVoucher.appendChild(voucherButton);
        });

        // Tampilkan modal
        modal.style.display = 'block';
    }

    function tutupVoucher() {
        const modal = document.getElementById('modal_voucher');
        $(modal).modal('hide');
    }

    function pilihVoucher(kode) {
        // Masukkan kode voucher ke input
        document.getElementById('kode_voucher').value = kode;

        // Tutup modal
        tutupVoucher();
    }
</script>
<!-- Contact End -->