<main id="main" class="main">
    <div>
        <h3 class="mb-4">Daftar Voucher Pelanggan</h1>
            <div class="card px-3 py-3">
                <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#tambahVoucherModal" style="width: 150px; float: right;" onclick="$('#tambahVoucherModal').modal('show')">Tambah Voucher</button>
                <div class="modal fade" id="tambahVoucherModal" tabindex="-1" aria-labelledby="tambahVoucherModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="tambahVoucherModalLabel">Tambah Voucher</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('Admin/KelolaDataMaster/add_voucher') ?>" method="POST">
                                    <div class="row mb-3">
                                        <label for="nama_pelanggan" class="col-sm-3 col-form-label">Nama Pelanggan</label>
                                        <div class="col-sm-9">
                                            <select name="nama_pelanggan" class="form-control">
                                                <option value="">---Pilih Nama Pelanggan---</option>
                                                <?php if (!empty($pelanggan)) : ?>
                                                    <?php foreach ($pelanggan as $value) : ?>
                                                        <option value="<?= $value->id_customer ?>"
                                                            <?php if (set_value('nama_pelanggan') == $value->id_customer) {
                                                                echo 'selected';
                                                            } ?>>
                                                            <?= $value->nama_customer ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="">Tidak ada pelanggan tersedia</option>
                                                <?php endif; ?>
                                            </select>
                                            <?= form_error('nama_pelanggan', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Pilih nama pelanggan yang akan menerima voucher.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="kode_voucher" class="col-sm-3 col-form-label">Kode Voucher</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="<?= set_value('kode_voucher') ?>" name="kode_voucher" class="form-control" maxlength="10">
                                            <?= form_error('kode_voucher', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Masukkan kode voucher dengan maksimal 10 karakter.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="nama_voucher" class="col-sm-3 col-form-label">Nama Voucher</label>
                                        <div class="col-sm-9">
                                            <input type="text" value="<?= set_value('nama_voucher') ?>" name="nama_voucher" class="form-control">
                                            <?= form_error('nama_voucher', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Masukkan nama voucher yang akan ditampilkan.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="diskon_persen" class="col-sm-3 col-form-label">Diskon (%)</label>
                                        <div class="col-sm-9">
                                            <input type="number" value="<?= set_value('diskon_persen') ?>" name="diskon_persen" class="form-control" min="1" max="100">
                                            <?= form_error('diskon_persen', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Masukkan persentase diskon dengan minimal 1% dan maksimal 100%.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_pembelian" class="col-sm-3 col-form-label">Minimum Qty Pesanan</label>
                                        <div class="col-sm-9">
                                            <input type="number" value="<?= set_value('minimum_pembelian') ?>" name="minimum_pembelian" class="form-control" min="1">
                                            <?= form_error('minimum_pembelian', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Masukkan minimum pesanan custom dengan minimal 1.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-9">
                                            <input type="date" value="<?= set_value('tgl_mulai') ?>" name="tgl_mulai" class="form-control">
                                            <?= form_error('tgl_mulai', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Pilih tanggal mulai voucher.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="tgl_berakhir" class="col-sm-3 col-form-label">Tanggal Berakhir</label>
                                        <div class="col-sm-9">
                                            <input type="date" value="<?= set_value('tgl_berakhir') ?>" name="tgl_berakhir" class="form-control">
                                            <?= form_error('tgl_berakhir', '<small class="text-danger pl-3">', '</small>'); ?>
                                            <small class="text-muted">Pilih tanggal berakhir voucher.</small>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-10">
                                            <button type="submit" class="btn btn-success">Simpan Voucher</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover mt-4">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Nama Pelanggan</th>
                            <th>Kode Voucher</th>
                            <th>Nama Voucher</th>
                            <th>Diskon (%)</th>
                            <th>Minimum Pembelian</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($vouchers)): ?>
                            <?php foreach ($vouchers as $key => $voucher): ?>
                                <tr>
                                    <td><?= $key + 1; ?></td>
                                    <td><?= $voucher->nama_customer; ?></td>
                                    <td><?= $voucher->kode_voucher; ?></td>
                                    <td><?= $voucher->nama_voucher; ?></td>
                                    <td><?= $voucher->diskon_persen; ?></td>
                                    <td><?= number_format($voucher->minimum_pembelian) . " " . "Qty"; ?></td>
                                    <td><?= date('d-m-Y', strtotime($voucher->tgl_mulai)); ?></td>
                                    <td><?= date('d-m-Y', strtotime($voucher->tgl_berakhir)); ?></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" onclick="location.href='<?= base_url('Admin/KelolaDataMaster/delete_voucher/' . $voucher->id_voucher) ?>'">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10" class="text-center">Tidak ada voucher tersedia</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
</main>