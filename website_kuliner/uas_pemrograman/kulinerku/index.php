<?php
include 'db_config.php';
$result = $conn->query("SELECT * FROM foodlist");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kulinerku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f1f1f1;
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #343a40;
            font-family: 'Arial', sans-serif;
            font-size: 2rem;
            text-transform: uppercase;
        }
        .table img {
            border-radius: 10px;
            width: 80px;
            height: 80px;
            object-fit: cover;
        }
        .btn {
            border-radius: 20px;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f8f9fa;
        }
        .container {
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 15px;
            padding: 30px;
            background: white;
            margin-top: 50px;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
            transform: scale(1.02);
            transition: transform 0.2s ease, background-color 0.2s ease;
        }
        .table-dark th {
            background-color: #343a40;
            color: white;
        }
        .table td {
            text-align: center;
            font-size: 14px;
        }
        .table thead th {
            font-size: 16px;
            font-weight: bold;
        }
        .table th, .table td {
            padding: 12px 15px;
        }
        .table {
            transition: all 0.3s ease;
        }
        .table td.deskripsi {
            text-align: left; /* Menambahkan alignment kiri untuk kolom deskripsi */
        }
        /* Menambah lebar kolom harga */
        .table .harga {
            width: 150px;
        }
        /* Menambahkan background warna secara acak pada baris */
        .table tbody tr:nth-child(even) {
            background-color: #d1ecf1; /* Biru muda */
        }
        .table tbody tr:nth-child(odd) {
            background-color: #f8d7da; /* Merah muda */
        }
        .table tbody tr:hover {
            background-color: #ffc107; /* Warna kuning saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><i class="fas fa-utensils"></i> Kulinerku</h1>
        <a href="tambah.php" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Tambah Makanan</a>
        <table class="table table-hover table-bordered table-striped" id="myTable">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Makanan</th>
                    <th class="harga">Harga</th> <!-- Menambahkan kelas 'harga' untuk mengatur lebar kolom -->
                    <th>Deskripsi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['nama_makanan'] ?></td>
                    <td class="harga">Rp <?= number_format($row['harga'], 0, ',', '.') ?></td> <!-- Memperbaiki format harga -->
                    <td class="deskripsi"><?= $row['deskripsi'] ?></td> <!-- Menambahkan class untuk alignment kiri -->
                    <td><img src="<?= $row['gambar'] ?>" alt="Gambar <?= $row['nama_makanan'] ?>"></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                        <a href="proses.php?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- DataTables dan Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        // Inisialisasi DataTable
        new DataTable('#myTable', {
            responsive: true,
            paging: true,
            searching: true,
            lengthChange: false,
            ordering: true,
            order: [[1, 'asc']] // Mengurutkan berdasarkan kolom nama makanan
        });
    </script>
</body>
</html>
