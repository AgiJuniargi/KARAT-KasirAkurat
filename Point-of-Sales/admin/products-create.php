<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow mb-4">
        <div class="card-body">
            <h3 class="fw-bold">Tambah Produk
                <a href="products.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <form action="code.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Pilih Kategori *</label>
                        <select name="category_id" id="" class="form-select" style="background-color: #D9D9D9;">
                            <option value="">-- Pilih Kategori Produk --</option>
                            <?php
                            $categories = getAll('categories');
                            if ($categories) {
                                if (mysqli_num_rows($categories) > 0) {
                                    foreach ($categories as $cateItem) {
                                        echo '<option value="' . $cateItem['id'] . '">' . $cateItem['name'] . '</option>';
                                    }
                                } else {
                                    echo '<option value="">Kategori tidak ditemukan.</option>';
                                }
                            } else {
                                echo '<option value="">Sepertinya ada yang salah.</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Nama Produk *</label>
                        <input type="text" name="name" required class="form-control" placeholder="Masukkan Nama Produk" style="background-color: #D9D9D9;" />
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="">Harga *</label>
                        <input type="text" name="price" required class="form-control" style="background-color: #D9D9D9;" placeholder="Masukkan Harga Produk" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Stok *</label>
                        <input type="number" name="quantity" required class="form-control" style="background-color: #D9D9D9;" placeholder="Masukkan Jumlah/Stok Produk" />
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="">Gambar Produk</label>
                        <input type="file" name="image" class="form-control" style="background-color: #D9D9D9;" />
                    </div>


                    <div class="col-md-12 mb-3">
                        <label for="">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" style="background-color: #D9D9D9;" placeholder="Masukkan Deskripsi Produk (Opsional)"></textarea>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label for="">Status (Unchecked=Visible, Cheked=Hidden)</label>
                        <br>
                        <input class="form-check-input border-0" type="checkbox" name="status" style="width:30px;height:30px; background-color:#D9D9D9">
                    </div>

                    <div class="col-md-6 text-end mb-2">
                        <br>
                        <button type="submit" name="saveProduct" class="btn btn-success" style="width: 150px;"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>