<main id="main" class="main mx-5 py-5">
    <h3 class="mb-4">Voucher Saya</h1>
        <div class="card px-3 py-3">
            <table class="table table-bordered table-hover mt-4">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Kode Voucher</th>
                        <th>Nama Voucher</th>
                        <th>Diskon (%)</th>
                        <th>Minimum Pembelian</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Berakhir</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($vouchers)): ?>
                        <?php foreach ($vouchers as $key => $voucher): ?>
                            <tr>
                                <td><?= $key + 1; ?></td>
                                <td><?= $voucher->kode_voucher; ?></td>
                                <td><?= $voucher->nama_voucher; ?></td>
                                <td><?= number_format($voucher->diskon_persen) . "%"; ?></td>
                                <td><?= number_format($voucher->minimum_pembelian) . " " . "Qty"; ?></td>
                                <td><?= date('d-m-Y', strtotime($voucher->tgl_mulai)); ?></td>
                                <td><?= date('d-m-Y', strtotime($voucher->tgl_berakhir)); ?></td>
                                <td>
                                    <button class="btn btn-success btn-sm" onclick="location.href='<?= base_url('pelanggan/katalog/status_order') ?>'">Gunakan</button>
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