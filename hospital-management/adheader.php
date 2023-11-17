<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>HMS - Admin</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="assets/plugins/morrisjs/morris.css" rel="stylesheet" />
    
    <!-- Custom Css -->
    <link href="assets/css/main.css" rel="stylesheet">
    <!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/themes/all-themes.css" rel="stylesheet" />
    <!-- Bootstrap Material Datetime Picker Css -->

</head>

<body class="theme-cyan">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-cyan">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Espere un momento...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Morphing Search  -->

    <!-- Top Bar -->
    <nav class="navbar clearHeader">
        <div class="col-12">
            <div class="navbar-header"> <a href="javascript:void(0);" class="bars"></a> <a class="navbar-brand"
                    href="#">Hospital Medi-sena</a> </div>
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li>
                    <a data-placement="bottom" title="Full Screen" href="logout.php"><i
                            class="zmdi zmdi-sign-in"></i></a>
                </li>               

            </ul>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- esto es si el admin esta logueado le va a mostrar este menu -->
            <?php
                if(isset($_SESSION['adminid']))
                {
            ?>
            <!--Admin Menu -->
            <div class="menu">
                <ul class="list" style="overflow: hidden; width: auto; height: calc(-184px + 100vh);">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li class="active open"><a href="adminaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Panel</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Perfil</span> </a>
                        <ul class="ml-menu">
                            <li><a href="adminprofile.php">Perfil del administrador</a></li>
                            <li><a href="adminchangepassword.php">Cambiar contraseña</a></li>
                            <li><a href="admin.php">Añadir Administrador</a></li>
                            <li><a href="viewadmin.php">Ver Administrador</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Cita</span> </a>
                        <ul class="ml-menu">
                            <li><a href="appointment.php">Nueva cita</a></li>
                            <li><a href="viewappointmentpending.php">Ver citas pendientes</a>
                            </li>
                            <li><a href="viewappointmentapproved.php">Ver citas aprobadas</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Doctor</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctor.php">Añadir doctor</a>
                            </li>
                            <li><a href="viewdoctor.php">Ver Doctor</a></li>
                            
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Pacientes</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patient.php">Añadir paciente</a></li>
                            <li><a href="viewpatient.php">Ver el historial del paciente</a></li>
                        </ul>
                    </li>


                    <li> <a href="javascript:void(0);" class="menu-toggle toggled waves-effect waves-block"><i
                                class="zmdi zmdi-copy"></i><span>Servicio</span> </a>
                        <ul class="ml-menu" style="display: block;">
                            <li><a href="department.php" class=" waves-effect waves-block">Añadir departamento</a></li>
                            <li><a href="viewdepartment.php" class=" waves-effect waves-block">Ver Departamento</a></li>
                            <li><a href="treatment.php" class=" waves-effect waves-block">Añadir tipo de tratamiento</a></li>
                            <li><a href="viewtreatment.php" class=" waves-effect waves-block">Ver tipos de tratamiento</a></li>
                            <li><a href="medicine.php" class=" waves-effect waves-block">Añadir medicamentos</a></li>
                            <li><a href="viewmedicine.php" class=" waves-effect waves-block">Ver Medicina</a></li>
                        </ul>
                    </li>

                    
                </li>

                </ul>
            </div>
            <!-- Admin Menu -->
            <?php }?>


            <!-- doctor Menu -->
            <!-- esto es si el doctor esta logueado le va a mostrar este menu -->

            <?php
            if(isset($_SESSION['doctorid']))
            {
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li class="active open"><a href="doctoraccount.php"><i
                                class="zmdi zmdi-home"></i><span>Panel</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Perfil</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctorprofile.php">Perfil</a></li>
                            <li><a href="doctorchangepassword.php">Cambiar contraseña</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Cita</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewappointmentpending.php" style="width:250px;">Ver citas pendientes</a>
                            </li>
                            <li><a href="viewappointmentapproved.php" style="width:250px;">Ver citas aprobadas</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Doctor</span> </a>
                        <ul class="ml-menu">
                            
                            <li><a href="doctortimings.php">Añadir hora de visita</a></li>
                            <li><a href="viewdoctortimings.php">Ver la hora de visita</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Pacientes</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewpatient.php">Ver Paciente</a>
                            </li>
                        </ul>
                    </li>

                    <li> <a href="viewdoctorconsultancycharge.php"><i class="zmdi zmdi-copy"></i><span>Informe de ingresos</span> </a></li>


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-copy"></i><span>Servicio</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">Ver registros de tratamiento</a></li>
                            <li><a href="viewtreatment.php">Ver tratamiento</a></li>
                        </ul>
                    </li>

                </ul>
            </div>

            <?php }; ?>
            <!-- doctor Menu -->




            <!-- patient Menu -->
            <!-- esto es si el paciente esta logueado le va a mostrar este menu -->

            <?php
            if(isset($_SESSION['patientid']))
            {
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li class="active open"><a href="patientaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Panel</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Perfil</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patientprofile.php">Ver perfil</a></li>
                            <li><a href="patientchangepassword.php">Cambiar la contraseña</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Cita</span> </a>
                        <ul class="ml-menu">
                            <li><a href="appointment.php" >Agregar cita</a></li>
                            <li><a href="viewappointment.php" >Ver cita</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Prescripción</span> </a>
                        <ul class="ml-menu">
                            <li><a  href="patviewprescription.php">Ver registros de prescripción</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Tratamiento</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">Ver registros de tratamiento</a></li>
                    </li>
                </ul>
                </li>


                </ul>
            </div>

            <?php }; ?>
            <!-- patient Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
     
    </section>
     <section class="content home">
