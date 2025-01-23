<main id="main" class="main">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Filter Produk -->
            <div class="col-14 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Alamat Pelanggan</h5>
                        <select id="productFilter" class="form-select" onchange="filterData()">
                            <option value="">Semua Produk</option>
                            <?php
                            // Menyiapkan array untuk produk dan ukuran yang unik
                            $uniqueProducts = [];

                            // Mengumpulkan nama produk dan ukuran dari data top selling
                            foreach ($top_selling as $value) {
                                $productKey = $value['nama_produk'] . ' (' . $value['size'] . ')';

                                // Cek apakah produk dan ukuran sudah ada, jika belum, tambahkan
                                if (!isset($uniqueProducts[$productKey])) {
                                    $uniqueProducts[$productKey] = true;
                                    // Menambahkan option ke dalam dropdown
                                    echo '<option value="' . htmlspecialchars($productKey) . '">' . htmlspecialchars($productKey) . '</option>';
                                }
                            }
                            ?>
                        </select>

                        <select id="addressFilter" class="form-select mt-2" onchange="filterData()">
                            <option value="">Semua Alamat</option>
                            <?php foreach (array_unique(array_column($pelanggan_list, 'alamat_customer')) as $alamat) : ?>
                                <option value="<?= $alamat ?>"><?= $alamat ?></option>
                            <?php endforeach; ?>
                        </select>

                        <div class="mt-4 d-flex justify-content-between">
                            <label for="yearFilter">Tahun:</label>
                            <select id="yearFilter" onchange="filterData()">
                                <option value="">Pilih Tahun</option>
                                <?php
                                $years = array_unique(array_map(function ($transaksi) {
                                    return date('Y', strtotime($transaksi['tanggal']));
                                }, $top_selling));
                                $minYear = 2020;
                                $years = array_filter($years, function ($year) use ($minYear) {
                                    return $year >= $minYear;
                                });
                                foreach ($years as $year) : ?>
                                    <option value="<?= $year ?>"><?= $year ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for="monthFilter">Bulan:</label>
                            <select id="monthFilter" onchange="filterData()">
                                <option value="">Pilih Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>

                            <label for="dayFilter">Hari:</label>
                            <select id="dayFilter" onchange="filterData()">
                                <option value="">Pilih Hari</option>
                                <?php for ($i = 1; $i <= 31; $i++) : ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Sales & Revenue Cards -->
            <div class="col-12 col-lg-8">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <!-- Sales Card -->
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
                        </div><!-- End Sales Card -->
                    </div>

                    <div class="col-12 col-lg-6">
                        <!-- Revenue Card -->
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title">Pemasukkan <span>| Transaksi</span></h5>
                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <strong><small>Rp. <?= number_format($pemasukkan->pemasukkan) ?></small></strong>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Revenue Card -->
                    </div>
                </div><!-- End Inner Row -->
            </div><!-- End Sales & Revenue Cards -->
        </div><!-- End Main Row -->

        <div class="row">
            <!-- OLAP Chart -->
            <div class="col-12 col-lg-8 d-flex flex-column">
                <div class="card flex-grow-1">
                    <div id="topProductChartContainer" class="card-body">
                        <h5 class="card-title">Grafik OLAP</h5>
                        <canvas id="topProductChart"></canvas>
                    </div>
                </div>
            </div><!-- End OLAP Chart -->

            <!-- Pie Chart for Pelanggan -->
            <div class="col-8 col-lg-4 d-flex flex-column">
                <div class="card flex-grow-1">
                    <div class="card-body">
                        <h5 class="card-title">Distribusi Pelanggan <span>| Berdasarkan Alamat</span></h5>
                        <canvas id="customerPieChart" width="100" height="100"></canvas>
                    </div>
                </div>
            </div><!-- End Pie Chart -->
        </div>

        <div class="row">
            <!-- Filter Card -->
            <div class="col-12 col-md-4 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-3 text-center">Filter Data</h5>
                        <div class="mb-3">
                            <label for="filterAlamat" class="form-label">Alamat</label>
                            <select id="filterAlamat" class="form-select">
                                <option value="all">Semua Alamat</option>
                                <?php foreach (array_unique(array_column($pelanggan_list, 'alamat_customer')) as $alamat) : ?>
                                    <option value="<?= $alamat ?>"><?= $alamat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="filterTahun" class="form-label">Tahun</label>
                            <select id="filterTahun" class="form-select">
                                <option value="all">Semua Tahun</option>
                                <?php
                                $tahun_list = array_unique(array_map(function ($pelanggan) {
                                    return date('Y', strtotime($pelanggan->tgl_transaksi_terakhir));
                                }, $pelanggan_list));
                                foreach ($tahun_list as $tahun): ?>
                                    <option value="<?= $tahun ?>"><?= $tahun ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="filterBulan" class="form-label">Bulan</label>
                            <select id="filterBulan" class="form-select">
                                <option value="all">Semua Bulan</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i ?>"><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div><!-- End Filter Card -->

            <!-- Chart Card -->
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">Distribusi Pelanggan Jas Jahit Selaras</h5>
                        <canvas id="myChart" width="800" height="400"></canvas>
                    </div>
                </div>
            </div><!-- End Chart Card -->
        </div><!-- End Row -->






        <!-- Recent Sales -->
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
        </div><!-- End Recent Sales -->



        <!-- Customers Table -->
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
        </div><!-- End Customers Table -->





        </div>
