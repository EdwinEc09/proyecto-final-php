<?php
session_start();
error_reporting(0);
include("dbconnection.php");
$dt = date("Y-m-d");
$tim = date("H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>HMS</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<!-- JQuery DataTable Css -->
<link href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
<link href="assets/css/main.css" rel="stylesheet">
<!-- Custom Css -->

<!-- Swift Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="assets/css/themes/all-themes.css" rel="stylesheet" />
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    href="#">Hospital Hospital Medi-Sena</a> </div>
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
            <?php
                if(isset($_SESSION['adminid']))
                {
            ?>
            <!--Admin Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">NAVEGACIÓN PRINCIPAL</li>
                    <li class="active open"><a href="adminaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Panel</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Perfil</span> </a>
                        <ul class="ml-menu">
                            <li><a href="adminprofile.php">Panel Del Administrador</a></li>
                            <li><a href="adminchangepassword.php">Cambiar Contraseña</a></li>
                            <li><a href="admin.php">Añadir Administración</a></li>
                            <li><a href="viewadmin.php">Ver Administrador</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Cita</span> </a>
                        <ul class="ml-menu">
                            <li><a href="appointment.php">Nueva Cita</a></li>
                            <li><a href="viewappointmentpending.php">Ver Pacientes Pendientes</a>
                            </li>
                            <li><a href="viewappointmentapproved.php">Ver Citas
                                    Aprobadas</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Doctor</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctor.php">Añadir Doctor</a>
                            </li>
                            <li><a href="viewdoctor.php">Ver Doctor</a></li>
                           
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Pacientes</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patient.php">Añadir Paciente</a></li>
                            <li><a href="viewpatient.php">Ver El Historial Del Paciente</a></li>
                        </ul>
                    </li>


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings-square"></i><span>Servicio</span> </a>
                        <ul class="ml-menu">
                            <li><a href="department.php">Añadir Departamento</a></li>
                            <li><a href="viewdepartment.php">Ver Departamento</a></li>
                            <li><a href="treatment.php">Añadir Tipo De Tratamiento</a></li>
                            <li><a href="viewtreatment.php">Ver Tipos De Tratamiento</a></li>
                            <li><a href="medicine.php">Añadir Medicamentos</a></li>
                            <li><a href="viewmedicine.php">Ver Medicina</a></li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Admin Menu -->
            <?php }?>


            <!-- doctor Menu -->
            <?php
            if(isset($_SESSION['doctorid']))
            {
            ?>
            <!-- <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="doctoraccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="doctorprofile.php">Profile</a></li>
                            <li><a href="doctorchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Appointment</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewappointmentpending.php" style="width:250px;">View Pending Appointments</a>
                            </li>
                            <li><a href="viewappointmentapproved.php" style="width:250px;">View Approved
                                    Appointments</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Doctors</span> </a>
                        <ul class="ml-menu">
                           
                            <li><a href="doctortimings.php">Add Visiting Hour</a></li>
                            <li><a href="viewdoctortimings.php">View Visiting Hour</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Patients</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewpatient.php">View Patient</a>
                            </li>
                        </ul>
                    </li>

                    <li> <a href="viewdoctorconsultancycharge.php"><i class="zmdi zmdi-copy"></i><span>Income
                                Report</span> </a></li>


                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-settings-square"></i><span>Service</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">View Treatment Records</a></li>
                            <li><a href="viewtreatment.php">View Treatment</a></li>
                        </ul>
                    </li>

                </ul>
            </div> -->

            <?php }; ?>
            <!-- doctor Menu -->




            <!-- patient Menu -->
            <?php
            if(isset($_SESSION['patientid']))
            {
            ?>
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active open"><a href="patientaccount.php"><i
                                class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>


                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Profile</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patientprofile.php">View Profile</a></li>
                            <li><a href="patientchangepassword.php">Change Password</a></li>
                        </ul>
                    </li>

                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-calendar-check"></i><span>Appointment</span> </a>
                        <ul class="ml-menu">
                            <li><a href="patientappointment.php" >Add Appointment</a></li>
                            <li><a href="viewappointment.php" >View Appointments</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-add"></i><span>Prescription</span> </a>
                        <ul class="ml-menu">
                            <li><a  href="patviewprescription.php">View Prescription Records</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-account-o"></i><span>Treatment</span> </a>
                        <ul class="ml-menu">
                            <li><a href="viewtreatmentrecord.php">View Treatment Records</a></li>
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
