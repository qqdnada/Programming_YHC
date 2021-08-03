<?php

require_once("auth.php");
require_once("config.php");

$sql = "SELECT * FROM nilai_mahasiswa";
$stmt = $db->prepare($sql);

$stmt->execute();
$nilai_mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);

$nilai_info = [];

if ($nilai_mahasiswa) {
    foreach($nilai_mahasiswa as $nilai) {

        $sql_mahasiswa = "SELECT mahasiswa_nama FROM mahasiswa WHERE mahasiswa_nim=:nim";
        $stmt_mahasiswa = $db->prepare($sql_mahasiswa);
        $stmt_mahasiswa->bindParam(':nim', $nilai['mahasiswa_nim'], PDO::PARAM_INT);

        $stmt_mahasiswa->execute();
        $nama_mahasiswa = $stmt_mahasiswa->fetch(PDO::FETCH_ASSOC);

        $info_nilai = [
            'id'                => $nilai['nilaimahasiswa_id'],
            'nama_mahasiswa'    => $nama_mahasiswa['mahasiswa_nama'],
            'mata_kuliah'       => $nilai['nilaimahasiswa_mata_kuliah'],
            'nilai'             => $nilai['nilaimahasiswa_nilai'],
        ];
        
        array_push($nilai_info, $info_nilai);
    }
}

if(isset($_POST['btnHapus'])) {
    
    $id = filter_input(INPUT_POST, 'inputID', FILTER_SANITIZE_STRING);

    $sql = "DELETE FROM nilai_mahasiswa WHERE nilaimahasiswa_id=:id";

    // prepare the statement for execution
    $statement = $db->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);

    // execute the statement
    if ($statement->execute()) {
        header("Location: showNilai.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Mahasiswa - Programming YHC</title>

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
                <li class="nav-item">
                    <a class="nav-link" href="showMahasiswa.php">Mahasiswa</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="showNilai.php">Nilai Mahasiswa<span class="sr-only">(current)</span></a>
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

    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <!-- <button type="button" class="btn btn-outline-dark"><i class="fas fa-arrow-left mr-2"></i>Kembali</button> -->
                <div class="row mx-1 justify-content-between align-items-center">
                    <h1 class="my-5">Data Nilai Mahasiswa</h1>
                    <a href="addNilai.php" class="btn btn-primary" style="height: fit-content;"><i class="fas fa-plus mr-2"></i>Tambah Nilai Mahasiswa</a>
                </div>
            </div>
            
        </div>
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Nama Mahasiswa</th>
                <th>Mata Kuliah</th>
                <th>Nilai</th>
                <th>Grade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($nilai_info as $n) { ?>
            <tr>
                <td><?php echo $n["nama_mahasiswa"]?></td>
                <td><?php echo $n["mata_kuliah"]?></td>
                <td><?php echo $n["nilai"]?></td>
                <td><?php
                    if ($n["nilai"] >= 85) {
                        echo "A";
                    } elseif ($n["nilai"] >= 75) {
                        echo "B";
                    } elseif ($n["nilai"] >= 65) {
                        echo "C";
                    } elseif ($n["nilai"] >= 50) {
                        echo "D";
                    } else {
                        echo "E";
                    }?>
                </td>
                <td>
                    <a href="editNilai.php?id=<?php echo $n['id']?>" class="btn btn-primary btn-sm">Ubah</a>
                    <button type="button" onclick="getId(<?php echo $n['id']?>)" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModalCenter">Hapus</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Apakah Anda yakin ingin menghapus data ini?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <form action="" method="post">
                <input type="hidden" name="inputID">
                <button type="submit" class="btn btn-danger" name="btnHapus">Hapus Data</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <script>
        function getId(id) {
            const inputId = document.getElementsByName('inputID')[0];
            inputId.setAttribute("value", id);
        }
    </script>
</body>
</html>