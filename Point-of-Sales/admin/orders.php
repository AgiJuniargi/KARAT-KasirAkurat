<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Pesanan</h3>
                <form method="GET" action="" class="d-flex">
                    <div class="input-group">
                        <button class="btn btn-primary"><i class="fa-solid fa-calendar-days"></i></button>
                        <select name="sort" class="form-select w-auto" onchange="this.form.submit()">
                            <option value="desc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? '' : 'selected' ?>>Terbaru</option>
                            <option value="asc" <?= isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'selected' : '' ?>>Terlama</option>
                        </select>
                    </div>
                    <div class="input-group ms-2">
                        <input type="text" name="search" class="form-control" placeholder="Cari Invoice, Pelanggan, Kasir..." value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>

            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php
            $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
            $limit = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;
            $sort_order = isset($_GET['sort']) && $_GET['sort'] == 'asc' ? 'ASC' : 'DESC';

            $query = "SELECT orders.*, admins.name AS admin_name FROM orders 
                      JOIN admins ON orders.order_placed_by_id = admins.id 
                      WHERE orders.invoice_no LIKE '%$search%' 
                      OR orders.customer_name LIKE '%$search%' 
                      OR admins.name LIKE '%$search%' 
                      ORDER BY orders.order_date $sort_order 
                      LIMIT $limit OFFSET $offset";

            $total_query = "SELECT COUNT(*) AS total FROM orders 
                            JOIN admins ON orders.order_placed_by_id = admins.id 
                            WHERE orders.invoice_no LIKE '%$search%' 
                            OR orders.customer_name LIKE '%$search%' 
                            OR admins.name LIKE '%$search%'";

            $total_result = mysqli_query($conn, $total_query);
            $total_row = mysqli_fetch_assoc($total_result);
            $total_pages = ceil($total_row['total'] / $limit);

            $orders = mysqli_query($conn, $query);
            if ($orders) {
                $i = $offset + 1;
                if (mysqli_num_rows($orders) > 0) {
            ?>
                    <table class="table table-striped text-center table-bordered align-items-center justify-content-center">
                        <thead class="text-white" style="background-color:#333333">
                            <tr>
                                <th>#</th>
                                <th>No. Invoice</th>
                                <th>Nama Pelanggan</th>
                                <th>Total Harga</th>
                                <th>Pembayaran</th>
                                <th>Tanggal</th>
                                <th>Nama Kasir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $orderItem) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $orderItem['invoice_no']; ?></td>
                                    <td><?= $orderItem['customer_name']; ?></td>
                                    <td>Rp<?= number_format($orderItem['total_amount']); ?></td>
                                    <td><?= $orderItem['payment_method']; ?></td>
                                    <td><?= date('d-m-Y', strtotime($orderItem['order_date'])); ?></td>
                                    <td><?= $orderItem['admin_name']; ?></td>
                                    <td>
                                        <a href="orders-view.php?invoice_no=<?= $orderItem['invoice_no']; ?>" class="btn btn-success mb-0 px-2 btn-sm"><i class="fa-solid fa-eye me-1"></i>View</a>
                                        <a href="orders-view-print.php?invoice_no=<?= $orderItem['invoice_no']; ?>" class="btn btn-warning mb-0 px-2 btn-sm"><i class="fa-solid fa-print me-1"></i>Print</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="col-md-12">
                        <hr style="height: 3px; border: 0px; background-color: #000000;">
                    </div>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <!-- Tombol Previous -->
                            <li class="page-item <?= ($page <= 1) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?search=<?= $search; ?>&sort=<?= $sort_order; ?>&page=<?= $page - 1; ?>">&laquo; Previous</a>
                            </li>

                            <!-- Nomor Halaman -->
                            <?php for ($p = 1; $p <= $total_pages; $p++) : ?>
                                <li class="page-item <?= ($p == $page) ? 'active' : ''; ?>">
                                    <a class="page-link" href="?search=<?= $search; ?>&sort=<?= $sort_order; ?>&page=<?= $p; ?>"><?= $p; ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Tombol Next -->
                            <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?search=<?= $search; ?>&sort=<?= $sort_order; ?>&page=<?= $page + 1; ?>">Next &raquo;</a>
                            </li>
                        </ul>
                    </nav>

            <?php
                } else {
                    echo '<h5>Tidak ada hasil ditemukan.</h5>';
                }
            } else {
                echo '<h5>Ada yang tidak beres.</h5>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>