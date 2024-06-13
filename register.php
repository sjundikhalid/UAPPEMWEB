<?php
include 'conn.php';

if (isset($_POST['register'])) { 
    $email = htmlspecialchars($_POST['email']);
    $nama = htmlspecialchars($_POST['nama']);
    $nomorHP = htmlspecialchars($_POST['nomorHP']);
    $passwords = htmlspecialchars($_POST['passwords']);
    $confirmPasswords = htmlspecialchars($_POST['confirmPasswords']);
    $check = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $check);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Email Ini Sudah Pernah Mendaftar, Tolong Gunakan email yang Lain');
                document.location.href = 'register.php'; 
                </script>";
    } elseif ($passwords !== $confirmPasswords) {
        echo "<script>
                alert('Konfirmasi Password Tidak Cocok, Ulangi Pendaftaran');
                document.location.href = 'register.php'; 
                </script>";
    } else {
        $hashed_password = password_hash($passwords, PASSWORD_DEFAULT); 
        $query = "INSERT INTO users (email, nama, nomorHP, roles, passwords) VALUES ('$email', '$nama', '$nomorHP', 'pelajar', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                        alert('Berhasil Mendaftar, Silahkan Login.');
                        document.location.href = 'login.php'; 
                        </script>";
            } else {
                echo "<script>
                        alert('Pendaftaran Gagal, Mohon Ulangi Pendataran.');
                        document.location.href = 'register.php'; 
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
    <title>Register</title>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            background-color: #dddddd;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        span{
            color: #2A629A;
            font-weight: bolder;
        }
    </style>
</head>
<body>
    <div class="container rounded-4 pt-5" style="height: 100%; width: 100%;">
        <div class="container rounded-4" style="background-color: white; height: 500px;">
            <h1 class="text-center pt-2">Register</h1>
            <p class="text-center pb-2">Daftarkan akun anda untuk login ke <span>Ambatucourse</span></p>
            <form action="" method="post">
                <div class="form-floating m-1">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating m-1">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nama" required>
                    <label for="floatingInput">Nama Lengkap</label>
                </div>
                <div class="form-floating m-1">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="nomorHP" required>
                    <label for="floatingInput">Nomor HP</label>
                </div>
                <div class="form-floating m-1">
                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="passwords" required>
                    <label for="floatingInput">Password</label>
                </div>
                <div class="form-floating m-1">
                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="confirmPasswords" required>
                    <label for="floatingInput">Confirm Password</label>
                </div>
                <a href="login.php" class="btn btn-outline-primary m-1" style="float: left;">Kembali</a>
                <button type="submit" name="register" class="btn btn-outline-primary m-1" style="float: right;">Register</button>
            </form>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>