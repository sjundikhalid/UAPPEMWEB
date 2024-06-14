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
$query = "DELETE FROM users WHERE email='$id'";
mysqli_query($conn, $query);
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Pelajar Berhasil Dihapus');
            document.location.href = 'admin-kelola-pelajar.php';
          </script>";
} else {
    echo "<script>
            alert('Data Pelajar Gagal Dihapus');
            document.location.href = 'admin-kelola-pelajar.php';
          </script>";
}
?>
