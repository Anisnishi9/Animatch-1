<?php
include('koneksi.php');
if (isset($_POST['daftar'])){
  $username = $_POST['username'];
  $username = htmlspecialchars($username, ENT_QUOTES);
  $pass = $_POST['password'];
  $pass = htmlspecialchars($pass, ENT_QUOTES);
  $nick = $_POST['nickname'];
  $nick = htmlspecialchars($nick, ENT_QUOTES);
  $stringfoto = $_POST['nickname'];
  $stringfoto = htmlspecialchars($stringfoto, ENT_QUOTES);
  $choice = $_POST['choice'];
  if ($choice == "male") { 
    $gender = "Male";              
  }
  else if ($choice == "female") { 
    $gender = "Female";         
  }
  $temp = explode('.', $_FILES['images']['name']);
  $ekstensi = pathinfo($_FILES['images']['name'], PATHINFO_EXTENSION);
  move_uploaded_file($_FILES['images']['tmp_name'],'photos/'.$stringfoto.'.'. end($temp));
}
$cekuser = mysqli_query($db,"SELECT * FROM user WHERE username = '$username'");
if(mysqli_num_rows($cekuser) > 0) {
  echo "<script>alert('Username Sudah Terdaftar!');window.location='daftar.php'</script>";
} else {
  if(!$username || !$pass) {
    echo "<script>alert('Data Belum Lengkap!');window.location='daftar.php'</script>";
  } else {
    $simpan = mysqli_query($db,"INSERT INTO user(username, password, nickname, gender, foto) VALUES('$username','$pass', '$nick', '$gender', '".$stringfoto.'.'.end($temp)."')");
    if($simpan) {
      echo "<script>alert('Pendaftaran Sukses!');window.location='login.php'</script>";
    } else {
      echo "<script>alert('Proses Gagal!');window.location='daftarpatch.php'</script>";
    }
  }
}
?>