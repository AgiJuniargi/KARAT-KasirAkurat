<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mt-4 fw-bold">Dashboard</h1>
            <?php alertMessages(); ?>
        </div>

        <!-- Card Jumlah Kategori, Produk, dan Admin -->
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 shadow bg-primary text-white">
                <p class="text-sm mb-0 text-capitalize fw-bold">Jumlah Kategori</p>
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-layer-group"></i> <?= getCount('categories'); ?></h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 shadow text-white" style="background-color: #1E1E1E;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Jumlah Produk</p>
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-box"></i> <?= getCount('products'); ?></h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 shadow text-white" style="background-color: #FF9800;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Jumlah Admin</p>
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-user"></i> <?= getCount('admins'); ?></h4>
            </div>
        </div>

        <!-- Card Pesanan -->
        <div class="col-md-12">
            <hr style="height: 3px; border: 0px; background-color: #000000;">
            <h3 class="fw-bold">Pesanan & Transaksi</h3>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 shadow text-white" style="background-color: #28A745;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Pendapatan Hari ini</p>
                <h4 class="fw-bold mb-0">
                    <?php
                    $todayDate = date('Y-m-d');
                    $todayRevenueQuery = mysqli_query($conn, "SELECT SUM(total_amount) as total_revenue FROM orders WHERE order_date='$todayDate'");

                    if ($todayRevenueQuery) {
                        $todayRevenueData = mysqli_fetch_assoc($todayRevenueQuery);
                        $todayRevenue = $todayRevenueData['total_revenue'];

                        if ($todayRevenue > 0) {
                            echo 'Rp' . number_format($todayRevenue);
                        } else {
                            echo 'Rp0,00';
                        }
                    } else {
                        echo 'Ada yang tidak beres.';
                    }
                    ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 shadow text-white" style="background-color: #0DFF00;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Banyak Transaksi Hari Ini</p>
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-clipboard-list"></i> 
                    <?php
                    $todayDate = date('Y-m-d');
                    $todayOrders = mysqli_query($conn, "SELECT * FROM orders WHERE order_date='$todayDate' ");
                    if ($todayOrders) {
                        if (mysqli_num_rows($todayOrders) > 0) {
                            $todayCountOrders = mysqli_num_rows($todayOrders);
                            echo $todayCountOrders;
                        } else {
                            echo "0";
                        }
                    } else {
                        echo 'Ada yang tidak beres.';
                    }
                    ?>
                </h4>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card card-body p-3 border-0 text-white" style="background-color: #000090;">
                <p class="text-sm mb-0 text-capitalize fw-bold">Total Seluruh Transaksi</p>
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-clipboard-list"></i> <?= getCount('orders'); ?></h4>
            </div>
        </div>

        <!-- Grafik Transaksi -->
        <div class="col-md-12 mb-4">
            <div class="card card-body p-3">
                <h4 class="fw-bold">Total Transaksi dalam 7 Hari Terakhir</h4>
                <?php
                // Definisikan tanggal hari ini
                $todayDate = date('Y-m-d');

                // Hitung tanggal 7 hari yang lalu
                $lastWeekDate = date('Y-m-d', strtotime('-6 days', strtotime($todayDate)));

                // Query untuk mengambil jumlah transaksi per hari dalam 7 hari terakhir
                $queryOrders = "SELECT 
                DATE(order_date) as order_day, 
                COUNT(*) as total_orders 
                FROM orders 
                WHERE order_date BETWEEN '$lastWeekDate' AND '$todayDate' 
                GROUP BY DATE(order_date) 
                ORDER BY order_day ASC";

                $resultOrders = mysqli_query($conn, $queryOrders);

                // Query untuk mengambil total pendapatan per hari dalam 7 hari terakhir
                $queryRevenue = "SELECT 
                DATE(order_date) as order_day, 
                SUM(total_amount) as total_revenue 
                FROM orders 
                WHERE order_date BETWEEN '$lastWeekDate' AND '$todayDate' 
                GROUP BY DATE(order_date) 
                ORDER BY order_day ASC";

                $resultRevenue = mysqli_query($conn, $queryRevenue);

                // Siapkan array untuk menyimpan data
                $labels = []; // Label tanggal dalam format Y-m-d
                $dataOrders = [];   // Jumlah transaksi
                $dataRevenue = [];  // Total pendapatan

                // Loop hasil query orders dan masukkan ke dalam array
                while ($row = mysqli_fetch_assoc($resultOrders)) {
                    $labels[] = $row['order_day']; // Simpan tanggal dalam format Y-m-d
                    $dataOrders[] = $row['total_orders']; // Jumlah transaksi
                }

                // Loop hasil query revenue dan masukkan ke dalam array
                while ($row = mysqli_fetch_assoc($resultRevenue)) {
                    $dataRevenue[] = $row['total_revenue']; // Total pendapatan
                }

                // Buat array untuk semua tanggal dalam 7 hari terakhir (format Y-m-d)
                $allDates = [];
                for ($i = 6; $i >= 0; $i--) {
                    $allDates[] = date('Y-m-d', strtotime("-$i days", strtotime($todayDate)));
                }

                // Lengkapi data yang kurang dari 7 hari
                foreach ($allDates as $date) {
                    if (!in_array($date, $labels)) {
                        // Tambahkan tanggal yang hilang ke dalam array
                        array_push($labels, $date);
                        array_push($dataOrders, 0);
                        array_push($dataRevenue, 0);
                    }
                }

                // Urutkan array berdasarkan tanggal (format Y-m-d)
                array_multisort($labels, $dataOrders, $dataRevenue);

                // Konversi tanggal ke format d M untuk tampilan di chart
                $labelsFormatted = array_map(function ($date) {
                    return date('d M', strtotime($date));
                }, $labels);
                ?>
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>

<!-- Sertakan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = <?php echo json_encode($labelsFormatted); ?>;
    const dataOrders = <?php echo json_encode($dataOrders); ?>;
    const dataRevenue = <?php echo json_encode($dataRevenue); ?>;

    const config = {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                    label: 'Jumlah Transaksi',
                    data: dataOrders,
                    borderColor: 'rgba(54, 162, 235, 1)', // Biru
                    backgroundColor: 'rgba(54, 162, 235, 0.2)', // Biru transparan
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y-axis-orders'
                },
                {
                    label: 'Pendapatan (Rp)',
                    data: dataRevenue,
                    borderColor: 'rgba(255, 206, 86, 1)', // Kuning
                    backgroundColor: 'rgba(255, 206, 86, 0.2)', // Kuning transparan
                    fill: true,
                    tension: 0.4,
                    yAxisID: 'y-axis-revenue'
                }
            ]
        },
        options: {
            scales: {
                'y-axis-orders': {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Transaksi'
                    }
                },
                'y-axis-revenue': {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Pendapatan (Rp)'
                    },
                    grid: {
                        drawOnChartArea: false
                    }
                }
            },
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    };

    const transactionChart = new Chart(
        document.getElementById('transactionChart'),
        config
    );
</script>