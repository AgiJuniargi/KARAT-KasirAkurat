<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h3 class="fw-bold">Edit Admin
                <a href="admins.php" class="btn btn-warning float-end fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Kembali</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>
            
            <form action="code.php" method="POST">

                <?php
                // if(isset($_GET['id']))
                // {
                //     if($_GET['id'] == '')
                //     {
                //         $adminId = $_GET['id'];
                //     }else{
                //         echo '<h5>ID Tidak Ditemukan.</h5>';
                //         return false;
                //     }
                // }
                // else
                // {
                //     echo '<h5>Tidak Ada ID di URL.</h5>';
                //     return false;
                // }

                if (isset($_GET['id']) && !empty($_GET['id'])) {
                    $adminId = $_GET['id'];
                } else {
                    echo '<h5>Parameter ID tidak ditemukan.</h5>';
                    return false;
                }

                $adminData = getById('admins', $adminId);
                if ($adminData) {
                    if ($adminData['status'] == 200) {
                ?>
                        <input type="hidden" name="adminId" value="<?= $adminData['data']['id']; ?>">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="">Nama Lengkap *</label>
                                <input type="text" name="name" required value="<?= $adminData['data']['name']; ?>" class="form-control" style="background-color:#D9D9D9;" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Email *</label>
                                <input type="email" name="email" required value="<?= $adminData['data']['email']; ?>" class="form-control" style="background-color:#D9D9D9;" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Password *</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password Baru Disini Jika Ingin Mengubah Password" style="background-color:#D9D9D9;" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="">Nomor Telepon</label>
                                <input type="number" name="phone" value="<?= $adminData['data']['phone']; ?>" class="form-control" style="background-color:#D9D9D9;" />
                            </div>
                            <div class="col-md-12 mt-2 mb-3 text-end">
                                <button type="submit" name="updateAdmin" class="btn btn-success"><i class="fa-solid fa-floppy-disk me-2"></i>Simpan Perubahan</button>
                            </div>
                        </div>
                <?php
                    } else {
                        echo '<h5>' . $adminData['message'] . '</h5>';
                    }
                } else {
                    echo 'Sepertinya ada yang salah.';
                    return false;
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>