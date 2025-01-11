<?php
include 'db_config.php';

// Ambil data berdasarkan ID
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM foodlist WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_makanan'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // Proses jika ada upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $target = "uploads/" . basename($gambar);

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target)) {
            $gambar_query = ", gambar='$target'";
        } else {
            echo "<script>alert('Gagal mengunggah gambar!');</script>";
            $gambar_query = "";
        }
    } else {
        $gambar_query = ""; // Jika tidak mengupload gambar baru
    }

    // Query Update Data
    $sql = "UPDATE foodlist SET nama_makanan='$nama', harga='$harga', deskripsi='$deskripsi' $gambar_query WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location='index.php';
              </script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Makanan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        h2 {
            color: #343a40;
            font-size: 2rem;
            margin-bottom: 30px;
            text-align: center;
        }
        .form-container {
            background: #ffffff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 40px;
            max-width: 600px;
            margin: 0 auto;
        }
        .form-container input, .form-container textarea {
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 15px;
            transition: box-shadow 0.3s ease-in-out;
        }
        .form-container input:focus, .form-container textarea:focus {
            box-shadow: 0 0 8px rgba(38, 143, 255, 0.6);
        }
        .form-container button {
            background-color: #ffc107;
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            font-size: 16px;
            width: 100%;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container button:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .form-container button:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(38, 143, 255, 0.6);
        }
        .mb-3 label {
            font-weight: bold;
            color: #343a40;
        }
        .mb-3 input, .mb-3 textarea {
            padding: 10px;
            font-size: 16px;
        }
        .mb-3 input[type="file"] {
            background: #f8f9fa;
            padding: 10px;
        }
        .form-container img {
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .form-container a {
            text-decoration: none;
            color: #007bff;
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .form-container a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="form-container">
            <h2><i class="fas fa-utensils"></i> Edit Data Makanan</h2>
            <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label class="form-label">Nama Makanan</label>
                    <input type="text" class="form-control" name="nama_makanan" value="<?= $row['nama_makanan'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" class="form-control" name="harga" value="<?= $row['harga'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" required><?= $row['deskripsi'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Saat Ini</label><br>
                    <img src="<?= $row['gambar'] ?>" class="rounded" width="150" alt="Gambar Makanan">
                </div>
                <div class="mb-3">
                    <label class="form-label">Upload Gambar Baru (Opsional)</label>
                    <input type="file" class="form-control" name="gambar">
                </div>
                <button type="submit" class="btn btn-warning">Perbarui</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
