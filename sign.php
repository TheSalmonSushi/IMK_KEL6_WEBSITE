<?php 
 
include 'test.php';
 
error_reporting(0);
 
session_start();
if (isset($_SESSION['nama'])) {
  header("Location: asu.php");
}
$email = $_POST['email'];
$password = $_POST['password'];

if(isset($_POST['email']) && isset($_POST['password'])){
if (isset($_POST['submit'])) {
    
 
    $sql = "SELECT * FROM daftar_nama WHERE email='$email' AND password='$password'";
    $params = array();
    $options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
    $result = sqlsrv_query($conn, $sql,$params,$options);
    $num_rows = sqlsrv_num_rows($result);
    
    if ($num_rows >0) {
        $row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_ASSOC);
        $_SESSION['nama'] = $row['nama'];
        echo "<script>alert('bisa masuk')</script>";
        header("Location: asu.php");
        
        
      
    } else {
      echo "<script>alert('salah')</script>";
      header("Location: sign.php");
     
    }
}}

 
?>
<!DOCTYPE html>
<head><link rel="preconnect" href="https://fonts.googleapis.com">
  <script src="https://kit.fontawesome.com/d25e0764f2.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="login.css">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet"></head>
<body>
<div class="alert alert-warning" role="alert">
        <?php echo $_SESSION['error']?>
    </div>
<header>
  <div class="header">
    <div class="nama">BUGAR</div>
    <div class="menu-list">
      <ul>
        <li>Tentang Kita</li>
        <li >Layanan</li>
        <li >Resep</li>
        <li>Beranda</li>
  </div>
</header>
<form action="" method="post">


  <div class="container1">
      <h1 style="text-align: center;">Selamat Datang</h1>
        
        
            <div class="rapi" style="text-align: center;">
            <label for="uname"><b>Email</b></label><br>
            <input type="text" placeholder="Masukkan Email" name="email" value="<?php echo $email; ?>" required><br>
            <label for="psw"><b>Kata Sandi</b></label><br>
            <input type="password" placeholder="Masukkan Kata Sandi" name="password" value="<?php echo $_POST['password']; ?>" required><br>
            <button type="submit" name="submit" >Masuk</button><br>
            <button type="daftar"  onclick="location.href='daftar.php'" >Daftar Dulu</button><br>
            </div>
        
  </div>

</form>
  
  
</body>
</html>