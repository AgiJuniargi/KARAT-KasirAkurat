<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow mb-4">
        <div class="card-body">
                <h3 class="fw-bold">Rincian Transaksi
                    <a href="orders.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
                    <a href="orders-view-print.php?invoice_no=<?= $_GET['invoice_no']; ?>" class="btn btn-danger float-end fw-semibold me-2"><i class="fa-solid fa-print me-2"></i>Print</a>
                </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <?php
            if (isset($_GET['invoice_no'])) {

                if ($_GET['invoice_no'] == '') {
            ?>
                    <div class="text-center py-5">
                        <h5>Nomor Invoice Tidak Ditemukan.</h5>
                        <div>
                            <a href="orders.php" class="btn btn-primary mt-4 w-25">Kembali ke Riwayat Transaksi</a>
                        </div>
                    </div>
                    <?php
                    return false;
                }
                $invoiceNo = validate($_GET['invoice_no']);

                $query = "SELECT orders.*, admins.name AS admin_name, admins.email as admin_email, admins.phone as admin_phone FROM orders 
                    JOIN admins ON orders.order_placed_by_id = admins.id WHERE invoice_no='$invoiceNo'";
                $orders = mysqli_query($conn, $query);
                if ($orders) {
                    if (mysqli_num_rows($orders) > 0) {
                        $orderData = mysqli_fetch_assoc($orders);
                        $orderId = $orderData['id'];

                    ?>
                        <div class="card card-body shadow-sm border-1 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Detail Transaksi</h4>
                                    <label class="mb-1">
                                        No. Invoice :
                                        <span class="fw-bold"><?= $orderData['invoice_no']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Tanggal Transaksi :
                                        <span class="fw-bold"><?= date('d-m-Y', strtotime($orderData['order_date'])); ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Nama Pelanggan :
                                        <span class="fw-bold"><?= $orderData['customer_name']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Metode Pembayaran :
                                        <span class="fw-bold"><?= $orderData['payment_method']; ?></span>
                                    </label>
                                    <br>
                                </div>
                                <div class="col-md-6 text-end">
                                    <h4>Detail Admin/Staff</h4>
                                    <label class="mb-1">
                                        Nama :
                                        <span class="fw-bold"><?= $orderData['admin_name']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Email :
                                        <span class="fw-bold"><?= $orderData['admin_email']; ?></span>
                                    </label>
                                    <br>
                                    <label class="mb-1">
                                        Nomor Telepon :
                                        <span class="fw-bold"><?= $orderData['admin_phone']; ?></span>
                                    </label>
                                    <br>
                                </div>

                                <?php
                                $i = 1;
                                $orderItemQuery = "SELECT oi.price as orderItemPrice, oi.quantity as orderItemQuantity, o.*, oi.*, p.*
                                                   FROM orders as o, order_items as oi, products as p
                                                   WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.invoice_no='$invoiceNo'";
                                $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                                if ($orderItemsRes) {
                                    if (mysqli_num_rows($orderItemsRes) > 0) {
                                ?>
                                        <h4 class="my-3">Detail Barang Pesanan</h4>
                                        <table class="table table-bordered table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Produk</th>
                                                    <th>Harga</th>
                                                    <th>Jumlah</th>
                                                    <th>Total Harga</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($orderItemsRes as $orderItemRow) : ?>
                                                    <tr>
                                                        <td><?= $i++; ?></td>
                                                        <td>
                                                            <?= $orderItemRow['name']; ?>
                                                        </td>
                                                        <td>
                                                            Rp<?= number_format($orderItemRow['orderItemPrice']); ?>
                                                        </td>
                                                        <td>
                                                            <?= $orderItemRow['orderItemQuantity']; ?>
                                                        </td>
                                                        <td>
                                                            Rp<?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity']); ?>
                                                        </td>

                                                    </tr>


                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="4" class="text-end fw-bold">Grand Total: </td>
                                                    <td colspan="1" class="text-center fw-bold">Rp<?= number_format($orderItemRow['total_amount']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                <?php
                                    } else {
                                        echo '<h5>Data Kosong.</h5>';
                                        return false;
                                    }
                                } else {
                                    echo '<h5>Ada yang tidak beres.</h5>';
                                    return false;
                                }

                                ?>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<h5>Data Kosong.</h5>';
                        return false;
                    }
                } else {
                    echo '<h5>Ada yang tidak beres.</h5>';
                }
            } else {
                ?>
                <div class="text-center py-5">
                    <h5>Nomor Invoice Tidak Ditemukan.</h5>
                    <div>
                        <a href="orders.php" class="btn btn-primary mt-4 w-25">Kembali ke Riwayat Transaksi</a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>