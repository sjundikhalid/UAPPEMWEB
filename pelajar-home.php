<?php
session_start();
include 'conn.php';
if (!isset($_SESSION['email']) || $_SESSION['roles'] !== 'pelajar') {
    header('Location: login.php');
    exit();
}

$jumlahDataPerHalaman = 3;
$jumlahDataQuery = mysqli_query($conn, "SELECT COUNT(*) as total from testimoni, users where testimoni.emailPelajar = users.email");
$jumlahData = mysqli_fetch_assoc($jumlahDataQuery)['total'];
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = isset($_GET["halaman"]) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

$result = mysqli_query($conn, "SELECT testimoni.isiTesti, users.nama from testimoni, users where testimoni.emailPelajar = users.email LIMIT $awalData, $jumlahDataPerHalaman");

$email = $_SESSION['email'];
if (isset($_POST['kirim-testi'])) { 
    $isiPesan = htmlspecialchars($_POST['isiPesan']);
            $query = "INSERT INTO testimoni (idTesti, isiTesti, emailPelajar) VALUES ('', '$isiPesan', '$email')";
            if (mysqli_query($conn, $query)) {
                echo "<script>
                            alert('Terimakasih atas reviewnya :)');
                            document.location.href = 'pelajar-home.php'; 
                            </script>";
            } else {
                echo "<script>
                        alert('Review Gagal Ditambahkan');
                        document.location.href = 'pelajar-home.php'; 
                        </script>";
            }
}

$sql_mentor = "SELECT COUNT(*) as total_mentor FROM users WHERE roles = 'mentor'";
$result_mentor = mysqli_query($conn, $sql_mentor);

$sql_pelajar = "SELECT COUNT(*) as total_pelajar FROM users WHERE roles = 'pelajar'";
$result_pelajar = mysqli_query($conn, $sql_pelajar);

$sql_kursus = "SELECT COUNT(*) as total_kursus FROM course";
$result_kursus = mysqli_query($conn, $sql_kursus);

$sql_materi = "SELECT COUNT(*) as total_materi FROM materi";
$result_materi = mysqli_query($conn, $sql_materi);

$total_mentor = 0;
$total_pelajar = 0;
$total_kursus = 0;
$total_materi = 0;

if (mysqli_num_rows($result_mentor) > 0) {
    $row = mysqli_fetch_assoc($result_mentor);
    $total_mentor = $row["total_mentor"];
}

if (mysqli_num_rows($result_pelajar) > 0) {
    $row = mysqli_fetch_assoc($result_pelajar);
    $total_pelajar = $row["total_pelajar"];
}
if (mysqli_num_rows($result_kursus) > 0) {
    $row = mysqli_fetch_assoc($result_kursus);
    $total_kursus = $row["total_kursus"];
}

