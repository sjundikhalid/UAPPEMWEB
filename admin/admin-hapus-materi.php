<?php
include '../conn.php';
$id = $_GET['id'];
$query = "DELETE FROM materi WHERE idMateri='$id'";
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Materi Berhasil Dihapus');
            document.location.href = 'admin-daftar-materi.php';
          </script>";
} else {
    echo "<script>
            alert('Data Materi Gagal Dihapus');
            document.location.href = 'admin-daftar-materi.php';
          </script>";
}
?>
