<?php
include '../conn.php';
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