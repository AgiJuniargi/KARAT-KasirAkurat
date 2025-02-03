<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h3 class="fw-bold">Tambah Admin
                <a href="admins.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <form action="code.php" method="POST">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">Nama Lengkap *</label>
                        <input type="text" name="name" required class="form-control" style="background-color:#D9D9D9;" placeholder="Masukkan Nama Lengkap" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                        <input type="email" name="email" required class="form-control" style="background-color:#D9D9D9;" placeholder="Masukkan Email (Contoh: budi@email.com)" />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password *</label>
                        <input type="password" name="password" required class="form-control" style="background-color:#D9D9D9;" placeholder="Masukkan Password" />
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Nomor Telepon</label>
                        <input type="number" name="phone" class="form-control" style="background-color:#D9D9D9;" placeholder="Masukkan Nomor Telepon (Contoh: 081XXXXXXXXX)" />
                    </div>
                    <div class="col-md-12 mt-2 mb-2 text-end">
                        <button type="submit" name="saveAdmin" class="btn btn-success" style="width: 150px;"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>