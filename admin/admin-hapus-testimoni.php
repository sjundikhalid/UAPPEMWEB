<?php
include '../conn.php';

$id = $_GET['id'];
$query = "DELETE FROM testimoni WHERE idTestimoni='$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Testimoni Berhasil Dihapus');
            document.location.href = 'admin-kelola-testimoni.php';
          </script>";
} else {
    echo "<script>
            alert('Data Testimoni Gagal Dihapus');
            document.location.href = 'admin-kelola-testimoni.php';
          </script>";
}
?>
