<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header">
            <h3 class="fw-bold">Print Invoice
                <a href="orders.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
        </div>
        <div class="card-body">

            <div id="invoiceArea">
                <?php
                if (isset($_GET['invoice_no'])) {
                    $invoiceNo = validate($_GET['invoice_no']);
                    if ($invoiceNo == '') {
                ?>
                        <div class="text-center py-5">
                            <h5>Nomor Invoice Tidak Ditemukan.</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary mt-4 w-25">Kembali ke Riwayat Transaksi</a>
                            </div>
                        </div>
                    <?php
                    }

                    $orderQuery = "SELECT * FROM orders
                               WHERE invoice_no='$invoiceNo' LIMIT 1";
                    $orderQueryRes = mysqli_query($conn, $orderQuery);
                    if (!$orderQueryRes) {
                        echo "<h5>Ada yang tidak beres.</h5>";
                        return false;
                    }

                    if (mysqli_num_rows($orderQueryRes) > 0) {
                        $orderDataRow = mysqli_fetch_assoc($orderQueryRes);
                    ?>
                        <table style="width: 100%; margin-bottom: 20px;">
                            <tbody>
                                <tr>
                                    <td style="text-align: center;" colspan="2">
                                        <h1 style="margin: 2px; padding: 0;"><b>Tokokita.co</b></h1>
                                        <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">Jln. Tamansari No. 27 Bandung, Jawa Barat</p>
                                        <p style="font-size: 16px; line-height: 24px; margin: 2px; padding: 0;">(022) 12345678</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;"><b>Invoice.</b></h5>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">No. <?= $orderDataRow['invoice_no']; ?></p>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;"><?= date('d M Y', strtotime($orderDataRow['order_date'])); ?></p>
                                    </td>
                                    <td align="end">
                                        <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;"><b>Customer.</b></h5>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Atas Nama Kak <?= $orderDataRow['customer_name']; ?></p>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Pembayaran via <?= $orderDataRow['payment_method']; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                    } else {
                        echo "<h5>Data Kosong.</h5>";
                        return false;
                    }

                    $orderItemQuery = "SELECT oi.price as orderItemPrice, oi.quantity as orderItemQuantity, o.*, oi.*, p.* 
                                   FROM orders o, order_items oi, products p
                                   WHERE oi.order_id=o.id AND p.id=oi.product_id AND o.invoice_no='$invoiceNo'";

                    $orderItemQueryRes = mysqli_query($conn, $orderItemQuery);
                    if ($orderItemQueryRes) {
                        if (mysqli_num_rows($orderItemQueryRes) > 0) {
                        ?>
                            <div class="table-responsive mb-3">
                                <table style="width: 100%;" cellpadding="5">
                                    <thead>
                                        <tr>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">#</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;">Nama Produk</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Harga</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="10%">Jumlah</th>
                                            <th align="start" style="border-bottom: 1px solid #ccc;" width="17%">Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        foreach ($orderItemQueryRes as $key => $row) :
                                        ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['orderItemPrice'], 0); ?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity']; ?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['orderItemPrice'] * $row['orderItemQuantity'], 0); ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        <tr>
                                            <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                            <td colspan="1" style="font-weight: bold;">Rp<?= number_format($row['total_amount'], 0); ?></td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                    <?php
                        } else {
                            echo "<h5>Data Kosong.</h5>";
                            return false;
                        }
                    } else {
                        echo "<h5>Ada yang tidak beres.</h5>";
                        return false;
                    }
                } else {
                    ?>
                    <div class="text-center py-5">
                        <h5>Nomor Invoice Tidak Ditemukan Pada Parameter.</h5>
                        <div>
                            <a href="orders.php" class="btn btn-primary mt-4 w-25">Kembali ke Riwayat Transaksi</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <div class="mt-4 text-end">
                <button class="px-4 mx-1 btn btn-primary float-end fw-semibold me-2" onclick="printInvoiceArea()"><i class="fa-solid fa-print me-2"></i>Print</a></button>
                <button class="btn btn-danger px-4 mx-1" onclick="downloadPDF('<?= $orderDataRow['invoice_no']; ?>')"><i class="fa-solid fa-file-pdf me-2"></i>Download PDF</button>
            </div>

        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>