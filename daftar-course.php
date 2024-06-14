<?php
session_start();
include 'conn.php';
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$jumlahDataPerHalaman = 4;
$jumlahDataQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM course");
$jumlahData = mysqli_fetch_assoc($jumlahDataQuery)['total'];
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);

$halamanAktif = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$query = "SELECT course.idCourse, course.namaCourse, course.deskSingkat, course.emailMentor, users.nama FROM course, users WHERE course.emailMentor = users.email LIMIT $awalData, $jumlahDataPerHalaman";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        html {
            height: 220vh;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-image: linear-gradient(to right, #2f73b8, #336b89);
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }
        #daftar-kursus .container {
            display: flex;
            justify-content: center;
        }
        #footer {
            margin-top: auto;
            background: #102C57;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .footer-box1 {
            padding: 20px;
        }
        .footer-box2 {
            padding: 20px;
        }
        .footer-box1-img {
            width: 120px;
            margin-bottom: 20px;
        }
        .footer-box2 .fa {
            margin-right: 8px;
            font-size: 25px;
            height: 40px;
            width: 40px;
            text-align: center;
            padding-top: 7px;
            border-radius: 2px;
            background-image: linear-gradient(to right, #2f73b8, #336b89);
        }
        .tittle{
            color: #FFF;
        }
        .tittle::before{
            content:'';
            background: #FFF;
            height: 5px;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            display: block;
            transform: translateY(63px);
        }
        .tittle::after{
            content:'';
            background: #FFF;
            height: 10px;
            width: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 40px;
            display: block;
            transform: translateY(8px);
        }
    </style>
    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-custom" style="background-image: linear-gradient(to right, #2f73b8, #336b89);">
        <div class="container-fluid">
            <a class="navbar-brand" href="mentor/mentor-home.php #course" style="color: white; font-weight: 500;">
                <i class="fa-solid fa-chevron-left"></i> Kembali
            </a>
        </div>
    </nav>
    <section id="daftar-kursus">
        <div class="container">
            <div class="col-md-6">
                <h1 class="tittle text-center mt-3">COURSE</h1>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card text-center mt-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["namaCourse"]; ?></h5>
                        <p class="card-text"><?= $row["deskSingkat"]; ?></p>
                        <p class="card-text">Mentor: <?= $row["nama"]; ?></p>
                        <a href="course.php?id=<?= $row["idCourse"]; ?>" class="btn btn-primary">Pelajari</a>
                    </div>
                </div>
                <?php endwhile; ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3">
                        <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                        <li class="page-item <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                            <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <section id="footer">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-4 footer-box1">
                    <img src="img/logo-buku2.png" alt="" class="footer-box1-img">
                    <p style="font-weight: 500;">AMBATUCOURSE!</p>
                </div>
                <div class="col-md-4 footer-box2">
                    <p><b>CONTACT US</b></p>
                    <p><i class="fa fas fa-location-dot"></i> Gedong Tataan, Atlanta</p>
                    <p><i class="fa fas fa-phone"></i> +62 81273647666</p>
                    <p><i class="fa fas fa-envelope"></i> ambatucourse@gmail.com</p>
                    <p><i class="fa fa-brands fa-square-instagram"></i> @ambatucourse</p>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
