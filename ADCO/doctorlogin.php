<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");

include("dbconnection.php");
if(isset($_SESSION['doctorid']))
{
	echo "<script>window.location='doctoraccount.php';</script>";
}
$err='';
if(isset($_POST['submit']))
{
	$sql = "SELECT * FROM doctor WHERE loginid='$_POST[loginid]' AND password='$_POST[password]' AND status='Activo'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rslogin = mysqli_fetch_array($qsql);
		$_SESSION['doctorid']= $rslogin['doctorid'] ;
		echo "<script>window.location='doctoraccount.php';</script>";
	}
	else
	{
		$err = "<div class='alert alert-danger'>
		<strong>Oh !</strong> Cambie algunas cosas e intente enviarlo de nuevo.
	</div>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>ADCO ~ Login Odontologo </title>
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link rel="icon" href="images/adcologo.png" type="image/x-icon">
<!-- Custom Css -->
<link href="assets/css/main.css" rel="stylesheet">
<link href="assets/css/login.css" rel="stylesheet">

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="assets/css/themes/all-themes.css" rel="stylesheet" />
</head>
<body class="theme-cyan login-page authentication">
<!-- header section -->



<div class="container">
	<div id = "err"><?php echo $err;
	
?></div>
    <div class="card-top"></div>
    <div class="card">
        <h1 class="title"><span>Sistema de Gestión Hospitalaria</span>Login <span class="msg">Hola, Odontologo!</span></h1>
        <div class="col-md-12">

    <form method="post" action="" name="frmadminlogin" id="sign_in" onSubmit="return validateform()">
    <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-account"></i> </span>
                    <div class="form-line">
					<input type="text" name="loginid" id="loginid" class="form-control" placeholder="Usuario" /></div>
                </div>
                <div class="input-group"> <span class="input-group-addon"> <i class="zmdi zmdi-lock"></i> </span>
                    <div class="form-line">
					<input type="password" name="password" id="password" class="form-control"  placeholder="Contraseña" /> </div>
                </div>
                <div>
                    <div class="">
                        <input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Recuérdame</label>
                    </div>
                    <div class="text-center">
					<input type="submit" name="submit" id="submit" value="Iniciar sesión" class="btn btn-raised waves-effect g-bg-cyan" /></div>
                    <div class="text-center"> <a href="Forgotpassword.php">¿Ha olvidado su contraseña?</a></div>
                </div>
            </form>
        </div>
    </div>    
</div>
 <div class="clear"></div>
 <div class="theme-bg"></div>
  </div>
</div>
<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
</body>
</html>
<script type="application/javascript">
var alphaExp = /^[a-zA-Z]+$/; //Variable to validate only alphabets
var alphaspaceExp = /^[a-zA-Z\s]+$/; //Variable to validate only alphabets and space
var numericExpression = /^[0-9]+$/; //Variable to validate only numbers
var alphanumericExp = /^[0-9a-zA-Z]+$/; //Variable to validate numbers and alphabets
var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/; //Variable to validate Email ID 

function validateform()
{
	if (document.frmdoctlogin.loginid.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'El ID de inicio de sesión no debe estar vacío.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctlogin.loginid.focus();
    return false;
}
else if (!document.frmdoctlogin.loginid.value.match(alphanumericExp)) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'Login ID no válido.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctlogin.loginid.focus();
    return false;
}
else if (document.frmdoctlogin.password.value == "") {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La contraseña no debe estar vacía.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctlogin.password.focus();
    return false;
}
else if (document.frmdoctlogin.password.value.length < 8) {
    Swal.fire({
        position: 'top-center',
        icon: 'error',
        title: 'La longitud de la contraseña debe ser superior a 8 caracteres.',
        showConfirmButton: false,
        timer: 2000,
    });
    document.frmdoctlogin.password.focus();
    return false;
}
	
}
</script>