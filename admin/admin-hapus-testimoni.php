<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['email']) || $_SESSION['roles'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_GET['id'])) {
  echo "<script>
          alert('Tidak ada ID yang dipilih');
          document.location.href = 'admin-kelola-mentor.php';
        </script>";
  exit();
}

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
