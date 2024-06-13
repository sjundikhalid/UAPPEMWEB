<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["login"])) {
    $email = htmlspecialchars($_POST['email']);
    $passwords = htmlspecialchars($_POST['passwords']);

    $stmt = $conn->prepare("SELECT email, nama, nomorHP, roles, passwords FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($passwords, $user['passwords'])) {
        $_SESSION['email'] = $user['email'];
        $_SESSION['roles'] = $user['roles'];

        if ($user['roles'] == 'admin') {
            header('Location: admin/admin-dashboard.php');
        } else if ($user['roles'] == 'mentor') {
            header('Location: mentor/mentor-home.php');
        } else if ($user['roles'] == 'pelajar'){
            header('Location: pelajar-home.php');
        }
        exit();
    } else {
        echo "<script>alert('Login gagal: email atau password salah.'); window.location.href = 'login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
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
        .container{
            background-color: #ffffff;
            display: flex;
            height: 500px;
            width: 800px;
            margin: auto;
            margin-top: 50px;
            border-radius: 25px;
            box-shadow: 0 5px 9px rgba(0, 0, 0, 0.1);
        }
        .gambar{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50%;
        }
        .gambar img{
            width: 100%;
            height: 90%;
            object-fit: cover;
            border-radius: 25px;
        }
        .formlogin{
            display: flex;
            justify-content: center;
            flex-direction: column;
            width: 50%;
            align-items: center;
        }
        .formlogin h1{
            margin: 10px;
            
        }
        .formlogin span{
            color: #2A629A;
            font-weight: bolder;
        }
        .formlogin .forminput{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        button{
            padding: 12px 30px;
            width: 150px;
            margin-top: 20px;
            background-color: #2A629A;
            color: white;
            border: none;
            border-radius: 25px;
            font-weight: bolder;
        }
        button:hover{
            cursor: pointer;
            background-color: #003285;
        }
    </style>
</head>
<body>
    <div class="container">   
        <div class="gambar">
            <img src="img/tom.png" alt="">
        </div>
        <div class="formlogin">
            <h1>Hello!</h1>
            <p>Selamat Datang di <span>Ambatucourse</span>, Silahkan Login.</p>
            <form action="" class="forminput" method="post">
                <div class="form-floating m-1">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" required>
                    <label for="floatingInput">Email</label>
                </div>
                <div class="form-floating m-2 pb-3">
                    <input type="password" class="form-control" id="floatingInput" placeholder="name@example.com" name="passwords" required>
                    <label for="floatingInput">Password</label>
                </div>
                <p>Belum punya akun? Silahkan <a href="register.php">Daftar</a></p>
                <button type="submit" name="login">LOG IN</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>