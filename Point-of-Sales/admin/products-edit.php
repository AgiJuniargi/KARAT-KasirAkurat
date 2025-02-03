<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 mb-4 shadow">
        <div class="card-body">
            <h3 class="fw-bold">Edit Produk
                <a href="products.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">

                <?php
                $paramValue = checkParamId('id');
                if (!is_numeric($paramValue)) {
                    echo '<h5>Tipe data Id bukan integer.</h5>';
                    return false;
                }

                $product = getById('products', $paramValue);
                if ($product) {
                    if ($product['status'] == 200) {
                ?>

                        <input type="hidden" name="product_id" value="<?= $product['data']['id']; ?>" />
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Pilih Kategori *</label>
                                <select name="category_id" id="" class="form-select" style="background-color: #D9D9D9;">
                                    <option value="">-- Pilih Kategori --</option>
                                    <?php
                                    $categories = getAll('categories');
                                    if ($categories) {
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $cateItem) {
                                    ?>
                                                <option
                                                    value="<?= $cateItem['id']; ?>"
                                                    <?= $product['data']['category_id'] == $cateItem['id'] ? 'selected' : ''; ?>>
                                                    <?= $cateItem['name']; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                            echo '<option value="">No Categories Found.</option>';
                                        }
                                    } else {
                                        echo '<option value="">Sepertinya ada yang salah.</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Nama Produk *</label>
                                <input type="text" name="name" required value="<?= $product['data']['name']; ?>" class="form-control" style="background-color: #D9D9D9;" />
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="">Harga *</label>
                                <input type="text" name="price" required value="<?= $product['data']['price']; ?>" class="form-control" style="background-color: #D9D9D9;" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Stok *</label>
                                <input type="number" name="quantity" required value="<?= $product['data']['quantity']; ?>" class="form-control" style="background-color: #D9D9D9;" />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Gambar Produk</label>
                                <input type="file" name="image" class="form-control" style="background-color: #D9D9D9;"/>
                                <center>
                                    <img src="../<?= $product['data']['image']; ?>" style="width:70px;height:70px;" class="text-center" alt="NO IMAGE">
                                </center>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">Deskripsi</label>
                                <textarea name="description" class="form-control" rows="3" style="background-color: #D9D9D9;" placeholder="Masukkan Deskripsi Produk (Opsional)"><?= $product['data']['description']; ?></textarea>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label for="">Status (Unchecked=Visible, Cheked=Hidden)</label>
                                <br>
                                <input class="form-check-input border-0" type="checkbox" name="status" <?= $product['data']['status'] == true ? 'checked' : ''; ?> style="width:30px;height:30px;background-color:#D9D9D9;">
                            </div>

                            <div class="col-md-6 text-end mb-2">
                                <br>
                                <button type="submit" name="updateProduct" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan</button>
                            </div>
                        </div>

                <?php
                    } else {
                        echo '<h5>' . $product['message'] . '</h5>';
                    }
                } else {
                    echo ' <h5>Ada yang Tidak Beres.</h5>';
                    return false;
                }
                ?>

            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>