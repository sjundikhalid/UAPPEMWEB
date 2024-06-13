<?php
include '../conn.php';
$sql_mentor = "SELECT COUNT(*) as total_mentor FROM users WHERE roles = 'mentor'";
$result_mentor = mysqli_query($conn, $sql_mentor);

$sql_pelajar = "SELECT COUNT(*) as total_pelajar FROM users WHERE roles = 'pelajar'";
$result_pelajar = mysqli_query($conn, $sql_pelajar);

$total_mentor = 0;
$total_pelajar = 0;

if (mysqli_num_rows($result_mentor) > 0) {
    $row = mysqli_fetch_assoc($result_mentor);
    $total_mentor = $row["total_mentor"];
}

if (mysqli_num_rows($result_pelajar) > 0) {
    $row = mysqli_fetch_assoc($result_pelajar);
    $total_pelajar = $row["total_pelajar"];
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
        *{
        margin: 0;
        padding: 0;
        border: none;
        outline: none;
        box-sizing: border-box;
        }
        body{
            display: flex;
        }
        .sidebar{
            position: sticky;
            top: 0;
            left: 0;
            bottom: 0;
            width: 130px;
            height: 100vh;
            padding: 0 1.7rem;
            color: white;
            overflow: hidden;
            transition: all 0.5s linear;
            background: #2f73b8;
        }
        .sidebar:hover{
            width: 250px;
            transition: 0.5s;
        }
        .logo{
            height: 80px;
            padding: 16px;
        }
        .menu{
            height: 88%;
            position: relative;
            list-style: none;
            padding: 0;
        }
        .menu li{
            padding: 1rem;
            margin: 8px;
            border-radius: 8px;
            transition: all 0.5s ease-in-out;
        }
        .menu li:hover, .active{
            background: rgb(255, 255, 255);
        }
        .menu a{
            color: black;
            font-size: 14px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }
        .menu a span{
            overflow: hidden;
        }
        .menu a i{
            font-size: 1.2rem;
        }
        .logout{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
        .main--content{
            position: relative;
            background: rgb(255, 255, 255);
            width: 100%;
            padding: 1rem;
        }
        .header--wrapper{
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 10px;
            padding: 10px 1rem;
            margin-bottom: 1rem;
        }
        .header--title{
            color: rgb(0, 0, 0);
        }
        .card--container{
            background: #2f73b8;
            padding: 1rem;
            border-radius: 10px;
        }
        .card--wrapper{
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .main--title{
            color: black;
            padding-bottom: 10px;
            font-size: 24px;
        }
        .main--card{
            background: rgb(255, 255, 255);
            border-radius: 10px;
            padding: 1.2rem;
            width: 281px;
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.5s ease-in-out;
        }
        .main--card:hover{
            transform: translateY(-5px);
        }
        .card--header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .amount{
            display: flex;
            flex-direction: column;
        }
        .title{
            font-size: 20px;
            font-weight: 200;
        }
        .amount--value{
            font-size: 24px;
            font-weight: 600;
        }
        .icon{
            color: white;
            padding: 1rem;
            height: 60px;
            width: 60px;
            text-align: center;
            border-radius: 50%;
            font-size: 1.5rem;
        }
        .card--detail{
            font-size: 18px;
            color: #777777;
            letter-spacing: 2px;
        }
        .light--red{
            background: red;
        }
        .light--green{
            background: green;
        }
        .light--blue{
            background: blue;
        }
        .light--yellow{
            background: yellow;
        }
    </style>
    <title>Admin</title>
</head>
<body>
    <div class="sidebar">
        <div class="logo"></div>
        <ul class="menu">
            <li class="active">
                <a href="admin-dashboard.php">
                    <i class="fas fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
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
                <h2>Dashboard</h2>
            </div>
        </div>
        <div class="card--container">
            <h1 class="main--title">Data Hari Ini</h1>
            <div class="card--wrapper">
                <div class="main--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Jumlah Mentor
                            </span>
                            <span class="amount--value"><?php echo $total_mentor; ?></span>
                        </div>
                        <i class="fas fa-user icon light--red"></i>
                    </div>
                    <span class="card--detail">owakoawk</span>
                </div>
                <div class="main--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Jumlah Pelajar
                            </span>
                            <span class="amount--value"><?php echo $total_pelajar; ?></span>
                        </div>
                        <i class="far fa-user icon light--green"></i>
                    </div>
                    <span class="card--detail">owakoawk</span>
                </div>
                <div class="main--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Jumlah Kelas
                            </span>
                            <span class="amount--value">3</span>
                        </div>
                        <i class="fas fa-star icon light--blue"></i>
                    </div>
                    <span class="card--detail">owakoawk</span>
                </div>
                <div class="main--card">
                    <div class="card--header">
                        <div class="amount">
                            <span class="title">
                                Jumlah Materi
                            </span>
                            <span class="amount--value">3</span>
                        </div>
                        <i class="fas fa-book icon light--yellow"></i>
                    </div>
                    <span class="card--detail">owakoawk</span>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>