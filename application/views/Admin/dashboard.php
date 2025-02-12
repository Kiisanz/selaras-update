<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>

    <section class="section dashboard">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="card info-card sales-card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Pelanggan <span>| Jahit</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?= $pelanggan->nama_customer ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Pemasukkan <span>| Transaksi</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <strong><h6>Rp. <?= number_format($pemasukkan->pemasukkan) ?></h6></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-14 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alamat Pelanggan</h5>
                        <select id="productFilter" class="form-select">
                            <option value="">Semua Nama Produk</option>
                                <?php
                                $productSizes = [];
                                foreach ($sales as $value) {
                                    $nama = $value->nama_produk;
                                    $size = $value->ukuran;

                                    if (!isset($productSizes[$nama])) {
                                        $productSizes[$nama] = [];
                                    }
                                    if (!in_array($size, $productSizes[$nama])) {
                                        $productSizes[$nama][] = $size;
                                    }
                                }

                                foreach (array_keys($productSizes) as $productName) {
                                    echo '<option value="' . htmlspecialchars($productName) . '">' . htmlspecialchars($productName) . '</option>';
                                }
                                ?>
                        </select>
                        <select id="addressFilter" class="form-select mt-2">
                            <option value="">Semua Alamat</option>
                            <?php foreach (array_unique(array_column($pelanggan_list, 'alamat_customer')) as $alamat) : ?>
                                <option value="<?= $alamat ?>"><?= $alamat ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-4 mt-1">Distribusi Pelanggan dan Penjualan Jasa Jahit Selaras</h4>
                            <div class="mb-2 mt-3">
                                <div id="reportrange" class="form-control d-flex align-items-center gap-2">
                                    <i class="bi bi-calendar-event-fill"></i>
                                    <span class="flex-grow-1">Pilih tanggal</span>
                                    <i class="bi bi-caret-down-fill"></i>
                                </div>
                            </div>
                        </div>
                        <div id="chart" style="width: 100%; max-height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Top Product Selling <span>| Rangking</span></h5>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody id="productTableBody">
                            <?php
                            $no = 1;
                            $combinedProducts = [];

                            foreach ($top_selling as $value) {
                                $productName = $value['nama_produk'];
                                $size = $value['size'];
                                $harga = $value['harga'];
                                $total = $value['total'];

                                if (isset($combinedProducts[$productName][$size])) {
                                    $combinedProducts[$productName][$size]['total'] += $total;
                                } else {
                                    $combinedProducts[$productName][$size] = [
                                        'nama_produk' => $productName,
                                        'size' => $size,
                                        'harga' => $harga,
                                        'total' => $total,
                                    ];
                                }
                            }

                            $allProducts = [];
                            foreach ($combinedProducts as $productName => $sizes) {
                                foreach ($sizes as $size => $product) {
                                    $allProducts[] = $product;
                                }
                            }

                            usort($allProducts, function ($a, $b) {
                                return $b['total'] - $a['total'];
                            });

                            foreach ($allProducts as $product) {
                            ?>
                                <tr data-product="<?= htmlspecialchars($product['nama_produk']) ?>">
                                    <th scope="row">
                                        <a href="detail.php?product=<?= urlencode($product['nama_produk']) ?>">#<?= $no++ ?></a>
                                    </th>
                                    <td><?= htmlspecialchars($product['nama_produk']) ?></td>
                                    <td><?= htmlspecialchars($product['size']) ?></td>
                                    <td>Rp. <?= number_format($product['harga'], 0, ',', '.') ?></td>
                                    <td><span class="badge bg-success"><?= number_format($product['total']) ?></span></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card recent-sales overflow-auto">
                <div class="card-body">
                    <h5 class="card-title">Pelanggan <span>| Daftar Pelanggan</span></h5>
                    <table class="table table-borderless datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Alamat</th>
                                <th scope="col">Tgl. Transaksi Terakhir</th>
                                <th scope="col">Jumlah Pembelian</th>
                                <th scope="col">Jumlah Custom</th>
                                <th scope="col">Total Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($pelanggan_list as $pelanggan) {
                            ?>
                                <tr>
                                    <th scope="row">#<?= $no++ ?></th>
                                    <td><?= $pelanggan->nama_customer ?></td>
                                    <td><?= $pelanggan->alamat_customer ?></td>
                                    <td><?= $pelanggan->tgl_transaksi_terakhir ?></td>
                                    <td><?= $pelanggan->total_pembelian ?></td>
                                    <td><?= $pelanggan->total_custom_qty ?></td>
                                    <td><?= $pelanggan->total_transaksi ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
</main>


<script>
$(function() {
    "use strict";

    var salesData = <?php echo json_encode($sales); ?>;
    var customOrderData = <?php echo json_encode($custom); ?>;
    var start = moment().startOf('month');
    var end = moment().endOf('month');
    var chart;

    $(document).ready(function() {
        $("#addressFilter").on("change", function() {
            updateChart();
        });
        $("#productFilter").on("change", function() {
            updateChart();
        });
    });

    function updateChart() {
        let currentStart = $('#reportrange').data('daterangepicker').startDate;
        let currentEnd = $('#reportrange').data('daterangepicker').endDate;
        const addressFilter = document.getElementById("addressFilter").value;
        const productFilter = document.getElementById("productFilter").value;

        // Filter data sales berdasarkan tanggal, alamat, dan produk
        const filteredSales = salesData.filter(item =>
            moment(item.tanggal, "YYYY-MM-DD").isBetween(currentStart, currentEnd, null, '[]') &&
            (addressFilter === "" || item.alamat === addressFilter) && 
            (productFilter === "" || item.nama_produk === productFilter)
        );

        // Filter data customOrder berdasarkan tanggal dan alamat saja
        const filteredCustomOrders = customOrderData.filter(item =>
            moment(item.tanggal, "YYYY-MM-DD").isBetween(currentStart, currentEnd, null, '[]') &&
            (addressFilter === "" || item.alamat === addressFilter)
        );

        updateChartWithData(filteredSales, filteredCustomOrders, currentStart, currentEnd);
    }

    function updateChartWithData(filteredSales, filteredCustomOrders, start, end) {
    const totalByDate = {}; // Total gabungan Produk + Jasa
    const productDetails = {}; // Detail produk terjual per tanggal
    const customerNamesByDate = {}; // Detail pelanggan jasa per tanggal

    filteredSales.forEach(item => {
        let date = item.tanggal;
        let productName = item.nama_produk;
        let qty = Number(item.total);
        totalByDate[date] = (totalByDate[date] || 0) + qty;

        if (!productDetails[date]) {
            productDetails[date] = {};
        }
        productDetails[date][productName] = (productDetails[date][productName] || 0) + qty;
    });

    filteredCustomOrders.forEach(item => {
        let date = item.tanggal;
        let pcs = Number(item.total_pcs);
        totalByDate[date] = (totalByDate[date] || 0) + pcs; // Tambahin ke total gabungan

        if (!customerNamesByDate[date]) {
            customerNamesByDate[date] = [];
        }
        customerNamesByDate[date].push(`${item.nama_pelanggan}: ${pcs} pcs`);
    });

    let datesArray = [];
    let totalsArray = [];
    let tooltipData = [];
    let currentDate = start.clone();

    while (currentDate.isSameOrBefore(end)) {
        let dateStr = currentDate.format("YYYY-MM-DD");
        datesArray.push(currentDate.format('D MMM'));
        totalsArray.push(totalByDate[dateStr] || 0);

        let productTooltip = productDetails[dateStr]
            ? Object.entries(productDetails[dateStr])
                .map(([name, qty]) => `${name} x ${qty} pcs`)
                .join('<br>')
            : "Tidak ada penjualan";

        let customOrderTooltip = customerNamesByDate[dateStr] && customerNamesByDate[dateStr].length > 0 
            ? customerNamesByDate[dateStr].join('<br>')
            : "Tidak ada pelanggan";

        tooltipData.push(
            `<b>Produk:</b><br>${productTooltip}<br><br><b>Jasa:</b><br>${customOrderTooltip}`
        );

        currentDate.add(1, 'day');
    }

    if (chart) {
        chart.updateOptions({ 
            xaxis: { categories: datesArray },
            tooltip: {
                custom: function({ seriesIndex, dataPointIndex }) {
                    return `<div class="tooltip-box" style="padding:10px; background:#fff; border:1px solid #ddd;">
                        ${tooltipData[dataPointIndex]}
                    </div>`;
                }
            }
        });
        chart.updateSeries([
            { name: 'Total Penjualan', data: totalsArray }
        ]);
    } else {
        var options = {
            chart: {
                type: 'area',
                height: 350
            },
            series: [
                { name: 'Total Penjualan', data: totalsArray }
            ],
            xaxis: { 
                categories: datesArray, 
                tickPlacement: 'on' 
            },
            stroke: {
                curve: 'smooth',
                width: 2,
                colors: ['#012970']
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'light',
                    type: 'vertical',
                    shadeIntensity: 0.4,
                    gradientToColors: ['#0055FF'], 
                    inverseColors: false,
                    opacityFrom: 0.6,
                    opacityTo: 0,
                    stops: [0, 100]
                }
            },
            dataLabels: {
                enabled: false
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value.toFixed(0);
                    }
                }
            },
            tooltip: {
                custom: function({ seriesIndex, dataPointIndex }) {
                    return `<div class="tooltip-box" style="padding:10px; background:#fff; border:1px solid #ddd;">
                        ${tooltipData[dataPointIndex]}
                    </div>`;
                }
            }
        };

        if (document.querySelector("#chart")) {
            chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        }
    }
}


    function cb(start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        updateChart();
    }

    if ($('#reportrange').length) {
        $('#reportrange').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, cb);

        cb(start, end);
    }


});
</script>
