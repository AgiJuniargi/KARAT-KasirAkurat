<?php 
include('includes/header.php'); 
if(!isset($_SESSION['productItems'])){
    echo '<script>window.location.href = "order-create.php"; </script>';
}
?>

<!-- Modal -->
<div class="modal fade" id="orderSuccessModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h5 id="orderPlaceSuccesMessage"></h5>
        <a href="orders.php" type="button" class="btn btn-secondary"><i class="fa-solid fa-xmark me-2"></i>Tutup</a>
        <button type="button" onclick="printInvoiceArea()" class="btn btn-warning"><i class="fa-solid fa-print me-2"></i>Print</button>
        <button type="button" onclick="downloadPDF('<?= $_SESSION['invoice_no']; ?>')" class="btn btn-danger fw-semibold"><i class="fa-solid fa-file-pdf me-2"></i>Download PDF</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-header bg-white">
                    <h3 class="mb-0 fw-bold">Ringkasan Pesanan
                        <a href="order-create.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali ke Laman Buat Pesanan</a>
                    </h3>
                </div>
                <div class="card-body">

                    <?php alertMessages(); ?>

                    <div id="invoiceArea">
                        <?php
                                $customerName = validate($_SESSION['customer_name']);
                                $invoiceNo = validate($_SESSION['invoice_no']);
                                $payment = validate($_SESSION['payment_method']);
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
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">No. <?= $invoiceNo; ?></p>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;"><?= date('d M Y'); ?></p>
                                    </td>
                                    <td align="end">
                                        <h5 style="font-size: 20px; line-height: 30px; margin: 0px; padding: 0;"><b>Customer.</b></h5>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Atas Nama Kak <?= $customerName; ?></p>
                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Pembayaran via <?= $payment; ?></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php
                        if(isset($_SESSION['productItems']))
                        {
                            $sessionProducts = $_SESSION['productItems'];
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
                                                $totalAmount = 0;

                                                foreach($sessionProducts as $key => $row) :

                                                $totalAmount += $row['price'] * $row['quantity']
                                            ?>
                                            <tr>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $i++;?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['name'];?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= number_format($row['price'],0);?></td>
                                                <td style="border-bottom: 1px solid #ccc;"><?= $row['quantity'];?></td>
                                                <td style="border-bottom: 1px solid #ccc;" class="fw-bold">
                                                    <?= number_format($row['price'] * $row['quantity'], 0) ;?> 
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold;">Grand Total: </td>
                                                <td colspan="1" style="font-weight: bold;">Rp<?= number_format($totalAmount,0);?></td>
                                            </tr>
                                            <!-- <tr>
                                                <td colspan="5"></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="center">
                                                    <h5 class="mt-5">Thank you.</h5>
                                                    <p >Have a Great Day!</p>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                        
                                    </table>
                                </div>
                            <?php
                        }else{
                            echo '<h5 class="text-center">Tidak ada barang yang ditambahkan.</h5>';
                        }
                        
                        ?>
                    </div>

                    <?php if(isset($_SESSION['productItems'])) : ?>
                    <div class="mt-4 text-end">
                        <button type="button" id="saveOrder" class="btn btn-success px-4"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Transaksi</button>
                    </div>
                    <?php endif; ?>


                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>