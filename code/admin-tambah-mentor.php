<?php
include 'conn.php';
if (isset($_POST['tambah'])) { 
    $idMentor = htmlspecialchars($_POST['idMentor']);
    $namaMentor = htmlspecialchars($_POST['namaMentor']);
    $emailMentor = htmlspecialchars($_POST['emailMentor']);
    $checkMentor = "SELECT * FROM mentor WHERE idMentor='$idMentor'";
    $checkResult = mysqli_query($conn, $checkMentor);
    if (mysqli_num_rows($checkResult) > 0) {
        echo "<script>
                alert('ID Mentor Sudah Ada, Tolong Gunakan ID yang Lain');
                document.location.href = 'admin-tambah-mentor.php'; 
                </script>";
    }
    else{
    $query = "INSERT INTO mentor (idMentor, namaMentor, emailMentor) VALUES ('$idMentor', '$namaMentor', '$emailMentor')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
                    alert('Data Mentor Berhasil Ditambahkan');
                    document.location.href = 'admin-kelola-mentor.php'; 
                    </script>";
        } else {
            echo "<script>
                    alert('Data Mentor Gagal Ditambahkan');
                    document.location.href = 'admin-tambah-mentor.php'; 
                    </script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style-admin-kelola-mentor.css">
    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li>
                <a href="admin-dashboard.php">
                    <i class="fas fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="admin-kelola-mentor.php">
                    <i class="fas fa-user"></i>
                    <span>Mentor</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="far fa-user"></i>
                    <span>Peserta</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-star"></i>
                    <span>Kursus</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-book"></i>
                    <span>Materi</span>
                </a>
            </li>
            <li>
                <a href="">
                    <i class="fas fa-feather"></i>
                    <span>Kursus diambil</span>
                </a>
            </li>
            <li class="logout">
                <a href="">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="main--content">
        <div class="header--wrapper">
            <div class="header--title">
                <h2>Kelola Mentor</h2>
            </div>
        </div>
        <div class="tambah--container">
            <h1 class="text-center pb-3">Tambah Mentor</h1>
            <form action="" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name="idMentor" placeholder="ID Mentor" required>
                    <label for="floatingInput">ID Mentor</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" name ="namaMentor" placeholder="Nama Mentor" required>
                    <label for="floatingInput">Nama Mentor</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" name="emailMentor" placeholder="Email Mentor" required>
                    <label for="floatingInput">Email Mentor</label>
                </div>
                <button type="submit" name="tambah" class="btn btn-success" style="float : right;">Tambah</button>
                <a href="admin-kelola-mentor.php"  class="btn btn-success" style="float : left;">Kembali</a>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>