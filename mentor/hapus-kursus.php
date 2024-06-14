<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['email']) || $_SESSION['roles'] !== 'mentor') {
    header('Location: ../login.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>
            alert('Tidak ada ID yang dipilih');
            document.location.href = 'kelola-kursus.php';
            </script>";
    exit();
}

$id = $_GET['id'];
$query = "DELETE FROM course WHERE idCourse='$id'";
mysqli_query($conn, $query);
if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Data Course Berhasil Dihapus');
            document.location.href = 'kelola-kursus.php';
            </script>";
} else {
    echo "<script>
            alert('Data Course Gagal Dihapus');
            document.location.href = 'kelola-kursus.php';
            </script>";
}
?>