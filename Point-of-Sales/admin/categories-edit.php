<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
    <div class="card-body">
            <h3 class="fw-bold">Edit Kategori
                <a href="categories.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <form action="code.php" method="POST">

                <?php
                $paramValue = checkParamId('id');
                if (!is_numeric($paramValue)) {
                    echo '<h5>' . $paramValue . '</h5>';
                    return false;
                }

                $category = getById('categories', $paramValue);
                if ($category['status'] == 200) {
                ?>

                    <input type="hidden" name="categoryId" value="<?= $category['data']['id']; ?>">

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="">Nama Kategori *</label>
                            <input type="text" name="name" value="<?= $category['data']['name']; ?>" required class="form-control" style="background-color:#D9D9D9;" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" style="background-color:#D9D9D9;"><?= $category['data']['description']; ?></textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="">Status (Unchecked=Visible, Cheked=Hidden)</label>
                            <br>
                            <input class="form-check-input border-0" type="checkbox" name="status" <?= $category['data']['status'] == true ? 'checked' : ''; ?> style="width:30px;height:30px; background-color:#D9D9D9;">
                        </div>

                        <div class="col-md-6 text-end mb-2">
                            <br>
                            <button type="submit" name="updateCategory" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan</button>
                        </div>
                    </div>
                <?php
                } else {
                    echo '<h5>' . $category['message'] . '</h5>';
                }

                ?>



            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>