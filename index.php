<?php require_once("config.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Programming YHC</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row vh-100">
            <div class="col-6 m-auto">
                <h2 class="mb-5 text-center">Admin Login</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputUsername">Username</label>
                        <input type="text" class="form-control" name="inputUsername" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" class="form-control" name="inputPassword" placeholder="Password">
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" name="btnLogin" value="Masuk" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>

<?php 

if(isset($_POST['btnLogin'])){

    $username = filter_input(INPUT_POST, 'inputUsername', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'inputPassword', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM admin WHERE admin_username=:username";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
    );

    $stmt->execute($params);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){

        // verifikasi password
        if( md5($password) == $user["admin_password"] ){

            session_start();
            $_SESSION["user"] = $user;

            header("Location: showMahasiswa.php");
        }
    }
}
?>
