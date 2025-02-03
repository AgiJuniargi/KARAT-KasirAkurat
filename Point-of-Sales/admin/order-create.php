<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h3 class="mb-0 fw-bold">Buat Pesanan
                <a href="orders.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-eye me-2"></i>Lihat Riwayat Transaksi</a>
            </h3>

            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <form action="orders-code.php" method="POST">

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="">Pilih Produk</label>
                        <select name="product_id" id="" class="form-select mySelect2">
                            <option value="">-- Pilih Produk --</option>
                            <?php
                            $product = getAll('products');
                            if ($product) {
                                if (mysqli_num_rows($product) > 0) {
                                    foreach ($product as $prodItem) {
                            ?>
                                        <option value="<?= $prodItem['id'] ?>"><?= $prodItem['name'] ?></option>
                            <?php
                                    }
                                } else {
                                    echo '<option value="">Tidak ada produk yang ditemukan!</option>';
                                }
                            } else {
                                echo '<option value="">Ada yang tidak beres.</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="">Jumlah Produk</label>
                        <input type="number" name="quantity" value="1" class="form-control" id="" style="background-color: #D9D9D9;" />

                    </div>

                    <div class="col-md-3 mb-3">
                        <br />
                        <button type="submit" name="addItem" class="btn btn-success fw-semibold"><i class="fa-solid fa-plus me-2"></i>Tambah Barang</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header bg-white">
            <h3 class="fw-bold">Produk</h3>
        </div>

        <div class="card-body" id="productArea">
            <?php
            if (isset($_SESSION['productItems'])) {
                $sessionProducts = $_SESSION['productItems'];
                if (empty($sessionProducts)) {
                    unset($_SESSION['productItemIds']);
                    unset($_SESSION['productItems']);
                }
            ?>
                <div id="productContent">
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered table-striped">
                            <thead style="background-color: #333333;" class="text-white">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Beli</th>
                                    <th>Total Harga</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($sessionProducts as $key => $item) :
                                ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $item['name']; ?></td>
                                        <td>Rp<?= number_format($item['price'], 0); ?></td>
                                        <td>
                                            <div class="input-group qtyBox">
                                                <input type="hidden" value="<?= $item['product_id']; ?>" class="prodId">
                                                <button class="input-group-text decrement">-</button>
                                                <input type="text" class="qty quantityInput" value="<?= $item['quantity']; ?>" disabled />
                                                <button class="input-group-text increment">+</button>
                                            </div>
                                        </td>
                                        <td>Rp<?= number_format($item['price'] * $item['quantity'], 0); ?></td>
                                        <td>
                                            <a href="order-item-delete.php?index=<?= $key; ?>" class="btn btn-danger fw-semibold">
                                                <i class="fa-solid fa-trash me-2"></i>Remove
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-2">
                        <hr />
                        <div class="row">
                            <div class="col-md-4">
                                <label>Metode Pembayaran</label>
                                <select id="payment_method" class="form-select" style="background-color: #D9D9D9;">
                                    <option value="">-- Pilih Metode Pembayaran --</option>
                                    <option value="Uang Tunai">Uang Tunai</option>
                                    <option value="QRIS">QRIS</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Nama Pelanggan</label>
                                <input style="background-color: #D9D9D9;" type="text" name="customer_name" id="customer_name" class="form-control" placeholder="Masukkan Nama Pelanggan" required />
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button class="btn btn-warning w-100 confirmOrder"><b>Konfirmasi</b></button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            } else {
                echo '<h5>Belum ada barang yang ditambahkan.</h5>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>