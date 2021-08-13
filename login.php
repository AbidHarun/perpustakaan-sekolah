<?php
    error_reporting(0);
    ob_start();
    
    session_start();


  $koneksi = new mysqli("localhost","root","","db_perpustakaan");

  if($_SESSION['admin'] || $_SESSION['petugas']){
        header("location:index.php");
        }

  else{

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sisfo Perpustakaan SMPN 2 Suwawa</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        
                        <div class="row">
                            <div class="col-lg-12 d-none d-lg-block"></div>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Perpustakaan SMP Negeri 2 Suwawa</h1>
                                    </div>
                                    <form class="user" method="POST">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Masukkan Username" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" placeholder="Masukkan Password" name="pass">
                                        </div>
                                        <input type="submit" class="btn btn-primary btn-user btn-block"  name="login" value="Login" />
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>

   
</body>
</html>


<?php

if (isset($_POST['login'])) {

        $nama=$_POST['nama'];
        $pass=$_POST['pass'];

        $ambil = $koneksi->query("SELECT * from tb_user where username='$nama' and password=md5('$pass')");
        $data = $ambil->fetch_assoc();
        $ketemu = $ambil->num_rows;

        if($ketemu >=1){
                                        
            session_start();
            
            $_SESSION[username] = $data [username];
            $_SESSION[pass] = $data [password];
            $_SESSION[level] = $data [level];
            
            if($data['level'] == "admin"){
                $_SESSION['admin'] = $data[id];
                header("location:index.php");
            }else if($data['level'] == "petugas"){
                $_SESSION['petugas'] = $data[id];
                header("location:index.php");    
            }

        } else{
    ?>
            <script type="text/javascript">
            alert("Username dan Password Anda Salah");
            </script>
    <?php
        }
}
}
?>