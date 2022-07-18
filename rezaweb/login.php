<?php 
session_start();
require 'functions.php';


// cek cookie untuk admin
if (!isset($_COOKIE['$pws5d']) && isset($_COOKIE['$ssl'])) {
    $key = $_COOKIE['$ssl'];

    // ambil data admin berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM admin");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash("sha256", $row['username'])) {
        $_SESSION['admin'] = true;     
    }
}

// cek session

if (isset($_SESSION["admin"])) {
    header("Location: index.php");
    exit;
}


 if (isset($_POST["login"])) {
  
  $username = $_POST["username"];
  $password = $_POST["password"];

  $admin = query("SELECT * FROM admin");
  foreach ($admin as $a) {}

  
  if ($username == $a["username"]) {
    $result = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username'");


  if (mysqli_num_rows($result) === 1 ) {
    

    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {

            // set session

            $_SESSION["login"] = true;
            $_SESSION["admin"] = true;
            $_SESSION["username"] = $username;

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie
                // $pws5d dan $ssl artinya adalah id dan username, disamarkan agar tidak mudah ditebak oleh penjahat
                setcookie('$ssl', hash('sha256', $row['username']), time()+3600);
                
                // buat login : 
                // user ID : reza
                // password : admin123

            }

      header("Location: index.php");
      exit;
    }

  } 

}

$error = true;
  
}

?>
<!DOCTYPE html>
<html>
<head>

    
    <title>Silahkan login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/login.css">

        
        <link rel="apple-touch-icon" href="http://qsr.richeesefactory.com/images/ico/favicon.png">


    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="maximum-scale=5, width=device-width">
    <meta name="description" content="Back Office & Outlet Richeese Factory">
    <meta name="keywords" content="back office, apps rf, apps.richeesefactory.com, richeese factory, apps, web apps, web apps richeese factory">
    <meta name="author" content="richeese factory">
    <meta name="csrf-token" content="yS3Ho8wG1od2jWjJ8QMeA5dAKWhZWn71KsHyzY4j">


    <link rel="apple-touch-icon" href="http://qsr.richeesefactory.com/images/ico/favicon.png">
    <link rel="shortcut icon" type="image/x-icon" href="http://qsr.richeesefactory.com/images/ico/favicon.ico">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600&display=swap&display=swap" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,600&display=swap&display=swap" media="print" onload="this.media='all'" />
     


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Icon dari Fontawesome -->
    <script src="https://kit.fontawesome.com/348c676099.js" crossorigin="anonymous"></script>
    <title>Silahkan Login</title>
    <style>
        #content {
            width: 100%;
            padding: 0 350px;
        }
        @media screen and (max-width: 1000px) {
            #content {
                padding: 0 10px;
            }
        }
        body {
          background-image: url("images/bg.jpeg");
          background-size: contain;
        }
    </style>
</head>

<body>

    <header>
        <div class="jumbotron">
        <div class="container fadeIn first d-flex wrapper">
            <div class="row content m-auto">
                <div class="col-md-6 m-auto">
                    <img width=100 height=100 src="../phprezaa/logo.jpg" class="img-fluid animated">
        </div>
            <h3> Richeese Factory <i class="fab fa-accusoft"></i></h3>
        </div>
    </header>

    <main>
        
        <div id="content">
            <h2 class="judul">Login</h2>
            <article class="card">
                <form action="" method="post">
                    <div class="jarak">
                         <label for="username">Username</label>
                         <input type="text" id="username" name="username" placeholder="Masukkan Username" required>
                    </div>
                    <div class="jarak">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>
                    </div>
                    <button type="submit" name="login" class="btn" style="width: 100%;">Login</button>
                </form>
            </article>

        </div>
    </main>
    

    <footer>
        <p>&#169 Richeese Factory <i class="fab fa-accusoft"></i> 2022</p>
    </footer>
</body>
</html>
