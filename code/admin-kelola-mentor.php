<?php
include 'conn.php';
$result = mysqli_query($conn, "SELECT * FROM mentor");
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
        <div class="table--container">
            <a href="admin-tambah-mentor.php" class="btn btn-primary mb-2">Tambah Mentor</a>
            <div class="table-responsive">
                <table id="example" class="table table-light table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">ID Mentor</th>
                            <th scope="col">Nama Mentor</th>
                            <th scope="col">Email Mentor</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row["idMentor"]; ?></td>
                            <td><?= $row["namaMentor"]; ?></td>
                            <td><?= $row["emailMentor"]; ?></td>
                            <td>
                                <a href="admin-edit-mentor.php?id=<?= $row["idMentor"]; ?>" class="btn btn-success">Edit</a>
                                <a href="admin-hapus-mentor.php?id=<?= $row["idMentor"]; ?>" onclick="return confirm('Apakah mau menghapus data?');" class="btn btn-danger">Delete</a>    
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>