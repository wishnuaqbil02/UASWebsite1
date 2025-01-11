<?php
include 'db_config.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM foodlist WHERE id=$id");
    echo "<script>alert('Data berhasil dihapus!'); window.location='index.php';</script>";
}
?>
