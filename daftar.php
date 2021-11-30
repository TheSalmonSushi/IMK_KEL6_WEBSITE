<?php 
 
include 'test.php';
 
error_reporting(0);
 
session_start();
 
if (isset($_SESSION['nama'])) {
    header("Location: index.php");
}
 
if (isset($_POST['signup'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    //$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $password =$_POST['password'];
 
    
        $sql = "SELECT * FROM daftar_nama WHERE email='$email'";
        $result =  sqlsrv_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO daftar_nama( email,nama, password)
                    VALUES ( ?,?, ?)";
            $params = array($email,$nama,$password);
            $result =  sqlsrv_query($conn, $sql,$params);
            echo(print_r(sqlsrv_errors(), true));
            if ($result) {
                header("Location: sign.php");
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $nama = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Email Sudah Terdaftar.')</script>";
        }
         
    
}
 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Sekarang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="signup.css">
</head>
<body>
    <header><div class="header">
        <div class="nama">BUGAR</div>
        <div class="menu-list">
          <ul>
            <li>Tentang Kita</li>
            <li >Layanan</li>
            <li >Resep</li>
            <li>Beranda</li>
      </div></header>
      <main>
      <form action="" method="post">
        
          <div class="container1">
              <h1 style="text-align: center;">Form Pendaftaran</h1>
                <div class="grup"><li><i class="fas fa-user-tie fa-10x"></i></li>
                </div>
                    <div class="rapi">
                    <label for="uname"><b>Email</b></label><br>
                    <input type="text" placeholder="Masukkan Email" name="email" value="<?php echo $email; ?>" required><br>
                    <label for="name"><b>Nama</b></label><br>
                    <input type="text" placeholder="Masukkan nama" name="nama" value="<?php echo $nama; ?>" required><br>
                    <label for="psw"><b>Kata Sandi</b></label><br>
                    <input type="password" placeholder="Masukkan Kata Sandi" name="password" value="<?php echo $_POST['password']; ?>" required><br>
                    <label for="psw"><b>Konfirmasi Sandi</b></label><br>
                    <input type="password" placeholder="Konfirmasi Kata Sandi" name="cpassword" value="<?php echo $_POST['cpassword']; ?>" required><br>
                    <button type="signup" onclick="location.href='sign.php'" name="signup" >Daftar</button>
                    
                  </div>
                
          </div>
        </main>      
</body>
</html>