if (mysqli_num_rows($result_materi) > 0) {
    $row = mysqli_fetch_assoc($result_materi);
    $total_materi = $row["total_materi"];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffff;
        }
        #banner{
            background-image: linear-gradient(to right, #2f73b8, #336b89);
            color: white;
            padding-top: 5%;
        }
        .promo-tittle{
            font-size: 40px;
            font-weight: 600;
            margin-top: 100px;
        }
        #featured{
            background: white;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        #featured .row {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        #testi{
            background: white;
            padding-top: 50px;
            padding-bottom: 50px;
        }
        #testi .row {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .tittle{
            color: #2f73b8;
        }
        .tittle::before{
            content:'';
            background: #2f73b8;
            height: 5px;
            width: 200px;
            margin-left: auto;
            margin-right: auto;
            display: block;
            transform: translateY(63px);
        }
        .tittle::after{
            content:'';
            background: #2f73b8;
            height: 10px;
            width: 50px;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 40px;
            display: block;
            transform: translateY(8px);
        }
        .card{
            transition: all 0.3s ease-in-out;
        }
        .card:hover{
            transform: translateY(-5px);
        }
        .card-title{
            color: white;
            font-size:28px;
        }
        .card-subtitle{
            color: white;
        }
        .card-text{
            color: black;
        }
        #course{
            background: #ffff;
            padding-bottom: 50px;
            padding-top: 50px;
        }
        .courses-tittle{
            font-size: 40px;
            font-weight: 800;
            margin-top: 8%;
        }
        #course ul li{
            margin: 10px 0;
        }
        #course ul{
            margin-left: 20px;
        }
        .span{
            color: #2f73b8;
            font-weight: bold;
        }
        #about-us{
            padding-top: 50px;
            padding-bottom: 50px;
        }
        .parag-about-us{
            font-size: 17px;
            text-align: center;
        }
        #footer{
            background-image: linear-gradient(to right, #2f73b8, #336b89);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            text-align: center;
        }
        .footer-box1{
            padding: 20px;
        }
        .footer-box2{
            padding: 20px;
        }
        .footer-box1-img{
            width: 120px;
            margin-bottom: 20px;
        }
        .footer-box2 .fa{
            margin-right: 8px;
            font-size: 25px;
            height: 40px;
            width: 40px;
            text-align: center;
            padding-top:7px;
            border-radius:2px;
            background-image: linear-gradient(to right, #2f73b8, #336b89);
        }
    </style>
    <title>Mentor</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top navbar-custom " style="background-image: linear-gradient(to right, #2f73b8, #336b89);">
        <div class="container-fluid">
            <a class="navbar-brand" href="mentor-home.php" style="color: white; font-weight: 500;">
                <img src="img/logo-buku2.png" alt="Bootstrap" width="30" height="30">Ambatucourse
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" style="color: white; font-weight: 500;" href="#banner" >Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="color: white; font-weight: 500;" href="#featured">Featured</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="color: white; font-weight: 500;" href="#course">Course</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="color: white; font-weight: 500;" href="#about-us">About Us</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" style="color: white; font-weight: 500;" href="#testi">Review</a>
                </li>
            </ul>
            <a class="nav-link" style="color: white; font-weight: 500;" href="logout.php" >Log Out</a>
            </div>
        </div>
    </nav>
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="promo-tittle">Selamat Datang, Pelajar!</p>
                    <p><span>Ambatucourse</span> hadir untuk menyelesaikan tugas akhir Praktikum PemWeb</p>
                </div>
                <div class="col-md-6 text-center">
                    <img src="img/logo-buku2.png" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="featured">
        <div class="container px-4 text-center">
            <h1 class="tittle text-center">FEATURED</h1>
            <div class="row gx-5">
                <div class="card p-3" style="width: 15rem; height:10rem; background: #2f73b8; box-shadow: 5px 10px 18px #888888;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_pelajar; ?></h5>
                        <h6 class="card-subtitle mb-2">Pelajar Terdaftar</h6>
                        <p class="card-text">yayay</p>
                    </div>
                </div>
                <div class="card p-3" style="width: 15rem; height:10rem; background: #2f73b8; box-shadow: 5px 10px 18px #888888;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_mentor; ?></h5>
                        <h6 class="card-subtitle mb-2">Mentor Terdaftar</h6>
                        <p class="card-text">yayay</p>
                    </div>
                </div>
                <div class="card p-3" style="width: 15rem; height:10rem; background: #2f73b8; box-shadow: 5px 10px 18px #888888;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_kursus; ?></h5>
                        <h6 class="card-subtitle mb-2">Kursus Tersedia</h6>
                        <p class="card-text">yayay</p>
                    </div>
                </div>
                <div class="card p-3" style="width: 15rem; height:10rem; background: #2f73b8; box-shadow: 5px 10px 18px #888888;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $total_materi; ?></h5>
                        <h6 class="card-subtitle mb-2">Materi Tersedia</h6>
                        <p class="card-text">yayay</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="course">
        <div class="container">
            <h1 class="tittle text-center">COURSES</h1>
            <div class="row">
                <div class="col-md-6 courses">
                    <p class="courses-tittle" style="color: #2f73b8">Apa saja yang ada disini?</p>
                    <ul>
                        <li>PHP Dasar</li>
                        <li>C++ Dasar</li>
                        <li>HTML Dasar</li>
                        <li>CSS Dasar</li>
                    </ul>
                    <a class="tombol-course btn btn-primary" href="daftar-course.php" role="button">Jelajahi</a>
                </div>
                <div class="col-md-6">
                    <img src="img/gambarmeja.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <section id="about-us">
        <div class="container">
            <h1 class="tittle text-center">ABOUT US</h1>
            <p class="parag-about-us">
                <span class="span text-center">Ambatucourse</span> percaya bahwa pendidikan adalah kunci 
                untuk membuka potensi dan mendorong kesuksesan. Misi kami adalah menyediakan konten pendidikan 
                berkualitas tinggi yang mudah diakses, sehingga para pelajar dapat mencapai tujuan pribadi dan profesional
                mereka.
            </p>
            <h3 class="text-center" style="color:#2f73b8;">Visi Kami</h3>
            <p class="parag-about-us">Visi kami adalah menciptakan komunitas belajar yang cinta akan pengetahuan. Kami berusaha untuk terus 
                berkembang dan mengikuti perkembangan zaman untuk menyesuaikan kebutuhan para pelajar.</p>
            <h3 class="text-center" style="color:#2f73b8;">Misi Kami</h3>
            <p class="parag-about-us">Menyediakan kursus online berkualitas tinggi di berbagai disiplin ilmu. 
                <br> Menciptakan lingkungan belajar yang mendukung dan interaktif. </p>
        </div>
    </section>
    <section id="testi">
        <div class="container px-4 text-center">
            <h1 class="tittle text-center">REVIEW</h1>
            <div class="row gx-5">
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <div class="card p-3" style="width: 15rem; height:10rem; background: #2f73b8; box-shadow: 5px 10px 18px #888888;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $row["nama"]; ?></h5>
                        <p class="card-text"><?= $row["isiTesti"]; ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
            <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3">
                        <?php for($i = 1; $i <= $jumlahHalaman; $i++): ?>
                        <li class="page-item <?= ($i == $halamanAktif) ? 'active' : ''; ?>">
                            <a class="page-link" href="?halaman=<?= $i; ?>#testi"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
        </div>
    </section>
    <section id="footer">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-4 footer-box1">
                    <img src="img/logo-buku2.png" alt="" class="footer-box1-img">
                    <p style="font-weight: 500;">AMBATUCOURSE!</p>
                    <form action="" method="POST">
                        <div class="input-group mb-3">
                            <textarea type="text" class="form-control" placeholder="Pengalaman anda (200)" name="isiPesan" aria-label="Recipient's username" aria-describedby="button-addon2" maxlength="200"></textarea> 
                            <button class="btn btn-success" name="kirim-testi" type="submit" id="button-addon2">Button</button>
                        </div>
                    </form>
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