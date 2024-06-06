<?php
include 'conn.php';
$id = $_GET['id'];
$query = "DELETE FROM mentor WHERE idMentor='$id'";
mysqli_query($conn, $query);
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Mentor Berhasil Dihapus');
            document.location.href = 'admin-kelola-mentor.php';
          </script>";
} else {
    echo "<script>
            alert('Data Mentor Gagal Dihapus');
            document.location.href = 'admin-kelola-mentor.php';
          </script>";
}
?>