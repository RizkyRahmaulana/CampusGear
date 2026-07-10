<?php
session_start();
require 'config/koneksi.php';

if(isset($_SESSION['login'])){
    header("Location: dashboard.php");
    exit;
}

$error = "";

if(isset($_POST['login'])){

    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn,"
        SELECT *
        FROM admin
        WHERE username='$username'
        AND password='$password'
    ");

    if(mysqli_num_rows($query)==1){

        $data = mysqli_fetch_assoc($query);

        $_SESSION['login']=true;
        $_SESSION['nama']=$data['nama'];

        header("Location: dashboard.php");
        exit;

    }else{

        $error="Username atau Password Salah!";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>CampusGear Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

display:flex;
justify-content:center;
align-items:center;
height:100vh;
background:linear-gradient(135deg,#2563eb,#1d4ed8);
overflow:hidden;

}

body::before{

content:"";
position:absolute;
width:450px;
height:450px;
background:rgba(255,255,255,.08);
border-radius:50%;
top:-150px;
right:-120px;

}

body::after{

content:"";
position:absolute;
width:350px;
height:350px;
background:rgba(255,255,255,.08);
border-radius:50%;
left:-120px;
bottom:-120px;

}

.login-card{

position:relative;
width:430px;
background:white;
border-radius:25px;
overflow:hidden;
box-shadow:0 25px 60px rgba(0,0,0,.3);
z-index:10;

}

.top-area{

background:linear-gradient(135deg,#2563eb,#1d4ed8);
padding:35px;
text-align:center;
color:white;

}

.logo{

width:85px;
height:85px;
border-radius:50%;
background:white;
padding:10px;
object-fit:contain;
box-shadow:0 8px 20px rgba(0,0,0,.2);

}

.title{

margin-top:15px;
font-size:30px;
font-weight:bold;

}

.subtitle{

font-size:14px;
opacity:.9;

}

.login-body{

padding:30px;

}

.input-group{

margin-bottom:18px;

}

.input-group-text{

background:#2563eb;
color:white;
border:none;

}

.form-control{

height:50px;

}

.form-control:focus{

box-shadow:none;
border-color:#2563eb;

}

.btn-login{

height:52px;
font-weight:bold;
font-size:17px;
border-radius:10px;
background:#2563eb;
border:none;
transition:.3s;

}

.btn-login:hover{

background:#1d4ed8;

}

.footer{

text-align:center;
margin-top:20px;
font-size:13px;
color:#666;

}

</style>

</head>

<body>

<div class="login-card">

    <div class="top-area">

        <img src="assets/img/logo.png"
             class="logo"
             alt="CampusGear">

        <h2 class="title">
            Kelompok 5
        </h2>

        <p class="subtitle">
            Sistem Peminjaman Alat Kampus
        </p>

<div class="mt-4">

    <div class="card border-0 shadow-sm bg-light">

        <div class="card-body py-2">

            <h6 class="text-primary text-center mb-3">

                <i class="bi bi-people-fill"></i>

                Kelompok 5

            </h6>

            <p class="mb-1 text-dark">

                <strong>Rizky Rahmaulana</strong> - 243510063

            </p>

            <p class="mb-1 text-dark">

                <strong>Lastio Alfiardi</strong> - 243510628

            </p>

            <p class="mb-0 text-dark">

                <strong>Hasta Aguz Permadi</strong> - 243510497

            </p>

        </div>

    </div>

</div>

    </div>

    <div class="login-body">

        <?php if($error!=""){ ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="bi bi-exclamation-circle-fill"></i>

            <?= $error; ?>

            <button
            class="btn-close"
            data-bs-dismiss="alert"></button>

        </div>

        <?php } ?>

        <form method="POST">

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-person-fill"></i>

                </span>

                <input
                type="text"
                name="username"
                class="form-control"
                placeholder="Masukkan Username"
                required>

            </div>

            <div class="input-group">

                <span class="input-group-text">

                    <i class="bi bi-lock-fill"></i>

                </span>

                <input
                type="password"
                name="password"
                id="password"
                class="form-control"
                placeholder="Masukkan Password"
                required>

                <button
                class="btn btn-outline-secondary"
                type="button"
                onclick="lihatPassword()">

                    <i
                    id="iconPassword"
                    class="bi bi-eye-fill"></i>

                </button>

            </div>

            <div class="d-grid mt-4">

                <button
                type="submit"
                name="login"
                class="btn btn-login">

                    <i class="bi bi-box-arrow-in-right"></i>

                    LOGIN

                </button>

            </div>

        </form>

        <div class="footer">

            <hr>

            <strong>CampusGear Inventory System</strong>

            <br>

            Universitas Islam Riau

            <br>


        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>

function lihatPassword(){

    let password=document.getElementById("password");

    let icon=document.getElementById("iconPassword");

    if(password.type==="password"){

        password.type="text";

        icon.classList.remove("bi-eye-fill");

        icon.classList.add("bi-eye-slash-fill");

    }else{

        password.type="password";

        icon.classList.remove("bi-eye-slash-fill");

        icon.classList.add("bi-eye-fill");

    }

}

const input=document.querySelectorAll(".form-control");

input.forEach(function(x){

    x.addEventListener("focus",function(){

        this.parentElement.style.transform="scale(1.02)";

        this.parentElement.style.transition=".3s";

    });

    x.addEventListener("blur",function(){

        this.parentElement.style.transform="scale(1)";

    });

});

</script>

</body>

</html>