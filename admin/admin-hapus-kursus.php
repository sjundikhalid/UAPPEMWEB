<?php
include '../conn.php';
$id = $_GET['id'];
$query = "DELETE FROM course WHERE idCourse='$id'";
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Kursus Berhasil Dihapus');
            document.location.href = 'admin-daftar-kursus.php';
          </script>";
} else {
    echo "<script>
            alert('Data Kursus Gagal Dihapus');
            document.location.href = 'admin-daftar-kursus.php';
          </script>";
}
?>