</main><!-- End #main -->

<script>
    let topProductChart;
    let customerPieChart;

    function filterData() {
        const productFilterValue = document.getElementById('productFilter').value;
        const addressFilterValue = document.getElementById('addressFilter').value;
        const yearFilterValue = document.getElementById('yearFilter').value;
        const monthFilterValue = document.getElementById('monthFilter').value;
        const dayFilterValue = document.getElementById('dayFilter').value;

        updateChart(productFilterValue, addressFilterValue, yearFilterValue, monthFilterValue, dayFilterValue);
    }

    function updateChart(productFilterValue, addressFilterValue, yearFilterValue, monthFilterValue, dayFilterValue) {
        const allPrices = <?= json_encode(array_column($top_selling, 'harga')) ?>;
        const allProductNames = <?= json_encode(array_column($top_selling, 'nama_produk')) ?>;
        const allSizes = <?= json_encode(array_column($top_selling, 'size')) ?>;
        const allTotal = <?= json_encode(array_column($top_selling, 'total')) ?>;
        const allAddresses = <?= json_encode(array_map(function ($pelanggan) {
                                    return $pelanggan->alamat_customer;
                                }, $pelanggan_list)) ?>;
        const allDates = <?= json_encode(array_map(function ($transaksi) {
                                return $transaksi['tanggal'];
                            }, $top_selling)) ?>;

        let aggregatedData = {};
        let addressData = {};

        allProductNames.forEach((product, index) => {
            const productKey = `${product} (${allSizes[index]})`;

            // Apply filters here
            const isProductMatch = (productFilterValue === "" || productKey === productFilterValue);
            const isAddressMatch = (addressFilterValue === "" || allAddresses[index] === addressFilterValue);
            const isYearMatch = (yearFilterValue === "" || new Date(allDates[index]).getFullYear() == yearFilterValue);
            const isMonthMatch = (monthFilterValue === "" || new Date(allDates[index]).getMonth() + 1 == monthFilterValue);
            const isDayMatch = (dayFilterValue === "" || new Date(allDates[index]).getDate() == dayFilterValue);

            // If all filters match
            if (isProductMatch && isAddressMatch && isYearMatch && isMonthMatch && isDayMatch) {
                if (!aggregatedData[productKey]) {
                    aggregatedData[productKey] = {
                        total: 0,
                        price: allPrices[index]
                    };
                }
                aggregatedData[productKey].total += allTotal[index];

                const address = allAddresses[index];
                if (address && address !== 'null' && address !== 'undefined') {
                    if (!addressData[address]) {
                        addressData[address] = 0;
                    }
                    addressData[address] += allTotal[index];
                }
            }
        });

        const filteredProductNames = Object.keys(aggregatedData);
        const filteredTotals = filteredProductNames.map(product => aggregatedData[product].total);

        const addressLabels = Object.keys(addressData).filter(address => address !== null && address !== undefined);
        const addressValues = addressLabels.map(address => addressData[address]);

        if (topProductChart) {
            topProductChart.destroy();
        }

        const ctxBar = document.getElementById('topProductChart').getContext('2d');
        topProductChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: filteredProductNames,
                datasets: [{
                    label: 'Total Terjual',
                    data: filteredTotals,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah Terjual'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Produk (Nama & Ukuran)'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} unit`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Grafik Total Penjualan'
                    }
                }
            }
        });

        // Hancurkan pie chart lama jika ada
        if (customerPieChart) {
            customerPieChart.destroy();
        }

        const ctxPie = document.getElementById('customerPieChart').getContext('2d');
        customerPieChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: addressLabels,
                datasets: [{
                    label: 'Distribusi Alamat',
                    data: addressValues,
                    backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)', 'rgba(255, 205, 86, 0.6)', 'rgba(75, 192, 192, 0.6)', 'rgba(153, 102, 255, 0.6)'],
                    borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 205, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw} unit`;
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Distribusi Alamat Pelanggan'
                    }
                }
            }
        });
    }

    // Initial chart load
    updateChart("", "", "", "", "");
    // Fungsi untuk menghasilkan warna acak
    function getRandomColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgba(${r}, ${g}, ${b}, 0.7)`; // Warna dengan transparansi
    }

    // Data pelanggan dan konteks canvas
    const dataPelanggan = [
        <?php foreach ($pelanggan_list as $pelanggan) : ?> {
                alamat: "<?= $pelanggan->alamat_customer ?>",
                tglTransaksi: "<?= $pelanggan->tgl_transaksi_terakhir ?>",
                totalTransaksi: <?= $pelanggan->total_transaksi ?>
            },
        <?php endforeach; ?>
    ];

    const ctx = document.getElementById('myChart').getContext('2d');

    // Fungsi untuk memfilter data pelanggan
    function filterDataPelanggan(filterAlamat, filterTahun, filterBulan) {
        return dataPelanggan.filter(item => {
            const date = new Date(item.tglTransaksi);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;

            return (
                (filterAlamat === 'all' || item.alamat === filterAlamat) &&
                (filterTahun === 'all' || year === parseInt(filterTahun)) &&
                (filterBulan === 'all' || month === parseInt(filterBulan))
            );
        });
    }

    // Fungsi untuk mendapatkan label dinamis (tahun, bulan, atau tanggal)
    function getLabels(filteredData, filterTahun, filterBulan) {
        if (filterTahun === 'all' && filterBulan === 'all') {
            // Jika tahun dan bulan kosong, tampilkan tahun
            return [...new Set(filteredData.map(item => {
                const date = new Date(item.tglTransaksi);
                return date.getFullYear().toString();
            }))];
        } else if (filterTahun !== 'all' && filterBulan === 'all') {
            // Jika tahun dipilih tapi bulan kosong, tampilkan bulan
            return [...new Set(filteredData.map(item => {
                const date = new Date(item.tglTransaksi);
                return date.toLocaleString('id-ID', {
                    month: 'long'
                });
            }))];
        } else if (filterTahun !== 'all' && filterBulan !== 'all') {
            // Jika tahun dan bulan dipilih, tampilkan tanggal
            return filteredData.map(item => new Date(item.tglTransaksi).toLocaleDateString('id-ID', {
                day: 'numeric'
            }));
        }
    }

    // Fungsi untuk merender ulang grafik
    function updateChartPelanggan(filteredData, filterTahun, filterBulan) {
        const labels = getLabels(filteredData, filterTahun, filterBulan);
        const dataByLabel = labels.map(label => {
            // Totalkan transaksi berdasarkan label
            const total = filteredData
                .filter(item => {
                    const date = new Date(item.tglTransaksi);
                    const year = date.getFullYear().toString();
                    const month = date.toLocaleString('id-ID', {
                        month: 'long'
                    });
                    const day = date.toLocaleDateString('id-ID', {
                        day: 'numeric'
                    });

                    return (
                        (filterTahun === 'all' && year === label) ||
                        (filterTahun !== 'all' && filterBulan === 'all' && month === label) ||
                        (filterTahun !== 'all' && filterBulan !== 'all' && day === label)
                    );
                })
                .reduce((sum, item) => sum + item.totalTransaksi, 0);
            return total;
        });

        // Generate random colors for each bar
        const randomColors = labels.map(() => getRandomColor());

        myChart.data.labels = labels;
        myChart.data.datasets[0].data = dataByLabel;
        myChart.data.datasets[0].backgroundColor = randomColors; // Apply random colors
        myChart.data.datasets[0].borderColor = randomColors.map(color => color.replace('0.7', '1')); // Border with full opacity
        myChart.update();
    }

    // Inisialisasi Chart.js
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [...new Set(dataPelanggan.map(item => new Date(item.tglTransaksi).getFullYear()))], // Default: Tahun
            datasets: [{
                label: 'Total Transaksi',
                data: dataPelanggan.map(item => item.totalTransaksi),
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // Default color
                borderColor: 'rgba(75, 192, 192, 1)', // Default border color
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Distribusi Total Transaksi'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const index = context.dataIndex;
                            const label = context.label;
                            const total = myChart.data.datasets[0].data[index];
                            return `Label: ${label}, Total: ${total}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Event listener untuk filter
    document.getElementById('filterAlamat').addEventListener('change', function() {
        const filterAlamat = this.value;
        const filterTahun = document.getElementById('filterTahun').value;
        const filterBulan = document.getElementById('filterBulan').value;

        const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
        updateChartPelanggan(filteredData, filterTahun, filterBulan);
    });

    document.getElementById('filterTahun').addEventListener('change', function() {
        const filterAlamat = document.getElementById('filterAlamat').value;
        const filterTahun = this.value;
        const filterBulan = document.getElementById('filterBulan').value;

        const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
        updateChartPelanggan(filteredData, filterTahun, filterBulan);
    });

    document.getElementById('filterBulan').addEventListener('change', function() {
        const filterAlamat = document.getElementById('filterAlamat').value;
        const filterTahun = document.getElementById('filterTahun').value;
        const filterBulan = this.value;

        const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
        updateChartPelanggan(filteredData, filterTahun, filterBulan);
    });
</script>