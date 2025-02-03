<?php include('includes/header.php'); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow">
        <div class="card-body">
            <h3 class="fw-bold">List Admin
                <a href="admins-create.php" class="btn btn-success float-end fw-semibold"><i class="fa-solid fa-plus me-2"></i>Tambah Admin</a>
            </h3>
            <div class="col-md-12">
                <hr style="height: 3px; border: 0px; background-color: #000000;">
            </div>

            <?php alertMessages(); ?>

            <!-- Tampil Data -->
            <?php
            // Inisialisasi Nomor
            $i = 1;
            // Konfigurasi Pagination
            $limit = 10; // Jumlah data per halaman
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Ambil nomor halaman dari URL
            $offset = ($page - 1) * $limit; // Hitung offset

            // Query dengan LIMIT dan OFFSET
            $admins = getAllWithPagination('admins', $limit, $offset);

            // Hitung total data untuk pagination
            $totalRecords = getTotalRecords('admins'); // Fungsi untuk menghitung total data
            $totalPages = ceil($totalRecords / $limit); // Hitung total halaman

            if (!$admins) {
                echo '<h4>Sepertinya ada yang salah.</h4>';
                return false;
            }
            if (mysqli_num_rows($admins) > 0) {
            ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered text-center">
                        <thead style="background-color: #333333;" class="text-white">
                            <tr>
                                <th>#</th>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $adminItem) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $adminItem['id'] ?></td>
                                    <td><?= $adminItem['name'] ?></td>
                                    <td><?= $adminItem['email'] ?></td>
                                    <td><?= $adminItem['phone'] ?></td>
                                    <td>
                                        <a href="admins-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen me-1"></i>Edit</a>
                                        <a href="admins-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash me-1"></i>Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-12">
                    <hr style="height: 3px; border: 0px; background-color: #000000;">
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <!-- Tombol Previous -->
                        <?php if ($page > 1) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo; Previous</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Previous" tabindex="-1">
                                    <span aria-hidden="true">&laquo; Previous</span>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Nomor Halaman -->
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : ''; ?>">
                                <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endfor; ?>

                        <!-- Tombol Next -->
                        <?php if ($page < $totalPages) : ?>
                            <li class="page-item">
                                <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">Next &raquo;</span>
                                </a>
                            </li>
                        <?php else : ?>
                            <li class="page-item disabled">
                                <a class="page-link" href="#" aria-label="Next" tabindex="-1">
                                    <span aria-hidden="true">Next &raquo;</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            <?php
            } else {
                echo '<h4 class="mb-0">Data Kosong.</h4>';
            }
            ?>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>