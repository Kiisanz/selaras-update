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
                            $uniqueProducts = [];
                            foreach ($top_selling as $value) {
                                $productKey = $value['nama_produk'] . ' (' . $value['size'] . ')';
                                if (!isset($uniqueProducts[$productKey])) {
                                    $uniqueProducts[$productKey] = true;
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

                        <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                            <label for="dateFilter" style="font-size: 14px; margin-bottom: 4px;">Pilih Tanggal:</label>
                            <input type="date" id="dateFilter" class="form-control" onchange="filterData()" />
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
            <!-- Chart Card -->
            <div class="col-12 col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">Distribusi Pelanggan Jasa Jahit Selaras</h5>
                        <canvas id="myChart" style="width: 100%; max-height: 300px;"></canvas>
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

    // document.querySelectorAll('#filterAlamat, #filterTahun, #filterBulan, #dateFilter').forEach((element) => {
    //     element.addEventListener('change', filterData);
    // });

    // function filterData() {
    //     const filterAlamat = document.getElementById('filterAlamat').value;
    //     const filterTahun = document.getElementById('filterTahun').value;
    //     const filterBulan = document.getElementById('filterBulan').value;
    //     const dateFilterValue = document.getElementById('dateFilter')?.value || '';
    //     const productFilterValue = document.getElementById('productFilter')?.value || '';


    //     let yearFilterValue = '';
    //     let monthFilterValue = '';
    //     let dayFilterValue = '';

    //     if (dateFilterValue) {
    //         const [year, month, day] = dateFilterValue.split('-');
    //         yearFilterValue = year;
    //         monthFilterValue = month;
    //         dayFilterValue = day;
    //     }
    //     const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);

    //     updateChartPelanggan(filteredData, filterTahun, filterBulan);
    //     updateChart(productFilterValue, addressFilterValue, yearFilterValue, monthFilterValue, dayFilterValue);
    // }

    function filterData() {
        const productFilterValue = document.getElementById('productFilter')?.value || '';
        const addressFilterValue = document.getElementById('addressFilter')?.value || '';
        const dateFilterValue = document.getElementById('dateFilter')?.value || '';

        let yearFilterValue = '';
        let monthFilterValue = '';
        let dayFilterValue = '';

        if (dateFilterValue) {
            const [year, month, day] = dateFilterValue.split('-');
            yearFilterValue = year;
            monthFilterValue = month;
            dayFilterValue = day;
        }

        updateChart(productFilterValue, addressFilterValue, yearFilterValue, monthFilterValue, dayFilterValue);
        const filteredData = filterDataPelanggan(addressFilterValue, yearFilterValue, monthFilterValue);
        updateChartPelanggan(filteredData, yearFilterValue, monthFilterValue);

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

            const isProductMatch = (productFilterValue === "" || productKey === productFilterValue);
            const isAddressMatch = (addressFilterValue === "" || allAddresses[index] === addressFilterValue);
            const isYearMatch = (yearFilterValue === "" || new Date(allDates[index]).getFullYear() == yearFilterValue);
            const isMonthMatch = (monthFilterValue === "" || new Date(allDates[index]).getMonth() + 1 == monthFilterValue);
            const isDayMatch = (dayFilterValue === "" || new Date(allDates[index]).getDate() == dayFilterValue);

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
                        ticks: {
                            callback: function(value) {
                                return value.toFixed(0);
                            }
                        },
                        title: {
                            display: true,
                            text: 'Jumlah Terjual'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Produk (Nama & Ukuran)'
                        },
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            callback: function(value, index, values) {
                                const label = filteredProductNames[index];
                                return label.length > 15 ? label.slice(0, 14) + '...' : label;
                            }
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
                                return `${context.label}: ${context.raw} pelanggan`;
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

    function getRandomColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgba(${r}, ${g}, ${b}, 0.7)`;
    }

    const dataPelanggan = [
        <?php foreach ($pelanggan_list as $pelanggan) : ?> {
                alamat: "<?= $pelanggan->alamat_customer ?>",
                tglTransaksi: "<?= $pelanggan->tgl_transaksi_terakhir ?>",
                totalTransaksi: <?= $pelanggan->total_transaksi ?>
            },
        <?php endforeach; ?>
    ];

    const ctx = document.getElementById('myChart').getContext('2d');

    function filterDataPelanggan(filterAlamat, filterTahun, filterBulan) {
        return dataPelanggan.filter(item => {
            const date = new Date(item.tglTransaksi);
            const year = date.getFullYear();
            const month = date.getMonth() + 1;

            const validFilterAlamat = filterAlamat && filterAlamat !== 'all' ? item.alamat === filterAlamat : true;
            const validFilterTahun = filterTahun && filterTahun !== 'all' ? year === parseInt(filterTahun) : true;
            const validFilterBulan = filterBulan && filterBulan !== 'all' ? month === parseInt(filterBulan) : true;

            if (!filterAlamat && !filterTahun && !filterBulan) {
                return true;
            }

            return validFilterAlamat && validFilterTahun && validFilterBulan;
        });
    }



    function getLabels(filteredData, filterTahun, filterBulan) {
        filterTahun = filterTahun?.trim() === '' || !filterTahun ? 'all' : filterTahun;
        filterBulan = filterBulan?.trim() === '' || !filterBulan ? 'all' : filterBulan;

        let labels = [];

        if (filterTahun === 'all' && filterBulan === 'all') {
            labels = [...new Set(filteredData.map(item => new Date(item.tglTransaksi).getFullYear()))];
        } else if (filterTahun !== 'all' && filterBulan === 'all') {
            labels = [...new Set(
                filteredData.map(item =>
                    new Date(item.tglTransaksi).toLocaleString('id-ID', {
                        month: 'long'
                    })
                )
            )];
        } else if (filterTahun !== 'all' && filterBulan !== 'all') {
            labels = [...new Set(
                filteredData
                .filter(item => {
                    const date = new Date(item.tglTransaksi);
                    return date.getMonth() + 1 === parseInt(filterBulan);
                })
                .map(item => new Date(item.tglTransaksi).getDate())
            )];
        }

        return labels;
    }


    function updateChartPelanggan(filteredData, filterTahun, filterBulan) {
        const isTahunEmpty = !filterTahun || filterTahun === "";
        const isBulanEmpty = !filterBulan || filterBulan === "";
        const labels = getLabels(filteredData, filterTahun, filterBulan);

        const dataByLabel = labels.map(label => {
            const filteredDataByLabel = filteredData
                .filter(item => {
                    const date = new Date(item.tglTransaksi);
                    const year = date.getFullYear();
                    const month = date.getMonth() + 1;
                    const day = date.getDate();

                    if (isTahunEmpty && isBulanEmpty) {
                        return year === label;
                    } else {
                        return (
                            (isTahunEmpty || year === (isTahunEmpty ? year : parseInt(filterTahun))) &&
                            (isBulanEmpty || month === parseInt(filterBulan)) &&
                            (isBulanEmpty || day === label)
                        );
                    }
                });

            const total = filteredDataByLabel.reduce((sum, item) => sum + item.totalTransaksi, 0);
            return total;
        });


        const randomColors = labels.map(() => getRandomColor());
        myChart.data.labels = labels;
        myChart.data.datasets[0].data = dataByLabel;
        myChart.data.datasets[0].backgroundColor = randomColors;
        myChart.data.datasets[0].borderColor = randomColors.map(color => color.replace('0.7', '1'));
        let xAxisTitle = 'Waktu';
        if (isBulanEmpty) {
            xAxisTitle = 'Tahun';
        } else if (!isBulanEmpty && !isTahunEmpty) {
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
            xAxisTitle = `Tanggal di bulan ${months[parseInt(filterBulan) - 1]}`;
        }

        myChart.options.scales.x.title.text = xAxisTitle;
        myChart.update();
    }


    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [...new Set(dataPelanggan.map(item => new Date(item.tglTransaksi).getFullYear()))],
            datasets: [{
                label: 'Total Transaksi',
                data: dataPelanggan.map(item => item.totalTransaksi),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
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
                            return `Label: ${label}, Total: ${total} pelanggan`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Waktu (Tahun/Bulan/Tanggal)'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toFixed(0);
                        }
                    },
                    title: {
                        display: true,
                        text: 'Total Pelanggan (dalam QTY)'
                    }
                }
            }
        }
    });

    updateChart("", "", "", "", "");
    const filteredData = filterDataPelanggan();
    updateChartPelanggan(filteredData);

    // document.getElementById('filterAlamat').addEventListener('change', function() {
    //     const filterAlamat = this.value;
    //     const filterTahun = document.getElementById('filterTahun').value;
    //     const filterBulan = document.getElementById('filterBulan').value;

    //     const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
    //     updateChartPelanggan(filteredData, filterTahun, filterBulan);
    // });

    // document.getElementById('filterTahun').addEventListener('change', function() {
    //     const filterAlamat = document.getElementById('filterAlamat').value;
    //     const filterTahun = this.value;
    //     const filterBulan = document.getElementById('filterBulan').value;

    //     const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
    //     updateChartPelanggan(filteredData, filterTahun, filterBulan);
    // });

    // document.getElementById('filterBulan').addEventListener('change', function() {
    //     const filterAlamat = document.getElementById('filterAlamat').value;
    //     const filterTahun = document.getElementById('filterTahun').value;
    //     const filterBulan = this.value;

    //     const filteredData = filterDataPelanggan(filterAlamat, filterTahun, filterBulan);
    //     updateChartPelanggan(filteredData, filterTahun, filterBulan);
    // });
</script>