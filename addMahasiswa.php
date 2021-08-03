<?php

require_once("auth.php");
require_once("config.php");

if(isset($_POST['btnTambah'])) {

    $nim = filter_input(INPUT_POST, 'inputNIM', FILTER_SANITIZE_STRING);
    $nama = filter_input(INPUT_POST, 'inputNama', FILTER_SANITIZE_STRING);
    $program_studi = filter_input(INPUT_POST, 'inputProgramStudi', FILTER_SANITIZE_STRING);
    $no_hp = filter_input(INPUT_POST, 'inputNomorHP', FILTER_SANITIZE_STRING);

    // (mahasiswa_nim, mahasiswa_nama, mahasiswa_program_studi, mahasiswa_no_hp)
    $sql = 'INSERT INTO mahasiswa VALUES (:nim, :nama, :program, :nohp)';
    $stmt = $db->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":nim"      => $nim,
        ":nama"     => $nama,
        ":program"  => $program_studi,
        ":nohp"     => $no_hp,
    );

    $stmt->execute($params);

    header("Location: showMahasiswa.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- DataTable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/0f57000d88.js" crossorigin="anonymous"></script>
</head>
<body>
<header class="bg-light">
    <div class="container p-0">
        <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
            <a class="navbar-brand" href="#">Dashboard</a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="showMahasiswa.php">Mahasiswa<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="showNilai.php">Nilai Mahasiswa</a>
                </li>
            </ul>
            <div class="justify-content-end">
                <ul class="navbar-nav mr-auto">  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?php echo $_SESSION["user"]["admin_photo"] ?>" alt="" style="height: 32px; border-radius:50%">
                            <?php echo $_SESSION["user"]["admin_username"] ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="logout.php">Keluar</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    </header>
    <div class="container my-5 mx-auto">
        <div class="card col-md-8 p-0 mx-auto">
            <div class="card-header">
                <h3 class="text-center">Tambah Data Mahasiswa</h3>
            </div>
            <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="inputNIM" class="col-sm-3 col-form-label text-right">NIM</label>
                    <div class="col-sm-9">
                        <input type="text" name="inputNIM" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNama" class="col-sm-3 col-form-label text-right">Nama Mahasiswa</label>
                    <div class="col-sm-9">
                    <input type="text" name="inputNama" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputProgramStudi" class="col-sm-3 col-form-label text-right">Program Studi</label>
                    <div class="col-sm-9">
                    <input type="text" name="inputProgramStudi" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNomorHP" class="col-sm-3 col-form-label text-right">Nomor HP</label>
                    <div class="col-sm-9">
                    <input type="text" name="inputNomorHP" class="form-control">
                    </div>
                </div>
                <div class="row justify-content-end">
                    <div class="col-sm-9">
                        <input type="submit" name="btnTambah" class="btn btn-primary" value="Tambah">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
</body>
</html>