<?php 
include_once('headerpasien.php');
require_once "../config/config.php";
/** @var mysqli $con */
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil Pasien</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-primary">Data Diri Anda</h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover admin" id="admin">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Username</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Usia</th>
                                        <th width="15%" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $id_pasien = $_SESSION['id_pasien'];
                                    $SqlQuery = mysqli_query($con, "SELECT * From pasien where id_pasien = '$id_pasien'");
                                    $no = 1;
                                    if (mysqli_num_rows($SqlQuery) > 0) {
                                        while ($row = mysqli_fetch_array($SqlQuery)) {
                                    ?>
                                            <tr>
                                                <td><?= $no++ ?></td>
                                                <td class="font-weight-bold text-dark"><?= $row['nama_pasien'] ?></td>
                                                <td><span class="badge badge-light border"><?= $row['usernameuser'] ?></span></td>
                                                <td><?= $row['jk'] ?></td>
                                                <td><?= $row['usia'] ?></td>
                                                <td class="text-center">
                                                    <a href="editpasien.php?id=<?= $row['id_pasien'] ?>" class="btn btn-primary btn-sm" title="Edit Profil"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan=\"6\" align=\"center\">Data tidak ditemukan</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php include_once('footer.php'); ?>

<script>
    $(document).ready(function() {
        if ($('.admin').length > 0) { $('.admin').DataTable(); }
    });
</script>