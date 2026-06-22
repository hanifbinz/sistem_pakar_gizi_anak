<?php
require_once "../config/config.php";
/** @var mysqli $con */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Hasil Diagnosa Gizi Buruk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        @media print {
            .no-print { display: none; }
        }
        body { color: black; background: white; padding: 20px; }
        .table th { background-color: #f8f9fa !important; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">LAPORAN HASIL DIAGNOSA</h2>
            <h4>Sistem Pakar Deteksi Gizi Buruk Pada Anak</h4>
            <hr style="border: 1px solid black;">
        </div>

        <table class="table table-bordered table-striped">
            <thead class="text-center">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Hasil Diagnosa Penyakit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $SqlQuery = mysqli_query($con, "SELECT * FROM hasil ORDER BY id_hasil DESC");
                $no = 1;
                if (mysqli_num_rows($SqlQuery) > 0) {
                    while ($row = mysqli_fetch_array($SqlQuery)) {
                ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td><?= $row['namapasien'] ?></td>
                            <td class="text-center"><?= $row['jeniskelamin'] ?></td>
                            <td><?= $row['hasildiagnosa'] ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan=\"4\" class=\"text-center\">Belum ada data diagnosa</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="text-right mt-5">
            <p>Dicetak pada: <?= date('d-m-Y H:i') ?></p>
            <br><br><br>
            <p>( ....................................... )</p>
        </div>

        <div class="text-center mt-4 no-print">
            <button onclick="window.print()" class="btn btn-primary btn-lg">Print Sekarang</button>
        </div>
    </div>
    
    <script>
        // Otomatis print saat halaman dimuat
        window.onload = function() { window.print(); }
    </script>
</body>
</html>