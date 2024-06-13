<?php
include '../conn.php'; // Menghubungkan ke file koneksi database

$namaCourse = "";
$deskSingkat = "";
$emailMentor = "";
$sukses = "";
$error = "";


if (isset($_POST['simpan'])) {
    $namaCourse = $_POST['namaCourse'];
    $deskSingkat = $_POST['deskSingkat'];
    $emailMentor = $_POST['emailMentor'];

    
    if ($namaCourse != '' && $deskSingkat != '' && $emailMentor != '') {
        if (isset($_POST['id'])) {
            
            $id = $_POST['id'];
            $sql = "UPDATE course SET namaCourse='$namaCourse', deskSingkat='$deskSingkat', emailMentor='$emailMentor' WHERE id='$id'";
        } else {
           
            $sql = "INSERT INTO course (namaCourse, deskSingkat, emailMentor) VALUES ('$namaCourse', '$deskSingkat', '$emailMentor')";
        }

      
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            $sukses = "Data berhasil disimpan atau diupdate";
        } else {
            $error = "Gagal menyimpan atau mengupdate data";
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}


if (isset($_GET['op']) && $_GET['op'] == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM course WHERE id='$id'";
    $query = mysqli_query($koneksi, $sql);
    $data = mysqli_fetch_assoc($query);

   
    if ($data) {
        $namaCourse = $data['namaCourse'];
        $deskSingkat = $data['deskSingkat'];
        $emailMentor = $data['emailMentor'];
    } else {
        $error = "Data tidak ditemukan";
    }
}


if (isset($_GET['op']) && $_GET['op'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM course WHERE id='$id'";
    $query = mysqli_query($koneksi, $sql);

    if ($query) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Gagal menghapus data";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kursus</title>
    <style>
        /* Sesuaikan styling sesuai kebutuhan */
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-3">Kelola Kursus</h1>

        <!-- Form untuk input atau edit data -->
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo isset($_GET['op']) && $_GET['op'] == 'edit' ? $_GET['id'] : '' ?>">
            <div class="mb-3">
                <label for="namaCourse" class="form-label">Nama Course</label>
                <input type="text" class="form-control" id="namaCourse" name="namaCourse" value="<?php echo $namaCourse ?>">
            </div>
            <div class="mb-3">
                <label for="deskSingkat" class="form-label">Deskripsi Singkat</label>
                <textarea class="form-control" id="deskSingkat" name="deskSingkat"><?php echo $deskSingkat ?></textarea>
            </div>
            <div class="mb-3">
                <label for="emailMentor" class="form-label">Email Mentor</label>
                <input type="text" class="form-control" id="emailMentor" name="emailMentor" value="<?php echo $emailMentor ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </form>

        <!-- Menampilkan pesan sukses atau error -->
        <?php if ($sukses) : ?>
            <div class="alert alert-success mt-3" role="alert">
                <?php echo $sukses ?>
            </div>
        <?php endif; ?>
        <?php if ($error) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $error ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
